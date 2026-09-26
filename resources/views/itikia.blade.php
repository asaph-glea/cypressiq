@extends('layouts.app')
@section('title', 'ITIKIA — Digital Engagement & Public Communication Platform | CypressIQ')
@section('meta_description', 'ITIKIA is a digital engagement and structured communication platform for public-facing campaigns, civic leaders, and institutions requiring an authoritative digital headquarters.')

@section('css')
<style>
  .itikia-hero-grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 3rem;
    align-items: center;
    margin-top: 1rem;
  }
  .module-feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
  }
  .module-feature-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2rem;
    transition: all 0.3s ease;
  }
  .module-feature-card:hover {
    border-color: var(--clr-accent);
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 212, 170, 0.12);
  }
  .arch-topology-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-top: 2.5rem;
  }
  .arch-topology-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
    position: relative;
    overflow: hidden;
  }
  .arch-topology-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--clr-accent);
  }
  .diagnostic-framework-box {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    margin-top: 2rem;
  }
  @media (max-width: 992px) {
    .itikia-hero-grid {
      grid-template-columns: 1fr;
      gap: 2.5rem;
    }
  }
</style>
@endsection

@section('content')

  <!-- ══════════════════════════════════════════════════════════
       1. ITIKIA HERO WITH LIVE INTERACTIVE TERMINAL
       ══════════════════════════════════════════════════════════ -->
  <section class="page-hero" style="text-align:left;padding-bottom:var(--space-12)">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container relative">
      <div class="itikia-hero-grid">
        
        <!-- Left: Product Messaging -->
        <div>
          <div style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.4rem 1rem;border-radius:var(--radius-full);background:rgba(0,212,170,0.12);border:1px solid rgba(0,212,170,0.3);font-size:0.85rem;color:var(--clr-accent);font-weight:600;margin-bottom:1.5rem">
            <span>📣</span> CypressIQ Proprietary Software
          </div>
          <h1 style="font-size:clamp(2.4rem,4.8vw,3.6rem);line-height:1.15;margin-bottom:1.25rem">
            ITIKIA: Digital Engagement &amp; <span class="text-gradient">Public Communication</span>
          </h1>
          <p style="font-size:1.1rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2rem">
            An authoritative digital headquarters purpose-built for public campaigns, organizations, civic leaders, and institutions. Replace scattered social posts with structured policy manifestos, grassroots volunteer intake, and multi-channel audience mobilization.
          </p>

          <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem">
            <a href="{{ route('contact') }}" class="btn btn--accent btn--lg">Request Platform Deployment →</a>
            <a href="#modules" class="btn btn--secondary btn--lg" onclick="event.preventDefault(); openProductVideoModal('itikia');">Review System Modules 🎥</a>
          </div>

          <div style="display:flex;gap:2rem;border-top:1px solid var(--border-subtle);padding-top:1.5rem">
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--text-primary)">100k+</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Concurrent Spike Capacity</div>
            </div>
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--clr-accent)">99.2%</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Edge Cache Hit Rate</div>
            </div>
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--clr-primary)">33</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Readiness Diagnostic Checks</div>
            </div>
          </div>
        </div>

        <!-- Right: Interactive Product Mockup -->
        <div class="browser-mockup-frame reveal">
          <div class="browser-chrome">
            <div class="browser-dots"><span></span><span></span><span></span></div>
            <div class="browser-address">🔒 https://itikia.amani.ke/hq</div>
            <span class="badge badge--accent" style="font-size:0.65rem">Active Node</span>
          </div>

          <div class="mockup-tab-bar">
            <button type="button" class="mockup-tab-btn active" onclick="switchItikiaTab('public', this)">🌐 Public Website</button>
            <button type="button" class="mockup-tab-btn" onclick="openProductVideoModal('itikia')">🎥 Live Tour</button>
            <button type="button" class="mockup-tab-btn" onclick="switchItikiaTab('content', this)">📝 Content</button>
            <button type="button" class="mockup-tab-btn" onclick="switchItikiaTab('engagement', this)">👥 Engagement</button>
            <button type="button" class="mockup-tab-btn" onclick="switchItikiaTab('messages', this)">💬 Messages</button>
            <button type="button" class="mockup-tab-btn" onclick="switchItikiaTab('analytics', this)">📊 Analytics</button>
          </div>

          <div class="mockup-viewport">
            <!-- View 1: Public Website -->
            <div id="itikia-page-public" class="mockup-pane" style="display:block">
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
            <div id="itikia-page-content" class="mockup-pane" style="display:none">
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
            <div id="itikia-page-engagement" class="mockup-pane" style="display:none">
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
            <div id="itikia-page-messages" class="mockup-pane" style="display:none">
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
            <div id="itikia-page-analytics" class="mockup-pane" style="display:none">
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
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       2. MODULAR PLATFORM ARCHITECTURE
       ══════════════════════════════════════════════════════════ -->
  <section class="section" id="modules" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3.5rem">
        <span class="badge badge--accent">⚙️ Architectural Modules</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Comprehensive Public Operations <span class="text-gradient">in One Engine</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          ITIKIA includes 8 specialized modules covering every operational facet of modern public communication, audience trust, and grassroots organizing.
        </p>
      </div>

      <div class="module-feature-grid stagger">
        <!-- Module 1 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">👤</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Identity &amp; Biography Hub</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Structured leadership profiles, organizational history, core values, slogan, and chronological mission timelines presented with high typographical clarity.
          </p>
        </div>

        <!-- Module 2 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📋</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Policy Manifestos Matrix</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Pillared policy initiatives structured logically: <em>Challenge → Proposed Solution → Measurable Impact</em>, enabling informed citizen review and accountability.
          </p>
        </div>

        <!-- Module 3 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📰</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Newsroom &amp; Press Communiqués</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Official publishing engine with editorial draft/review workflows, media categories, high-resolution imagery, and canonical press timestamping.
          </p>
        </div>

        <!-- Module 4 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📍</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Townhalls, Events &amp; Rallies</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Interactive scheduling for community forums, barazas, and public gatherings with venue GPS coordinates, start/end dates, and automatic event archival.
          </p>
        </div>

        <!-- Module 5 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📥</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Media Kit &amp; Verified Asset Vault</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Downloadable high-resolution logos, candidate photography, official brand guidelines, and full manifesto PDF downloads with automated counter telemetry.
          </p>
        </div>

        <!-- Module 6 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">🤝</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Grassroots Volunteer Mobilization</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Regional citizen signup capturing volunteer location, specialized skills (legal, logistics, translation, digital), and admin CSV export with formula injection sanitization.
          </p>
        </div>

        <!-- Module 7 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">💳</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Multi-Channel Funding Rails</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Pre-configured channels for Lipa na M-Pesa (Paybill / Till Number / STK Push) and direct commercial bank account transfers with one-click copy triggers.
          </p>
        </div>

        <!-- Module 8 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📊</div>
          <h4 style="font-size:1.2rem;margin-bottom:0.5rem">Completeness Health Diagnostics</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Automated health evaluation engine analyzing 33 weighted readiness criteria across modules, providing actionable recommendations to campaign directors.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       3. ARCHITECTURAL RIGOR & BROADCAST SURGE CAPABILITY
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto">
        <span class="badge badge--primary">⚡ High-Concurrency Architecture</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Engineered for <span class="text-gradient">Broadcast Spikes</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Public announcements and televised debates generate massive instantaneous traffic spikes. ITIKIA is built to stay online when attention matters most.
        </p>
      </div>

      <div class="arch-topology-grid">
        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Edge Caching &amp; Origin Shield</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            Static assets, manifesto downloads, and public pages are aggressively cached at edge CDN nodes. 99.2% of visitor requests are satisfied without hitting origin database servers.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">CSV Formula Injection Sanitization</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            Volunteer intake exports strictly sanitize user-submitted fields to prevent formula injection attacks (e.g. <code>=cmd|' /C calc'!A0</code>) from executing when opened in Excel.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Idempotent Mobile Money Ingestion</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            M-Pesa Daraja STK Push callbacks are ingested via asynchronous queue workers. Duplicate transaction references from carrier network timeouts are deduplicated automatically.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Asynchronous SMS Dispatch</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            Mass mobilization text alerts to volunteer captains are processed in throttled background queues, ensuring carrier rate-limit compliance and delivery reporting.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       4. CAMPAIGN HEALTH DIAGNOSTIC ENGINE
       ══════════════════════════════════════════════════════════ -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto">
        <span class="badge badge--accent">🛡️ Algorithmic Health Scoring</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          33-Point Readiness <span class="text-gradient">Diagnostic Engine</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          ITIKIA continuously monitors public completeness across 33 weighted criteria to ensure your digital headquarters represents maximum organizational readiness.
        </p>
      </div>

      <div class="diagnostic-framework-box reveal">
        <div style="display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
          <div>
            <h4 style="font-size:1.2rem;margin-bottom:0.25rem">Automated Readiness Criteria Weighting</h4>
            <span style="font-size:0.8rem;color:var(--text-muted)">Algorithmic verification across 8 core operational categories</span>
          </div>
          <div style="font-family:var(--font-mono);font-size:0.85rem;color:var(--clr-accent)">
            SCORE = &sum;(W<sub>i</sub> &times; C<sub>i</sub>) &rarr; Max 100
          </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:1.25rem">
          <div style="padding:1rem;background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
            <div style="font-weight:700;color:var(--clr-accent);font-size:1.1rem;margin-bottom:0.25rem">15% Weight</div>
            <div style="font-weight:600;font-size:0.85rem;color:var(--text-primary)">Biography &amp; Vision</div>
            <p style="font-size:0.75rem;color:var(--text-muted);margin:0.25rem 0 0">Profile clarity, historical milestones, high-resolution portrait asset.</p>
          </div>

          <div style="padding:1rem;background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
            <div style="font-weight:700;color:var(--clr-accent);font-size:1.1rem;margin-bottom:0.25rem">25% Weight</div>
            <div style="font-weight:600;font-size:0.85rem;color:var(--text-primary)">Policy Manifestos Matrix</div>
            <p style="font-size:0.75rem;color:var(--text-muted);margin:0.25rem 0 0">Pillar completeness, challenge/solution/impact ratios, downloadable PDF.</p>
          </div>

          <div style="padding:1rem;background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
            <div style="font-weight:700;color:var(--clr-accent);font-size:1.1rem;margin-bottom:0.25rem">20% Weight</div>
            <div style="font-weight:600;font-size:0.85rem;color:var(--text-primary)">Volunteer Mobilization</div>
            <p style="font-size:0.75rem;color:var(--text-muted);margin:0.25rem 0 0">Regional routing, skill intake fields, sanitized CSV data exports.</p>
          </div>

          <div style="padding:1rem;background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
            <div style="font-weight:700;color:var(--clr-accent);font-size:1.1rem;margin-bottom:0.25rem">20% Weight</div>
            <div style="font-weight:600;font-size:0.85rem;color:var(--text-primary)">Funding Channels</div>
            <p style="font-size:0.75rem;color:var(--text-muted);margin:0.25rem 0 0">Verified Paybill/Till, commercial bank IBAN/SWIFT, one-click copy triggers.</p>
          </div>

          <div style="padding:1rem;background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
            <div style="font-weight:700;color:var(--clr-accent);font-size:1.1rem;margin-bottom:0.25rem">20% Weight</div>
            <div style="font-weight:600;font-size:0.85rem;color:var(--text-primary)">Media &amp; Events Sync</div>
            <p style="font-size:0.75rem;color:var(--text-muted);margin:0.25rem 0 0">Press kit resolution, townhall coordinates, past event auto-archival.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       5. DEPLOYMENT & SCOPING CALL TO ACTION
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="final-tech-cta reveal" style="text-align:center;max-width:820px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1.25rem">🚀 Platform Scoping &amp; Deployment</span>
        <h2>Deploy ITIKIA for your <span class="text-gradient">organization or campaign.</span></h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Consult directly with our systems engineering team. We assist with custom domain provisioning, SSL hardening, M-Pesa Daraja merchant configuration, and editorial onboarding.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--accent btn--lg">
            Schedule Scoping Session →
          </a>
          <a href="{{ route('opero') }}" class="btn btn--secondary btn--lg">
            Explore Opero Platform
          </a>
          <a href="{{ route('portfolio') }}" class="btn btn--outline btn--lg">
            View Case Studies
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Centered Product Video Walkthrough Modal -->
  @include('partials.product-video-modal')

@endsection

@section('scripts')
<script>
  function switchItikiaTab(tab, btn) {
    document.querySelectorAll('.mockup-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const panes = ['public', 'content', 'engagement', 'messages', 'analytics'];
    panes.forEach(p => {
      const el = document.getElementById('itikia-page-' + p);
      if (el) el.style.display = (p === tab) ? 'block' : 'none';
    });
  }
</script>
@endsection
