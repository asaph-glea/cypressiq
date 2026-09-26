@extends('layouts.app')
@section('title', 'Technology Consulting & Digital Transformation — CypressIQ Solutions')
@section('meta_description', 'CypressIQ guides organizations through strategic technology consulting and digital transformation: transitioning fragmented operations into synchronized, automated systems.')

@section('css')
<style>
  .comparison-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin: 3rem 0;
  }
  .comparison-col {
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    border: 1px solid var(--border-subtle);
  }
  .comparison-col.fragmented {
    background: rgba(255, 71, 87, 0.04);
    border-color: rgba(255, 71, 87, 0.2);
  }
  .comparison-col.connected {
    background: rgba(0, 212, 170, 0.04);
    border-color: rgba(0, 212, 170, 0.3);
  }
  .comparison-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-subtle);
  }
  .comparison-item:last-child { border-bottom: none; }
  .phase-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 1.5rem;
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 2rem;
    align-items: center;
    transition: all 0.3s ease;
  }
  .phase-card:hover {
    border-color: var(--border-accent);
    transform: translateX(4px);
  }
  .phase-number {
    font-family: var(--font-display);
    font-size: 2.25rem;
    font-weight: 800;
    color: var(--clr-accent);
    line-height: 1;
    text-align: center;
  }
  @media (max-width: 800px) {
    .comparison-grid { grid-template-columns: 1fr; }
    .phase-card { grid-template-columns: 1fr; gap: 1rem; }
  }
</style>
@endsection

@section('content')
  <!-- HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2;text-align:center;max-width:860px;margin:0 auto">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">🔄 Client Solutions · Technology Consulting</span>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Modernizing Fragmented Operations Into <span class="text-gradient">Connected Digital Systems</span>
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        We help growing businesses, civic institutions, and regional enterprises move away from isolated spreadsheets, paper logs, and manual handoffs toward unified, resilient digital platforms with real-time operational visibility.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Request Systems Audit →</a>
        <a href="#framework" class="btn btn--secondary btn--lg">Our Methodology</a>
      </div>
    </div>
  </section>

  <!-- THE FRAGMENTATION PROBLEM -->
  <section class="section" style="padding-top:0">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 2rem">
        <span class="badge badge--warning">The Operational Bottleneck</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          The Hidden Cost of <span class="text-gradient">Fragmented Systems</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          When departments operate in technology silos, organizational productivity slows down and operational risks multiply.
        </p>
      </div>

      <div class="comparison-grid reveal">
        <!-- Fragmented State -->
        <div class="comparison-col fragmented">
          <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.5rem">
            <span style="font-size:1.5rem">❌</span>
            <h3 style="font-size:1.35rem;color:var(--clr-danger)">The Fragmented State</h3>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-size:1.25rem">•</span>
            <div>
              <strong>Spreadsheet Dependency:</strong> Multiple conflicting Excel sheets maintained by different staff members without version control.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-size:1.25rem">•</span>
            <div>
              <strong>Manual Handoffs:</strong> Orders, stock deductions, and customer requests manually re-typed between WhatsApp, paper books, and emails.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-size:1.25rem">•</span>
            <div>
              <strong>Lagging Retrospective Data:</strong> Leadership only knows monthly performance 15 days after month-end when reports are manually compiled.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-size:1.25rem">•</span>
            <div>
              <strong>Process Fragility:</strong> Key institutional knowledge and customer histories exist only in the heads or personal phones of specific staff.
            </div>
          </div>
        </div>

        <!-- Connected State -->
        <div class="comparison-col connected">
          <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.5rem">
            <span style="font-size:1.5rem">✅</span>
            <h3 style="font-size:1.35rem;color:var(--clr-accent)">The Connected State with CypressIQ</h3>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-size:1.25rem">✓</span>
            <div>
              <strong>Single Source of Truth:</strong> Centralized relational database where sales, inventory, and finance sync simultaneously in real time.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-size:1.25rem">✓</span>
            <div>
              <strong>Automated Workflow Bridges:</strong> Checkouts trigger immediate stock deductions, invoice creation, and management alerts automatically.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-size:1.25rem">✓</span>
            <div>
              <strong>Live Operational Dashboards:</strong> Real-time visibility into active cashflow, stock movements, and performance across all locations.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-size:1.25rem">✓</span>
            <div>
              <strong>Institutional Resilience:</strong> Standardized digital processes protected by role-based access controls and automated cloud backups.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TRANSFORMATION METHODOLOGY -->
  <section class="section" id="framework" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3.5rem">
        <span class="badge badge--primary">📐 The CypressIQ Blueprint</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          How We Guide <span class="text-gradient">Digital Modernization</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          We don't force generic software onto complex organizations. We execute a disciplined, phased transformation.
        </p>
      </div>

      <div style="max-width:860px;margin:0 auto">
        <div class="phase-card reveal">
          <div class="phase-number">01</div>
          <div>
            <h4 style="font-size:1.25rem;margin-bottom:0.5rem">Operational &amp; Systems Audit</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.925rem">
              We examine your existing operational workflows, spreadsheet dependencies, communication handoffs, and software tools. We pinpoint data bottlenecks, human error risks, and compliance vulnerabilities.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">02</div>
          <div>
            <h4 style="font-size:1.25rem;margin-bottom:0.5rem">Solution Architecture &amp; Data Model Design</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.925rem">
              We determine the optimal technical pathway: deploying a tailored instance of our proprietary products (such as <strong>Opero</strong> for business management or <strong>ITIKIA Campaign</strong> for public engagement) or engineering custom business software for bespoke workflows.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">03</div>
          <div>
            <h4 style="font-size:1.25rem;margin-bottom:0.5rem">Safe Data Migration &amp; Integration</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.925rem">
              We extract, clean, normalize, and migrate your legacy historical records into modern relational databases without operational interruption. We build custom API bridges to external payment channels and services.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">04</div>
          <div>
            <h4 style="font-size:1.25rem;margin-bottom:0.5rem">Rollout, Team Training &amp; Continuous Scale</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.925rem">
              Technology succeeds only when staff adopt it confidently. We provide hands-on role-specific training, establish operational protocols, and support long-term system scaling through dedicated service-level agreements.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal" style="text-align:center;max-width:800px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">Initial Consultation</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Schedule a Systems Architecture Audit
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Let our engineering team assess your existing tools and outline a realistic, structured blueprint to connect your operational systems.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Systems Audit →</a>
          <a href="{{ route('solutions.custom-software') }}" class="btn btn--secondary btn--lg">View Custom Engineering</a>
        </div>
      </div>
    </div>
  </section>
@endsection
