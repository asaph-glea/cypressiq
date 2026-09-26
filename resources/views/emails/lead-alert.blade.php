<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CypressIQ Inbound Lead Alert</title>
  <style>
    body { margin:0; padding:0; background-color:#080b14; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#f1f5f9; }
    .container { max-width:600px; margin:20px auto; background-color:#0d1221; border:1px solid rgba(255,255,255,0.1); border-radius:16px; overflow:hidden; }
    .header { background:linear-gradient(135deg, #1e1b4b 0%, #0d1221 100%); padding:28px 32px; border-bottom:1px solid rgba(255,255,255,0.08); }
    .brand { font-size:20px; font-weight:800; color:#ffffff; letter-spacing:-0.02em; }
    .brand span { color:#00D4AA; }
    .badge { display:inline-block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; padding:4px 12px; border-radius:999px; margin-top:8px; }
    .badge-urgent { background:rgba(239,68,68,0.2); color:#f87171; border:1px solid rgba(239,68,68,0.4); }
    .badge-high { background:rgba(249,115,22,0.2); color:#fb923c; border:1px solid rgba(249,115,22,0.4); }
    .badge-medium { background:rgba(108,99,255,0.2); color:#818cf8; border:1px solid rgba(108,99,255,0.4); }
    .body { padding:32px; }
    .title { font-size:22px; font-weight:700; color:#f8fafc; margin:0 0 12px 0; }
    .desc { font-size:14px; line-height:1.6; color:#94a3b8; margin:0 0 24px 0; }
    .info-table { width:100%; border-collapse:collapse; margin-bottom:28px; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.06); border-radius:10px; overflow:hidden; }
    .info-table td { padding:12px 16px; font-size:14px; border-bottom:1px solid rgba(255,255,255,0.05); }
    .info-table tr:last-child td { border-bottom:none; }
    .label { color:#64748b; font-weight:600; width:35%; text-transform:uppercase; font-size:11px; letter-spacing:0.05em; }
    .val { color:#f1f5f9; font-weight:500; }
    .val strong { color:#ffffff; }
    .btn-row { display:flex; gap:12px; margin-top:20px; }
    .btn { display:inline-block; padding:12px 24px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none; text-align:center; }
    .btn-primary { background-color:#6C63FF; color:#ffffff !important; }
    .btn-secondary { background-color:#1e293b; color:#38bdf8 !important; border:1px solid rgba(56,189,248,0.3); }
    .footer { padding:20px 32px; background-color:#090d17; border-top:1px solid rgba(255,255,255,0.06); font-size:12px; color:#475569; text-align:center; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="brand">⚡ CypressIQ<span>.</span></div>
      <div class="badge {{ $priority === 'urgent' ? 'badge-urgent' : ($priority === 'high' ? 'badge-high' : 'badge-medium') }}">
        ● {{ strtoupper($priority) }} PRIORITY INBOUND
      </div>
    </div>

    <div class="body">
      <h1 class="title">
        @if($type === 'booking')
          📅 New Strategy Call Booking
        @elseif($type === 'inquiry')
          🎯 New Project Inquiry
        @elseif($type === 'overdue')
          ⚠️ SLA Follow-Up Overdue
        @else
          ⚡ New Lead Captured
        @endif
      </h1>
      <p class="desc">
        A prospect has reached out through the CypressIQ platform. Review the captured intelligence below to coordinate immediate follow-up.
      </p>

      <table class="info-table">
        @if(!empty($payload['name']))
        <tr>
          <td class="label">Client Name</td>
          <td class="val"><strong>{{ $payload['name'] }}</strong></td>
        </tr>
        @endif

        <tr>
          <td class="label">Email Address</td>
          <td class="val">
            <a href="mailto:{{ $payload['email'] }}" style="color:#00D4AA;text-decoration:none">
              {{ $payload['email'] }}
            </a>
          </td>
        </tr>

        @if(!empty($payload['phone']))
        <tr>
          <td class="label">Phone / WhatsApp</td>
          <td class="val">
            <a href="tel:{{ $payload['phone'] }}" style="color:#38bdf8;text-decoration:none;font-weight:700">
              📞 {{ $payload['phone'] }} (Click to Call)
            </a>
          </td>
        </tr>
        @endif

        @if(!empty($payload['service']))
        <tr>
          <td class="label">Product / Service</td>
          <td class="val"><strong style="color:#a78bfa">{{ $payload['service'] }}</strong></td>
        </tr>
        @endif

        @if(!empty($payload['slot']))
        <tr>
          <td class="label">Requested Time Slot</td>
          <td class="val"><strong style="color:#f59e0b">⏰ {{ $payload['slot'] }}</strong></td>
        </tr>
        @endif

        @if(!empty($payload['budget']))
        <tr>
          <td class="label">Budget / Timeline</td>
          <td class="val">{{ $payload['budget'] }}</td>
        </tr>
        @endif

        @if(!empty($payload['source']))
        <tr>
          <td class="label">Lead Source</td>
          <td class="val">{{ $payload['source'] }}</td>
        </tr>
        @endif

        @if(!empty($payload['message']))
        <tr>
          <td class="label">Project Scope</td>
          <td class="val" style="line-height:1.6;font-size:13px">{{ $payload['message'] }}</td>
        </tr>
        @endif
      </table>

      <div>
        <a href="{{ url('/admin') }}" class="btn btn-primary" style="margin-right:8px">
          Open Sales Cockpit →
        </a>
        @if(!empty($payload['phone']))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $payload['phone']) }}" class="btn btn-secondary" target="_blank">
          Message via WhatsApp 💬
        </a>
        @endif
      </div>
    </div>

    <div class="footer">
      CypressIQ Autonomous Lead Intelligence &amp; SLA Pipeline &bull; {{ now()->format('M j, Y H:i:s T') }}
    </div>
  </div>
</body>
</html>
