@extends('layouts.app')
@section('title', 'Automation & System Integrations — CypressIQ Solutions')
@section('meta_description', 'Connect disparate applications with resilient API gateways, webhook listeners, payment rails (M-Pesa, Stripe), and automated event-driven pipelines.')

@section('css')
<style>
  .solution-hero {
    padding: calc(var(--nav-h) + 4rem) 0 4rem;
    position: relative;
    overflow: hidden;
  }
  .solution-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
  }
  .solution-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all var(--transition-base);
  }
  .solution-card:hover {
    border-color: var(--border-accent);
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }
  .spec-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
    background: var(--bg-glass-strong);
    border: 1px solid var(--border-subtle);
    color: var(--text-secondary);
    margin: 0.2rem;
  }
  .metric-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(0, 212, 170, 0.1);
    color: var(--clr-accent);
    border: 1px solid rgba(0, 212, 170, 0.3);
    padding: 0.35rem 0.85rem;
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
</style>
@endsection

@section('content')
  <!-- HERO -->
  <section class="solution-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2;text-align:center;max-width:880px;margin:0 auto">
      <div style="display:flex;justify-content:center;margin-bottom:1.5rem">
        <span class="metric-badge">🔌 Client Solutions · Automation &amp; Integrations</span>
      </div>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Seamless APIs &amp; <span class="text-gradient">Intelligent System Automation</span>
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        Break down the data silos between your software ecosystem. We architect resilient API gateways, webhook listeners, payment rails, and asynchronous queue workers that eliminate repetitive manual data entry.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Connect Your Systems →</a>
        <a href="#capabilities" class="btn btn--secondary btn--lg">View Integration Capabilities</a>
      </div>
    </div>
  </section>

  <!-- CAPABILITIES -->
  <section class="section" id="capabilities" style="padding-top:0">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3rem">
        <span class="badge badge--accent">Fault-Tolerant Pipelines</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Engineered for Guaranteed Message Delivery
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          We handle API rate limits, network partitions, webhook retries, and data transformations with idempotency and enterprise error logging.
        </p>
      </div>

      <div class="solution-grid">
        <!-- Card 1: Custom API Gateways -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">⚡</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">API Engineering &amp; Gateways</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Secure, versioned RESTful and GraphQL APIs built to power mobile apps, third-party partner connections, and internal service communication with high speed and low latency.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> OpenAPI / Swagger interactive documentation</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> OAuth2, JWT &amp; API key token authentication</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Rate-limiting, throttling &amp; DDoS shielding</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated integration regression tests</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">REST / GraphQL</span>
            <span class="spec-tag">OAuth2</span>
            <span class="spec-tag">Swagger</span>
            <span class="spec-tag">Redis Cache</span>
          </div>
        </div>

        <!-- Card 2: Payment Rails & Financial Bridges -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">💳</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Payment Rails &amp; FinTech Bridges</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Seamless financial integrations bridging local mobile money (M-Pesa Daraja, Airtel Money) and global card processors (Stripe, Flutterwave, Paystack) directly into your ledger.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> STK Push, C2B, B2C automated reconciliation</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Idempotent transaction processing with zero duplicates</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time settlement webhooks &amp; ledger posting</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated receipt and invoice generation</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">M-Pesa Daraja</span>
            <span class="spec-tag">Stripe</span>
            <span class="spec-tag">Idempotency</span>
            <span class="spec-tag">Auto-Reconcile</span>
          </div>
        </div>

        <!-- Card 3: Asynchronous Queues & Event Automation -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🔄</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Queues &amp; Background Pipelines</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Decouple heavy tasks from user response cycles. Scheduled cron pipelines, background workers, and webhook handlers ensure instant UI responsiveness and guaranteed completion.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Redis-backed asynchronous worker queues</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> SMS (Africa's Talking / Twilio) &amp; WhatsApp notification bots</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Exponential backoff retries with dead-letter queue recovery</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Third-party CRM/ERP sync (HubSpot, Salesforce, Zoho)</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Redis Workers</span>
            <span class="spec-tag">WhatsApp/SMS</span>
            <span class="spec-tag">Webhook Listener</span>
            <span class="spec-tag">Dead-Letter Queues</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal" style="text-align:center;max-width:800px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">Integrate With Confidence</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Ready to Automate Your Data Flows?
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Schedule an integration review with our backend engineers to connect your applications into a synchronized pipeline.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Integration Review →</a>
          <a href="{{ route('solutions.web-development') }}" class="btn btn--secondary btn--lg">View Web Development</a>
        </div>
      </div>
    </div>
  </section>
@endsection
