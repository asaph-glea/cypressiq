<?php

namespace App\Services;

use App\Mail\LeadAlertMail;
use App\Models\Booking;
use App\Models\ContactSetting;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadAlertService
{
    /**
     * Dispatch multi-channel alerts (Email, Telegram/Webhook, System Log)
     */
    public static function dispatchAlert(string $type, array $payload, string $priority = 'medium'): void
    {
        // 1. Resolve Admin Notification Email
        try {
            $settings = ContactSetting::first();
            $adminEmail = $settings->company_email ?? config('mail.from.address', 'admin@cypressiq.agency');

            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new LeadAlertMail($type, $payload, $priority));
            }
        } catch (\Throwable $e) {
            Log::warning("LeadAlertService: Mail dispatch failed gracefully: " . $e->getMessage());
        }

        // 2. Dispatch Telegram Bot Instant Push (if configured)
        try {
            self::sendTelegramPush($type, $payload, $priority);
        } catch (\Throwable $e) {
            Log::warning("LeadAlertService: Telegram push failed gracefully: " . $e->getMessage());
        }

        // 3. Dispatch Discord Webhook (if configured)
        try {
            self::sendDiscordWebhook($type, $payload, $priority);
        } catch (\Throwable $e) {
            Log::warning("LeadAlertService: Discord webhook failed gracefully: " . $e->getMessage());
        }

        // 4. Dispatch Generic Webhook (e.g. Slack / Zapier / Make.com)
        try {
            self::sendGenericWebhook($type, $payload, $priority);
        } catch (\Throwable $e) {
            Log::warning("LeadAlertService: Generic webhook failed gracefully: " . $e->getMessage());
        }

        // 5. Log Structured Lead Event
        Log::channel('single')->info("CypressIQ Lead Alert Dispatched [{$type}]", [
            'type'            => $type,
            'priority'        => $priority,
            'payload'         => $payload,
            'timestamp'       => now()->toIso8601String(),
            'lifecycle_stage' => 'alert_dispatched',
        ]);
    }

    /**
     * Send instant formatted Telegram push message with direct deep links
     */
    protected static function sendTelegramPush(string $type, array $payload, string $priority): void
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId   = env('TELEGRAM_CHAT_ID');

        if (empty($botToken) || empty($chatId)) {
            return;
        }

        $badge = match ($type) {
            'booking' => '📅 *STRATEGY CALL BOOKED*',
            'inquiry' => '🎯 *NEW PROJECT INQUIRY*',
            'overdue' => '⚠️ *SLA FOLLOW-UP OVERDUE*',
            default   => '⚡ *NEW LEAD CAPTURED*',
        };

        $lines = [
            "🚨 {$badge}",
            "━━━━━━━━━━━━━━━━━━━━━━",
            "• *Client:* " . ($payload['name'] ?? 'Direct Lead'),
            "• *Email:* " . ($payload['email'] ?? 'N/A'),
        ];

        if (!empty($payload['phone'])) {
            $lines[] = "• *Phone:* `{$payload['phone']}`";
        }
        if (!empty($payload['service'])) {
            $lines[] = "• *Service / Product:* *{$payload['service']}*";
        }
        if (!empty($payload['slot'])) {
            $lines[] = "• *Requested Slot:* *{$payload['slot']}*";
        }
        if (!empty($payload['budget'])) {
            $lines[] = "• *Timeline/Budget:* {$payload['budget']}";
        }
        if (!empty($payload['source'])) {
            $lines[] = "• *Source:* {$payload['source']}";
        }
        if (!empty($payload['message'])) {
            $lines[] = "\n*Project Details:*\n" . substr($payload['message'], 0, 300) . (strlen($payload['message']) > 300 ? '...' : '');
        }

        $adminUrl = url('/admin');
        $lines[] = "━━━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "👉 [Open Sales Cockpit]({$adminUrl})";

        $message = implode("\n", $lines);

        Http::timeout(5)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id'                  => $chatId,
            'text'                     => $message,
            'parse_mode'               => 'Markdown',
            'disable_web_page_preview' => true,
        ]);
    }

    /**
     * Dispatch generic JSON webhook to Slack, Discord, or automation platforms
     */
    protected static function sendGenericWebhook(string $type, array $payload, string $priority): void
    {
        $webhookUrl = env('LEAD_WEBHOOK_URL');
        if (empty($webhookUrl)) {
            return;
        }

        Http::timeout(5)->post($webhookUrl, [
            'event'     => 'lead.captured',
            'type'      => $type,
            'priority'  => $priority,
            'payload'   => $payload,
            'timestamp' => now()->toIso8601String(),
            'source'    => 'CypressIQ Platform',
        ]);
    }

    /**
     * Dispatch rich Discord Webhook with embedded fields and direct sales cockpit button
     */
    protected static function sendDiscordWebhook(string $type, array $payload, string $priority): void
    {
        $discordUrl = env('DISCORD_WEBHOOK_URL') ?: (str_contains(env('LEAD_WEBHOOK_URL', ''), 'discord.com') ? env('LEAD_WEBHOOK_URL') : null);
        if (empty($discordUrl)) {
            return;
        }

        $color = match ($priority) {
            'urgent' => 0xFF4757, // Red
            'high'   => 0xFF6B35, // Orange
            default  => 0x6C63FF, // CypressIQ Indigo
        };

        $title = match ($type) {
            'booking' => '📅 New Strategy Consultation Booked',
            'inquiry' => '🎯 New Inbound Project Inquiry',
            'overdue' => '⚠️ Action Required: SLA Follow-up Overdue',
            default   => '⚡ New Lead Captured',
        };

        $fields = [
            ['name' => '👤 Client', 'value' => (string)($payload['name'] ?? 'Direct Lead'), 'inline' => true],
            ['name' => '📧 Email', 'value' => (string)($payload['email'] ?? 'N/A'), 'inline' => true],
        ];

        if (!empty($payload['phone'])) {
            $fields[] = ['name' => '📞 Phone', 'value' => (string)$payload['phone'], 'inline' => true];
        }
        if (!empty($payload['service'])) {
            $fields[] = ['name' => '🛠️ Service / Product', 'value' => (string)$payload['service'], 'inline' => true];
        }
        if (!empty($payload['slot'])) {
            $fields[] = ['name' => '⏰ Requested Time', 'value' => (string)$payload['slot'], 'inline' => true];
        }
        if (!empty($payload['budget'])) {
            $fields[] = ['name' => '💰 Timeline / Budget', 'value' => (string)$payload['budget'], 'inline' => true];
        }
        if (!empty($payload['source'])) {
            $fields[] = ['name' => '🌐 Source Channel', 'value' => (string)$payload['source'], 'inline' => true];
        }
        if (!empty($payload['message'])) {
            $fields[] = ['name' => '📝 Details', 'value' => substr((string)$payload['message'], 0, 1000), 'inline' => false];
        }

        $adminUrl = url('/admin');

        Http::timeout(5)->post($discordUrl, [
            'username'   => 'CypressIQ Radar Bot',
            'avatar_url' => 'https://cypressiq.agency/assets/logo.png',
            'embeds'     => [
                [
                    'title'       => $title,
                    'description' => "[👉 Open Lead in Sales Cockpit]({$adminUrl})",
                    'color'       => $color,
                    'fields'      => $fields,
                    'footer'      => [
                        'text' => 'CypressIQ Autonomous Lead Dispatch • ' . now()->format('M d, Y H:i T'),
                    ],
                ],
            ],
        ]);
    }

    /**
     * Get Radar follow-up intelligence and action-required metrics
     */
    public static function getRadarData(): array
    {
        // 1. Overdue leads: status 'new' and created > 24 hours ago
        $overdueLeads = Lead::where('status', 'new')
            ->where('created_at', '<=', now()->subHours(24))
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($lead) {
                return [
                    'id'               => $lead->id,
                    'name'             => $lead->name ?: 'Direct Prospect',
                    'email'            => $lead->email,
                    'phone'            => $lead->phone,
                    'product_interest' => $lead->product_interest ?: ($lead->type ?: 'General'),
                    'priority'         => $lead->priority ?: 'medium',
                    'hours_waiting'    => (int) $lead->created_at->diffInHours(now()),
                    'created_at'       => $lead->created_at->toIso8601String(),
                ];
            });

        // 2. Urgent / High priority leads needing follow-up within 2 hours
        $urgentLeads = Lead::where('status', 'new')
            ->whereIn('priority', ['urgent', 'high'])
            ->where('created_at', '<=', now()->subHours(2))
            ->where('created_at', '>', now()->subHours(24))
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($lead) {
                return [
                    'id'               => $lead->id,
                    'name'             => $lead->name ?: 'Direct Prospect',
                    'email'            => $lead->email,
                    'phone'            => $lead->phone,
                    'product_interest' => $lead->product_interest ?: ($lead->type ?: 'General'),
                    'priority'         => $lead->priority,
                    'hours_waiting'    => (int) $lead->created_at->diffInHours(now()),
                    'created_at'       => $lead->created_at->toIso8601String(),
                ];
            });

        // 3. Pending Strategy Call Bookings
        $pendingBookings = Booking::where('status', 'confirmed')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($b) {
                return [
                    'id'                  => $b->id,
                    'name'                => $b->name,
                    'email'               => $b->email,
                    'phone'               => $b->phone,
                    'preferred_time_slot' => $b->preferred_time_slot,
                    'created_at'          => $b->created_at->toIso8601String(),
                ];
            });

        // Latest lead ID for live browser polling detection
        $latestLead = Lead::latest('id')->first();

        return [
            'total_overdue'    => $overdueLeads->count(),
            'total_urgent'     => $urgentLeads->count(),
            'total_pending'    => $pendingBookings->count(),
            'overdue_leads'    => $overdueLeads,
            'urgent_leads'     => $urgentLeads,
            'pending_bookings' => $pendingBookings,
            'latest_lead_id'   => $latestLead ? $latestLead->id : 0,
            'latest_timestamp' => now()->toIso8601String(),
        ];
    }
}
