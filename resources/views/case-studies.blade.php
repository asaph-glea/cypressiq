@extends('layouts.app')
@section('title', 'Technical Case Studies & Engineering Architecture — CypressIQ')
@section('meta_description', 'Detailed case studies examining how CypressIQ engineers resilient business systems, high-concurrency platforms, and custom software for operational scale.')

@section('css')
<style>
  .case-studies-filters {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 3.5rem;
  }
  .case-filter-btn {
    padding: 0.6rem 1.35rem;
    border-radius: var(--radius-full);
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid var(--border-mid);
    color: var(--text-secondary);
    transition: all 0.2s;
    cursor: pointer;
    background: var(--bg-glass);
  }
  .case-filter-btn.active, .case-filter-btn:hover {
    background: var(--gradient-primary);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
  }
  .study-hero-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    padding: 3rem;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
  }
  .study-hero-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
  }
  .case-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 4rem;
  }
  .case-card {
    border-radius: var(--radius-2xl);
    overflow: hidden;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
  }
  .case-card:hover {
    transform: translateY(-4px);
    border-color: var(--border-accent);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  }
  .case-header {
    padding: 2rem 2rem 1.25rem 2rem;
    border-bottom: 1px solid var(--border-subtle);
    background: var(--bg-glass);
  }
  .case-category {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--clr-primary-light);
    margin-bottom: 0.5rem;
  }
  .case-body {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    flex-grow: 1;
  }
  .case-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--bg-surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-subtle);
  }
  .case-meta-title {
    font-size: 0.72rem;
    text-transform: uppercase;
    color: var(--text-muted);
    font-weight: 600;
    margin-bottom: 0.25rem;
  }
  .case-meta-val {
    font-size: 0.85rem;
    color: var(--text-primary);
    font-weight: 500;
  }
  .tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
  }
  .tech-tag {
    padding: 0.3rem 0.65rem;
    background: var(--bg-glass);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-family: monospace;
    color: var(--text-secondary);
  }
  @media (max-width: 900px) {
    .case-grid { grid-template-columns: 1fr; }
    .study-hero-card { padding: 2rem; }
  }
