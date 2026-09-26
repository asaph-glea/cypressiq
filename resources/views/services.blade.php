@extends('layouts.app')
@section('title', 'Custom Software Engineering — CypressIQ Solutions')
@section('meta_description', 'CypressIQ engineers custom software around specific organizational needs: custom applications, internal platforms, APIs, automation, and scalable systems.')

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
      <div class="tech-card reveal" id="web-apps">
        <div>
          <span class="badge badge--primary" style="margin-bottom:1rem">💻 Core Engineering</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Web Applications &amp; Custom Software</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            We build robust, database-driven web applications designed for stability, security, and high concurrency. From customer-facing products to operational management tools, our codebases adhere to modern architecture standards with strict type safety and modular components.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem;font-size:0.9rem;color:var(--text-secondary)">
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Custom SaaS &amp; multi-tenant architecture</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Responsive, reactive interfaces (Vue, Alpine, modern JS)</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Robust backend logic with PHP 8.2+ and Laravel</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Comprehensive relational schema design (MySQL / PostgreSQL)</li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--clr-accent);margin-bottom:0.75rem">// TECHNICAL SPECS</div>
          <div style="margin-bottom:1rem">
            <span class="tech-tag">Laravel 12</span>
            <span class="tech-tag">REST APIs</span>
            <span class="tech-tag">Tailwind CSS</span>
            <span class="tech-tag">MySQL / Postgres</span>
            <span class="tech-tag">Docker</span>
          </div>
          <div style="font-size:0.8rem;color:var(--text-secondary);border-top:1px solid var(--border-subtle);padding-top:0.75rem">
            Typical delivery: Modular iterative milestones with continuous automated testing.
          </div>
        </div>
      </div>

      <!-- 2. Business Systems & Internal Platforms -->
      <div class="tech-card reveal" id="systems">
        <div>
          <span class="badge badge--accent" style="margin-bottom:1rem">🏢 Enterprise Operations</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Business Systems &amp; Internal Platforms</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            Eliminate operational chaos. We develop internal enterprise cockpits, inventory loggers, approval chains, and multi-branch management systems that give executive leadership real-time visibility across all operations.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem;font-size:0.9rem;color:var(--text-secondary)">
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Multi-department approval workflows and status queues</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time telemetry, transaction logging, and ledger auditability</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Role-based access control (RBAC) with granular permissions</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> PDF document and invoice generation on demand</li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--clr-primary);margin-bottom:0.75rem">// ARCHITECTURE</div>
          <div style="margin-bottom:1rem">
            <span class="tech-tag">RBAC</span>
            <span class="tech-tag">Audit Trails</span>
            <span class="tech-tag">PDF Generation</span>
            <span class="tech-tag">Multi-Branch</span>
            <span class="tech-tag">Encrypted Storage</span>
          </div>
          <div style="font-size:0.8rem;color:var(--text-secondary);border-top:1px solid var(--border-subtle);padding-top:0.75rem">
            Designed for secure enterprise intranet deployment or authenticated cloud hosting.
          </div>
        </div>
      </div>

      <!-- 3. Customer & Partner Portals -->
      <div class="tech-card reveal" id="portals">
        <div>
          <span class="badge badge--warning" style="margin-bottom:1rem">👥 External Engagement</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Customer &amp; Partner Portals</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            Provide your clients, distributors, and partners with dedicated, secure self-service portals. Enable them to track order fulfillment, access documentation, manage account profiles, and submit inquiries without manual phone calls.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem;font-size:0.9rem;color:var(--text-secondary)">
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Authenticated user management with 2FA support</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time order and shipment status tracking</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Secure file and contract exchange</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Integrated support ticketing and messaging channels</li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--clr-warning);margin-bottom:0.75rem">// SECURITY &amp; AUTH</div>
          <div style="margin-bottom:1rem">
            <span class="tech-tag">Session Auth</span>
            <span class="tech-tag">Document Vault</span>
            <span class="tech-tag">Ticketing</span>
            <span class="tech-tag">Audit Logs</span>
          </div>
          <div style="font-size:0.8rem;color:var(--text-secondary);border-top:1px solid var(--border-subtle);padding-top:0.75rem">
            Compliant with data privacy standards and encrypted data storage at rest.
          </div>
        </div>
      </div>

      <!-- 4. Integrations, APIs & Automation -->
      <div class="tech-card reveal" id="apis">
        <div>
          <span class="badge badge--primary" style="margin-bottom:1rem">🔌 Data Connectivity</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Integrations, APIs &amp; Workflow Automation</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            Break down the barriers between systems. We build resilient API gateways, webhook listeners, and background task pipelines that connect payment processors (M-Pesa, Stripe, Flutterwave), external CRMs, and third-party logistics.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem;font-size:0.9rem;color:var(--text-secondary)">
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Custom RESTful &amp; GraphQL API design and documentation</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Asynchronous queue processing and scheduled cron pipelines</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Webhook event handling with retry logic and idempotency</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Payment gateway and SMS/WhatsApp notification bridges</li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--clr-accent);margin-bottom:0.75rem">// INTEGRATION STACK</div>
          <div style="margin-bottom:1rem">
            <span class="tech-tag">Webhooks</span>
            <span class="tech-tag">M-Pesa Daraja</span>
            <span class="tech-tag">Queue Workers</span>
            <span class="tech-tag">Stripe</span>
            <span class="tech-tag">Redis</span>
          </div>
          <div style="font-size:0.8rem;color:var(--text-secondary);border-top:1px solid var(--border-subtle);padding-top:0.75rem">
            Built for resilient, fault-tolerant execution with comprehensive error logging.
          </div>
        </div>
      </div>

      <!-- 5. Cloud Deployment & Modernization -->
      <div class="tech-card reveal" id="cloud">
        <div>
          <span class="badge badge--accent" style="margin-bottom:1rem">☁️ DevOps &amp; Cloud</span>
          <h3 style="font-size:1.75rem;margin-bottom:1rem">Cloud Deployment, Maintenance &amp; Modernization</h3>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">
            We configure secure Linux server environments, containerized Docker instances, automated database snapshots, and SSL termination. We also refactor legacy applications to restore stability, eliminate technical debt, and ensure modern security compliance.
          </p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem;font-size:0.9rem;color:var(--text-secondary)">
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Cloud server provisioning (AWS, DigitalOcean, VPS)</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated database snapshots and offsite backup pipelines</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Enterprise security headers (CSP, HSTS, X-Frame protection)</li>
            <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Legacy PHP / Laravel framework upgrades and refactoring</li>
          </ul>
        </div>
        <div class="tech-spec-box">
          <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--clr-primary);margin-bottom:0.75rem">// INFRASTRUCTURE</div>
          <div style="margin-bottom:1rem">
            <span class="tech-tag">Linux / Nginx</span>
            <span class="tech-tag">Docker</span>
            <span class="tech-tag">SSL / TLS</span>
            <span class="tech-tag">PHP 8.2+</span>
            <span class="tech-tag">CI/CD</span>
          </div>
          <div style="font-size:0.8rem;color:var(--text-secondary);border-top:1px solid var(--border-subtle);padding-top:0.75rem">
            Hardened configuration with proactive performance monitoring.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ENGINEERING METHODOLOGY -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3.5rem">
        <span class="badge badge--warning">📐 Our Approach</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Pragmatic Engineering <span class="text-gradient">From Start to Finish</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          We don't over-engineer. We build software that performs, scales predictably, and solves your exact operational problem.
        </p>
      </div>

      <div style="max-width:860px;margin:0 auto">
        <div class="process-step-row reveal">
          <div class="step-circle">1</div>
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Architecture &amp; Requirements Audit</h4>
            <p style="color:var(--text-secondary);line-height:1.7;font-size:0.95rem">
              Before writing code, we interview operational stakeholders to clarify database entities, business constraints, integration endpoints, and user roles.
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
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Technical Consultation →</a>
      </div>
    </div>
  </section>
@endsection
