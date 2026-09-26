@extends('layouts.app')
@section('title', 'Engineering Case Studies & System Implementations — CypressIQ')

@section('css')
<style>
  .portfolio-filters {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 3.5rem;
  }
  .filter-btn {
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
  .filter-btn.active, .filter-btn:hover {
    background: var(--gradient-primary);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
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
  .featured-deep-dive {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    padding: 3rem;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 3rem;
    align-items: center;
    position: relative;
    overflow: hidden;
  }
  .featured-deep-dive::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
  }
  .architecture-stack {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  .arch-item {
    display: flex;
    align-items: flex-start;
    gap: 0.85rem;
    padding: 1rem;
    background: var(--bg-glass);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-md);
  }
  .arch-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
    padding-top: 0.1rem;
  }
  @media (max-width: 900px) {
    .case-grid { grid-template-columns: 1fr; }
    .featured-deep-dive { grid-template-columns: 1fr; padding: 2rem; }
  }
</style>
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">🏗️ Systems in Production</span>
      <h1>Engineered for <span class="text-gradient">Operational Reality</span></h1>
      <p>A technical overview of proprietary platforms, custom business systems, and architectural solutions built by CypressIQ across East Africa and beyond.</p>
      <div style="display:flex;gap:1rem;justify-content:center;margin-top:1.5rem">
        <a href="{{ route('trust') }}" class="btn btn--secondary btn--sm">⭐ View Client Testimonials &amp; Verified Track Record →</a>
      </div>
    </div>
  </section>

  <!-- CASE STUDIES GRID -->
  <section class="section">
    <div class="container">
      <div class="portfolio-filters reveal">
        <button class="filter-btn active" onclick="window.filterCases('all', this)">All Deployments</button>
        <button class="filter-btn" onclick="window.filterCases('products', this)">Proprietary Products</button>
        <button class="filter-btn" onclick="window.filterCases('custom', this)">Custom Software &amp; APIs</button>
        <button class="filter-btn" onclick="window.filterCases('transformation', this)">Digital Transformation</button>
      </div>

      <div class="case-grid">
        <!-- CASE 1: OPERO ERP -->
        <div class="case-card reveal" data-category="products">
          <div class="case-header">
            <div class="case-category">Product Deployment &bull; Operations</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Opero Multi-Branch Retail &amp; Inventory Engine</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Centralized catalog synchronization, offline-capable POS, and multi-store financial tracking.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Challenge</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A multi-branch distribution business struggled with inventory discrepancies between physical retail stores and central warehouse storage. Point-of-sale terminals lacked offline resilience during intermittent network outages, causing manual paper log backups.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Solution</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Deployed Opero with local-first offline caching, background queue synchronization when connectivity resumes, automated stock threshold triggers, and real-time branch shift reconciliation.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Deployment Scope</div>
                <div class="case-meta-val">Multi-Store POS &amp; Inventory</div>
              </div>
              <div>
                <div class="case-meta-title">Integrations</div>
                <div class="case-meta-val">ESC/POS, Barcode, Ledger Export</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">Opero Core</span>
                <span class="tech-tag">PostgreSQL</span>
                <span class="tech-tag">Redis Cache</span>
                <span class="tech-tag">IndexedDB (Offline)</span>
                <span class="tech-tag">WebSockets</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem">
              <a href="{{ route('opero') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Explore Opero Capabilities →</a>
            </div>
          </div>
        </div>

        <!-- CASE 2: ITIKIA CAMPAIGN -->
        <div class="case-card reveal" data-category="products">
          <div class="case-header">
            <div class="case-category">Product Deployment &bull; Civic Engagement</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">ITIKIA High-Concurrency Engagement Platform</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Public-facing engagement hub supporting thousands of concurrent visitors during announcements.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Challenge</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A public interest campaign required an authentic, secure digital headquarters to coordinate field volunteers, publish real-time newsroom releases, and distribute digital manifestos without crashing under live broadcast traffic spikes.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Solution</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Configured ITIKIA Campaign with edge-cached content delivery, structured volunteer onboarding workflows, verified multi-channel donation integrations, and an administrative dashboard for field rally dispatch.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Deployment Scope</div>
                <div class="case-meta-val">Engagement &amp; Field Coordination</div>
              </div>
              <div>
                <div class="case-meta-title">Key Channels</div>
                <div class="case-meta-val">Web Portal, SMS Gateway, USSD</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">ITIKIA Core</span>
                <span class="tech-tag">Edge Caching</span>
                <span class="tech-tag">Mobile Money API</span>
                <span class="tech-tag">SMS Gateway</span>
                <span class="tech-tag">Role-Based Auth</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem">
              <a href="{{ route('itikia') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Explore ITIKIA Campaign →</a>
            </div>
          </div>
        </div>

        <!-- CASE 3: FLEET & DISPATCH GATEWAY -->
        <div class="case-card reveal" data-category="custom">
          <div class="case-header">
            <div class="case-category">Custom Engineering &bull; Logistics</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Fleet Dispatch &amp; Route Telematics API</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Real-time driver assignment, digital proof-of-delivery, and automated status webhooks.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Challenge</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A regional freight and courier provider was coordinating 90+ transport vehicles through manual WhatsApp messages and paper delivery sheets, resulting in delayed milestone confirmations and lost consignment documentation.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Solution</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Architected a progressive web application for drivers with geofence milestone tracking, digital recipient signatures, automated SMS delivery alerts, and bi-directional customer tracking webhooks.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Delivery Format</div>
                <div class="case-meta-val">Driver PWA + Admin Console</div>
              </div>
              <div>
                <div class="case-meta-title">Core Capability</div>
                <div class="case-meta-val">Digital Proof-of-Delivery</div>
              </div>
            </div>
            <div>
              <div class="case-meta-title" style="margin-bottom:0.35rem">Technology Stack</div>
              <div class="tech-tags">
                <span class="tech-tag">RESTful API</span>
                <span class="tech-tag">Progressive Web App</span>
                <span class="tech-tag">PostGIS / Mapbox</span>
                <span class="tech-tag">S3 Storage</span>
                <span class="tech-tag">Redis Pub/Sub</span>
              </div>
            </div>
            <div style="margin-top:auto;padding-top:1rem">
              <a href="{{ route('solutions.custom-software') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Custom Software Capabilities →</a>
            </div>
          </div>
        </div>

        <!-- CASE 4: RECONCILIATION ENGINE -->
        <div class="case-card reveal" data-category="transformation">
          <div class="case-header">
            <div class="case-category">Digital Transformation &bull; Finance</div>
            <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Automated Multi-Bank Reconciliation Engine</h3>
            <p style="color:var(--text-secondary);font-size:0.875rem">Replacing manual spreadsheet audits with automated bank statement ingestion and matching.</p>
          </div>
          <div class="case-body">
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Operational Challenge</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                A B2B enterprise processed hundreds of invoice settlements per week across three commercial banks and two mobile money merchants. Staff spent 10+ days per month manually cross-referencing paper bank printouts with internal ledger entries.
              </p>
            </div>
            <div>
              <h4 style="font-size:0.95rem;margin-bottom:0.4rem;color:var(--text-primary)">Engineering Solution</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Engineered an asynchronous matching pipeline that parses MT940 and CSV banking feeds, validates reference algorithms against active invoices, surfaces discrepancies in an exception dashboard, and writes reconciled journal entries directly into the accounting system.
              </p>
            </div>
            <div class="case-meta-grid">
              <div>
                <div class="case-meta-title">Transformation Scope</div>
                <div class="case-meta-val">Spreadsheet to Automated Ingestion</div>
              </div>
              <div>
                <div class="case-meta-title">Auditability</div>
                <div class="case-meta-val">Full Cryptographic Audit Trail</div>
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
            <div style="margin-top:auto;padding-top:1rem">
              <a href="{{ route('solutions.technology-consulting') }}" class="btn btn--outline btn--sm w-full" style="text-align:center">Digital Transformation Roadmap →</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURED ARCHITECTURE DEEP DIVE -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">Architecture Deep Dive</span>
        <h2>How We Engineer <span class="text-gradient">For Reliability</span></h2>
        <p>Software designed for real-world bandwidth constraints, operational stress, and verifiable data integrity.</p>
      </div>

      <div class="featured-deep-dive reveal">
        <div>
          <h3 style="font-size:1.5rem;margin-bottom:1rem">The CypressIQ Systems Blueprint</h3>
          <p style="color:var(--text-secondary);margin-bottom:1.5rem;line-height:1.8">
            Every digital platform or custom software solution we build follows a foundational architecture that balances performance, ease of maintenance, and institutional longevity.
          </p>
          <div class="architecture-stack">
            <div class="arch-item">
              <div class="arch-icon">⚡</div>
              <div>
                <strong style="color:var(--text-primary);display:block;font-size:0.95rem">Resilient Data Storage &amp; Integrity</strong>
                <span style="color:var(--text-secondary);font-size:0.85rem">ACID-compliant relational databases, strict schema migrations, and automated multi-region snapshot backups.</span>
              </div>
            </div>
            <div class="arch-item">
              <div class="arch-icon">🔌</div>
              <div>
                <strong style="color:var(--text-primary);display:block;font-size:0.95rem">API-First System Interoperability</strong>
                <span style="color:var(--text-secondary);font-size:0.85rem">Strict OpenAPI specifications, tokenized authentication, and webhooks that allow clean integration with external accounting, ERP, or payment systems.</span>
              </div>
            </div>
            <div class="arch-item">
              <div class="arch-icon">🛡️</div>
              <div>
                <strong style="color:var(--text-primary);display:block;font-size:0.95rem">Granular Role-Based Access Controls</strong>
                <span style="color:var(--text-secondary);font-size:0.85rem">Multi-tenant isolation, precise permissions per staff tier, and immutable audit logs on sensitive financial actions.</span>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:2rem">
            <h4 style="font-size:1.1rem;margin-bottom:1rem;color:var(--clr-primary-light)">Engineering Guarantees</h4>
            <ul style="display:flex;flex-direction:column;gap:0.85rem;color:var(--text-secondary);font-size:0.875rem">
              <li style="display:flex;gap:0.75rem">
                <span style="color:var(--clr-accent)">✓</span>
                <span><strong>Zero Vendor Trap:</strong> Clean, well-documented source code and database migrations belonging to your organization.</span>
              </li>
              <li style="display:flex;gap:0.75rem">
                <span style="color:var(--clr-accent)">✓</span>
                <span><strong>Offline-Aware Architecture:</strong> Critical workflows engineered to prevent data loss during network hiccups.</span>
              </li>
              <li style="display:flex;gap:0.75rem">
                <span style="color:var(--clr-accent)">✓</span>
                <span><strong>Security by Design:</strong> Throttled endpoints, CSRF defenses, parameter sanitization, and encrypted credential storage.</span>
              </li>
              <li style="display:flex;gap:0.75rem">
                <span style="color:var(--clr-accent)">✓</span>
                <span><strong>Direct Technical Ownership:</strong> Senior software engineers build and review your codebase from day one.</span>
              </li>
            </ul>
            <div style="margin-top:2rem">
              <a href="{{ route('contact') }}" class="btn btn--primary w-full" style="text-align:center">Consult with Our Architects →</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Have a System That Needs to Be Built or Fixed?</h2>
        <p>Speak directly with our technical team to discuss requirements, architecture, and realistic project timelines.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Schedule a Technical Call →</a>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script>
  window.filterCases = function(category, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
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
