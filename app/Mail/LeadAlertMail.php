<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $type;
    public array $payload;
    public string $priority;

    /**
     * Create a new message instance.
     */
    public function __construct(string $type, array $payload, string $priority = 'medium')
    {
        $this->type = $type;
        $this->payload = $payload;
        $this->priority = $priority;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = match ($this->type) {
            'booking' => "📅 URGENT: Strategy Call Booked by " . ($this->payload['name'] ?? 'Prospect'),
            'inquiry' => "🎯 New Inbound Inquiry: " . ($this->payload['service'] ?? 'CypressIQ Services') . " (" . ($this->payload['name'] ?? 'Prospect') . ")",
            'lead'    => "⚡ High-Priority Lead Captured: " . ($this->payload['email'] ?? 'Prospect'),
            'overdue' => "⚠️ SLA Escalation: Lead Follow-Up Required for " . ($this->payload['name'] ?? 'Prospect'),
            default   => "🔔 CypressIQ Inbound Notification: " . ($this->payload['email'] ?? ''),
        };

        return $this->subject($subject)
                    ->view('emails.lead-alert')
                    ->with([
                        'type'     => $this->type,
                        'payload'  => $this->payload,
                        'priority' => $this->priority,
                    ]);
    }
}
