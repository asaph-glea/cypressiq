@extends('layouts.app')
@section('title', 'Portfolio & Case Studies — Our Work')

@section('css')
<style>
.portfolio-filters {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      justify-content: center;
      margin-bottom: 3rem;
    }
    .filter-btn {
      padding: 0.5rem 1.25rem;
      border-radius: var(--radius-full);
      font-size: 0.875rem;
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
    }
    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }
    .portfolio-item {
      border-radius: var(--radius-xl);
      overflow: hidden;
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      transition: all 0.3s;
      cursor: pointer;
    }
    .portfolio-item:hover { transform: translateY(-6px); border-color: var(--border-accent); box-shadow: var(--shadow-primary); }
    .portfolio-thumb {
      height: 200px;
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
      position: relative;
      overflow: hidden;
    }
    .portfolio-thumb::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(108,99,255,0.6), rgba(0,212,170,0.4));
    }
    .portfolio-thumb .emoji { position: relative; z-index: 1; }
    .portfolio-thumb--1 { background: linear-gradient(135deg, #1a1a2e, #16213e); }
    .portfolio-thumb--2 { background: linear-gradient(135deg, #0d1b2a, #1b263b); }
    .portfolio-thumb--3 { background: linear-gradient(135deg, #2d1b69, #1a0a3b); }
    .portfolio-thumb--4 { background: linear-gradient(135deg, #003333, #004040); }
    .portfolio-thumb--5 { background: linear-gradient(135deg, #1a0a00, #3d1a00); }
    .portfolio-thumb--6 { background: linear-gradient(135deg, #0a1a0a, #1a2e1a); }
    .portfolio-body { padding: 1.5rem; }
    .portfolio-body h3 { font-size: 1.1rem; margin-bottom: 0.375rem; }
    .portfolio-body p { color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1rem; }
    .portfolio-stats { display: flex; gap: 1rem; }
    .p-stat { text-align: center; }
    .p-stat__n { font-family: var(--font-display); font-size: 1.25rem; font-weight: 800; color: var(--clr-primary); }
    .p-stat__l { font-size: 0.7rem; color: var(--text-muted); }
    .case-study-card {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl);
      padding: 3rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
      margin-bottom: 2rem;
    }
    .before-after {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    .ba-box {
      background: var(--bg-glass);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-md);
      padding: 1.25rem;
      text-align: center;
    }
    .ba-box.after { border-color: rgba(0,212,170,0.4); background: rgba(0,212,170,0.05); }
    @media (max-width: 900px) {
      .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
      .case-study-card { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
      .portfolio-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">🏆 Our Work</span>
      <h1>Projects That <span class="text-gradient">Changed Businesses</span></h1>
      <p>Real work. Real clients. Real results. Browse our portfolio of impactful digital projects across industries.</p>
    </div>
  </section>

  <!-- PORTFOLIO GRID -->
  <section class="section">
    <div class="container">
      <div class="portfolio-filters reveal">
        <button class="filter-btn active">All Projects</button>
        <button class="filter-btn">Web Development</button>
        <button class="filter-btn">SEO</button>
        <button class="filter-btn">E-Commerce</button>
        <button class="filter-btn">Branding</button>
        <button class="filter-btn">ERP</button>
      </div>

      <div class="portfolio-grid stagger">
        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--1">
            <span class="emoji">🛍️</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--primary" style="margin-bottom:0.75rem;font-size:0.65rem">E-Commerce</span>
            <h3>ShopNest — E-Commerce Platform</h3>
            <p>Full-stack e-commerce store with payment integration, inventory sync, and Cypressiq ERP backend.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">+320%</div><div class="p-stat__l">Sales</div></div>
              <div class="p-stat"><div class="p-stat__n">1.8s</div><div class="p-stat__l">Load Time</div></div>
              <div class="p-stat"><div class="p-stat__n">6mo</div><div class="p-stat__l">ROI Payback</div></div>
            </div>
          </div>
        </div>

        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--2">
            <span class="emoji">🏥</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--accent" style="margin-bottom:0.75rem;font-size:0.65rem">Web + SEO</span>
            <h3>MediCare+ — Health Portal</h3>
            <p>Patient portal with online booking, SEO strategy, and 400% organic traffic growth in 8 months.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">+400%</div><div class="p-stat__l">Organic Traffic</div></div>
              <div class="p-stat"><div class="p-stat__n">#1</div><div class="p-stat__l">Local Search</div></div>
              <div class="p-stat"><div class="p-stat__n">3,200</div><div class="p-stat__l">Monthly Leads</div></div>
            </div>
          </div>
        </div>

        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--3">
            <span class="emoji">🏗️</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--warning" style="margin-bottom:0.75rem;font-size:0.65rem">ERP + Web</span>
            <h3>BuildCorp — Enterprise ERP Setup</h3>
            <p>Cypressiq ERP full deployment for a construction company — inventory, HR, and project financials.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">-45%</div><div class="p-stat__l">Operations Cost</div></div>
              <div class="p-stat"><div class="p-stat__n">3x</div><div class="p-stat__l">Efficiency</div></div>
              <div class="p-stat"><div class="p-stat__n">6wk</div><div class="p-stat__l">Full Deployment</div></div>
            </div>
          </div>
        </div>

        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--4">
            <span class="emoji">🎓</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--primary" style="margin-bottom:0.75rem;font-size:0.65rem">Web Dev</span>
            <h3>EduMax — Learning Management System</h3>
            <p>Custom LMS with course management, student tracking, payments, and live video integration.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">12k</div><div class="p-stat__l">Students</div></div>
              <div class="p-stat"><div class="p-stat__n">98%</div><div class="p-stat__l">Uptime</div></div>
              <div class="p-stat"><div class="p-stat__n">4wk</div><div class="p-stat__l">Build Time</div></div>
            </div>
          </div>
        </div>

        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--5">
            <span class="emoji">💊</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--accent" style="margin-bottom:0.75rem;font-size:0.65rem">PPC + SEO</span>
            <h3>PharmaLink — Digital Marketing</h3>
            <p>Combined PPC + SEO strategy delivering 6.2x ROAS and dominating competitor keywords.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">6.2x</div><div class="p-stat__l">ROAS</div></div>
              <div class="p-stat"><div class="p-stat__n">-38%</div><div class="p-stat__l">CPA</div></div>
              <div class="p-stat"><div class="p-stat__n">$2.1M</div><div class="p-stat__l">Revenue Added</div></div>
            </div>
          </div>
        </div>

        <div class="portfolio-item reveal">
          <div class="portfolio-thumb portfolio-thumb--6">
            <span class="emoji">🚚</span>
          </div>
          <div class="portfolio-body">
            <span class="badge badge--warning" style="margin-bottom:0.75rem;font-size:0.65rem">Branding + Web</span>
            <h3>LogiTrans — Brand Identity & Website</h3>
            <p>Complete brand overhaul — logo, identity system, corporate website, and social media kit.</p>
            <div class="portfolio-stats">
              <div class="p-stat"><div class="p-stat__n">+180%</div><div class="p-stat__l">Brand Recall</div></div>
              <div class="p-stat"><div class="p-stat__n">2wk</div><div class="p-stat__l">Delivery</div></div>
              <div class="p-stat"><div class="p-stat__n">★4.9</div><div class="p-stat__l">Client Rating</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURED CASE STUDY -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">📊 Case Study</span>
        <h2>From Invisible to <span class="text-gradient">Industry Leader</span></h2>
        <p>How we helped RetailPro Ghana grow from $50K to $2M/year in revenue in under 18 months.</p>
      </div>

      <div class="case-study-card reveal">
        <div>
          <h3 style="font-size:1.5rem;margin-bottom:0.75rem">The Challenge</h3>
          <p style="color:var(--text-secondary);margin-bottom:1.5rem;line-height:1.8">RetailPro was a promising retail chain with zero digital presence. No website, no SEO strategy, and a completely manual inventory and sales process costing them hours every day and thousands in lost revenue.</p>

          <h3 style="font-size:1.5rem;margin-bottom:0.75rem">Our Solution</h3>
          <ul style="display:flex;flex-direction:column;gap:0.5rem;color:var(--text-secondary)">
            <li style="display:flex;gap:0.5rem"><span style="color:var(--clr-accent)">→</span>Built e-commerce website with integrated Cypressiq ERP backend</li>
            <li style="display:flex;gap:0.5rem"><span style="color:var(--clr-accent)">→</span>Implemented full SEO strategy targeting 200+ keywords</li>
            <li style="display:flex;gap:0.5rem"><span style="color:var(--clr-accent)">→</span>Launched Google & Meta ad campaigns</li>
            <li style="display:flex;gap:0.5rem"><span style="color:var(--clr-accent)">→</span>Complete social media management takeover</li>
            <li style="display:flex;gap:0.5rem"><span style="color:var(--clr-accent)">→</span>Deployed Cypressiq ERP for inventory, POS &amp; HR</li>
          </ul>
        </div>
        <div>
          <h3 style="font-size:1.25rem;margin-bottom:1rem">Before vs After — 18 Months</h3>
          <div class="before-after">
            <div class="ba-box">
              <div style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:0.75rem">Before</div>
              <div style="font-size:1.5rem;font-weight:800;color:var(--text-muted)">$50K</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Annual Revenue</div>
              <hr style="border-color:var(--border-subtle);margin:0.75rem 0">
              <div style="font-size:1.25rem;font-weight:700;color:var(--text-muted)">200</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Monthly Visitors</div>
              <hr style="border-color:var(--border-subtle);margin:0.75rem 0">
              <div style="font-size:1.25rem;font-weight:700;color:var(--text-muted)">0</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Online Orders</div>
            </div>
            <div class="ba-box after">
              <div style="font-size:0.7rem;color:var(--clr-accent);text-transform:uppercase;margin-bottom:0.75rem">After ✓</div>
              <div style="font-size:1.5rem;font-weight:800;color:var(--clr-accent)">$2M</div>
              <div style="font-size:0.75rem;color:var(--text-secondary)">Annual Revenue</div>
              <hr style="border-color:rgba(0,212,170,0.2);margin:0.75rem 0">
              <div style="font-size:1.25rem;font-weight:700;color:var(--clr-accent)">68K</div>
              <div style="font-size:0.75rem;color:var(--text-secondary)">Monthly Visitors</div>
              <hr style="border-color:rgba(0,212,170,0.2);margin:0.75rem 0">
              <div style="font-size:1.25rem;font-weight:700;color:var(--clr-accent)">1,200</div>
              <div style="font-size:0.75rem;color:var(--text-secondary)">Monthly Orders</div>
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
        <h2>Your Success Story Starts Here</h2>
        <p>Join 500+ businesses that chose Cypressiq to grow their brands.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Start Your Project Today 🚀</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
