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
            <span style="font-size:1.5rem">⚠️</span>
            <h3 style="font-size:1.25rem;color:var(--clr-danger)">Fragmented Operations</h3>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-weight:700">✕</span>
            <div>
              <strong>Manual Spreadsheet Dependencies:</strong> Critical inventory, attendance, and finance data maintained in unbacked-up local files.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-weight:700">✕</span>
            <div>
              <strong>Duplicate Data Re-Entry:</strong> Staff re-type information from sales slips into separate accounting books, introducing transposition errors.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-weight:700">✕</span>
            <div>
              <strong>Delayed Executive Reporting:</strong> Management waits days or weeks for end-of-month consolidation rather than having live pulse data.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-danger);font-weight:700">✕</span>
            <div>
              <strong>Single-Point Failures:</strong> Processes depend on individual institutional memory rather than deterministic system software.
            </div>
          </div>
        </div>

        <!-- Connected State -->
        <div class="comparison-col connected">
          <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.5rem">
            <span style="font-size:1.5rem">⚡</span>
            <h3 style="font-size:1.25rem;color:var(--clr-accent)">CypressIQ Modernized State</h3>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-weight:700">✓</span>
            <div>
              <strong>Single Source of Operational Truth:</strong> All departments read and write to synchronized relational databases with point-in-time backups.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-weight:700">✓</span>
            <div>
              <strong>Event-Driven Automation:</strong> A sale automatically updates inventory, logs accounting debits/credits, and syncs delivery queues.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-weight:700">✓</span>
            <div>
              <strong>Real-Time Executive Cockpits:</strong> Live revenue, till balances, and inventory movements accessible instantly from any browser.
            </div>
          </div>
          <div class="comparison-item">
            <span style="color:var(--clr-accent);font-weight:700">✓</span>
            <div>
              <strong>Scalable, Audit-Ready Architecture:</strong> Cryptographic activity logs, role-based security, and zero downtime as transaction volumes grow.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TRANSFORMATION FRAMEWORK -->
  <section class="section" id="framework" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3.5rem">
        <span class="badge badge--primary">📐 Consulting Methodology</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          A Disciplined <span class="text-gradient">Modernization Roadmap</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          We don't impose cookie-cutter software. We execute an architectural transition that respects existing team capabilities and preserves business continuity.
        </p>
      </div>

      <div style="max-width:840px;margin:0 auto">
        <div class="phase-card reveal">
          <div class="phase-number">01</div>
          <div>
            <span class="badge badge--accent" style="font-size:0.7rem;margin-bottom:0.5rem">Phase 1</span>
            <h3 style="font-size:1.35rem;margin-bottom:0.5rem">Operational &amp; Systems Audit</h3>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We interview department leads, map existing manual handoffs, analyze current software usage, and catalog friction points to identify immediate quick wins and structural bottlenecks.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">02</div>
          <div>
            <span class="badge badge--primary" style="font-size:0.7rem;margin-bottom:0.5rem">Phase 2</span>
            <h3 style="font-size:1.35rem;margin-bottom:0.5rem">Target Architecture &amp; Data Schema Design</h3>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We define target data flows, API boundaries, security roles, and user permission matrices. We create interactive prototypes to confirm alignment before engineering begins.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">03</div>
          <div>
            <span class="badge badge--warning" style="font-size:0.7rem;margin-bottom:0.5rem">Phase 3</span>
            <h3 style="font-size:1.35rem;margin-bottom:0.5rem">Phased Deployment &amp; Legacy Data Migration</h3>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We clean and normalize legacy historical records, script automated import pipelines, and deploy systems in incremental stages to prevent operational interruption.
            </p>
          </div>
        </div>

        <div class="phase-card reveal">
          <div class="phase-number">04</div>
          <div>
            <span class="badge badge--success" style="font-size:0.7rem;margin-bottom:0.5rem">Phase 4</span>
            <h3 style="font-size:1.35rem;margin-bottom:0.5rem">Staff Onboarding &amp; Continuous Optimization</h3>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We conduct structured training workshops, establish internal system champions, and monitor operational telemetry to continuously refine user experience and query performance.
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
        <span class="badge badge--primary" style="margin-bottom:1rem">Strategic Advisory</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Ready to Modernize Your Operations?
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Schedule an initial systems discovery session with our technology consultants to evaluate where custom technology can generate the highest ROI.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Book Discovery Consultation →</a>
          <a href="{{ route('portfolio') }}" class="btn btn--outline btn--lg">View Deliveries &amp; Case Studies</a>
        </div>
      </div>
    </div>
  </section>
@endsection
