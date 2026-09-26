@extends('layouts.app')
@section('title', 'Web Development & Application Engineering — CypressIQ Solutions')
@section('meta_description', 'High-performance web applications, interactive portals, and modern web solutions engineered for security, speed, and business growth.')

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
        <span class="metric-badge">🌐 Client Solutions · Web Development</span>
      </div>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        High-Performance <span class="text-gradient">Web Applications</span> &amp; Modern Frontends
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        We architect and build bespoke web applications, interactive digital experiences, and progressive web platforms engineered for speed, search visibility, high concurrency, and seamless usability across all devices.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Start Your Web Project →</a>
        <a href="#capabilities" class="btn btn--secondary btn--lg">Explore Capabilities</a>
      </div>
    </div>
  </section>

  <!-- CAPABILITIES OVERVIEW -->
  <section class="section" id="capabilities" style="padding-top:0">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3rem">
        <span class="badge badge--accent">Engineered for Reliability</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Full-Stack Web Engineering Built to Perform
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          From customer-facing transactional platforms to high-throughput web software, we deliver clean architecture, rigorous testing, and exceptional interface design.
        </p>
      </div>

      <div class="solution-grid">
        <!-- Card 1: Custom Web Applications -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">⚡</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Custom Web Applications</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Full-featured web applications built with modern frameworks and robust backend engines. Designed for scalability, high availability, and fluid responsiveness under heavy operational loads.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Responsive reactive interfaces (Vue, React, Alpine.js)</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Robust backend architecture (PHP 8.2+, Laravel, Node)</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Optimized relational database schemas &amp; caching</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Comprehensive automated unit &amp; integration testing</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Laravel</span>
            <span class="spec-tag">PostgreSQL</span>
            <span class="spec-tag">Tailwind</span>
            <span class="spec-tag">Vite</span>
          </div>
        </div>

        <!-- Card 2: Interactive Portals & Client Hubs -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🔐</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Client &amp; Partner Portals</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Secure, authenticated digital spaces where your customers and partners can manage accounts, track requests, download documents, and transact with complete privacy.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Enterprise role-based access &amp; 2FA security</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Document repositories &amp; encrypted vault storage</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time status dashboards &amp; ticket workflows</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Self-service account administration</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">RBAC</span>
            <span class="spec-tag">2FA Auth</span>
            <span class="spec-tag">Audit Logs</span>
            <span class="spec-tag">REST APIs</span>
          </div>
        </div>

        <!-- Card 3: Modern Frontends & Progressive Web Apps -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">📱</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">PWAs &amp; Frontends</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Lightning-fast frontend architectures that feel like native desktop and mobile applications. Offline caching, instant load times, and fluid page transitions built to captivate users.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Service worker offline caching &amp; app manifest</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Lighthouse performance 95+ score optimization</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> SEO metadata and OpenGraph structured data</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Cross-browser accessibility (WCAG AA compliant)</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">PWA</span>
            <span class="spec-tag">Accessibility</span>
            <span class="spec-tag">Lighthouse</span>
            <span class="spec-tag">CSS Grid</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal" style="text-align:center;max-width:800px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">Build With CypressIQ</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Ready to Build Your Next Web Platform?
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Consult with our engineering team to map technical specifications, user requirements, and delivery milestones.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Engineering Consultation →</a>
          <a href="{{ route('solutions.custom-software') }}" class="btn btn--secondary btn--lg">View Custom Software</a>
        </div>
      </div>
    </div>
  </section>
@endsection
