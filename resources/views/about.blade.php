@extends('layouts.app')
@section('title', 'About CypressIQ — Technology Company & Product Studio')

@section('css')
<style>
  .evolution-track {
    position: relative;
    padding: 2rem 0;
  }
  .evolution-track::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--gradient-primary);
    transform: translateX(-50%);
  }
  .evolution-step {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2.5rem;
    align-items: center;
    margin-bottom: 3.5rem;
  }
  .evolution-step:nth-child(even) .step-content {
    grid-column: 3;
    text-align: left;
  }
  .evolution-step:nth-child(even) .step-empty {
    grid-column: 1;
  }
  .evolution-step:nth-child(odd) .step-content {
    text-align: right;
  }
  .step-node {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--bg-card);
    border: 2px solid var(--clr-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    box-shadow: 0 0 20px rgba(108, 99, 255, 0.3);
    z-index: 1;
  }
  .step-phase {
    font-family: monospace;
    font-size: 0.8rem;
    color: var(--clr-primary-light);
    font-weight: 700;
    letter-spacing: 0.05em;
    margin-bottom: 0.4rem;
  }
  .step-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 1.75rem;
  }
  .principle-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2.25rem;
    transition: all 0.3s;
  }
  .principle-card:hover {
    transform: translateY(-4px);
    border-color: var(--border-accent);
  }
  .discipline-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2rem;
    text-align: center;
  }
  .discipline-icon {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-lg);
    background: var(--bg-glass);
    border: 1px solid var(--border-subtle);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin: 0 auto 1.25rem;
  }
  @media (max-width: 768px) {
    .evolution-track::before { left: 26px; }
    .evolution-step { grid-template-columns: auto 1fr; gap: 1.5rem; }
    .evolution-step:nth-child(even) .step-content { grid-column: 2; }
    .evolution-step:nth-child(even) .step-empty, .step-empty { display: none; }
    .evolution-step:nth-child(odd) .step-content { text-align: left; }
  }
