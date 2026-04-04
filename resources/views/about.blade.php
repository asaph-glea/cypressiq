@extends('layouts.app')
@section('title', 'About Us — Our Story, Mission & Team')

@section('css')
<style>
.timeline { position: relative; padding: 2rem 0; }
    .timeline::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 0;
      bottom: 0;
      width: 2px;
      background: var(--gradient-primary);
      transform: translateX(-50%);
    }
    .timeline-item {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      gap: 2rem;
      align-items: center;
      margin-bottom: 3rem;
    }
    .timeline-item:nth-child(even) .timeline-content { grid-column: 3; text-align: left; }
    .timeline-item:nth-child(even) .timeline-empty { grid-column: 1; }
    .timeline-item:nth-child(odd) .timeline-content { text-align: right; }
    .timeline-dot {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      box-shadow: 0 0 0 4px var(--bg-base), 0 0 0 6px rgba(108,99,255,0.3);
      z-index: 1;
    }
    .timeline-year { font-family: var(--font-mono); font-size: 0.75rem; color: var(--clr-primary); font-weight: 600; margin-bottom: 0.5rem; }
    .team-card {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-xl);
      padding: 2rem;
      text-align: center;
      transition: all 0.3s;
    }
    .team-card:hover { transform: translateY(-6px); border-color: var(--border-accent); }
    .team-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin: 0 auto 1.25rem;
      box-shadow: var(--shadow-primary);
    }
    .team-social { display: flex; gap: 0.5rem; justify-content: center; margin-top: 1rem; }
    .team-social a {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: var(--bg-glass-strong);
      border: 1px solid var(--border-subtle);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem; color: var(--text-secondary);
      transition: all 0.2s;
    }
    .team-social a:hover { background: var(--clr-primary); color: white; border-color: transparent; }
    @media (max-width: 768px) {
      .timeline::before { left: 24px; }
      .timeline-item { grid-template-columns: auto 1fr; }
      .timeline-item:nth-child(even) .timeline-content { grid-column: 2; }
      .timeline-item:nth-child(even) .timeline-empty, .timeline-empty { display: none; }
      .timeline-item:nth-child(odd) .timeline-content { text-align: left; }
    }
</style>
@endsection

