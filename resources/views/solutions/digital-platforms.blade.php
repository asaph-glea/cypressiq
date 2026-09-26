@extends('layouts.app')
@section('title', 'Digital Platforms, Portals & Cloud Solutions — CypressIQ Solutions')
@section('meta_description', 'Scalable multi-tenant digital platforms, partner ecosystems, and hardened cloud infrastructure engineered for business growth and data security.')

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
        <span class="metric-badge">☁️ Client Solutions · Digital Platforms</span>
      </div>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Scalable <span class="text-gradient">Digital Platforms</span> &amp; Cloud Infrastructure
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2.5rem">
        We architect multi-tenant SaaS engines, comprehensive partner ecosystem portals, and containerized cloud environments engineered for high uptime, data sovereignty, and elastic growth.
      </p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Scope Your Platform →</a>
        <a href="#capabilities" class="btn btn--secondary btn--lg">Explore Architecture</a>
      </div>
    </div>
  </section>

  <!-- CAPABILITIES -->
  <section class="section" id="capabilities" style="padding-top:0">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3rem">
        <span class="badge badge--accent">Cloud &amp; Platform Architecture</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Platforms Built for Scale, Security &amp; Compliance
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem">
          From multi-tenant SaaS structures to zero-downtime containerized deployments, our systems are built to withstand enterprise volume.
        </p>
      </div>

      <div class="solution-grid">
        <!-- Card 1: Multi-Tenant Digital Platforms -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🏗️</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Multi-Tenant Platform Architecture</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Custom SaaS foundations featuring isolated tenant databases, tenant-scoped cache layers, custom subdomains, and automated organization provisioning out of the box.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Tenant-isolated data segregation &amp; encryption</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated subdomain routing &amp; custom domain SSL</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Subscription billing &amp; plan usage meter integration</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Global tenant management cockpit for operators</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Multi-Tenancy</span>
            <span class="spec-tag">Wildcard SSL</span>
            <span class="spec-tag">SaaS Billing</span>
            <span class="spec-tag">Data Isolation</span>
          </div>
        </div>

        <!-- Card 2: Partner & Ecosystem Portals -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🤝</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Ecosystem &amp; Distributor Portals</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Empower your third-party distributors, affiliated vendors, and field agents with branded portals for order placement, documentation, and commission tracking.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Wholesaler pricing tiers &amp; bulk ordering matrices</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Commission ledgers &amp; automated statement generation</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Compliance document upload and verification workflows</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Real-time dispatch and logistics status tracking</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Vendor Portals</span>
            <span class="spec-tag">Pricing Tiers</span>
            <span class="spec-tag">Commissions</span>
            <span class="spec-tag">Self-Service</span>
          </div>
        </div>

        <!-- Card 3: Cloud Infrastructure & Modernization -->
        <div class="solution-card reveal">
          <div>
            <div style="font-size:2rem;margin-bottom:1rem">🔒</div>
            <h3 style="font-size:1.4rem;margin-bottom:1rem">Cloud DevOps &amp; Hardened Security</h3>
            <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:1.5rem;font-size:0.95rem">
              Production-grade Linux, Docker containerization, automated offsite database snapshots, and strict security headers that keep your platform fast, resilient, and safe.
            </p>
            <ul style="display:flex;flex-direction:column;gap:0.6rem;font-size:0.875rem;color:var(--text-secondary);margin-bottom:1.5rem">
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Dockerized microservices &amp; CI/CD deployment pipelines</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Automated point-in-time database snapshot backups</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Zero-downtime deployment strategies</li>
              <li style="display:flex;align-items:center;gap:0.5rem"><span style="color:var(--clr-accent)">✓</span> Comprehensive SSL, HSTS, and CSP security policies</li>
            </ul>
          </div>
          <div style="border-top:1px solid var(--border-subtle);padding-top:1rem">
            <span class="spec-tag">Docker</span>
            <span class="spec-tag">CI/CD</span>
            <span class="spec-tag">Nginx</span>
            <span class="spec-tag">Security Headers</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal" style="text-align:center;max-width:800px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">Architect for Scale</span>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.5rem);margin-bottom:1rem">
          Ready to Build Your Digital Platform?
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Schedule an infrastructure and platform scoping session with our lead architects to review hosting topology, security, and scalability.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Book Platform Scoping Session →</a>
          <a href="{{ route('solutions.technology-consulting') }}" class="btn btn--secondary btn--lg">View Technology Consulting</a>
        </div>
      </div>
    </div>
  </section>
@endsection
