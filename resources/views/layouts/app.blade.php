<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'CypressIQ — Technology Company & Product Studio')</title>
  <meta name="description" content="@yield('meta_description', 'CypressIQ builds technology that helps organizations operate, engage and grow. We develop proprietary software products (Opero, ITIKIA Campaign), engineer custom business systems, and lead digital transformation.')" />
  <meta name="keywords" content="technology company, product studio, ITIKIA Campaign, Opero, business systems, custom software, web applications, digital transformation, APIs, cloud engineering" />
  <meta property="og:title" content="@yield('title', 'CypressIQ — Technology Company & Product Studio')" />
  <meta property="og:description" content="@yield('meta_description', 'CypressIQ builds digital products, business systems and custom technology solutions that help organizations operate, engage and grow.')" />
  <meta property="og:type" content="website" />
  <meta name="theme-color" content="#6C63FF" />
  <link rel="canonical" href="{{ url()->current() }}" />

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "CypressIQ",
    "description": "Technology company and product studio developing software products, custom business systems, and digital transformation architectures.",
    "url": "https://cypressiq.agency",
    "logo": "https://cypressiq.agency/assets/logo.png",
    "knowsAbout": [
      "Software Engineering",
      "Digital Products",
      "Opero Business Management Platform",
      "ITIKIA Campaign Engagement Platform",
      "Digital Transformation",
      "Custom Web Applications",
      "System Integration & APIs"
    ],
    "address": {
      "@@type": "PostalAddress",
      "streetAddress": "{{ $contactSettings->address ?? 'Pinkam House Nakuru, Kenya' }}"
    },
    "contactPoint": {
      "@@type": "ContactPoint",
      "telephone": "{{ $contactSettings->phone_number ?? '+254 745 763 093' }}",
      "email": "{{ $contactSettings->company_email ?? 'hello@cypressiqagency.com' }}",
      "contactType": "technical inquiries"
    }
  }
  </script>

  <link rel="stylesheet" href="{{ asset('css/design-system.css') }}?v={{ file_exists(public_path('css/design-system.css')) ? filemtime(public_path('css/design-system.css')) : time() }}" />
  <style>
    /* Critical Navbar Foundation (Zero FOUC, Always Visible Design Element) */
    .nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      height: 72px;
      display: flex;
      align-items: center;
      background: rgba(8, 11, 20, 0.88);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    }
    .nav__inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 1.5rem;
      height: 100%;
      flex-wrap: nowrap;
    }
    .nav__logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-shrink: 0;
      text-decoration: none;
    }
    .nav__links {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      margin: 0;
      padding: 0;
      list-style: none;
      flex-wrap: nowrap;
      white-space: nowrap;
    }
    .nav__actions {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-shrink: 0;
    }
    .nav__hamburger {
      display: none;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 5px;
      width: 42px;
      height: 42px;
      min-width: 42px;
      min-height: 42px;
      flex-shrink: 0;
      cursor: pointer;
      padding: 8px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.12);
      box-sizing: border-box;
      z-index: 1002;
    }
    .nav__hamburger span {
      display: block;
      width: 22px;
      min-width: 22px;
      height: 2px;
      min-height: 2px;
      background-color: #F1F5F9;
      border-radius: 2px;
    }
    @media (max-width: 1180px) {
      .nav__links { display: none !important; }
      .nav__hamburger { display: flex !important; }
    }
    @media (min-width: 1181px) {
      .nav__links { display: flex !important; }
      .nav__hamburger { display: none !important; }
      .nav__mobile { display: none !important; }
    }
    @media (max-width: 640px) {
      .nav__actions .btn { display: none !important; }
      .nav__inner { padding: 0 0.85rem; }
    }
  </style>
  @yield('css')
  @stack('styles')