@section('content')
<!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">🌍 About Us</span>
      <h1>Built by Builders,<br/><span class="text-gradient">For Builders</span></h1>
      <p>We're a team of strategists, developers, designers, and data nerds united by one mission: making African businesses compete — and win — on a global stage.</p>
    </div>
  </section>

  <!-- MISSION & VISION -->
  <section class="section">
    <div class="container">
      <div class="grid grid-2 stagger" style="max-width:900px;margin:0 auto;gap:1.5rem">
        <div class="card reveal" style="padding:2.5rem;background:linear-gradient(135deg,rgba(108,99,255,0.1),rgba(108,99,255,0.05));border-color:rgba(108,99,255,0.3)">
          <div style="font-size:3rem;margin-bottom:1rem">🎯</div>
          <h3 style="font-size:1.5rem;margin-bottom:0.75rem">Our Mission</h3>
          <p style="color:var(--text-secondary);line-height:1.8">To empower businesses with world-class digital tools, strategies, and systems that create sustainable, compounding growth — starting from Africa and reaching every corner of the world.</p>
        </div>
        <div class="card reveal" style="padding:2.5rem;background:linear-gradient(135deg,rgba(0,212,170,0.1),rgba(0,212,170,0.05));border-color:rgba(0,212,170,0.3)">
          <div style="font-size:3rem;margin-bottom:1rem">🚀</div>
          <h3 style="font-size:1.5rem;margin-bottom:0.75rem">Our Vision</h3>
          <p style="color:var(--text-secondary);line-height:1.8">A world where every business — regardless of size or location — has access to the same world-class digital infrastructure, ERP systems, and marketing strategies that power billion-dollar companies.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- OUR STORY TIMELINE -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">📖 Our Story</span>
        <h2>From a Laptop to <span class="text-gradient">500+ Clients</span></h2>
      </div>

      <div class="timeline" style="max-width:800px;margin:0 auto">
        <div class="timeline-item reveal">
          <div class="timeline-content">
            <div class="timeline-year">2019</div>
            <h4 style="margin-bottom:0.5rem">The Beginning</h4>
            <p style="color:var(--text-secondary);font-size:0.9rem">Founded in Accra with a laptop and a bold vision: to bring Silicon Valley-quality digital services to African businesses at fair prices.</p>
          </div>
          <div class="timeline-dot">🌱</div>
          <div class="timeline-empty"></div>
        </div>

        <div class="timeline-item reveal">
          <div class="timeline-empty"></div>
          <div class="timeline-dot">📈</div>
          <div class="timeline-content">
            <div class="timeline-year">2020</div>
            <h4 style="margin-bottom:0.5rem">First 50 Clients</h4>
            <p style="color:var(--text-secondary);font-size:0.9rem">Grew to a team of 8, serving 50+ businesses across Ghana, Nigeria, and Kenya. Web development became our flagship service.</p>
          </div>
        </div>

        <div class="timeline-item reveal">
          <div class="timeline-content">
            <div class="timeline-year">2022</div>
            <h4 style="margin-bottom:0.5rem">Cypressiq ERP is Born</h4>
            <p style="color:var(--text-secondary);font-size:0.9rem">After seeing how many clients struggled with business management, we built Cypressiq ERP — a Laravel-powered solution purpose-built for growing SMEs.</p>
          </div>
          <div class="timeline-dot">⚙️</div>
          <div class="timeline-empty"></div>
        </div>

        <div class="timeline-item reveal">
          <div class="timeline-empty"></div>
          <div class="timeline-dot">🌍</div>
          <div class="timeline-content">
            <div class="timeline-year">2024</div>
            <h4 style="margin-bottom:0.5rem">Going Global</h4>
            <p style="color:var(--text-secondary);font-size:0.9rem">Expanded services to 15 countries. Launched Cypressiq ERP SaaS with 200+ active business subscribers and growing.</p>
          </div>
        </div>

        <div class="timeline-item reveal">
          <div class="timeline-content">
            <div class="timeline-year">2026</div>
            <h4 style="margin-bottom:0.5rem">The New Standard</h4>
            <p style="color:var(--text-secondary);font-size:0.9rem">500+ clients served, Cypressiq ERP v3.0 launched on Laravel 11, and a team of 45+ specialists delivering world-class digital growth.</p>
          </div>
          <div class="timeline-dot">⚡</div>
          <div class="timeline-empty"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">👥 The Team</span>
        <h2>Meet the People <span class="text-gradient">Behind the Results</span></h2>
        <p>Our team of 45+ specialists brings together decades of combined expertise across digital marketing, engineering, and business strategy.</p>
      </div>

      <div class="grid grid-4 stagger">
        <div class="team-card reveal">
          <div class="team-avatar">👨🏾‍💼</div>
          <h4 style="margin-bottom:0.25rem">Kwame Asante</h4>
          <p style="color:var(--clr-primary);font-size:0.8rem;font-weight:600">CEO & Founder</p>
          <p style="color:var(--text-secondary);font-size:0.8rem;margin-top:0.5rem">Digital strategy visionary with 10+ years building brands across Africa.</p>
          <div class="team-social"><a href="#">in</a><a href="#">𝕏</a></div>
        </div>
        <div class="team-card reveal">
          <div class="team-avatar">👩🏾‍💻</div>
          <h4 style="margin-bottom:0.25rem">Adaeze Obi</h4>
          <p style="color:var(--clr-accent);font-size:0.8rem;font-weight:600">CTO & Lead Dev</p>
          <p style="color:var(--text-secondary);font-size:0.8rem;margin-top:0.5rem">Laravel architect and the brain behind Cypressiq ERP's technical foundation.</p>
          <div class="team-social"><a href="#">in</a><a href="#">🐙</a></div>
        </div>
        <div class="team-card reveal">
          <div class="team-avatar">👨🏽‍🎨</div>
          <h4 style="margin-bottom:0.25rem">Emeka Nwosu</h4>
          <p style="color:var(--clr-warning);font-size:0.8rem;font-weight:600">Creative Director</p>
          <p style="color:var(--text-secondary);font-size:0.8rem;margin-top:0.5rem">Award-winning designer crafting brand identities that stand the test of time.</p>
          <div class="team-social"><a href="#">in</a><a href="#">🎨</a></div>
        </div>
        <div class="team-card reveal">
          <div class="team-avatar">👩🏾‍📊</div>
          <h4 style="margin-bottom:0.25rem">Fatima Al-Rashid</h4>
          <p style="color:var(--clr-primary);font-size:0.8rem;font-weight:600">Head of Growth</p>
          <p style="color:var(--text-secondary);font-size:0.8rem;margin-top:0.5rem">Data-driven growth strategist who has managed $5M+ in ad spend for clients.</p>
          <div class="team-social"><a href="#">in</a><a href="#">𝕏</a></div>
        </div>
      </div>
    </div>
  </section>

  <!-- VALUES -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">💎 Core Values</span>
        <h2>What We <span class="text-gradient">Stand For</span></h2>
      </div>
      <div class="grid grid-3 stagger">
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🎯</div>
          <h3 style="margin-bottom:0.5rem">Results Over Vanity</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">We measure success by your business outcomes, not engagement metrics. Revenue, growth, and ROI — that's what we're after.</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🤝</div>
          <h3 style="margin-bottom:0.5rem">Radical Transparency</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">No smoke and mirrors. You get full visibility into strategy, spending, and results. We share what's working and what isn't, always.</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🌍</div>
          <h3 style="margin-bottom:0.5rem">Built for Africa</h3>
          <p style="color:var(--text-secondary);font-size:0.9rem">We understand the African market deeply — its nuances, opportunities, and unique challenges — and we build strategies that match.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Let's Build Something Great Together</h2>
        <p>Book a free strategy call and meet the team that will grow your business.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Schedule a Free Call 🤝</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
