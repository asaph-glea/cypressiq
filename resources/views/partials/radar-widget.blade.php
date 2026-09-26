@php
    $hasAlerts = ($radar['total_overdue'] ?? 0) > 0 || ($radar['total_urgent'] ?? 0) > 0 || ($radar['total_pending'] ?? 0) > 0;
@endphp

<div class="radar-card" style="background:var(--bg-card);border:1px solid {{ $hasAlerts ? 'rgba(239,68,68,0.35)' : 'var(--border-subtle)' }};border-radius:var(--radius-xl);padding:1.5rem;box-shadow:{{ $hasAlerts ? '0 10px 30px rgba(239,68,68,0.15)' : 'none' }};transition:all 0.3s ease">
    <!-- Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.25rem">
        <div style="display:flex;align-items:center;gap:0.75rem">
            <div style="width:40px;height:40px;border-radius:var(--radius-lg);background:{{ $hasAlerts ? 'rgba(239,68,68,0.15)' : 'rgba(0,212,170,0.12)' }};border:1px solid {{ $hasAlerts ? 'rgba(239,68,68,0.35)' : 'rgba(0,212,170,0.3)' }};display:flex;align-items:center;justify-content:center;font-size:1.25rem">
                {{ $hasAlerts ? '🚨' : '⚡' }}
            </div>
            <div>
                <div style="font-family:var(--font-display);font-size:1.15rem;font-weight:700;color:var(--text-primary);display:flex;align-items:center;gap:0.5rem">
                    <span>Inbound Action Radar &amp; Follow-Up SLA Tracker</span>
                    @if($hasAlerts)
                        <span style="font-size:0.7rem;background:#ef4444;color:#fff;padding:2px 8px;border-radius:999px;font-weight:700;text-transform:uppercase;animation:pulse 2s infinite">Action Required</span>
                    @else
                        <span style="font-size:0.7rem;background:rgba(16,185,129,0.15);color:#34d399;border:1px solid rgba(16,185,129,0.3);padding:2px 8px;border-radius:999px;font-weight:700">All SLAs Clear</span>
                    @endif
                </div>
                <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:2px">
                    Real-time detection of client inquiries, strategy call requests, and overdue follow-up SLAs.
                </div>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap">
            <button type="button" class="btn btn--outline btn--sm" onclick="playLeadChime()" title="Test audio notification" style="padding:4px 10px;font-size:0.75rem">
                🔔 Test Chime
            </button>
            <button type="button" class="btn btn--outline btn--sm" id="btn-desktop-notif" onclick="enableDesktopNotifications()" style="padding:4px 10px;font-size:0.75rem">
                📲 Push Alerts
            </button>
            <button type="button" class="btn btn--secondary btn--sm" onclick="fetchRadarData(true)" style="padding:4px 10px;font-size:0.75rem">
                🔄 Sync Now
            </button>
        </div>
    </div>

    <!-- Radar Metrics Pills -->
    <div style="display:flex;gap:0.75rem;margin-bottom:1.25rem;flex-wrap:wrap">
        <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.4rem 0.85rem;display:flex;align-items:center;gap:0.5rem;font-size:0.8rem">
            <span style="color:#ef4444;font-weight:700">● {{ $radar['total_overdue'] ?? 0 }}</span>
            <span style="color:var(--text-secondary)">Overdue Follow-ups (>24h)</span>
        </div>
        <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.4rem 0.85rem;display:flex;align-items:center;gap:0.5rem;font-size:0.8rem">
            <span style="color:#f97316;font-weight:700">● {{ $radar['total_urgent'] ?? 0 }}</span>
            <span style="color:var(--text-secondary)">Urgent Inquiries (>2h)</span>
        </div>
        <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.4rem 0.85rem;display:flex;align-items:center;gap:0.5rem;font-size:0.8rem">
            <span style="color:#f59e0b;font-weight:700">● {{ $radar['total_pending'] ?? 0 }}</span>
            <span style="color:var(--text-secondary)">Strategy Calls Scheduled</span>
        </div>
        <div style="margin-left:auto;display:flex;align-items:center;gap:0.4rem;font-size:0.72rem;color:var(--text-muted)">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--clr-accent)"></span>
            <span>Live Telemetry Active (15s Poll)</span>
        </div>
    </div>

    <!-- Radar Action Queue -->
    <div id="radar-queue-container">
        @if(!$hasAlerts)
            <div style="padding:1.25rem;background:rgba(16,185,129,0.04);border:1px dashed rgba(16,185,129,0.25);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:space-between">
                <div style="display:flex;align-items:center;gap:0.75rem">
                    <span style="font-size:1.4rem">🟢</span>
                    <div>
                        <strong style="color:#34d399;font-size:0.9rem">All client inquiries and strategy calls are fully attended to.</strong>
                        <div style="font-size:0.78rem;color:var(--text-secondary);margin-top:2px">
                            New incoming submissions from forms, the discovery engine, or strategy booking will alert you here and through your configured channels immediately.
                        </div>
                    </div>
                </div>
                <button class="btn btn--outline btn--sm" onclick="showPanel('leads', null)" style="padding:4px 12px;font-size:0.75rem">
                    View Complete Pipeline →
                </button>
            </div>
        @else
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                {{-- 1. Overdue Leads (>24 hours) --}}
                @foreach($radar['overdue_leads'] ?? [] as $ol)
                <div class="radar-item" id="radar-item-{{ $ol['id'] }}" style="padding:1rem 1.25rem;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.25);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
                    <div style="display:flex;align-items:center;gap:1rem">
                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.4);display:flex;align-items:center;justify-content:center;color:#f87171;font-weight:700;font-size:0.85rem">
                            ⚠️
                        </div>
                        <div>
                            <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
                                <strong style="color:var(--text-primary);font-size:0.95rem">{{ $ol['name'] }}</strong>
                                <span style="font-size:0.72rem;background:rgba(239,68,68,0.2);color:#fca5a5;padding:1px 8px;border-radius:999px;font-weight:700">
                                    Overdue: {{ $ol['hours_waiting'] }}h waiting
                                </span>
                                <span style="font-size:0.72rem;background:rgba(108,99,255,0.15);color:var(--clr-primary-light);padding:1px 8px;border-radius:999px;font-weight:600">
                                    {{ strtoupper($ol['product_interest']) }}
                                </span>
                            </div>
                            <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:3px;display:flex;align-items:center;gap:0.75rem">
                                <a href="mailto:{{ $ol['email'] }}" style="color:var(--text-secondary);text-decoration:none">✉️ {{ $ol['email'] }}</a>
                                @if(!empty($ol['phone']))
                                    <a href="tel:{{ $ol['phone'] }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">📞 {{ $ol['phone'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;gap:0.5rem">
                        @if(!empty($ol['phone']))
                            <a href="tel:{{ $ol['phone'] }}" class="btn btn--outline btn--sm" style="padding:4px 10px;font-size:0.75rem;color:var(--clr-accent);border-color:rgba(0,212,170,0.3)">
                                📞 Call Client
                            </a>
                        @endif
                        <button class="btn btn--primary btn--sm" onclick="quickMarkContacted({{ $ol['id'] }})" style="padding:4px 12px;font-size:0.75rem">
                            ✓ Mark Contacted
                        </button>
                        <button class="btn btn--outline btn--sm" onclick="inspectLeadById({{ $ol['id'] }})" style="padding:4px 10px;font-size:0.75rem">
                            Inspect
                        </button>
                    </div>
                </div>
                @endforeach

                {{-- 2. Urgent Untouched Leads (>2 hours) --}}
                @foreach($radar['urgent_leads'] ?? [] as $ul)
                <div class="radar-item" id="radar-item-{{ $ul['id'] }}" style="padding:1rem 1.25rem;background:rgba(249,115,22,0.06);border:1px solid rgba(249,115,22,0.25);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
                    <div style="display:flex;align-items:center;gap:1rem">
                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(249,115,22,0.15);border:1px solid rgba(249,115,22,0.4);display:flex;align-items:center;justify-content:center;color:#fb923c;font-weight:700;font-size:0.85rem">
                            ⚡
                        </div>
                        <div>
                            <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
                                <strong style="color:var(--text-primary);font-size:0.95rem">{{ $ul['name'] }}</strong>
                                <span style="font-size:0.72rem;background:rgba(249,115,22,0.2);color:#fdba74;padding:1px 8px;border-radius:999px;font-weight:700">
                                    Urgent: {{ $ul['hours_waiting'] }}h waiting
                                </span>
                                <span style="font-size:0.72rem;background:rgba(108,99,255,0.15);color:var(--clr-primary-light);padding:1px 8px;border-radius:999px;font-weight:600">
                                    {{ strtoupper($ul['product_interest']) }}
                                </span>
                            </div>
                            <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:3px;display:flex;align-items:center;gap:0.75rem">
                                <a href="mailto:{{ $ul['email'] }}" style="color:var(--text-secondary);text-decoration:none">✉️ {{ $ul['email'] }}</a>
                                @if(!empty($ul['phone']))
                                    <a href="tel:{{ $ul['phone'] }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">📞 {{ $ul['phone'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;gap:0.5rem">
                        @if(!empty($ul['phone']))
                            <a href="tel:{{ $ul['phone'] }}" class="btn btn--outline btn--sm" style="padding:4px 10px;font-size:0.75rem;color:var(--clr-accent);border-color:rgba(0,212,170,0.3)">
                                📞 Call Client
                            </a>
                        @endif
                        <button class="btn btn--primary btn--sm" onclick="quickMarkContacted({{ $ul['id'] }})" style="padding:4px 12px;font-size:0.75rem">
                            ✓ Mark Contacted
                        </button>
                        <button class="btn btn--outline btn--sm" onclick="inspectLeadById({{ $ul['id'] }})" style="padding:4px 10px;font-size:0.75rem">
                            Inspect
                        </button>
                    </div>
                </div>
                @endforeach

                {{-- 3. Pending Strategy Calls --}}
                @foreach($radar['pending_bookings'] ?? [] as $pb)
                <div class="radar-item" style="padding:1rem 1.25rem;background:rgba(245,158,11,0.06);border:1px solid rgba(245,158,11,0.25);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
                    <div style="display:flex;align-items:center;gap:1rem">
                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.4);display:flex;align-items:center;justify-content:center;color:#facc15;font-weight:700;font-size:0.85rem">
                            📅
                        </div>
                        <div>
                            <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
                                <strong style="color:var(--text-primary);font-size:0.95rem">{{ $pb['name'] }}</strong>
                                <span style="font-size:0.72rem;background:rgba(245,158,11,0.2);color:#fde047;padding:1px 8px;border-radius:999px;font-weight:700">
                                    Slot: {{ $pb['preferred_time_slot'] }}
                                </span>
                            </div>
                            <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:3px;display:flex;align-items:center;gap:0.75rem">
                                <a href="mailto:{{ $pb['email'] }}" style="color:var(--text-secondary);text-decoration:none">✉️ {{ $pb['email'] }}</a>
                                @if(!empty($pb['phone']))
                                    <a href="tel:{{ $pb['phone'] }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">📞 {{ $pb['phone'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;gap:0.5rem">
                        <button class="btn btn--outline btn--sm" onclick="showPanel('bookings', null)" style="padding:4px 12px;font-size:0.75rem">
                            Manage Booking →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
