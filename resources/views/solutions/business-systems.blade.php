@extends('layouts.app')
@section('title', 'Custom Business Systems & Operational Platforms — CypressIQ Solutions')
@section('meta_description', 'Eliminate operational bottlenecks with custom enterprise cockpits, inventory systems, multi-branch workflows, and audit-ready business platforms.')

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
        <span class="metric-badge">🏢 Client Solutions · Business Systems</span>
      </div>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Custom Business Systems Engineered for <span class="text-gradient">Operational Control</span>
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        Replace disconnected spreadsheets, manual paperwork, and fragmented off-the-shelf software with purpose-built internal platforms, automated approval queues, and central command cockpits.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Systems Consultation →</a>
        <a href="#capabilities" class="btn btn--secondary btn--lg">Review System Capabilities</a>
      </div>
    </div>
  </section>

  <!-- CAPABILITIES -->
  <section class="section" id="capabilities" style="padding-top:0">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3rem">
        <span class="badge badge--accent">Enterprise Architecture</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Total Visibility &amp; Deterministic Workflows
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          We engineer enterprise tools around your organization's exact hierarchy, approval thresholds, compliance rules, and reporting structures.
        </p>
      </div>

      <div class="solution-grid">
        <!-- Card 1: Enterprise Cockpits & Dashboards -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">📊</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Executive Operational Cockpits</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Real-time dashboards aggregating metrics across departments, branches, and regional units. Get instant clarity on cash flows, active orders, team velocity, and critical operational KPIs.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Multi-dimensional telemetry and visual analytics</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Custom scheduled reporting (PDF / Excel generation)</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time alerts on margin breaches or stock deficits</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Multi-currency and regional branch consolidation</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Telemetry</span>
            <span class="spec-tag">Automated PDF</span>
            <span class="spec-tag">Multi-Branch</span>
            <span class="spec-tag">Live Analytics</span>
          </div>
        </div>

        <!-- Card 2: Workflow Automation & Approval Engines -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🛡️</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Multi-Stage Approval Chains</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Prevent unauthorized expenditure and workflow bottlenecks. We build automated approval engines where requisitions, POs, and disbursements flow through verifiable stage gates.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Configurable hierarchy &amp; expenditure authorization limits</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Granular Role-Based Access Control (RBAC)</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Immutable audit trails with timestamped actor logs</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Email and SMS approval push triggers</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">RBAC</span>
            <span class="spec-tag">Audit Ledger</span>
            <span class="spec-tag">Approval Queues</span>
            <span class="spec-tag">Security</span>
          </div>
        </div>

        <!-- Card 3: Inventory & Supply Chain Tracking -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">📦</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Multi-Warehouse Inventory &amp; Assets</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Track stock levels, transfers, batch numbers, and asset depreciation across warehouses and storefronts without discrepancy or lost documentation.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Barcode scanning &amp; SKU movement tracking</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Inter-branch transfer manifest &amp; dispatch approvals</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated reorder alerts &amp; supplier purchase orders</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Batch expiration &amp; shrinkage loss tracking</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Barcode/SKU</span>
            <span class="spec-tag">Warehouses</span>
            <span class="spec-tag">Batch Tracking</span>
            <span class="spec-tag">Automated POs</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal" style="text-align:center;max-width:800px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">Streamline Your Organization</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Ready to Modernize Your Internal Systems?
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Book an architecture session with our business systems specialists to map your workflow requirements and eliminate operational waste.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Book Systems Architecture Session →</a>
          <a href="{{ route('opero') }}" class="btn btn--secondary btn--lg">Explore Opero ERP Product</a>
        </div>
      </div>
    </div>
  </section>
@endsection
