@extends('layouts.app')
@section('title', 'Digital Services — Web Development, SEO, PPC & More')

@section('css')
<style>
.service-hero-card {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl);
      padding: var(--space-12);
      margin-bottom: var(--space-6);
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: var(--space-12);
      align-items: center;
      position: relative;
      overflow: hidden;
      transition: all var(--transition-base);
    }
    .service-hero-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--gradient-card);
      opacity: 0;
      transition: opacity var(--transition-base);
    }
    .service-hero-card:hover::before { opacity: 1; }
    .service-hero-card:hover { border-color: var(--border-accent); }
    .service-visual {
      background: var(--bg-glass-strong);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-xl);
      padding: var(--space-6);
      position: relative;
    }
    .service-outcome {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      padding: var(--space-3);
      background: var(--bg-glass);
      border-radius: var(--radius-md);
      margin-top: var(--space-3);
    }
    .outcome-num {
      font-family: var(--font-display);
      font-size: var(--text-2xl);
      font-weight: 800;
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .process-step {
      display: flex;
      gap: var(--space-5);
      align-items: flex-start;
      padding: var(--space-6) 0;
      border-bottom: 1px solid var(--border-subtle);
    }
    .process-step:last-child { border-bottom: none; }
    .step-num {
      width: 44px;
      height: 44px;
      min-width: 44px;
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
      .service-hero-card { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">💼 Our Services</span>
      <h1>Digital Services That <span class="text-gradient">Drive Real Revenue</span></h1>
      <p>We don't just deliver services — we build growth engines. Every strategy is custom-crafted for your business goals, market, and budget.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Start Your Project</a>
        <a href="{{ route('tools') }}" class="btn btn--secondary btn--lg">Calculate Your ROI</a>
      </div>
    </div>
  </section>

  <!-- WEB DEVELOPMENT -->
  <section class="section" id="web">
    <div class="container">
      <div class="service-hero-card reveal">
        <div style="position:relative;z-index:1">
          <span class="badge badge--primary" style="margin-bottom:1rem">🌐 Web Development</span>
          <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Websites That Work<br/>As Hard As You Do</h2>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">Your website is your #1 sales rep. We build fast, beautiful, conversion-optimized websites that work 24/7 to grow your business. From sleek landing pages to complex enterprise portals — we've built them all.</p>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:1.5rem">
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>Corporate Sites</div>
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>E-commerce Stores</div>
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>Educational Portals</div>
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>NGO & Charity Sites</div>
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>SAAS Dashboards</div>
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.875rem"><span style="color:var(--clr-accent)">✓</span>Custom Web Apps</div>
          </div>
          <a href="{{ route('contact') }}" class="btn btn--primary">Start Web Project</a>
        </div>

        <div class="service-visual" style="position:relative;z-index:1">
          <div style="font-size:0.7rem;color:var(--text-muted);font-family:var(--font-mono);margin-bottom:1rem">Project Metrics</div>
          <div class="service-outcome">
            <div class="outcome-num">2.1s</div>
            <div><div style="font-weight:600;font-size:0.875rem">Avg Load Time</div><div style="color:var(--text-muted);font-size:0.75rem">PageSpeed 95+</div></div>
          </div>
          <div class="service-outcome">
            <div class="outcome-num">+180%</div>
            <div><div style="font-weight:600;font-size:0.875rem">Conversion Rate</div><div style="color:var(--text-muted);font-size:0.75rem">vs old site average</div></div>
          </div>
          <div class="service-outcome">
            <div class="outcome-num">7-14d</div>
            <div><div style="font-weight:600;font-size:0.875rem">Delivery Time</div><div style="color:var(--text-muted);font-size:0.75rem">Landing pages</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SEO -->
  <section class="section" id="seo" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">🔍 SEO</span>
        <h2>Rank #1. Get Found. <span class="text-gradient">Win Organically.</span></h2>
        <p>Full-stack SEO that drives sustainable, compounding organic traffic. Not just rankings — real business results.</p>
      </div>

      <div class="grid grid-3 stagger" style="margin-bottom:3rem">
        <div class="card reveal">
          <div class="card__icon card__icon--accent">🔬</div>
          <h3 style="margin-bottom:0.5rem">Technical SEO</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">Core Web Vitals, site architecture, schema markup, XML sitemaps, and crawlability optimization.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--primary">📝</div>
          <h3 style="margin-bottom:0.5rem">Content Strategy</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">Keyword research, content clusters, and authoritative content that ranks and converts.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--warning">🔗</div>
          <h3 style="margin-bottom:0.5rem">Link Building</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">High-authority backlink acquisition through digital PR, guest posts, and strategic partnerships.</p>
        </div>
      </div>

      <div style="background:linear-gradient(135deg,rgba(0,212,170,0.08),rgba(108,99,255,0.05));border:1px solid rgba(0,212,170,0.2);border-radius:var(--radius-2xl);padding:3rem;display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:center" class="reveal">
        <div>
          <h3 style="font-size:1.5rem;margin-bottom:1rem">Our SEO Results</h3>
          <div style="display:flex;flex-direction:column;gap:1.25rem" class="skills-section">
            <div>
              <div style="display:flex;justify-content:space-between;font-size:0.875rem;margin-bottom:0.5rem"><span>Organic Traffic Growth</span><span style="color:var(--clr-accent);font-weight:600">+340%</span></div>
              <div class="progress-bar-wrap"><div class="progress-bar" data-width="90"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:0.875rem;margin-bottom:0.5rem"><span>First Page Rankings</span><span style="color:var(--clr-accent);font-weight:600">87%</span></div>
              <div class="progress-bar-wrap"><div class="progress-bar" data-width="87"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:0.875rem;margin-bottom:0.5rem"><span>Client Retention</span><span style="color:var(--clr-accent);font-weight:600">94%</span></div>
              <div class="progress-bar-wrap"><div class="progress-bar" data-width="94"></div></div>
            </div>
          </div>
        </div>
        <div style="text-align:center">
          <div style="font-size:5rem;margin-bottom:1rem">🏆</div>
          <div style="font-family:var(--font-display);font-size:3rem;font-weight:800;background:var(--gradient-primary);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">6 months</div>
          <div style="color:var(--text-secondary)">Average time to first page</div>
        </div>
      </div>
    </div>
  </section>

  <!-- PPC -->
  <section class="section" id="ppc">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--warning">📢 PPC Advertising</span>
        <h2>Ad Spend That Returns <span class="text-gradient">6x, Not Breakeven</span></h2>
        <p>Data-driven Google & Meta ad campaigns managed by certified specialists who obsess over your ROAS.</p>
      </div>

      <div class="grid grid-2 stagger">
        <div class="card reveal">
          <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem">
            <div style="font-size:2rem">🔍</div>
            <h3>Google Ads</h3>
          </div>
          <p style="color:var(--text-secondary);margin-bottom:1.5rem">Search, Display, Shopping, YouTube, and Performance Max campaigns. We capture intent-driven traffic at the exact moment your customers are ready to buy.</p>
          <div style="display:flex;gap:2rem">
            <div style="text-align:center"><div style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--clr-primary)" data-counter="6.2" data-decimals="1" data-suffix="x">6.2x</div><div style="font-size:0.75rem;color:var(--text-muted)">Avg ROAS</div></div>
            <div style="text-align:center"><div style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--clr-primary)" data-counter="38" data-suffix="%">38%</div><div style="font-size:0.75rem;color:var(--text-muted)">Lower CPA</div></div>
          </div>
        </div>
        <div class="card reveal">
          <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem">
            <div style="font-size:2rem">📘</div>
            <h3>Meta Ads (FB/IG)</h3>
          </div>
          <p style="color:var(--text-secondary);margin-bottom:1.5rem">Hyper-targeted Facebook and Instagram campaigns with creative testing, lookalike audiences, and funnel-based retargeting that converts cold traffic to customers.</p>
          <div style="display:flex;gap:2rem">
            <div style="text-align:center"><div style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--clr-accent)" data-counter="4.8" data-decimals="1" data-suffix="x">4.8x</div><div style="font-size:0.75rem;color:var(--text-muted)">Avg ROAS</div></div>
            <div style="text-align:center"><div style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--clr-accent)" data-counter="52" data-suffix="%">52%</div><div style="font-size:0.75rem;color:var(--text-muted)">CTR Improvement</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SOCIAL MEDIA -->
  <section class="section" id="social" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">📱 Social Media</span>
        <h2>Build a Community. <span class="text-gradient">Drive Revenue.</span></h2>
        <p>We manage your social presence end-to-end — strategy, content, community management, and paid social — all aligned to drive business outcomes.</p>
      </div>

      <div class="grid grid-4 stagger">
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">📸</div>
          <h4 style="margin-bottom:0.5rem">Instagram</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Reels, stories, carousels that engage and convert</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">📘</div>
          <h4 style="margin-bottom:0.5rem">Facebook</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Page management, group engagement & ads</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">in</div>
          <h4 style="margin-bottom:0.5rem">LinkedIn</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">B2B thought leadership & lead generation</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">▶️</div>
          <h4 style="margin-bottom:0.5rem">YouTube/TikTok</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Video content that builds brand and drives traffic</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT CREATION -->
  <section class="section" id="content">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">✍️ Content Creation</span>
        <h2>Content That Educates, <span class="text-gradient">Sells, and Ranks</span></h2>
        <p>High-quality, SEO-optimized content that positions your brand as the go-to authority in your industry.</p>
      </div>

      <div class="grid grid-3 stagger">
        <div class="card reveal">
          <div class="card__icon card__icon--primary">📖</div>
          <h3 style="margin-bottom:0.5rem">Blog Articles</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">In-depth, keyword-optimised blog posts that rank on Google and educate your audience.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--accent">🎬</div>
          <h3 style="margin-bottom:0.5rem">Video Scripts</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">Engaging video scripts for YouTube, explainers, ads, and social media content.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--warning">📊</div>
          <h3 style="margin-bottom:0.5rem">Infographics & Design</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">Visual content that makes complex ideas shareable and dramatically increases engagement.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Let's Build Your Growth Engine</h2>
        <p>Get a free strategy audit and discover the fastest path to scalable revenue.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Book Free Strategy Audit 🚀</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
