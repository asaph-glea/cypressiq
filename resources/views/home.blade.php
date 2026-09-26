@extends('layouts.app')
@section('title', 'CypressIQ — Technology Company & Software Product Studio')
@section('meta_description', 'CypressIQ builds technology built around how your organization works: proprietary software products (Opero, ITIKIA), custom business systems, and digital solutions.')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}" />
@endsection

@section('content')

  <!-- ══════════════════════════════════════════════════════════
       1. HERO SECTION
       ══════════════════════════════════════════════════════════ -->
  <section class="hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    
    <div class="container" style="width:100%">
      <div class="hero__content reveal">
        <div class="hero__eyebrow">
          <span class="dot"></span>
          Technology Company &amp; Product Studio
        </div>

        <h1 class="hero__headline">
          Technology built around how <span class="text-gradient">your organization works.</span>
        </h1>

        <p class="hero__sub">
          CypressIQ builds digital products, business systems and custom technology solutions that help organizations operate, engage and grow.
        </p>

        <div class="hero__actions">
          <a href="#products" class="btn btn--primary btn--lg">
            ⚡ Explore our products
          </a>
          <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">
            Build with CypressIQ →
          </a>
        </div>

        <div class="hero__pills">
          <div class="hero__pills-item">
            <span style="color:var(--clr-accent)">✓</span> Proprietary Digital Products
          </div>
          <div class="hero__pills-item">
            <span style="color:var(--clr-accent)">✓</span> Custom Systems Engineering
          </div>
          <div class="hero__pills-item">
            <span style="color:var(--clr-accent)">✓</span> Digital Transformation Practice
          </div>
        </div>
      </div>

      <!-- Live Interactive System Monitor -->
      <div class="hero__system-monitor reveal">
        <div class="system-monitor-card">
          <div class="system-monitor-topbar">
            <div class="system-monitor-dots">
              <span></span><span></span><span></span>
            </div>
            <div class="system-monitor-tabs">
              <button class="system-monitor-tab active" id="tab-btn-opero" onclick="switchMonitorTab('opero')">
                <span>⚙️</span> Opero Business System
              </button>
              <button class="system-monitor-tab" id="tab-btn-itikia" onclick="switchMonitorTab('itikia')">
                <span>📣</span> ITIKIA Engagement Hub
              </button>
            </div>
            <span class="badge badge--success" style="font-size:0.7rem;display:flex;align-items:center;gap:0.35rem">
              <span style="width:6px;height:6px;background:var(--clr-success);border-radius:50%"></span> Live Architecture
            </span>
          </div>

          <!-- Opero Preview Pane -->
          <div id="pane-opero" class="system-monitor-body" style="display:block">
            <div class="system-metric-grid">
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-primary)">Real-Time Sync</div>
                <div class="system-metric-lbl">Multi-Warehouse Inventory &amp; Stock Rebalancing</div>
              </div>
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-accent)">&lt; 150ms Latency</div>
                <div class="system-metric-lbl">Point of Sale Invoicing &amp; Cart Checkout</div>
              </div>
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-warning)">Automated Ledger</div>
                <div class="system-metric-lbl">Double-Entry Financials, Payroll &amp; Audit Logs</div>
              </div>
            </div>

            <div class="system-table">
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-success)"></div>
                <div class="col-title">Point of Sale (POS) Engine</div>
                <div class="col-desc">Offline-tolerant checkout, barcode scanning &amp; digital tax invoicing</div>
                <div class="col-badge badge badge--success">Operational</div>
              </div>
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-primary)"></div>
                <div class="col-title">Centralized Inventory Core</div>
                <div class="col-desc">Automated stock movement tracking across retail branches &amp; central depots</div>
                <div class="col-badge badge badge--primary">Synchronized</div>
              </div>
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-warning)"></div>
                <div class="col-title">Workforce &amp; Financial Ledger</div>
                <div class="col-desc">Granular RBAC access controls, statutory deductions &amp; audit trails</div>
                <div class="col-badge badge badge--warning">Monitored</div>
              </div>
            </div>
          </div>

          <!-- ITIKIA Preview Pane -->
          <div id="pane-itikia" class="system-monitor-body" style="display:none">
            <div class="system-metric-grid">
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-accent)">100k+ Concurrency</div>
                <div class="system-metric-lbl">Edge-Cached Public Announcements &amp; Manifestos</div>
              </div>
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-primary)">Grassroots Intake</div>
                <div class="system-metric-lbl">Regional Volunteer Recruitment &amp; Skill Tagging</div>
              </div>
              <div class="system-metric-box">
                <div class="system-metric-val" style="color:var(--clr-success)">Direct Rail Funding</div>
                <div class="system-metric-lbl">Integrated Mobile Money (M-Pesa) &amp; Card Ingestion</div>
              </div>
            </div>

            <div class="system-table">
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-accent)"></div>
                <div class="col-title">Structured Policy Matrix</div>
                <div class="col-desc">Challenge → Solution → Impact voter manifesto framework</div>
                <div class="col-badge badge badge--success">Published</div>
              </div>
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-primary)"></div>
                <div class="col-title">Volunteer Network Directory</div>
                <div class="col-desc">Real-time coordinator dashboard with skill filtering &amp; dispatch tools</div>
                <div class="col-badge badge badge--primary">Active</div>
              </div>
              <div class="system-table-row">
                <div class="col-icon" style="background:var(--clr-warning)"></div>
                <div class="col-title">Multi-Channel Contribution Bridge</div>
                <div class="col-desc">Automated receipt generation &amp; reconciliation for citizen contributions</div>
                <div class="col-badge badge badge--warning">Reconciled</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       2. INTRODUCTION: TECHNOLOGY COMPANY & PRODUCT BUILDER
       ══════════════════════════════════════════════════════════ -->
  <section class="section" style="background:var(--bg-surface);border-top:1px solid var(--border-subtle);border-bottom:1px solid var(--border-subtle)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:840px;margin:0 auto">
        <span class="badge badge--primary">🏛️ Who We Are</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1.25rem">
          A Technology Company &amp; <span class="text-gradient">Software Product Builder</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.1rem;line-height:1.8">
          We are not a marketing agency or a generalist dev shop. CypressIQ is an engineering company and software product studio. We build proprietary digital platforms for systemic scale, and we architect tailored business systems for organizations whose operational complexity cannot be shoehorned into off-the-shelf software.
        </p>
      </div>

      <div class="intro-grid">
        <!-- Pillar 1 -->
        <div class="intro-card reveal">
          <div class="intro-card__tag">
            <span>⚡</span> Track 01 · Software Products
          </div>
          <h3>Proprietary Product Studio</h3>
          <p>
            We conceptualize, engineer, and continuously maintain proprietary software platforms that address critical operational and public engagement challenges across Africa and beyond.
          </p>
          <div style="margin-top:auto;padding-top:1.25rem">
            <a href="#products" style="font-size:0.85rem;font-weight:600;color:var(--clr-primary);text-decoration:none">Explore Software Products →</a>
          </div>
        </div>

        <!-- Pillar 2 -->
        <div class="intro-card reveal">
          <div class="intro-card__tag">
            <span>💻</span> Track 02 · Client Solutions
          </div>
          <h3>Custom Systems Engineering</h3>
          <p>
            When commercial tools impose operational compromises, we engineer custom software, web applications, transactional portals, and API gateways tailored to your exact business specifications.
          </p>
          <div style="margin-top:auto;padding-top:1.25rem">
            <a href="#solutions" style="font-size:0.85rem;font-weight:600;color:var(--clr-accent);text-decoration:none">View Engineering Solutions →</a>
          </div>
        </div>

        <!-- Pillar 3 -->
        <div class="intro-card reveal">
          <div class="intro-card__tag">
            <span>🔄</span> Track 03 · Transformation
          </div>
          <h3>Digital Systems Modernization</h3>
          <p>
            We guide growing institutions through digital transformation: transitioning away from isolated spreadsheets, paper logs, and manual handoffs into synchronized, automated digital operations.
          </p>
          <div style="margin-top:auto;padding-top:1.25rem">
            <a href="{{ route('solutions.technology-consulting') }}" style="font-size:0.85rem;font-weight:600;color:var(--clr-warning);text-decoration:none">Read Modernization Approach →</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       3. FLAGSHIP PRODUCTS: ITIKIA & OPERO
       ══════════════════════════════════════════════════════════ -->
  <section class="section" id="products">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto 4rem">
        <span class="badge badge--accent">📦 Proprietary Platforms</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Flagship Software Engineered by <span class="text-gradient">CypressIQ</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Our proprietary products represent turnkey software systems built with high engineering discipline, continuous stability, and enterprise-grade security.
        </p>
      </div>

      <!-- PRODUCT 1: ITIKIA CAMPAIGN -->
      <div class="product-showcase-card product-showcase-card--itikia reveal">
        <div>
          <div class="product-badge-pill product-badge-pill--teal">
            <span>📣</span> Digital Engagement &amp; Communication
          </div>
          <h3 style="font-size:clamp(1.8rem,3vw,2.4rem);margin-bottom:1rem">ITIKIA</h3>
          <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8">
            A structured digital engagement and communication platform designed for public-facing campaigns, organizations, civic leaders, and institutions that require an authoritative, scalable digital headquarters.
          </p>

          <div class="capability-list">
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Policy Manifestos Matrix (Challenge &rarr; Solution &rarr; Impact)</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Grassroots Volunteer Intake &amp; Regional Directory</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Rally, Townhall &amp; Event Coordination Dispatch</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Direct Multi-Channel Funding (M-Pesa Daraja &amp; Card)</span>
            </div>
          </div>

          <div style="display:flex;gap:1rem;flex-wrap:wrap">
            <a href="{{ route('itikia') }}" class="btn btn--accent btn--lg">Explore ITIKIA Platform →</a>
            <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">Request Platform Setup</a>
          </div>
        </div>

        <!-- ITIKIA Interactive Browser Mockup -->
        <div class="product-preview-terminal">
          <div class="browser-chrome">
            <div class="browser-dots"><span></span><span></span><span></span></div>
            <div class="browser-address">🔒 https://itikia.amani.ke/hq</div>
            <span class="badge badge--accent" style="font-size:0.65rem">Active Node</span>
          </div>

          <div class="mockup-tab-bar">
            <button class="mockup-tab-btn active" onclick="switchItikiaMockup('tour', this)">🎥 Live Tour</button>
            <button class="mockup-tab-btn" onclick="switchItikiaMockup('public', this)">🌐 Public Website</button>
            <button class="mockup-tab-btn" onclick="switchItikiaMockup('content', this)">📝 Content</button>
            <button class="mockup-tab-btn" onclick="switchItikiaMockup('engagement', this)">👥 Engagement</button>
            <button class="mockup-tab-btn" onclick="switchItikiaMockup('messages', this)">💬 Messages</button>
            <button class="mockup-tab-btn" onclick="switchItikiaMockup('analytics', this)">📊 Analytics</button>
          </div>

          <div class="mockup-viewport">
            <!-- View 0: Live Tour Video Looper -->
            <div id="itikia-view-tour" class="mockup-pane" style="display:block">
              <div class="product-video-wrapper">
                <video 
                  id="itikia-video-player"
                  class="ambient-loop-video"
                  autoplay 
                  loop 
                  muted 
                  playsinline 
                  preload="metadata"
                  poster="{{ asset(ltrim($productVideos['itikia']->poster_url ?? 'images/mockups/itikia-poster.webp', '/')) }}"
                >
                  <source src="{{ asset(ltrim($productVideos['itikia']->video_url ?? 'videos/itikia-loop.mp4', '/')) }}" type="video/mp4">
                  <img src="{{ asset(ltrim($productVideos['itikia']->poster_url ?? 'images/mockups/itikia-poster.webp', '/')) }}" alt="ITIKIA Campaign Platform" />
                </video>
                <div class="video-overlay-gradient"></div>
                <div class="video-badge-overlay">
                  <div class="video-badge-status">
                    <span class="pulse-dot pulse-dot--teal"></span>
                    <span>ITIKIA Movement Engine</span>
                    <span style="color:var(--text-muted);font-weight:400">● 100k Concurrency</span>
                  </div>
                  <button type="button" class="video-expand-btn" onclick="openProductVideoModal('itikia')">
                    🔍 Expand Tour
                  </button>
                </div>
              </div>
            </div>

            <!-- View 1: Public Website -->
            <div id="itikia-view-public" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.25rem">
                <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:0.75rem;margin-bottom:0.85rem">
                  <div style="font-weight:800;font-size:0.95rem;letter-spacing:0.04em">AMANI KENYA <span style="font-size:0.65rem;color:var(--clr-accent);font-weight:600">● OFFICIAL HQ</span></div>
                  <div style="display:flex;gap:0.65rem;font-size:0.7rem;color:var(--text-secondary)">
                    <span>Vision</span><span>News</span><span>Events</span><span>Media</span><span>Connect</span>
                  </div>
                </div>
                <div style="display:flex;gap:0.5rem;margin-bottom:0.85rem">
                  <span class="badge badge--accent" style="font-size:0.65rem">Support Movement</span>
                  <span class="badge badge--primary" style="font-size:0.65rem">Contact HQ</span>
                </div>
                <div style="background:rgba(0,212,170,0.06);border:1px solid rgba(0,212,170,0.2);border-radius:var(--radius-md);padding:0.75rem">
                  <div style="font-size:0.7rem;color:var(--clr-accent);font-weight:700">// LATEST UPDATE</div>
                  <div style="font-size:0.825rem;font-weight:600;color:var(--text-primary)">Citizen Townhall &amp; Economic Manifesto Release</div>
                  <div style="font-size:0.7rem;color:var(--text-muted);margin-top:0.2rem">Published 2h ago &bull; 48,200 Citizen Downloads</div>
                </div>
              </div>
            </div>

            <!-- View 2: Content (Editorial CMS) -->
            <div id="itikia-view-content" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.5rem">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle);font-size:0.75rem">
                  <div>
                    <span style="font-weight:600;color:var(--text-primary)">Agricultural Modernization Charter</span>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Sector 04 &bull; English &amp; Swahili</span>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Published</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle);font-size:0.75rem">
                  <div>
                    <span style="font-weight:600;color:var(--text-primary)">Healthcare Access &amp; Sub-County Clinics</span>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Sector 02 &bull; 3,210 words</span>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Published</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle);font-size:0.75rem">
                  <div>
                    <span style="font-weight:600;color:var(--text-primary)">Youth Innovation &amp; Tech Incubator Policy</span>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Scheduled for rally release</span>
                  </div>
                  <span class="badge badge--warning" style="font-size:0.6rem">In Review</span>
                </div>
              </div>
            </div>

            <!-- View 3: Engagement (Volunteers) -->
            <div id="itikia-view-engagement" class="mockup-pane" style="display:none">
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.75rem">
                <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
                  <div style="font-family:var(--font-display);font-size:1.25rem;font-weight:700;color:var(--clr-accent)">14,820</div>
                  <div style="font-size:0.68rem;color:var(--text-muted)">Verified Field Volunteers</div>
                </div>
                <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
                  <div style="font-family:var(--font-display);font-size:1.25rem;font-weight:700;color:var(--clr-primary)">128</div>
                  <div style="font-size:0.68rem;color:var(--text-muted)">Regional Chapter Captains</div>
                </div>
              </div>
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.65rem 0.85rem;font-size:0.725rem">
                <strong style="color:var(--text-primary)">Top Volunteer Clusters:</strong>
                <div style="display:flex;gap:0.3rem;flex-wrap:wrap;margin-top:0.35rem">
                  <span class="badge badge--accent" style="font-size:0.62rem">Field Mobilization (42%)</span>
                  <span class="badge badge--primary" style="font-size:0.62rem">Digital Comms (28%)</span>
                  <span class="badge badge--warning" style="font-size:0.62rem">Logistics (18%)</span>
                </div>
              </div>
            </div>

            <!-- View 4: Messages (Inbound Queues) -->
            <div id="itikia-view-messages" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.5rem">
                <div style="padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle);font-size:0.75rem">
                  <div style="display:flex;justify-content:space-between;margin-bottom:0.2rem">
                    <span style="font-weight:700;color:var(--clr-accent)">WhatsApp Citizen Inquiry</span>
                    <span style="font-size:0.65rem;color:var(--text-muted)">3m ago</span>
                  </div>
                  <p style="font-size:0.72rem;color:var(--text-secondary);margin:0">"Where will the Nakuru constituency manifesto copies be distributed this Saturday?"</p>
                  <span style="font-size:0.62rem;color:var(--clr-success);font-weight:600">✓ Auto-routed to Nakuru Coordinator</span>
                </div>
                <div style="padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle);font-size:0.75rem">
                  <div style="display:flex;justify-content:space-between;margin-bottom:0.2rem">
                    <span style="font-weight:700;color:var(--clr-primary)">SMS Broadcast Dispatch</span>
                    <span style="font-size:0.65rem;color:var(--text-muted)">45,000 sent</span>
                  </div>
                  <p style="font-size:0.72rem;color:var(--text-secondary);margin:0">Townhall reminder delivered &bull; 99.4% carrier delivery rate.</p>
                </div>
              </div>
            </div>

            <!-- View 5: Analytics -->
            <div id="itikia-view-analytics" class="mockup-pane" style="display:none">
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.75rem">
                <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
                  <div style="font-family:var(--font-display);font-size:1.25rem;font-weight:700;color:var(--clr-accent)">128,400</div>
                  <div style="font-size:0.68rem;color:var(--text-muted)">Weekly Unique Reach</div>
                </div>
                <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
                  <div style="font-family:var(--font-display);font-size:1.25rem;font-weight:700;color:var(--clr-success)">98/100</div>
                  <div style="font-size:0.68rem;color:var(--text-muted)">Campaign Health Score</div>
                </div>
              </div>
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.65rem 0.85rem;font-size:0.725rem">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.25rem">
                  <span>Edge Caching Performance:</span><strong style="color:var(--clr-accent)">99.2% Cached</strong>
                </div>
                <div style="display:flex;justify-content:space-between">
                  <span>Donation Conversion Rate:</span><strong style="color:var(--clr-primary)">8.4% STK Verified</strong>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- PRODUCT 2: OPERO -->
      <div class="product-showcase-card product-showcase-card--opero reveal">
        <div>
          <div class="product-badge-pill product-badge-pill--purple">
            <span>⚙️</span> Business Operations &amp; Management
          </div>
          <h3 style="font-size:clamp(1.8rem,3vw,2.4rem);margin-bottom:1rem">OPERO</h3>
          <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8">
            A comprehensive operational management platform unifying point of sale, multi-location inventory, workforce payroll, and financial accounting into a single real-time operational engine.
          </p>

          <div class="capability-list">
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Point of Sale (POS) with Offline-Tolerant Checkout</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Multi-Warehouse Inventory &amp; Automated Reorder Alerts</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Workforce HR, Attendance &amp; Statutory Payroll</span>
            </div>
            <div class="capability-list-item">
              <span class="check">✓</span>
              <span>Double-Entry Financial Ledger &amp; Cryptographic Audit</span>
            </div>
          </div>

          <div style="display:flex;gap:1rem;flex-wrap:wrap">
            <a href="{{ route('opero') }}" class="btn btn--primary btn--lg">Explore Opero Platform →</a>
            <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">Book Platform Walkthrough</a>
          </div>
        </div>

        <!-- OPERO Interactive Device Mockup -->
        <div class="product-preview-terminal">
          <div class="browser-chrome">
            <div class="browser-dots"><span></span><span></span><span></span></div>
            <div class="browser-address">🔒 https://opero.cypressiq.app/enterprise</div>
            <span class="badge badge--success" style="font-size:0.65rem">Ledger Online</span>
          </div>

          <div class="mockup-tab-bar">
            <button class="mockup-tab-btn mockup-tab-btn--purple active" onclick="switchOperoMockup('tour', this)">🎥 Live Tour</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('dashboard', this)">📈 Dashboard</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('sales', this)">🛒 Sales (POS)</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('inventory', this)">📦 Inventory</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('hr', this)">👥 HR</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('finance', this)">💳 Finance</button>
            <button class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoMockup('reports', this)">📋 Reports</button>
          </div>

          <div class="mockup-viewport">
            <!-- View 0: Live Tour Video Looper -->
            <div id="opero-view-tour" class="mockup-pane" style="display:block">
              <div class="product-video-wrapper">
                <video 
                  id="opero-video-player"
                  class="ambient-loop-video"
                  autoplay 
                  loop 
                  muted 
                  playsinline 
                  preload="metadata"
                  poster="{{ asset(ltrim($productVideos['opero']->poster_url ?? 'images/mockups/opero-poster.webp', '/')) }}"
                >
                  <source src="{{ asset(ltrim($productVideos['opero']->video_url ?? 'videos/opero-loop.mp4', '/')) }}" type="video/mp4">
                  <img src="{{ asset(ltrim($productVideos['opero']->poster_url ?? 'images/mockups/opero-poster.webp', '/')) }}" alt="OPERO Business ERP Suite" />
                </video>
                <div class="video-overlay-gradient"></div>
                <div class="video-badge-overlay">
                  <div class="video-badge-status">
                    <span class="pulse-dot pulse-dot--purple"></span>
                    <span>OPERO Operations Engine</span>
                    <span style="color:var(--text-muted);font-weight:400">● Real-Time POS Sync</span>
                  </div>
                  <button type="button" class="video-expand-btn" onclick="openProductVideoModal('opero')">
                    🔍 Expand Tour
                  </button>
                </div>
              </div>
            </div>

            <!-- View 1: Dashboard (KES 1,245,000 Monthly Sales) -->
            <div id="opero-view-dashboard" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.15rem">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem">
                  <div>
                    <div style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em">Monthly Revenue</div>
                    <div style="font-family:var(--font-display);font-size:1.45rem;font-weight:800;color:var(--text-primary)">KES 1,245,000 <span style="font-size:0.75rem;color:var(--clr-success);font-weight:700">+18.4%</span></div>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.65rem">4 Branches Live</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;margin-bottom:0.75rem">
                  <div style="padding:0.6rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);font-size:0.75rem">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Gross Margin:</span> <strong style="color:var(--clr-accent)">32.6%</strong>
                  </div>
                  <div style="padding:0.6rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);font-size:0.75rem">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Active POS Drawers:</span> <strong style="color:var(--clr-primary)">4 Online</strong>
                  </div>
                </div>
                <div style="padding:0.6rem 0.75rem;background:rgba(255,180,0,0.08);border:1px solid rgba(255,180,0,0.3);border-radius:var(--radius-md);display:flex;align-items:center;gap:0.4rem;font-size:0.725rem">
                  <span>⚠️</span> <span><strong>Stock Alert:</strong> 3 SKUs below reorder threshold (Branch: Nairobi Central)</span>
                </div>
              </div>
            </div>

            <!-- View 2: Sales (POS) -->
            <div id="opero-view-sales" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:0.85rem;font-size:0.75rem">
                <div style="display:flex;justify-content:space-between;padding-bottom:0.4rem;border-bottom:1px solid var(--border-subtle);margin-bottom:0.6rem">
                  <span style="font-weight:700;color:var(--text-primary)">POS Terminal #02 &bull; Cart Order #4092</span>
                  <span class="badge badge--success" style="font-size:0.6rem">Paid</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:0.3rem;color:var(--text-secondary)">
                  <span>2x Industrial Lubricant (20L)</span><strong style="color:var(--text-primary)">KES 14,000</strong>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:0.6rem;color:var(--text-secondary)">
                  <span>4x Heavy Duty Hydraulic Filter</span><strong style="color:var(--text-primary)">KES 6,800</strong>
                </div>
                <div style="display:flex;justify-content:space-between;padding-top:0.4rem;border-top:1px solid var(--border-subtle);font-weight:700;color:var(--text-primary)">
                  <span>Total Paid:</span><span style="color:var(--clr-primary)">KES 20,800</span>
                </div>
                <div style="margin-top:0.4rem;font-size:0.68rem;color:var(--text-muted)">
                  Tender: M-Pesa STK Push (Ref: QK9182LA) &bull; Receipt #8819 Printed &bull; Cashier: John M.
                </div>
              </div>
            </div>

            <!-- View 3: Inventory -->
            <div id="opero-view-inventory" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.45rem;font-size:0.75rem">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.55rem 0.75rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Central Depot (Warehouse A)</strong>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Main storage &bull; 4,820 units on hand</span>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Adequate</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.55rem 0.75rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Nairobi Central Outlet</strong>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Retail floor &bull; 1,140 units on hand</span>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.6rem">Normal</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.55rem 0.75rem;background:rgba(255,71,87,0.06);border-radius:var(--radius-md);border:1px solid rgba(255,71,87,0.25)">
                  <div>
                    <strong style="color:#ff6b81">SKU-2041 (Hydraulic Valve)</strong>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Current: 12 units (Threshold: 20 units)</span>
                  </div>
                  <span class="badge badge--warning" style="font-size:0.6rem">Reorder PO #108</span>
                </div>
              </div>
            </div>

            <!-- View 4: HR & Payroll -->
            <div id="opero-view-hr" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:0.85rem;font-size:0.75rem">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.6rem">
                  <div>
                    <span style="font-size:0.68rem;color:var(--text-muted);text-transform:uppercase">Active Roster</span>
                    <div style="font-weight:700;color:var(--text-primary);font-size:1rem">18 / 18 Staff Clocked In</div>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Biometric Verified</span>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.35rem;font-size:0.72rem;color:var(--text-secondary)">
                  <div style="display:flex;justify-content:space-between;padding:0.25rem 0;border-bottom:1px solid var(--border-subtle)">
                    <span>Current Payroll Period:</span><strong>September 2026</strong>
                  </div>
                  <div style="display:flex;justify-content:space-between;padding:0.25rem 0;border-bottom:1px solid var(--border-subtle)">
                    <span>Statutory Deductions (PAYE, NSSF, NHIF):</span><strong style="color:var(--clr-accent)">Reconciled</strong>
                  </div>
                  <div style="display:flex;justify-content:space-between;padding:0.25rem 0">
                    <span>Disbursement Authorizations:</span><strong style="color:var(--clr-primary)">Dual Signoff Approved</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- View 5: Finance & Ledger -->
            <div id="opero-view-finance" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:0.85rem;font-size:0.75rem">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.6rem">
                  <span style="font-weight:700;color:var(--text-primary)">Double-Entry Operational Ledger</span>
                  <span style="font-family:var(--font-mono);font-size:0.62rem;color:var(--clr-accent)">AUDIT-HASH: 7f8a9e...</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;margin-bottom:0.6rem">
                  <div style="padding:0.5rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
                    <span style="font-size:0.65rem;color:var(--text-muted)">Daily Bank Ingestion:</span>
                    <div style="font-weight:700;color:var(--clr-success)">KES 342,000 Reconciled</div>
                  </div>
                  <div style="padding:0.5rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
                    <span style="font-size:0.65rem;color:var(--text-muted)">Open Receivables:</span>
                    <div style="font-weight:700;color:var(--text-primary)">KES 180,000 (&lt; 15d)</div>
                  </div>
                </div>
                <div style="font-size:0.68rem;color:var(--text-muted)">
                  Zero unallocated transaction lines &bull; MT940 automated reconciliation active.
                </div>
              </div>
            </div>

            <!-- View 6: Reports -->
            <div id="opero-view-reports" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.5rem;font-size:0.75rem">
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Executive Monthly P&amp;L Statement</strong>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Branch breakdown with gross &amp; net margins</span>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.6rem">PDF / Excel</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>SKU Velocity &amp; Shrinkage Audit</strong>
                    <span style="display:block;font-size:0.68rem;color:var(--text-muted)">Fastest moving products &amp; warehouse discrepancy log</span>
                  </div>
                  <span class="badge badge--accent" style="font-size:0.6rem">Telemetry</span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       4. TECHNOLOGY SOLUTIONS (CUSTOM CLIENT CAPABILITIES)
       ══════════════════════════════════════════════════════════ -->
  <section class="section" id="solutions" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto 3.5rem">
        <span class="badge badge--warning">🛠️ Client Capabilities</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Custom Technology Built for <span class="text-gradient">Client Needs</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Products are our proprietary software suite. Solutions represent bespoke systems engineered from the ground up to match your organization's exact operational reality.
        </p>
      </div>

      <div class="solutions-grid">
        <!-- Solution 1 -->
        <a href="{{ route('solutions.web-development') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">🌐</div>
            <h4>Web Development &amp; Portals</h4>
            <p>High-performance web applications, interactive customer portals, and modern frontends built for speed, SEO, and fluid usability.</p>
          </div>
          <span class="solution-box__link">Explore Web Development →</span>
        </a>

        <!-- Solution 2 -->
        <a href="{{ route('solutions.custom-software') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">💻</div>
            <h4>Custom Software Engineering</h4>
            <p>Bespoke software engineered to address unique operational bottlenecks that off-the-shelf platforms cannot accommodate.</p>
          </div>
          <span class="solution-box__link">Explore Custom Software →</span>
        </a>

        <!-- Solution 3 -->
        <a href="{{ route('solutions.business-systems') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">🏢</div>
            <h4>Business Systems &amp; Cockpits</h4>
            <p>Internal management platforms, multi-department approval queues, multi-branch inventory tracking, and RBAC security.</p>
          </div>
          <span class="solution-box__link">Explore Business Systems →</span>
        </a>

        <!-- Solution 4 -->
        <a href="{{ route('solutions.automation-integrations') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">🔌</div>
            <h4>Automation &amp; Integrations</h4>
            <p>Resilient RESTful/GraphQL API gateways, event-driven webhooks, and payment rails (M-Pesa Daraja, Stripe, Bank APIs).</p>
          </div>
          <span class="solution-box__link">Explore Automation &amp; APIs →</span>
        </a>

        <!-- Solution 5 -->
        <a href="{{ route('solutions.digital-platforms') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">☁️</div>
            <h4>Digital Platforms &amp; Cloud</h4>
            <p>Scalable multi-tenant SaaS engines, distributor partner hubs, containerized Docker deployments, and cloud modernization.</p>
          </div>
          <span class="solution-box__link">Explore Digital Platforms →</span>
        </a>

        <!-- Solution 6 -->
        <a href="{{ route('solutions.technology-consulting') }}" class="solution-box reveal">
          <div>
            <div class="solution-box__icon">🔄</div>
            <h4>Technology Consulting</h4>
            <p>Systems architecture audits, legacy code refactoring, and digital transformation roadmaps to modernize fragmented operations.</p>
          </div>
          <span class="solution-box__link">Explore Technology Consulting →</span>
        </a>
      </div>

      <!-- Solutions Video Telemetry Showcase -->
      <div class="product-preview-terminal reveal" style="max-width:980px;margin:3.5rem auto 0">
        <div class="browser-chrome">
          <div class="browser-dots"><span></span><span></span><span></span></div>
          <div class="browser-address">🔒 https://api.cypressiq.io/v1/telemetry/live-cluster</div>
          <span class="badge badge--accent" style="font-size:0.65rem">Distributed Core</span>
        </div>
        <div class="product-video-wrapper">
          <video 
            id="solutions-video-player"
            class="ambient-loop-video"
            autoplay 
            loop 
            muted 
            playsinline 
            preload="metadata"
            poster="{{ asset(ltrim($productVideos['solutions']->poster_url ?? 'images/mockups/solutions-poster.webp', '/')) }}"
          >
            <source src="{{ asset(ltrim($productVideos['solutions']->video_url ?? 'videos/solutions-loop.mp4', '/')) }}" type="video/mp4">
            <img src="{{ asset(ltrim($productVideos['solutions']->poster_url ?? 'images/mockups/solutions-poster.webp', '/')) }}" alt="CypressIQ Custom Systems Engine" />
          </video>
          <div class="video-overlay-gradient"></div>
          <div class="video-badge-overlay">
            <div class="video-badge-status">
              <span class="pulse-dot pulse-dot--sky"></span>
              <span>Bespoke Engineering Cluster</span>
              <span style="color:var(--text-muted);font-weight:400">● 99.99% Systems Uptime</span>
            </div>
            <button type="button" class="video-expand-btn" onclick="openProductVideoModal('solutions')">
              🔍 Expand Tour
            </button>
          </div>
        </div>
      </div>

      <!-- ══════════════════════════════════════════════════════════
           PROJECT DISCOVERY SYSTEM: SALES CONVERSION ENGINE
           ══════════════════════════════════════════════════════════ -->
      <div class="discovery-container reveal" id="project-discovery">
        <div style="text-align:center;max-width:720px;margin:0 auto 2.5rem">
          <span class="badge badge--accent" style="margin-bottom:0.75rem">⚡ Project Discovery Engine</span>
          <h3 style="font-size:clamp(1.5rem,2.8vw,2.2rem);margin-bottom:0.75rem">
            What are you trying to <span class="text-gradient">build or solve?</span>
          </h3>
          <p style="color:var(--text-secondary);font-size:0.95rem;line-height:1.7">
            Select your operational priority below. Tell us the core bottleneck and receive an initial architecture scoping session with our lead engineering team.
          </p>
        </div>

        <form id="home-discovery-form" onsubmit="handleDiscoverySubmit(event)">
          <input type="hidden" name="service_interest" id="discovery-selected-service" value="Business Operations (Opero ERP)">

          <!-- Step 1: Select Type -->
          <div class="discovery-step-title">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:50%;background:rgba(0,212,170,0.15);color:var(--clr-accent);font-size:0.75rem;font-weight:700">1</span>
            <span>Select Primary Objective</span>
          </div>
          <div class="discovery-options-grid">
            <div class="discovery-option-card selected" onclick="selectDiscoveryType('Business Operations (Opero ERP)', this)">
              <span class="icon">🏢</span>
              <span class="label">Opero Operations / ERP</span>
            </div>
            <div class="discovery-option-card" onclick="selectDiscoveryType('Digital Engagement (ITIKIA Platform)', this)">
              <span class="icon">📣</span>
              <span class="label">ITIKIA Public Platform</span>
            </div>
            <div class="discovery-option-card" onclick="selectDiscoveryType('Custom Software Engineering', this)">
              <span class="icon">💻</span>
              <span class="label">Custom Software System</span>
            </div>
            <div class="discovery-option-card" onclick="selectDiscoveryType('Integrations & API Gateways', this)">
              <span class="icon">🔌</span>
              <span class="label">APIs &amp; Payment Rails</span>
            </div>
            <div class="discovery-option-card" onclick="selectDiscoveryType('Systems Architecture Consulting', this)">
              <span class="icon">🔄</span>
              <span class="label">Architecture Audit</span>
            </div>
          </div>

          <!-- Step 2: Problem Description -->
          <div class="discovery-step-title">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:50%;background:rgba(0,212,170,0.15);color:var(--clr-accent);font-size:0.75rem;font-weight:700">2</span>
            <span>Describe the Bottleneck or Desired Outcome</span>
          </div>
          <div style="margin-bottom:2rem">
            <textarea name="message" id="discovery-message" rows="3" class="form-control" style="width:100%;background:var(--bg-surface);border:1px solid var(--border-subtle);border-radius:var(--radius-md);color:var(--text-primary);padding:0.85rem 1rem;font-family:inherit;font-size:0.9rem;resize:vertical" placeholder="e.g. We have 6 branches running on fragmented spreadsheets with stock discrepancies and manual M-Pesa receipts. We need real-time multi-branch inventory and unified ledger reconciliation..." required></textarea>
          </div>

          <!-- Step 3: Contact & Transmission -->
          <div class="discovery-step-title">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;border-radius:50%;background:rgba(0,212,170,0.15);color:var(--clr-accent);font-size:0.75rem;font-weight:700">3</span>
            <span>Where Should We Send Preliminary Scoping &amp; Architecture?</span>
          </div>
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:1rem;margin-bottom:1.5rem">
            <div>
              <label style="display:block;font-size:0.75rem;font-weight:600;color:var(--text-muted);margin-bottom:0.35rem">Your Name *</label>
              <input type="text" name="first_name" id="discovery-name" class="form-control" style="width:100%;background:var(--bg-surface);border:1px solid var(--border-subtle);border-radius:var(--radius-md);color:var(--text-primary);padding:0.65rem 0.85rem;font-family:inherit;font-size:0.875rem" placeholder="e.g. Alex Kamau" required>
            </div>
            <div>
              <label style="display:block;font-size:0.75rem;font-weight:600;color:var(--text-muted);margin-bottom:0.35rem">Work Email *</label>
              <input type="email" name="email" id="discovery-email" class="form-control" style="width:100%;background:var(--bg-surface);border:1px solid var(--border-subtle);border-radius:var(--radius-md);color:var(--text-primary);padding:0.65rem 0.85rem;font-family:inherit;font-size:0.875rem" placeholder="alex@organization.com" required>
            </div>
            <div>
              <label style="display:block;font-size:0.75rem;font-weight:600;color:var(--text-muted);margin-bottom:0.35rem">Phone / WhatsApp</label>
              <input type="text" name="phone" id="discovery-phone" class="form-control" style="width:100%;background:var(--bg-surface);border:1px solid var(--border-subtle);border-radius:var(--radius-md);color:var(--text-primary);padding:0.65rem 0.85rem;font-family:inherit;font-size:0.875rem" placeholder="+254 700 000000">
            </div>
          </div>

          <div id="discovery-alert" style="display:none;padding:0.85rem 1.25rem;border-radius:var(--radius-md);font-size:0.875rem;margin-bottom:1.5rem"></div>

          <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem">
            <div style="font-size:0.75rem;color:var(--text-muted);display:flex;align-items:center;gap:0.4rem">
              <span>🔒</span> Strict NDA confidentiality. No spam. Direct response within 24 business hours.
            </div>
            <button type="submit" id="discovery-submit-btn" class="btn btn--accent btn--lg" style="font-size:0.95rem;padding:0.85rem 2rem">
              Request Architecture Scoping Session →
            </button>
          </div>
        </form>
      </div>

    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       5. HOW WE BUILD (5-STEP DISCIPLINED PROCESS)
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto">
        <span class="badge badge--primary">📐 Engineering Methodology</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          How We Build: <span class="text-gradient">A Disciplined Process</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          We reject reckless prototyping and over-engineering. We follow a deterministic delivery framework designed to produce durable, maintainable systems.
        </p>
      </div>

      <div class="process-track">
        <!-- Step 1 -->
        <div class="process-step-card reveal">
          <div class="process-step-number">01</div>
          <h4>Understand</h4>
          <p>We audit existing operational workflows, data touchpoints, user roles, and constraints before proposing architecture or writing code.</p>
        </div>

        <!-- Step 2 -->
        <div class="process-step-card reveal">
          <div class="process-step-number">02</div>
          <h4>Design</h4>
          <p>We design normalized relational database schemas, clear API contracts, and intuitive interfaces with a focus on error prevention.</p>
        </div>

        <!-- Step 3 -->
        <div class="process-step-card reveal">
          <div class="process-step-number">03</div>
          <h4>Build</h4>
          <p>We engineer test-driven codebases using modern, type-safe frameworks, running automated unit and feature test suites continuously.</p>
        </div>

        <!-- Step 4 -->
        <div class="process-step-card reveal">
          <div class="process-step-number">04</div>
          <h4>Deploy</h4>
          <p>We configure hardened Linux/Docker infrastructure, point-in-time database snapshots, SSL termination, and execute zero-downtime releases.</p>
        </div>

        <!-- Step 5 -->
        <div class="process-step-card reveal">
          <div class="process-step-number">05</div>
          <h4>Improve</h4>
          <p>We monitor live system telemetry, optimize queries under growing load, and provide continuous SLA support and modular expansion.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       6. SELECTED WORK (REAL PROJECTS FROM CODEBASE)
       ══════════════════════════════════════════════════════════ -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto">
        <span class="badge badge--accent">📁 Proven Deliveries</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Selected Engineering <span class="text-gradient">Deliveries</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Real systems engineered, deployed, and operating under production loads across regional enterprises and civic institutions.
        </p>
      </div>

      <div class="selected-work-grid">
        <!-- Project 1 -->
        <div class="work-item-card reveal">
          <div>
            <div class="work-item-badge">Retail &bull; Opero ERP Deployment</div>
            <h3>Regional Multi-Branch Retail Operations</h3>
            <p>
              Unified 14 distributed retail outlets onto a central Opero ERP instance. Deployed offline-tolerant POS terminals, real-time central stock sync, and automated daily bank recon.
            </p>
          </div>
          <div class="work-item-meta">
            <span>Result: <strong>92% reduction</strong> in inventory discrepancies</span>
            <a href="{{ route('portfolio') }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">View Details →</a>
          </div>
        </div>

        <!-- Project 2 -->
        <div class="work-item-card reveal">
          <div>
            <div class="work-item-badge">Civic Engagement &bull; ITIKIA Platform</div>
            <h3>High-Concurrency Public Engagement Hub</h3>
            <p>
              Configured and hosted ITIKIA Campaign to serve 100k+ concurrent visitors during nationwide broadcast announcements with edge caching and asynchronous queue worker pipelines.
            </p>
          </div>
          <div class="work-item-meta">
            <span>Uptime: <strong>99.98% availability</strong> during broadcast spikes</span>
            <a href="{{ route('portfolio') }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">View Details →</a>
          </div>
        </div>

        <!-- Project 3 -->
        <div class="work-item-card reveal">
          <div>
            <div class="work-item-badge">Finance &bull; Custom Integration Pipeline</div>
            <h3>Automated Multi-Bank Reconciliation Engine</h3>
            <p>
              Engineered an asynchronous matching pipeline that ingests MT940 and CSV bank feeds, validates payment algorithms against active invoices, and writes verified ledger entries.
            </p>
          </div>
          <div class="work-item-meta">
            <span>Time Saved: <strong>10 days/month</strong> of manual paperwork eliminated</span>
            <a href="{{ route('portfolio') }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">View Details →</a>
          </div>
        </div>

        <!-- Project 4 -->
        <div class="work-item-card reveal">
          <div>
            <div class="work-item-badge">Logistics &bull; Progressive Web App</div>
            <h3>Fleet &amp; Dispatch Logistics Gateway</h3>
            <p>
              Built a high-reliability PWA for delivery dispatchers and drivers operating in low-connectivity areas, featuring GPS waypoint logging and digital proof of delivery.
            </p>
          </div>
          <div class="work-item-meta">
            <span>Performance: <strong>Sub-second UI</strong> with offline sync</span>
            <a href="{{ route('portfolio') }}" style="color:var(--clr-accent);text-decoration:none;font-weight:600">View Details →</a>
          </div>
        </div>
      </div>

      <div style="text-align:center;margin-top:3rem;display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('portfolio') }}" class="btn btn--outline btn--lg">View All Deliveries &amp; Architecture →</a>
        <a href="{{ route('trust') }}" class="btn btn--primary btn--lg">⭐ Verified Client Testimonials &amp; Track Record →</a>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       7. TECHNOLOGY / CAPABILITIES (ARCHITECTURAL RIGOR)
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto">
        <span class="badge badge--primary">⚙️ Architectural Rigor</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Engineering Built for <span class="text-gradient">Operational Durability</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          We prioritize data integrity, system security, and deterministic execution over ephemeral framework trends.
        </p>
      </div>

      <div class="tech-pillars-grid">
        <!-- Tech 1 -->
        <div class="tech-pillar-card reveal">
          <div class="tech-pillar-card__icon">🗄️</div>
          <h4>Relational Data Integrity</h4>
          <p>Normalized database schemas, strict foreign key constraints, and transactional isolation preventing data corruption under heavy concurrent writes.</p>
          <div class="tech-tag-row">
            <span class="tech-tag-pill">PostgreSQL</span>
            <span class="tech-tag-pill">MySQL 8.0</span>
            <span class="tech-tag-pill">ACID</span>
            <span class="tech-tag-pill">Migrations</span>
          </div>
        </div>

        <!-- Tech 2 -->
        <div class="tech-pillar-card reveal">
          <div class="tech-pillar-card__icon">⚡</div>
          <h4>High-Concurrency Execution</h4>
          <p>In-memory Redis caching, asynchronous queue worker pipelines, and query indexing targeting sub-100ms API response windows.</p>
          <div class="tech-tag-row">
            <span class="tech-tag-pill">Redis</span>
            <span class="tech-tag-pill">Queue Workers</span>
            <span class="tech-tag-pill">Varnish / Edge</span>
            <span class="tech-tag-pill">PHP 8.2+</span>
          </div>
        </div>

        <!-- Tech 3 -->
        <div class="tech-pillar-card reveal">
          <div class="tech-pillar-card__icon">🛡️</div>
          <h4>Enterprise Security &amp; RBAC</h4>
          <p>Granular role-based permissions, cryptographic audit ledgers, two-factor authentication, and encrypted data storage at rest.</p>
          <div class="tech-tag-row">
            <span class="tech-tag-pill">RBAC</span>
            <span class="tech-tag-pill">Audit Trail</span>
            <span class="tech-tag-pill">2FA</span>
            <span class="tech-tag-pill">OWASP Standards</span>
          </div>
        </div>

        <!-- Tech 4 -->
        <div class="tech-pillar-card reveal">
          <div class="tech-pillar-card__icon">🔌</div>
          <h4>Fault-Tolerant Integrations</h4>
          <p>Resilient webhook listeners, automated exponential-backoff retries, and dead-letter queues ensuring zero lost financial transactions.</p>
          <div class="tech-tag-row">
            <span class="tech-tag-pill">M-Pesa Daraja</span>
            <span class="tech-tag-pill">Stripe</span>
            <span class="tech-tag-pill">Idempotency</span>
            <span class="tech-tag-pill">REST / GraphQL</span>
          </div>
        </div>

        <!-- Tech 5 -->
        <div class="tech-pillar-card reveal">
          <div class="tech-pillar-card__icon">☁️</div>
          <h4>Cloud DevOps &amp; Uptime</h4>
          <p>Dockerized service containers, automated offsite database snapshots, SSL termination, and continuous CI/CD deployment pipelines.</p>
          <div class="tech-tag-row">
            <span class="tech-tag-pill">Docker</span>
            <span class="tech-tag-pill">Linux / Nginx</span>
            <span class="tech-tag-pill">Automated Backups</span>
            <span class="tech-tag-pill">CI/CD</span>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       8. INSIGHTS (TECHNICAL PERSPECTIVES)
       ══════════════════════════════════════════════════════════ -->
  @php
    try {
      $recentPosts = \Illuminate\Support\Facades\Schema::hasTable('posts')
        ? \App\Models\Post::where('status', 'published')
          ->with('category')
          ->orderBy('created_at', 'desc')
          ->take(3)
          ->get()
        : collect();
    } catch (\Throwable $e) {
      $recentPosts = collect();
    }
  @endphp

  <section class="section" style="background:var(--bg-surface);border-top:1px solid var(--border-subtle);border-bottom:1px solid var(--border-subtle)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:780px;margin:0 auto">
        <span class="badge badge--warning">💡 Thought Leadership</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Engineering &amp; <span class="text-gradient">Systems Insights</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Technical thinking on systems architecture, data silos, and operational efficiency from our engineering team.
        </p>
      </div>

      <div class="insights-home-grid">
        @if($recentPosts->count() > 0)
          @foreach($recentPosts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="insight-home-card reveal">
              <div>
                <div class="insight-home-card__meta">
                  <span class="badge badge--accent" style="font-size:0.65rem">{{ $post->category->name ?? 'Technology' }}</span>
                  <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M j, Y') : $post->created_at->format('M j, Y') }}</span>
                </div>
                <h4>{{ \Illuminate\Support\Str::limit($post->title, 65) }}</h4>
                <p>{{ \Illuminate\Support\Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
              </div>
              <span class="insight-home-card__link">Read Article →</span>
            </a>
          @endforeach
        @else
          <!-- Curated Architectural Articles -->
          <a href="{{ route('blog.index') }}" class="insight-home-card reveal">
            <div>
              <div class="insight-home-card__meta">
                <span class="badge badge--accent" style="font-size:0.65rem">Systems Architecture</span>
                <span>Sep 2026</span>
              </div>
              <h4>Scaling Distributed Architecture Across Regional Markets</h4>
              <p>How we design database replication, offline caching, and failover mechanisms for unpredictable network topologies.</p>
            </div>
            <span class="insight-home-card__link">Read Article →</span>
          </a>

          <a href="{{ route('blog.index') }}" class="insight-home-card reveal">
            <div>
              <div class="insight-home-card__meta">
                <span class="badge badge--accent" style="font-size:0.65rem">Operations</span>
                <span>Aug 2026</span>
              </div>
              <h4>The Hidden Cost of Fragmented Business Spreadsheets</h4>
              <p>Why growing organizations reach a breaking point with manual data entry and how centralized software restores control.</p>
            </div>
            <span class="insight-home-card__link">Read Article →</span>
          </a>

          <a href="{{ route('blog.index') }}" class="insight-home-card reveal">
            <div>
              <div class="insight-home-card__meta">
                <span class="badge badge--accent" style="font-size:0.65rem">FinTech</span>
                <span>Jul 2026</span>
              </div>
              <h4>Engineering Resilient M-Pesa Daraja &amp; Payment Rails</h4>
              <p>Best practices for idempotent webhook handling, duplicate transaction prevention, and automatic ledger reconciliation.</p>
            </div>
            <span class="insight-home-card__link">Read Article →</span>
          </a>
        @endif
      </div>

      <div style="text-align:center;margin-top:3rem">
        <a href="{{ route('blog.index') }}" class="btn btn--outline btn--lg">Explore All Technical Insights →</a>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       9. FINAL TECHNICAL CTA
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="final-tech-cta reveal">
        <span class="badge badge--accent" style="margin-bottom:1.25rem">🤝 Direct Engineering Collaboration</span>
        <h2>Build something with <span class="text-gradient">CypressIQ.</span></h2>
        <p>
          Whether deploying our proprietary platforms or architecting bespoke software for your organization — consult directly with our technology team to review feasibility, timelines, and technical architecture.
        </p>
        <div class="final-tech-cta__actions">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">
            Schedule Technical Consultation →
          </a>
          <a href="#products" class="btn btn--secondary btn--lg">
            Explore Products
          </a>
          <a href="{{ route('portfolio') }}" class="btn btn--outline btn--lg">
            View Case Studies
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════════════════════════
       FULL VIDEO WALKTHROUGH MODAL (REUSABLE PARTIAL)
       ══════════════════════════════════════════════════════════ -->
  @include('partials.product-video-modal')

@endsection

@section('scripts')
<script>
  function switchMonitorTab(type) {
    const btnOpero = document.getElementById('tab-btn-opero');
    const btnItikia = document.getElementById('tab-btn-itikia');
    const paneOpero = document.getElementById('pane-opero');
    const paneItikia = document.getElementById('pane-itikia');

    if (type === 'opero') {
      btnOpero.classList.add('active');
      btnItikia.classList.remove('active');
      paneOpero.style.display = 'block';
      paneItikia.style.display = 'none';
    } else {
      btnItikia.classList.add('active');
      btnOpero.classList.remove('active');
      paneItikia.style.display = 'block';
      paneOpero.style.display = 'none';
    }
  }

  function switchItikiaMockup(tab, btn) {
    const card = btn.closest('.product-showcase-card--itikia');
    if (card) {
      card.querySelectorAll('.mockup-tab-btn').forEach(b => b.classList.remove('active'));
    }
    btn.classList.add('active');

    const panes = ['tour', 'public', 'content', 'engagement', 'messages', 'analytics'];
    panes.forEach(p => {
      const el = document.getElementById('itikia-view-' + p);
      if (el) el.style.display = (p === tab) ? 'block' : 'none';
    });

    const itikiaVid = document.getElementById('itikia-video-player');
    if (itikiaVid) {
      if (tab === 'tour') {
        itikiaVid.play().catch(() => {});
      } else {
        itikiaVid.pause();
      }
    }
  }

  function switchOperoMockup(tab, btn) {
    const card = btn.closest('.product-showcase-card--opero');
    if (card) {
      card.querySelectorAll('.mockup-tab-btn').forEach(b => b.classList.remove('active'));
    }
    btn.classList.add('active');

    const panes = ['tour', 'dashboard', 'sales', 'inventory', 'hr', 'finance', 'reports'];
    panes.forEach(p => {
      const el = document.getElementById('opero-view-' + p);
      if (el) el.style.display = (p === tab) ? 'block' : 'none';
    });

    const operoVid = document.getElementById('opero-video-player');
    if (operoVid) {
      if (tab === 'tour') {
        operoVid.play().catch(() => {});
      } else {
        operoVid.pause();
      }
    }
  }

  // ── WALKTHROUGH MODAL BRIDGE (DELEGATES TO REUSABLE PRODUCT VIDEO MODAL) ──
  function openWalkthroughModal(type, title, videoSrc) {
    if (typeof openProductVideoModal === 'function') {
      openProductVideoModal(type, title, videoSrc);
    }
  }

  function closeWalkthroughModal() {
    if (typeof closeProductVideoModal === 'function') {
      closeProductVideoModal();
    }
  }

  // ── AMBIENT VIDEO PERFORMANCE & BATTERY OBSERVER ──
  document.addEventListener('DOMContentLoaded', () => {
    const isDataSaver = navigator.connection && navigator.connection.saveData;
    const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (isDataSaver || isReducedMotion) {
      document.querySelectorAll('.ambient-loop-video').forEach(v => v.pause());
      return;
    }

    const ambientVideos = document.querySelectorAll('.ambient-loop-video');
    if (!ambientVideos.length) return;

    const videoObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        const video = entry.target;
        const pane = video.closest('.mockup-pane');
        const isPaneVisible = !pane || pane.style.display !== 'none';

        if (entry.isIntersecting && isPaneVisible) {
          video.play().catch(() => {});
        } else {
          video.pause();
        }
      });
    }, {
      rootMargin: '200px 0px',
      threshold: 0.15
    });

    ambientVideos.forEach(v => videoObserver.observe(v));
  });

  function selectDiscoveryType(type, card) {
    document.querySelectorAll('.discovery-option-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    document.getElementById('discovery-selected-service').value = type;
  }

  async function handleDiscoverySubmit(event) {
    event.preventDefault();
    const btn = document.getElementById('discovery-submit-btn');
    const alertBox = document.getElementById('discovery-alert');

    btn.disabled = true;
    btn.innerText = 'Transmitting Discovery Request...';
    alertBox.style.display = 'none';

    const fullName = document.getElementById('discovery-name').value.trim();
    const parts = fullName.split(' ');
    const firstName = parts[0] || 'Client';
    const lastName = parts.slice(1).join(' ') || '-';

    const formData = new FormData();
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('email', document.getElementById('discovery-email').value);
    formData.append('phone', document.getElementById('discovery-phone').value || '');
    formData.append('service_interest', document.getElementById('discovery-selected-service').value);
    formData.append('message', document.getElementById('discovery-message').value);

    try {
      const response = await fetch('/contact-submit', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      });

      const data = await response.json();

      if (data.success) {
        alertBox.innerText = '✅ Project Discovery Received. Our systems team will review your requirements and reach out within 24 hours to schedule your preliminary scoping session.';
        alertBox.style.display = 'block';
        alertBox.style.background = 'rgba(0, 212, 170, 0.12)';
        alertBox.style.border = '1px solid rgba(0, 212, 170, 0.35)';
        alertBox.style.color = 'var(--clr-accent)';
        document.getElementById('home-discovery-form').reset();
      } else {
        alertBox.innerText = '⚠️ There was an issue processing your request. Please check the fields and try again.';
        alertBox.style.display = 'block';
        alertBox.style.background = 'rgba(255, 71, 87, 0.12)';
        alertBox.style.border = '1px solid rgba(255, 71, 87, 0.35)';
        alertBox.style.color = '#ff6b81';
      }
    } catch (err) {
      console.error(err);
      alertBox.innerText = '⚠️ Connection error. Please contact us directly at inquiries@cypressiq.com.';
      alertBox.style.display = 'block';
      alertBox.style.background = 'rgba(255, 71, 87, 0.12)';
      alertBox.style.border = '1px solid rgba(255, 71, 87, 0.35)';
      alertBox.style.color = '#ff6b81';
    } finally {
      btn.disabled = false;
      btn.innerText = 'Request Architecture Scoping Session →';
    }
  }
</script>
@endsection
