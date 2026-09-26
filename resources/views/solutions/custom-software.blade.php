@extends('layouts.app')
@section('title', 'Custom Software Engineering — CypressIQ Solutions')
@section('meta_description', 'CypressIQ engineers custom software around specific organizational needs: bespoke applications, internal business platforms, APIs, automation, and scalable systems.')

@section('css')
<style>
  .tech-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    padding: 2.5rem;
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 3rem;
    align-items: center;
    position: relative;
    overflow: hidden;
    transition: all var(--transition-base);
  }
  .tech-card:hover {
    border-color: var(--border-accent);
    box-shadow: var(--shadow-md);
  }
  .tech-spec-box {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 1.75rem;
  }
  .tech-tag {
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
  .process-step-row {
    display: grid;
    grid-template-columns: 60px 1fr;
    gap: 1.5rem;
    padding: 1.75rem 0;
    border-bottom: 1px solid var(--border-subtle);
  }
  .process-step-row:last-child { border-bottom: none; }
  .step-circle {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-full);
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    color: white;
    font-family: var(--font-display);
  }
  @media (max-width: 900px) {
    .tech-card { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2;text-align:center;max-width:860px;margin:0 auto">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">💻 Client Solutions · Custom Software</span>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Software Engineered Around <span class="text-gradient">Your Operational Reality</span>
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        When commercial off-the-shelf software forces compromises, CypressIQ architects, builds, and maintains custom software, web applications, and connected business platforms tailored to your organization's exact workflows.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Start Technical Project →</a>
        <a href="#capabilities" class="btn btn--secondary btn--lg">Explore Capabilities</a>
        <button type="button" class="btn btn--outline btn--lg" onclick="openProductVideoModal('solutions')">Review Systems Walkthrough 🎥</button>
      </div>
    </div>
  </section>

  <!-- CAPABILITIES CONTAINER -->
  <section class="section" id="capabilities">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 4rem">
        <span class="badge badge--primary">⚙️ Capabilities Breakdown</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Full-Lifecycle <span class="text-gradient">Engineering Services</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          From greenfield web applications to mission-critical backend integrations and legacy modernization.
        </p>
      </div>

      <!-- 1. Web Applications & Custom Software -->
      <div class="tech-card reveal">
        <div>
          <span class="badge badge--accent" style="margin-bottom:1rem">01 · Web &amp; Enterprise</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Custom Web Applications &amp; Portals</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            We build performant, secure, and intuitive web applications tailored to how your teams actually operate. Modern responsive interfaces backed by resilient server-side architecture and normalized relational databases.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1.5rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Role-based access control (RBAC) with granular user permissions</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Offline-tolerant local data synchronization for remote field operations</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Real-time notifications, websocket feeds, and executive data visualizations</span></li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.05em">Core Stack</div>
          <div style="margin-bottom:1.25rem">
            <span class="tech-tag">Laravel 11</span>
            <span class="tech-tag">PHP 8.2+</span>
            <span class="tech-tag">PostgreSQL</span>
            <span class="tech-tag">MySQL 8.0</span>
            <span class="tech-tag">Redis</span>
            <span class="tech-tag">REST APIs</span>
          </div>
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Delivery Paradigm</div>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">Test-driven design, isolated staging environments, and zero-downtime deployment pipelines.</p>
        </div>
      </div>

      <!-- 2. System Integration & APIs -->
      <div class="tech-card reveal">
        <div>
          <span class="badge badge--primary" style="margin-bottom:1rem">02 · Connectivity</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">API Architecture &amp; System Integration</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            Connect disparate software systems into unified data flows. We engineer resilient API gateways, event-driven webhooks, and fault-tolerant connectors between internal tools and external services.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1.5rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Financial payment gateway rails (M-Pesa Daraja, Stripe, Bank APIs)</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Two-way inventory and order synchronization across retail channels</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Automated retry logic with exponential backoff and dead-letter queues</span></li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.05em">Integration Standards</div>
          <div style="margin-bottom:1.25rem">
            <span class="tech-tag">M-Pesa Daraja</span>
            <span class="tech-tag">OpenAPI 3.0</span>
            <span class="tech-tag">OAuth 2.0</span>
            <span class="tech-tag">Webhooks</span>
            <span class="tech-tag">Queue Workers</span>
            <span class="tech-tag">HMAC Auth</span>
          </div>
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Reliability Benchmark</div>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">Idempotent payload processing with cryptographic payload verification to guarantee zero duplicate financial transactions.</p>
        </div>
      </div>

      <!-- 3. Workflow Automation & Operations -->
      <div class="tech-card reveal">
        <div>
          <span class="badge badge--warning" style="margin-bottom:1rem">03 · Automation</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Workflow Automation &amp; Process Digitization</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            Eliminate repetitive manual bottlenecks. We automate multi-step internal approvals, document generation, invoice matching, and cross-department notification workflows.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1.5rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Automated document parsing, thermal receipt generation, and PDF invoicing</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Scheduled audit report compilation and automated management email digests</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent)">✓</span><span>Event-triggered SMS broadcasts and WhatsApp business API routing</span></li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.05em">Automation Infrastructure</div>
          <div style="margin-bottom:1.25rem">
            <span class="tech-tag">Cron Daemons</span>
            <span class="tech-tag">Horizon</span>
            <span class="tech-tag">Event Dispatchers</span>
            <span class="tech-tag">DOMPDF</span>
            <span class="tech-tag">Twilio / SMS</span>
          </div>
          <div style="font-size:0.8rem;font-weight:700;color:var(--text-muted);margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Efficiency Metric</div>
          <p style="color:var(--text-secondary);font-size:0.8rem;line-height:1.6">Eliminating redundant data re-entry across administrative teams to reduce administrative cycle times by up to 80%.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ENGINEERING METHODOLOGY -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3rem">
        <span class="badge badge--accent">📐 Methodology</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          How We Deliver <span class="text-gradient">Custom Software</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          A disciplined, four-phase delivery cycle from operational discovery to production deployment.
        </p>
      </div>

      <div style="max-width:800px;margin:0 auto">
        <div class="process-step-row reveal">
          <div class="step-circle">1</div>
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Operational Audit &amp; Technical Discovery</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We audit your operational workflows, identify data handoff friction points, map stakeholder requirements, and outline exact system boundaries before writing a single line of code.
            </p>
          </div>
        </div>
        <div class="process-step-row reveal">
          <div class="step-circle">2</div>
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Relational Schema &amp; Component Design</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We design normalized relational database tables, API contracts, and user interface prototypes with a strict focus on usability and error prevention.
            </p>
          </div>
        </div>
        <div class="process-step-row reveal">
          <div class="step-circle">3</div>
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Iterative Engineering &amp; Automated Verification</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We construct software in testable milestones, running automated unit and feature tests to guarantee reliability and transaction safety.
            </p>
          </div>
        </div>
        <div class="process-step-row reveal">
          <div class="step-circle">4</div>
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Deployment, Handover &amp; SLA Support</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              We provision production environments, execute zero-downtime deployments, conduct team training, and provide ongoing maintenance contracts.
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
        <span class="badge badge--primary" style="margin-bottom:1rem">Project Inquiry</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Discuss Your Custom Software Requirements
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Schedule an architectural consultation with our engineering team to review specifications, timelines, and technical feasibility.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Technical Consultation →</a>
          <a href="{{ route('portfolio') }}" class="btn btn--outline btn--lg">View Deliveries &amp; Case Studies</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Centered Product Video Walkthrough Modal -->
  @include('partials.product-video-modal')
@endsection