</style>
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">📑 Deep-Dive Engineering Studies</span>
      <h1>In-Depth Technical <span class="text-gradient">Case Studies</span></h1>
      <p>Architectural analyses of real systems engineered by CypressIQ: the operational challenges, system design blueprints, and verified production outcomes.</p>
      <div style="display:flex;gap:1rem;justify-content:center;margin-top:1.5rem">
        <a href="{{ route('trust') }}" class="btn btn--secondary btn--sm">⭐ View Client Endorsements &amp; Track Record →</a>
      </div>
    </div>
  </section>

  <!-- CASE STUDIES DIRECTORY -->
  <section class="section">
    <div class="container">
      <div class="case-studies-filters reveal">
        <button class="case-filter-btn active" onclick="window.filterCaseStudies('all', this)">All Case Studies</button>
        <button class="case-filter-btn" onclick="window.filterCaseStudies('products', this)">Proprietary Products</button>
        <button class="case-filter-btn" onclick="window.filterCaseStudies('custom', this)">Custom Software</button>
        <button class="case-filter-btn" onclick="window.filterCaseStudies('finance', this)">Financial Systems</button>
        <button class="case-filter-btn" onclick="window.filterCaseStudies('logistics', this)">Logistics &amp; Telematics</button>
      </div>

      <div class="case-grid">
        <!-- STUDY 1: OPERO MULTI-BRANCH -->
        <div class="case-card reveal" data-category="products">
          <div class="case-header">
            <div class="case-category">Product Deployment &bull; Commercial Operations</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Opero Multi-Branch Retail &amp; Inventory Engine</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Centralized catalog synchronization, offline-capable POS, and multi-store financial tracking.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Bottleneck</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A 14-location regional retailer experienced severe stock drift between retail counters and central storage. Intermittent Internet connectivity caused counter staff to fall back to paper receipts, creating a 5-day month-end reconciliation delay.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Architecture</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Deployed Opero with local-first IndexedDB offline caching on POS terminals, asynchronous queue synchronization via Redis when connections resume, automated barcode threshold triggers, and real-time bank reconciliation.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Measured Impact</div>
                <div class="case-meta-val">92% Drop in Stock Drift</div>
              </div>
              <div>
                <div class="case-meta-title">Reconciliation Speed</div>
                <div class="case-meta-val">5 Days &rarr; Same-Day Close</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">Opero Core</span>
                <span class="tech-tag">PostgreSQL</span>
                <span class="tech-tag">IndexedDB (Offline)</span>
                <span class="tech-tag">Redis Queue</span>
                <span class="tech-tag">WebSockets</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem;display:flex;gap:0.75rem">
              <a href="{{ route('opero') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Explore Opero Platform →</a>
            </div>
          </div>
        </div>

        <!-- STUDY 2: ITIKIA HIGH CONCURRENCY -->
        <div class="case-card reveal" data-category="products">
          <div class="case-header">
            <div class="case-category">Product Deployment &bull; Civic Engagement</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">ITIKIA High-Concurrency Public Engagement Hub</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Scalable engagement hub serving 100k+ concurrent visitors during nationwide broadcast announcements.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Bottleneck</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A public advocacy movement suffered crashes during television manifesto broadcasts. Volunteer intake was scattered across disorganized Google Sheets, leading to volunteer abandonment and unrouted inquiries.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Architecture</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Engineered edge caching layers on Cloudflare Workers, structured asynchronous volunteer onboarding with geocoding, multi-tiered donor reporting, and broadcast-ready press distribution.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Measured Uptime</div>
                <div class="case-meta-val">99.98% Under 100k Spikes</div>
              </div>
              <div>
                <div class="case-meta-title">Volunteer Retention</div>
                <div class="case-meta-val">14,800+ Verified Registrations</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">ITIKIA Core</span>
                <span class="tech-tag">Edge Caching</span>
                <span class="tech-tag">Daraja M-Pesa API</span>
                <span class="tech-tag">SMS Gateway</span>
                <span class="tech-tag">Worker Pools</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem;display:flex;gap:0.75rem">
              <a href="{{ route('itikia') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Explore ITIKIA Platform →</a>
            </div>
          </div>
        </div>

        <!-- STUDY 3: FLEET TELEMATICS -->
        <div class="case-card reveal" data-category="logistics">
          <div class="case-header">
            <div class="case-category">Custom Engineering &bull; Logistics</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Fleet Dispatch &amp; Route Telematics API</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Real-time driver assignment, digital proof-of-delivery, and automated status webhooks.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Bottleneck</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A regional freight and courier provider was coordinating 90+ transport vehicles through manual phone calls and paper delivery sheets, resulting in delayed milestone confirmations and lost consignment documentation.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Architecture</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Architected a progressive web application for drivers with geofence milestone tracking, digital recipient signatures, automated SMS delivery alerts, and bi-directional customer tracking webhooks.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Delivery Format</div>
                <div class="case-meta-val">Driver PWA + Admin Cockpit</div>
              </div>
              <div>
                <div class="case-meta-title">Consignment Velocity</div>
                <div class="case-meta-val">Zero Paper Manifests</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">RESTful API</span>
                <span class="tech-tag">PWA</span>
                <span class="tech-tag">PostGIS / Mapbox</span>
                <span class="tech-tag">S3 Storage</span>
                <span class="tech-tag">Redis Pub/Sub</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem;display:flex;gap:0.75rem">
              <a href="{{ route('solutions.custom-software') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Custom Software Details →</a>
            </div>
          </div>
        </div>

        <!-- STUDY 4: RECONCILIATION PIPELINE -->
        <div class="case-card reveal" data-category="finance">
          <div class="case-header">
            <div class="case-category">Custom Engineering &bull; Financial Operations</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Automated Multi-Bank Reconciliation Pipeline</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Replacing manual spreadsheet audits with automated bank statement ingestion and matching.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Bottleneck</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A B2B enterprise processed hundreds of invoice settlements per week across three commercial banks and two mobile money merchants. Staff spent 10+ days per month manually cross-referencing paper bank printouts with internal ledger entries.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Architecture</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Engineered an asynchronous matching pipeline that parses MT940 and CSV banking feeds, validates reference algorithms against active invoices, surfaces discrepancies in an exception dashboard, and writes reconciled journal entries directly into the accounting system.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Time Recovery</div>
                <div class="case-meta-val">10 Days/Month Recovered</div>
              </div>
              <div>
                <div class="case-meta-title">Matching Precision</div>
                <div class="case-meta-val">99.8% Automated Clear</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">PHP / Laravel</span>
                <span class="tech-tag">PostgreSQL</span>
                <span class="tech-tag">Queue Workers</span>
                <span class="tech-tag">Audit Trail Engine</span>
                <span class="tech-tag">CSV / MT940 Parser</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem;display:flex;gap:0.75rem">
              <a href="{{ route('solutions.business-systems') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Business Systems Details →</a>
            </div>
          </div>
        </div>
      </div>

      <!-- CALLOUT TO PORTFOLIO SHOWCASE -->
      <div class="study-hero-card reveal">
        <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:2rem;align-items:center">
          <div>
            <span class="badge badge--accent" style="margin-bottom:0.75rem">📁 Production Portfolio</span>
            <h3 style="font-size:1.6rem;margin-bottom:0.75rem">Looking for the Complete Systems Portfolio?</h3>
            <p style="color:var(--text-secondary);font-size:0.95rem;line-height:1.7">
              Browse our broader showcase of production web applications, client portals, internal cockpits, and architecture blueprints.
            </p>
          </div>
          <div style="text-align:right">
            <a href="{{ route('portfolio') }}" class="btn btn--primary btn--lg">View Systems Portfolio →</a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Have a Complex System That Needs Architecture?</h2>
        <p>Consult directly with our engineering leads to review requirements, scalability, and deployment timelines.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Schedule a Technical Call →</a>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script>
  window.filterCaseStudies = function(category, btn) {
    document.querySelectorAll('.case-filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const cards = document.querySelectorAll('.case-card');
    cards.forEach(card => {
      if (category === 'all' || card.getAttribute('data-category') === category) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  };
</script>
@endsection
