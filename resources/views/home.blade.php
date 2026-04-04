@extends('layouts.app')
@section('title', 'Digital Growth & ERP Solutions')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}" />
@endsection

@section('content')
<!-- ═══════════════════════════════════ HERO SECTION -->
  <section class="hero">
    <div class="hero-bg">
      <div class="hero-grid"></div>
    </div>

    <div class="container" style="width:100%">
      <div class="hero__content" style="animation: fadeInUp 0.8s ease;">
        <div class="hero__eyebrow">
          <span class="dot"></span>
          Trusted by 500+ Businesses Worldwide
        </div>

        <h1 class="hero__headline">
          We Build <span class="text-gradient">Digital Empires</span><br/>
          That Dominate Markets
        </h1>

        <p class="hero__sub">
          From stunning websites to SEO domination, PPC mastery, and our powerful Cypressiq ERP — we give your business every tool to grow fast, scale smart, and win big.
        </p>

        <div class="hero__actions">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">
            🚀 Get Free Strategy Audit
          </a>
          <a href="{{ route('opero') }}" class="btn btn--secondary btn--lg">
            ⚙️ Explore Cypressiq ERP
          </a>
        </div>

        <div class="hero__trust">
          <div class="hero__trust-item">
            <span class="check">✓</span>No long-term lock-in
          </div>
          <div class="hero__trust-item">
            <span class="check">✓</span>Results guaranteed
          </div>
          <div class="hero__trust-item">
            <span class="check">✓</span>24/7 dedicated support
          </div>
        </div>
      </div>
    </div>

    <!-- Dashboard Visual -->
    <div class="hero__visual" style="animation: fadeIn 1.2s ease 0.4s both;">
      <div class="hero__dashboard">
        <div class="dashboard-topbar">
          <div class="dashboard-dots">
            <span></span><span></span><span></span>
          </div>
          <div class="dashboard-title">cypressiq-erp.app — Dashboard</div>
        </div>

        <div class="dashboard-stats">
          <div class="dash-stat">
            <div class="dash-stat__val" data-counter="142500" data-prefix="$">$0</div>
            <div class="dash-stat__lbl">Revenue</div>
          </div>
          <div class="dash-stat">
            <div class="dash-stat__val" data-counter="1284">0</div>
            <div class="dash-stat__lbl">Orders</div>
          </div>
          <div class="dash-stat">
            <div class="dash-stat__val" data-counter="98.4" data-suffix="%" data-decimals="1">0%</div>
            <div class="dash-stat__lbl">Uptime</div>
          </div>
        </div>

        <div class="dashboard-chart">
          <div class="chart-bar" style="height:40%"></div>
          <div class="chart-bar" style="height:65%"></div>
          <div class="chart-bar" style="height:50%"></div>
          <div class="chart-bar" style="height:80%"></div>
          <div class="chart-bar" style="height:60%"></div>
          <div class="chart-bar" style="height:90%"></div>
          <div class="chart-bar" style="height:75%"></div>
          <div class="chart-bar" style="height:100%"></div>
        </div>

        <div class="dashboard-table">
          <div class="table-row">
            <div class="row-dot" style="background:var(--clr-success)"></div>
            <div class="row-name">Sales Today</div>
            <div class="row-val">$4,280</div>
            <div class="row-badge badge badge--success">+12%</div>
          </div>
          <div class="table-row">
            <div class="row-dot" style="background:var(--clr-primary)"></div>
            <div class="row-name">Inventory Items</div>
            <div class="row-val">3,421</div>
            <div class="row-badge badge badge--primary">OK</div>
          </div>
          <div class="table-row">
            <div class="row-dot" style="background:var(--clr-warning)"></div>
            <div class="row-name">Low Stock Alert</div>
            <div class="row-val">8 items</div>
            <div class="row-badge badge badge--warning">Alert</div>
          </div>
        </div>
      </div>

      <!-- Floating Cards -->
      <div class="hero__float-card hero__float-card--1">
        <div class="float-icon" style="background:rgba(46,213,115,0.15)">📈</div>
        <div>
          <div style="font-size:0.875rem;font-weight:700">+247% ROI</div>
          <div style="font-size:0.7rem;color:var(--text-muted)">Average client result</div>
        </div>
      </div>

      <div class="hero__float-card hero__float-card--2">
        <div class="float-icon" style="background:rgba(108,99,255,0.15)">⚡</div>
        <div>
          <div style="font-size:0.875rem;font-weight:700">2.1s Load Time</div>
          <div style="font-size:0.7rem;color:var(--text-muted)">Average page speed</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ TRUST / MARQUEE -->
  <div class="marquee-section">
    <p class="marquee-label">Trusted by industry-leading businesses</p>
    <div style="overflow:hidden">
      <div class="marquee-track">
        <div class="marquee-logo"><div class="marquee-logo-icon">🏪</div>RetailPro</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏗️</div>BuildCorp</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🎓</div>EduMax</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">💊</div>PharmaLink</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🚚</div>LogiTrans</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏦</div>FinVault</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🛍️</div>ShopNest</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏥</div>MediCare+</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏪</div>RetailPro</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏗️</div>BuildCorp</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🎓</div>EduMax</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">💊</div>PharmaLink</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🚚</div>LogiTrans</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏦</div>FinVault</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🛍️</div>ShopNest</div>
        <div class="marquee-logo"><div class="marquee-logo-icon">🏥</div>MediCare+</div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════ METRICS -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">📊 Track Record</span>
        <h2>Numbers That Speak <span class="text-gradient">For Themselves</span></h2>
        <p>We've delivered exceptional results for businesses across Africa and beyond.</p>
      </div>

      <div class="metrics-grid reveal">
        <div class="metric-item">
          <span class="metric-num" data-counter="500" data-suffix="+">0+</span>
          <span class="metric-label">Clients Served</span>
        </div>
        <div class="metric-item">
          <span class="metric-num" data-counter="247" data-suffix="%">0%</span>
          <span class="metric-label">Avg. ROI Delivered</span>
        </div>
        <div class="metric-item">
          <span class="metric-num" data-counter="98" data-suffix="%">0%</span>
          <span class="metric-label">Client Satisfaction</span>
        </div>
        <div class="metric-item">
          <span class="metric-num" data-counter="7" data-suffix=" yrs">0 yrs</span>
          <span class="metric-label">Industry Experience</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ SERVICES PREVIEW -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">💼 Services</span>
        <h2>Everything Your Business <span class="text-gradient">Needs to Grow</span></h2>
        <p>From day-one launch to sustained domination — we cover every digital angle.</p>
      </div>

      <div class="services-grid stagger">
        <div class="card service-card reveal">
          <div class="card__icon card__icon--primary">🌐</div>
          <div class="service-card__tag">Web Development</div>
          <h3>Websites That Convert &amp; Scale</h3>
          <p>From sleek corporate sites to powerful e-commerce platforms. We build fast, beautiful, and functionally superior web experiences that turn visitors into customers.</p>
          <a href="{{ route('services') }}#web" class="service-card__arrow">Explore Service →</a>
        </div>
        <div class="card service-card reveal">
          <div class="card__icon card__icon--accent">🔍</div>
          <div class="service-card__tag">SEO</div>
          <h3>Rank #1 &amp; Own Your Market</h3>
          <p>Technical SEO, content strategy, and authority building that drives sustainable organic traffic. We get you found when your customers are searching.</p>
          <a href="{{ route('services') }}#seo" class="service-card__arrow">Explore Service →</a>
        </div>
        <div class="card service-card reveal">
          <div class="card__icon card__icon--warning">📢</div>
          <div class="service-card__tag">PPC Advertising</div>
          <h3>Every Dollar Working Hard</h3>
          <p>Data-driven Google &amp; Meta ad campaigns with relentless optimization. We maximise your ad spend to deliver the highest possible ROI.</p>
          <a href="{{ route('services') }}#ppc" class="service-card__arrow">Explore Service →</a>
        </div>
        <div class="card service-card reveal">
          <div class="card__icon card__icon--primary">📱</div>
          <div class="service-card__tag">Social Media</div>
          <h3>Build a Brand That People Love</h3>
          <p>Content, community management, influencer partnerships, and growth strategies that transform your social presence into a revenue-generating machine.</p>
          <a href="{{ route('services') }}#social" class="service-card__arrow">Explore Service →</a>
        </div>
        <div class="card service-card reveal">
          <div class="card__icon card__icon--accent">✍️</div>
          <div class="service-card__tag">Content Creation</div>
          <h3>Content That Educates &amp; Sells</h3>
          <p>SEO-optimized blog posts, video scripts, infographics, and copy that positions you as the authority in your industry and drives conversions.</p>
          <a href="{{ route('services') }}#content" class="service-card__arrow">Explore Service →</a>
        </div>
        <div class="card service-card reveal" style="background:linear-gradient(135deg,rgba(108,99,255,0.12),rgba(0,212,170,0.08));border-color:var(--border-accent)">
          <div class="card__icon" style="background:var(--gradient-primary);color:white">⚙️</div>
          <div class="service-card__tag" style="color:var(--clr-accent)">Cypressiq ERP</div>
          <h3>The ERP System Built for Growth</h3>
          <p>Manage your entire business — POS, inventory, HR, payroll, and finances — from one powerful, cloud-ready platform. Built with Laravel 11.</p>
          <a href="{{ route('opero') }}" class="service-card__arrow" style="color:var(--clr-accent)">See Cypressiq ERP →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ CYPRESSIQ ERP TEASER -->
  <section class="section">
    <div class="container">
      <div class="erp-teaser reveal">
        <div class="erp-teaser__inner">
          <div>
            <span class="badge badge--accent" style="margin-bottom:1.5rem">⚙️ Cypressiq ERP Platform</span>
            <h2 style="font-size:clamp(2rem,4vw,3rem);margin-bottom:1rem">
              One Platform to Run <span class="text-gradient">Your Entire Business</span>
            </h2>
            <p style="color:var(--text-secondary);font-size:1.1rem;line-height:1.8;margin-bottom:2rem">
              Cypressiq ERP is our flagship SaaS product — a modular business management system that streamlines operations, reduces costs, and gives you real-time insights across every department.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap">
              <a href="{{ route('opero') }}" class="btn btn--primary btn--lg">Explore Cypressiq ERP</a>
              <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">Book Free Demo</a>
            </div>
          </div>

          <div class="erp-teaser__modules">
            <div class="erp-module">
              <div class="erp-module__icon">🛒</div>
              <div>
                <div class="erp-module__name">POS System</div>
                <div class="erp-module__desc">Real-time cart</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">📦</div>
              <div>
                <div class="erp-module__name">Inventory</div>
                <div class="erp-module__desc">Stock alerts</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">👥</div>
              <div>
                <div class="erp-module__name">HR & Payroll</div>
                <div class="erp-module__desc">Full workforce</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">💰</div>
              <div>
                <div class="erp-module__name">Financials</div>
                <div class="erp-module__desc">Reporting</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">🔐</div>
              <div>
                <div class="erp-module__name">RBAC</div>
                <div class="erp-module__desc">Role controls</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">🗄️</div>
              <div>
                <div class="erp-module__name">Backups</div>
                <div class="erp-module__desc">Automated</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">🏪</div>
              <div>
                <div class="erp-module__name">Suppliers</div>
                <div class="erp-module__desc">CRM built-in</div>
              </div>
            </div>
            <div class="erp-module">
              <div class="erp-module__icon">⚙️</div>
              <div>
                <div class="erp-module__name">Settings</div>
                <div class="erp-module__desc">Full control</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ WHY CHOOSE US -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--warning">🏆 Why Cypressiq</span>
        <h2>The Unfair Advantage<br/><span class="text-gradient">Your Competition Doesn't Have</span></h2>
      </div>

      <div class="grid grid-3 stagger" style="gap:1.5rem">
        <div class="card reveal">
          <div class="card__icon card__icon--primary">🎯</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Data-Driven Strategy</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">Every decision is backed by deep analytics. We don't guess — we know what will move the needle for your business.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--accent">⚡</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Speed to Market</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">We deliver fast without compromising quality. Your projects launch on schedule with performance built-in from day one.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--warning">🌍</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Global + Local Expertise</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">We understand African markets deeply while applying global best practices. The best of both worlds for your growth.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--primary">🔄</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Full-Funnel Coverage</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">From brand awareness to conversion and retention — we cover every stage of your customer journey.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--accent">🛡️</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Transparent Reporting</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">Real-time dashboards and monthly reports. You always know exactly what's happening and what results you're getting.</p>
        </div>
        <div class="card reveal">
          <div class="card__icon card__icon--warning">🤝</div>
          <h3 style="font-size:1.25rem;margin-bottom:0.75rem">Dedicated Partnership</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem;line-height:1.7">You get a dedicated account manager and a team that treats your business as their own. We succeed when you succeed.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ TESTIMONIALS -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">⭐ Testimonials</span>
        <h2>What Our Clients <span class="text-gradient">Say About Us</span></h2>
        <p>Real results. Real businesses. Real testimonials from companies we've helped grow.</p>
      </div>

      <div class="testimonials-track stagger">
        <div class="card testimonial-card reveal">
          <div class="testimonial-card__quote">"</div>
          <p class="testimonial-card__text">Cypressiq completely transformed our online presence. Our organic traffic increased by 340% in just 6 months, and revenue followed. They're worth every penny.</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">AK</div>
            <div>
              <div class="testimonial-card__name">Amara Kofi</div>
              <div class="testimonial-card__role">CEO, RetailPro Ghana</div>
            </div>
            <div style="margin-left:auto;color:#FFD700">★★★★★</div>
          </div>
        </div>

        <div class="card testimonial-card reveal">
          <div class="testimonial-card__quote">"</div>
          <p class="testimonial-card__text">The Cypressiq ERP system is a game-changer. We replaced three separate tools with one platform and cut our operational costs by 45%. Exceptional product.</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">FO</div>
            <div>
              <div class="testimonial-card__name">Funmilayo Okafor</div>
              <div class="testimonial-card__role">Operations Director, MedSupply NG</div>
            </div>
            <div style="margin-left:auto;color:#FFD700">★★★★★</div>
          </div>
        </div>

        <div class="card testimonial-card reveal">
          <div class="testimonial-card__quote">"</div>
          <p class="testimonial-card__text">Our PPC campaigns with Cypressiq deliver 6.2x ROAS consistently. Their team is not just professional — they're genuinely invested in our growth.</p>
          <div class="testimonial-card__author">
            <div class="testimonial-card__avatar">DM</div>
            <div>
              <div class="testimonial-card__name">David Mensah</div>
              <div class="testimonial-card__role">Founder, BuildTech Solutions</div>
            </div>
            <div style="margin-left:auto;color:#FFD700">★★★★★</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ TOOLS PREVIEW -->
  <section class="section-sm" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">🛠️ Free Tools</span>
        <h2>Know Your Numbers <span class="text-gradient">Before We Talk</span></h2>
        <p>Use our interactive tools to get instant estimates and projections.</p>
      </div>

      <div class="grid grid-2 stagger" style="max-width:800px;margin:0 auto">
        <a href="{{ route('tools') }}#roi" class="card reveal" style="text-align:center">
          <div style="font-size:3rem;margin-bottom:1rem">💰</div>
          <h3 style="margin-bottom:0.5rem">ROI Calculator</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">See your potential revenue growth</p>
          <div class="btn btn--outline" style="margin-top:1.5rem;width:100%">Try It Free →</div>
        </a>
        <a href="{{ route('tools') }}#estimator" class="card reveal" style="text-align:center">
          <div style="font-size:3rem;margin-bottom:1rem">🌐</div>
          <h3 style="margin-bottom:0.5rem">Website Cost Estimator</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">Get an instant project quote</p>
          <div class="btn btn--outline" style="margin-top:1.5rem;width:100%">Get Estimate →</div>
        </a>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ FINAL CTA -->
  <section class="section">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Ready to Dominate<br/>Your Market?</h2>
        <p>Get a free, no-obligation strategy audit. We'll show you exactly where you're leaving money on the table and how to fix it.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;position:relative">
          <a href="{{ route('contact') }}" class="btn btn--light btn--lg">🚀 Book Free Strategy Audit</a>
          <a href="{{ route('opero') }}" class="btn" style="background:rgba(255,255,255,0.15);color:white;border:1px solid rgba(255,255,255,0.3);padding:1rem 2rem;border-radius:9999px;font-weight:600;font-size:1rem;transition:all 0.25s">⚙️ Start Cypressiq ERP Trial</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════ FOOTER -->
@endsection