</head>
<body class="page-enter">

  <!-- ═══════════════════════════════════ NAVIGATION -->
  <nav class="nav" id="main-nav">
    <div class="nav__inner">
      <a href="{{ route('home') }}" class="nav__logo">
        <div class="nav__logo-icon">⚡</div>
        <span>CypressIQ<span style="color:var(--clr-accent)">.</span></span>
      </a>
      <ul class="nav__links">
        <li><a href="{{ route('home') }}" class="nav__link">Home</a></li>
        <li class="nav__dropdown-wrap">
          <a href="{{ route('opero') }}" class="nav__link">Products ▾</a>
          <div class="nav__dropdown-menu">
            <div class="dropdown-header">
              <span>Our Software</span>
              <span class="dropdown-badge dropdown-badge--products">Proprietary</span>
            </div>
            <a href="{{ route('opero') }}" class="dropdown-item">
              <span class="dropdown-item__icon">⚙️</span>
              <div>
                <strong>Opero</strong>
                <p>Business Operations &amp; ERP System</p>
              </div>
            </a>
            <a href="{{ route('itikia') }}" class="dropdown-item">
              <span class="dropdown-item__icon">📣</span>
              <div>
                <strong>ITIKIA Campaign</strong>
                <p>Public Engagement &amp; Campaigns</p>
              </div>
            </a>
            <div class="dropdown-footer">
              <span>CypressIQ Software Suite</span>
            </div>
          </div>
        </li>
        <li class="nav__dropdown-wrap">
          <a href="{{ route('solutions.custom-software') }}" class="nav__link">Solutions ▾</a>
          <div class="nav__dropdown-menu nav__dropdown-menu--wide">
            <div class="dropdown-header">
              <span>Client Solutions</span>
              <span class="dropdown-badge dropdown-badge--solutions">Built for Clients</span>
            </div>
            <div class="dropdown-grid">
              <a href="{{ route('solutions.web-development') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">🌐</span>
                <div>
                  <strong>Web Development</strong>
                  <p>Fast, reactive web apps &amp; frontends</p>
                </div>
              </a>
              <a href="{{ route('solutions.custom-software') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">💻</span>
                <div>
                  <strong>Custom Software</strong>
                  <p>Bespoke software built to exact specs</p>
                </div>
              </a>
              <a href="{{ route('solutions.business-systems') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">🏢</span>
                <div>
                  <strong>Business Systems</strong>
                  <p>Internal operations, workflows &amp; RBAC</p>
                </div>
              </a>
              <a href="{{ route('solutions.automation-integrations') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">🔌</span>
                <div>
                  <strong>Automation &amp; Integrations</strong>
                  <p>Resilient APIs, queues &amp; payment rails</p>
                </div>
              </a>
              <a href="{{ route('solutions.digital-platforms') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">☁️</span>
                <div>
                  <strong>Digital Platforms</strong>
                  <p>Multi-tenant SaaS &amp; partner portals</p>
                </div>
              </a>
              <a href="{{ route('solutions.technology-consulting') }}" class="dropdown-item dropdown-item--compact">
                <span class="dropdown-item__icon">🔄</span>
                <div>
                  <strong>Technology Consulting</strong>
                  <p>Architecture audits &amp; transformation</p>
                </div>
              </a>
            </div>
            <div class="dropdown-footer">
              <span>Need a custom architecture?</span>
              <a href="{{ route('contact') }}">Consult an Engineer →</a>
            </div>
          </div>
        </li>
        <li class="nav__dropdown-wrap">
          <a href="{{ route('portfolio') }}" class="nav__link">Work ▾</a>
          <div class="nav__dropdown-menu">
            <div class="dropdown-header">
              <span>Proven Deliveries</span>
              <span class="dropdown-badge dropdown-badge--work">Work</span>
            </div>
            <a href="{{ route('portfolio') }}" class="dropdown-item">
              <span class="dropdown-item__icon">📁</span>
              <div>
                <strong>Portfolio</strong>
                <p>Selected systems &amp; architectures</p>
              </div>
            </a>
            <a href="{{ route('case-studies') }}" class="dropdown-item">
              <span class="dropdown-item__icon">📑</span>
              <div>
                <strong>Case Studies</strong>
                <p>In-depth technical delivery stories</p>
              </div>
            </a>
            <a href="{{ route('trust') }}" class="dropdown-item">
              <span class="dropdown-item__icon">⭐</span>
              <div>
                <strong>Trust &amp; Credibility</strong>
                <p>Testimonials, clients &amp; partnerships</p>
              </div>
            </a>
          </div>
        </li>
        <li><a href="{{ route('blog.index') }}" class="nav__link">Insights</a></li>
        <li><a href="{{ route('about') }}" class="nav__link">About</a></li>
        <li><a href="{{ route('contact') }}" class="nav__link">Contact</a></li>
      </ul>
      <div class="nav__actions">
        <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme" aria-label="Toggle dark/light mode">
        </button>
        <span class="theme-icon" style="font-size:1rem">🌙</span>
        <a href="{{ route('contact') }}" class="btn btn--primary btn--sm">Start a Project</a>
        <button class="nav__hamburger" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
    <div class="nav__mobile">
      <a href="{{ route('home') }}" class="nav__link">Home</a>
      <div style="display:flex;align-items:center;justify-content:space-between;padding:0.6rem 1rem 0.25rem;font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em">
        <span>Products</span>
        <span class="dropdown-badge dropdown-badge--products">Our Software</span>
      </div>
      <a href="{{ route('opero') }}" class="nav__link" style="padding-left:1.5rem">⚙️ Opero — Business Management</a>
      <a href="{{ route('itikia') }}" class="nav__link" style="padding-left:1.5rem">📣 ITIKIA — Campaign Engagement</a>

      <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem 0.25rem;font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em">
        <span>Solutions</span>
        <span class="dropdown-badge dropdown-badge--solutions">Built for Clients</span>
      </div>
      <a href="{{ route('solutions.web-development') }}" class="nav__link" style="padding-left:1.5rem">🌐 Web Development</a>
      <a href="{{ route('solutions.custom-software') }}" class="nav__link" style="padding-left:1.5rem">💻 Custom Software</a>
      <a href="{{ route('solutions.business-systems') }}" class="nav__link" style="padding-left:1.5rem">🏢 Business Systems</a>
      <a href="{{ route('solutions.automation-integrations') }}" class="nav__link" style="padding-left:1.5rem">🔌 Automation &amp; Integrations</a>
      <a href="{{ route('solutions.digital-platforms') }}" class="nav__link" style="padding-left:1.5rem">☁️ Digital Platforms</a>
      <a href="{{ route('solutions.technology-consulting') }}" class="nav__link" style="padding-left:1.5rem">🔄 Technology Consulting</a>

      <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem 0.25rem;font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em">
        <span>Work &amp; Company</span>
      </div>
      <a href="{{ route('portfolio') }}" class="nav__link" style="padding-left:1.5rem">📁 Portfolio</a>
      <a href="{{ route('case-studies') }}" class="nav__link" style="padding-left:1.5rem">📑 Case Studies</a>
      <a href="{{ route('trust') }}" class="nav__link" style="padding-left:1.5rem">⭐ Trust &amp; Credibility</a>
      <a href="{{ route('blog.index') }}" class="nav__link">Insights</a>
      <a href="{{ route('about') }}" class="nav__link">About CypressIQ</a>
      <a href="{{ route('contact') }}" class="nav__link">Contact Us</a>
      <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top:0.75rem">Start a Project</a>
    </div>
  </nav>

  @yield('content')

  <!-- ═══════════════════════════════════ FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__brand">
          <a href="{{ route('home') }}" class="nav__logo">
            <div class="nav__logo-icon">⚡</div>
            <span style="font-family:var(--font-display);font-size:1.25rem;font-weight:700">CypressIQ<span style="color:var(--clr-accent)">.</span></span>
          </a>
          <p>A technology company and product studio. We build proprietary software products, business systems, and custom technology solutions that help organizations operate, engage and grow.</p>
          <div style="margin-top:1rem;display:flex;flex-wrap:wrap;align-items:center;gap:0.75rem 1rem;font-size:0.85rem;color:var(--text-secondary)">
            <span style="display:inline-flex;align-items:center;gap:0.35rem">
              📍 <strong>{{ $contactSettings->address ?? 'Pinkam House Nakuru, Kenya' }}</strong>
            </span>
            <span style="color:var(--border-mid)">•</span>
            <a href="mailto:{{ $contactSettings->company_email ?? 'hello@cypressiqagency.com' }}" style="display:inline-flex;align-items:center;gap:0.35rem;color:inherit;transition:color 0.2s" onmouseover="this.style.color='var(--clr-accent)'" onmouseout="this.style.color='inherit'">
              ✉️ {{ $contactSettings->company_email ?? 'hello@cypressiqagency.com' }}
            </a>
            @if(!empty($contactSettings->phone_number ?? '+254 745 763 093'))
            <span style="color:var(--border-mid)">•</span>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactSettings->phone_number ?? '+254745763093') }}" style="display:inline-flex;align-items:center;gap:0.35rem;color:inherit;transition:color 0.2s" onmouseover="this.style.color='var(--clr-accent)'" onmouseout="this.style.color='inherit'">
              📞 {{ $contactSettings->phone_number ?? '+254 745 763 093' }}
            </a>
            @endif
          </div>
        </div>

        <div>
          <h4 class="footer__heading">Products (Our Software)</h4>
          <ul class="footer__links">
            <li><a href="{{ route('opero') }}" class="footer__link">Opero Business Management</a></li>
            <li><a href="{{ route('opero') }}#pos" class="footer__link">Opero Point of Sale</a></li>
            <li><a href="{{ route('opero') }}#inventory" class="footer__link">Opero Inventory &amp; Stock</a></li>
            <li><a href="{{ route('itikia') }}" class="footer__link">ITIKIA Campaign Platform</a></li>
            <li><a href="{{ route('itikia') }}#engagement" class="footer__link">Public Engagement Matrix</a></li>
            <li><a href="{{ route('itikia') }}#volunteers" class="footer__link">Volunteer Intake Directory</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer__heading">Solutions (For Clients)</h4>
          <ul class="footer__links">
            <li><a href="{{ route('solutions.web-development') }}" class="footer__link">Web Development</a></li>
            <li><a href="{{ route('solutions.custom-software') }}" class="footer__link">Custom Software</a></li>
            <li><a href="{{ route('solutions.business-systems') }}" class="footer__link">Business Systems</a></li>
            <li><a href="{{ route('solutions.automation-integrations') }}" class="footer__link">Automation &amp; Integrations</a></li>
            <li><a href="{{ route('solutions.digital-platforms') }}" class="footer__link">Digital Platforms</a></li>
            <li><a href="{{ route('solutions.technology-consulting') }}" class="footer__link">Technology Consulting</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer__heading">Company &amp; Studio</h4>
          <ul class="footer__links">
            <li><a href="{{ route('about') }}" class="footer__link">About CypressIQ</a></li>
            <li><a href="{{ route('portfolio') }}" class="footer__link">Portfolio &amp; Work</a></li>
            <li><a href="{{ route('case-studies') }}" class="footer__link">Case Studies</a></li>
            <li><a href="{{ route('trust') }}" class="footer__link">Trust &amp; Credibility</a></li>
            <li><a href="{{ route('blog.index') }}" class="footer__link">Technical Insights</a></li>
            <li><a href="{{ route('tools') }}" class="footer__link">Interactive Tools</a></li>
            <li><a href="{{ route('contact') }}" class="footer__link">Consult Our Engineers</a></li>
          </ul>
        </div>
      </div>

      <div class="footer__bottom">
        <p>© 2026 CypressIQ Technology. Engineered with precision.</p>
        <p>
          <a href="{{ route('about') }}" style="color:var(--text-muted);margin-right:1rem">About</a>
          <a href="{{ route('contact') }}" style="color:var(--text-muted);margin-right:1rem">Contact</a>
          <a href="#" style="color:var(--text-muted)">Terms &amp; Privacy</a>
        </p>
      </div>
    </div>
  </footer>

  <!-- ═══════════════════════════════════ CHATBOT ASSISTANT -->
  <button class="chatbot-trigger" title="Technical Solutions Assistant" aria-label="Open solutions assistant">
    🤖
  </button>

  <div class="chatbot-window">
    <div class="chatbot-header">
      <h3><span class="chatbot-status"></span> CypressIQ Solutions Assistant</h3>
      <span class="chatbot-close" onclick="closeChatbot()">×</span>
    </div>
    <div class="chatbot-messages" id="chatbot-messages"></div>
    <div class="chat-quick-replies">
      <button class="chat-quick-reply">⚙️ Opero Platform</button>
      <button class="chat-quick-reply">📣 ITIKIA Campaign</button>
      <button class="chat-quick-reply">💻 Custom Software</button>
      <button class="chat-quick-reply">🔄 Digital Transformation</button>
      <button class="chat-quick-reply">📅 Schedule Call</button>
    </div>
    <div class="chatbot-input-area">
      <input class="chatbot-input" id="chatbot-input" type="text" placeholder="Ask about our products or engineering..." />
      <button class="chatbot-send">➤</button>
    </div>
  </div>

  <!-- ═══════════════════════════════════ ENGINEERING CONSULTATION MODAL -->
  <div id="exit-intent-modal" onclick="if(event.target===this)closeExitModal()">
    <div class="modal-box">
      <span class="modal-close" onclick="closeExitModal()">×</span>
      <div style="font-size:2.5rem;margin-bottom:1rem">⚡</div>
      <h3 style="font-size:1.4rem;margin-bottom:0.5rem">Architecting Your Next System?</h3>
      <p style="color:var(--text-secondary);font-size:0.9rem;margin-bottom:1.5rem">
        Whether you are evaluating <strong>Opero</strong>, launching an <strong>ITIKIA Campaign</strong>, or engineering custom software — consult directly with our technology team.
      </p>
      <form id="exit-form" onsubmit="window.submitModalLead(event)" style="display:flex;flex-direction:column;gap:0.75rem">
        <input type="email" id="modal-lead-email" placeholder="Your business email" class="form-input" required />
        <button type="submit" class="btn btn--primary btn--lg">Request Technical Consultation →</button>
      </form>
    </div>
  </div>

  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    window.submitModalLead = async function(e) {
      e.preventDefault();
      const email = document.getElementById('modal-lead-email')?.value;
      if (!email) return;
      try {
        const res = await fetch('{{ route('lead.capture') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ email: email, source: 'consultation_modal', type: 'consultation_request' })
        });
        const data = await res.json();
        closeExitModal();
        if (typeof Toast !== 'undefined') {
          Toast.show(data.message || 'Consultation request received.', 'success');
        } else {
          alert('Thank you! Our engineering team will be in touch.');
        }
      } catch (err) {
        closeExitModal();
        window.location.href = '{{ route('contact') }}';
      }
    };
  </script>
  @yield('scripts')
  @stack('scripts')
</body>
</html>