</style>
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">⚙️ Who We Are</span>
      <h1>Technology Built for <span class="text-gradient">Organizations in Motion</span></h1>
      <p>CypressIQ is a technology company and product studio based in East Africa. We develop proprietary software products, engineer custom business systems, and guide digital transformation.</p>
    </div>
  </section>

  <!-- PURPOSE & IDENTITY -->
  <section class="section">
    <div class="container">
      <div class="grid grid-2 stagger" style="max-width:1050px;margin:0 auto;gap:2rem">
        <div class="card reveal" style="padding:2.75rem;background:linear-gradient(135deg,rgba(108,99,255,0.08),rgba(108,99,255,0.02));border-color:rgba(108,99,255,0.25)">
          <div style="font-size:2.5rem;margin-bottom:1rem">🎯</div>
          <h3 style="font-size:1.4rem;margin-bottom:0.75rem">Our Core Purpose</h3>
          <p style="color:var(--text-secondary);line-height:1.8;font-size:0.95rem">
            Organizations across East Africa face fragmented workflows: critical operational records scattered across WhatsApp threads, paper receipts, and unlinked spreadsheets. Our purpose is to engineer cohesive, resilient software that brings clarity, speed, and governance to daily operations.
          </p>
        </div>
        <div class="card reveal" style="padding:2.75rem;background:linear-gradient(135deg,rgba(0,212,170,0.08),rgba(0,212,170,0.02));border-color:rgba(0,212,170,0.25)">
          <div style="font-size:2.5rem;margin-bottom:1rem">🏛️</div>
          <h3 style="font-size:1.4rem;margin-bottom:0.75rem">Product &amp; Systems Studio</h3>
          <p style="color:var(--text-secondary);line-height:1.8;font-size:0.95rem">
            We are not a marketing agency. We do not sell superficial advertising packages. We are a software engineering organization. We design, deploy, and maintain platforms that handle real financial transactions, multi-branch stock reconciliation, and high-volume public engagement.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- THE THREE PILLARS (OVERVIEW) -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">CypressIQ Architecture</span>
        <h2>How We <span class="text-gradient">Deliver Value</span></h2>
        <p>Three complementary pillars designed to meet organizations wherever they are in their digital lifecycle.</p>
      </div>

      <div class="grid grid-3 stagger">
        <div class="principle-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📦</div>
          <h3 style="font-size:1.2rem;margin-bottom:0.5rem">1. Proprietary Digital Products</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7;margin-bottom:1.25rem">
            Turnkey software platforms developed and continuously maintained in-house. <strong>Opero</strong> powers unified multi-branch commerce, inventory, HR, and accounting. <strong>ITIKIA Campaign</strong> drives public advocacy, volunteer mobilization, and verified funding.
          </p>
          <div style="display:flex;gap:0.5rem">
            <a href="{{ route('opero') }}" class="btn btn--outline btn--sm">Opero →</a>
            <a href="{{ route('itikia') }}" class="btn btn--outline btn--sm">ITIKIA →</a>
          </div>
        </div>

        <div class="principle-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">💻</div>
          <h3 style="font-size:1.2rem;margin-bottom:0.5rem">2. Custom Technology Engineering</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7;margin-bottom:1.25rem">
            For operational requirements that off-the-shelf software cannot satisfy. We engineer tailor-made web applications, enterprise portals, API bridges, mobile money integrations, and specialized database architectures.
          </p>
          <a href="{{ route('solutions.custom-software') }}" class="btn btn--outline btn--sm">Custom Engineering →</a>
        </div>

        <div class="principle-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">🔄</div>
          <h3 style="font-size:1.2rem;margin-bottom:0.5rem">3. Digital Transformation Practice</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7;margin-bottom:1.25rem">
            Guiding established organizations as they transition from paper records and legacy silos into connected digital operations. We conduct audits, plan data migration, train teams, and implement sustainable governance.
          </p>
          <a href="{{ route('solutions.technology-consulting') }}" class="btn btn--outline btn--sm">Transformation Roadmap →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- EVOLUTION TIMELINE -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">Our Trajectory</span>
        <h2>The Evolution of <span class="text-gradient">CypressIQ</span></h2>
        <p>From custom software projects to an integrated technology company and product studio.</p>
      </div>

      <div class="evolution-track" style="max-width:860px;margin:0 auto">
        <div class="evolution-step reveal">
          <div class="step-content">
            <div class="step-card">
              <div class="step-phase">FOUNDATION &bull; 2021</div>
              <h4 style="margin-bottom:0.5rem">Bespoke Software &amp; Systems Engineering</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Began by building custom web applications and bespoke internal systems for commercial enterprises in East Africa, mastering database scalability, offline resilience, and localized payment rails.
              </p>
            </div>
          </div>
          <div class="step-node">🌱</div>
          <div class="step-empty"></div>
        </div>

        <div class="evolution-step reveal">
          <div class="step-empty"></div>
          <div class="step-node">⚙️</div>
          <div class="step-content">
            <div class="step-card">
              <div class="step-phase">INCEPTION &bull; 2023</div>
              <h4 style="margin-bottom:0.5rem">Recognizing Operational Gaps: Opero Platform</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Noticed that multi-location enterprises struggled with heavy, unlocalized enterprise ERPs. We architected Opero as a modular business management engine covering POS, inventory, HR, payroll, and financials tailored for regional commerce.
              </p>
            </div>
          </div>
        </div>

        <div class="evolution-step reveal">
          <div class="step-content">
            <div class="step-card">
              <div class="step-phase">CIVIC ENGAGEMENT &bull; 2024</div>
              <h4 style="margin-bottom:0.5rem">Public Mobilization: ITIKIA Campaign</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Recognized that public campaigns and civic organizations lacked professionalized digital machinery. Engineered ITIKIA Campaign to unite real-time event mapping, volunteer dispatch, policy manifestos, and multi-channel funding.
              </p>
            </div>
          </div>
          <div class="step-node">📣</div>
          <div class="step-empty"></div>
        </div>

        <div class="evolution-step reveal">
          <div class="step-empty"></div>
          <div class="step-node">⚡</div>
          <div class="step-content">
            <div class="step-card">
              <div class="step-phase">PRESENT &bull; 2026</div>
              <h4 style="margin-bottom:0.5rem">Unified Technology Studio</h4>
              <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.6">
                Operating as a complete technology partner: powering businesses through proprietary products, engineering custom systems, and leading comprehensive digital modernization across East Africa.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ENGINEERING PHILOSOPHY -->
  <section id="philosophy" class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">Engineering Culture</span>
        <h2>Principles That Guide <span class="text-gradient">Every Line of Code</span></h2>
      </div>

      <div class="grid grid-2 stagger" style="max-width:1050px;margin:0 auto;gap:1.5rem">
        <div class="principle-card reveal">
          <h4 style="font-size:1.15rem;margin-bottom:0.5rem;color:var(--clr-primary-light)">1. Reality-First Engineering</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            We build software for real-world operating conditions: intermittent connectivity, varying device capabilities, and diverse user digital literacy. Systems must be fault-tolerant and intuitive, not fragile.
          </p>
        </div>

        <div class="principle-card reveal">
          <h4 style="font-size:1.15rem;margin-bottom:0.5rem;color:var(--clr-accent)">2. Open Standards &amp; Interoperability</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            We do not create closed walled gardens. We build with clean relational database schemas, standard REST APIs, and automated backup routines so your organization maintains full sovereignty over its data.
          </p>
        </div>

        <div class="principle-card reveal">
          <h4 style="font-size:1.15rem;margin-bottom:0.5rem;color:var(--clr-warning)">3. Direct Engineer-to-Client Access</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            We eliminate layers of account executives and non-technical intermediaries. When you collaborate with CypressIQ, you communicate directly with software engineers and systems architects who build and maintain the solution.
          </p>
        </div>

        <div class="principle-card reveal">
          <h4 style="font-size:1.15rem;margin-bottom:0.5rem;color:var(--clr-primary-light)">4. Long-Term Maintainability</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            We prioritize readable, maintainable, and well-tested code over obscure shortcuts. Systems are architected so that future engineers, internal IT staff, and third-party auditors can easily understand and extend them.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- FUNCTIONAL DISCIPLINES -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">Our Disciplines</span>
        <h2>Engineering &amp; Delivery <span class="text-gradient">Capabilities</span></h2>
        <p>Our multidisciplinary team covers the complete software product lifecycle.</p>
      </div>

      <div class="grid grid-4 stagger">
        <div class="discipline-card reveal">
          <div class="discipline-icon">📐</div>
          <h4 style="margin-bottom:0.35rem">Systems Architecture</h4>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">Database modeling, schema design, API contract definition, and system security boundaries.</p>
        </div>
        <div class="discipline-card reveal">
          <div class="discipline-icon">💻</div>
          <h4 style="margin-bottom:0.35rem">Full-Stack Development</h4>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">High-performance web applications, responsive customer portals, and asynchronous queue workers.</p>
        </div>
        <div class="discipline-card reveal">
          <div class="discipline-icon">☁️</div>
          <h4 style="margin-bottom:0.35rem">Cloud &amp; DevOps</h4>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">Automated deployment pipelines, server monitoring, edge caching, and automated disaster recovery.</p>
        </div>
        <div class="discipline-card reveal">
          <div class="discipline-icon">🤝</div>
          <h4 style="margin-bottom:0.35rem">Implementation &amp; SLA</h4>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">On-site deployment, staff training, data migration from legacy spreadsheets, and continuous hypercare.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Partner with a Genuine Technology Team</h2>
        <p>Let's discuss how our digital products or custom engineering can bring order and scale to your operations.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Talk to an Engineer →</a>
      </div>
    </div>
  </section>
@endsection
