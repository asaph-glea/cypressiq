<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Cypressiq — Digital Growth & ERP Solutions')</title>
  <meta name="description" content="@yield('meta_description', 'Cypressiq is a full-service digital agency helping businesses grow online through web development, SEO, PPC, social media, and the Cypressiq ERP system. Get your free strategy audit today.')" />
  <meta name="keywords" content="digital agency, web development, SEO, PPC, social media, ERP system, Cypressiq ERP, business growth" />
  <meta property="og:title" content="@yield('title', 'Cypressiq — Digital Growth & ERP Solutions')" />
  <meta property="og:description" content="@yield('meta_description', 'Full-service digital agency + powerful ERP system for businesses that want to grow fast.')" />
  <meta property="og:type" content="website" />
  <meta name="theme-color" content="#6C63FF" />
  <link rel="canonical" href="{{ url()->current() }}" />

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "Cypressiq",
    "description": "Full-service digital agency offering web development, SEO, PPC, social media management, and Cypressiq ERP software.",
    "url": "https://cypressiq.agency",
    "logo": "https://cypressiq.agency/assets/logo.png",
    "contactPoint": {
      "@@type": "ContactPoint",
      "telephone": "+1-555-0123-4567",
      "contactType": "customer service"
    },
    "sameAs": ["https://twitter.com/cypressiqagency", "https://linkedin.com/company/cypressiqagency"]
  }
  </script>

  <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
  @yield('css')
</head>
<body class="page-enter">

  <!-- ═══════════════════════════════════ NAVIGATION -->
  <nav class="nav" id="main-nav">
    <div class="nav__inner">
      <a href="{{ route('home') }}" class="nav__logo">
        <div class="nav__logo-icon">⚡</div>
        <span>Cypressiq<span style="color:var(--clr-accent)">.</span></span>
      </a>
      <ul class="nav__links">
        <li><a href="{{ route('home') }}" class="nav__link">Home</a></li>
        <li><a href="{{ route('services') }}" class="nav__link">Services</a></li>
        <li><a href="{{ route('opero') }}" class="nav__link">Cypressiq ERP</a></li>
        <li><a href="{{ route('portfolio') }}" class="nav__link">Portfolio</a></li>
        <li><a href="{{ route('tools') }}" class="nav__link">Tools</a></li>
        <li><a href="{{ route('blog.index') }}" class="nav__link">Blog</a></li>
        <li><a href="{{ route('about') }}" class="nav__link">About</a></li>
      </ul>
      <div class="nav__actions">
        <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme" aria-label="Toggle dark/light mode">
        </button>
        <span class="theme-icon" style="font-size:1rem">🌙</span>
        <a href="{{ route('contact') }}" class="btn btn--primary btn--sm">Get Free Audit</a>
        <button class="nav__hamburger" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
    <div class="nav__mobile">
      <a href="{{ route('home') }}" class="nav__link">Home</a>
      <a href="{{ route('services') }}" class="nav__link">Services</a>
      <a href="{{ route('opero') }}" class="nav__link">Cypressiq ERP</a>
      <a href="{{ route('portfolio') }}" class="nav__link">Portfolio</a>
      <a href="{{ route('tools') }}" class="nav__link">Tools</a>
      <a href="{{ route('blog.index') }}" class="nav__link">Blog</a>
      <a href="{{ route('about') }}" class="nav__link">About</a>
      <a href="{{ route('contact') }}" class="btn btn--primary">Get Free Audit</a>
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
            <span style="font-family:var(--font-display);font-size:1.25rem;font-weight:700">Cypressiq<span style="color:var(--clr-accent)">.</span></span>
          </a>
          <p>A full-service digital agency and ERP software company helping businesses grow, scale, and dominate their markets globally.</p>
          <div class="footer__social">
            <a href="#" class="footer__social-link">𝕏</a>
            <a href="#" class="footer__social-link">in</a>
            <a href="#" class="footer__social-link">f</a>
            <a href="#" class="footer__social-link">▶</a>
          </div>
        </div>

        <div>
          <h4 class="footer__heading">Services</h4>
          <ul class="footer__links">
            <li><a href="{{ route('services') }}" class="footer__link">Web Development</a></li>
            <li><a href="{{ route('services') }}#seo" class="footer__link">SEO Optimization</a></li>
            <li><a href="{{ route('services') }}#ppc" class="footer__link">PPC Advertising</a></li>
            <li><a href="{{ route('services') }}#social" class="footer__link">Social Media</a></li>
            <li><a href="{{ route('services') }}#content" class="footer__link">Content Creation</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer__heading">Products</h4>
          <ul class="footer__links">
            <li><a href="{{ route('opero') }}" class="footer__link">Cypressiq ERP</a></li>
            <li><a href="{{ route('opero') }}#pos" class="footer__link">POS System</a></li>
            <li><a href="{{ route('opero') }}#inventory" class="footer__link">Inventory Manager</a></li>
            <li><a href="{{ route('opero') }}#hr" class="footer__link">HR & Payroll</a></li>
            <li><a href="{{ route('opero') }}#pricing" class="footer__link">Pricing</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer__heading">Company</h4>
          <ul class="footer__links">
            <li><a href="{{ route('about') }}" class="footer__link">About Us</a></li>
            <li><a href="{{ route('portfolio') }}" class="footer__link">Portfolio</a></li>
            <li><a href="{{ route('blog.index') }}" class="footer__link">Blog</a></li>
            <li><a href="{{ route('tools') }}" class="footer__link">Free Tools</a></li>
            <li><a href="{{ route('contact') }}" class="footer__link">Contact</a></li>
          </ul>
        </div>
      </div>

      <div class="footer__bottom">
        <p>© 2026 Cypressiq. All rights reserved.</p>
        <p>
          <a href="#" style="color:var(--text-muted);margin-right:1rem">Privacy Policy</a>
          <a href="#" style="color:var(--text-muted)">Terms of Service</a>
        </p>
      </div>
    </div>
  </footer>

  <!-- ═══════════════════════════════════ CHATBOT -->
  <button class="chatbot-trigger" title="Chat with Cypressiq AI" aria-label="Open chat assistant">
    🤖
  </button>

  <div class="chatbot-window">
    <div class="chatbot-header">
      <h3><span class="chatbot-status"></span> Cypressiq AI Assistant</h3>
      <span class="chatbot-close" onclick="closeChatbot()">×</span>
    </div>
    <div class="chatbot-messages" id="chatbot-messages"></div>
    <div class="chat-quick-replies">
      <button class="chat-quick-reply">💼 Our Services</button>
      <button class="chat-quick-reply">⚙️ Cypressiq ERP</button>
      <button class="chat-quick-reply">💰 Pricing</button>
      <button class="chat-quick-reply">📅 Book Demo</button>
    </div>
    <div class="chatbot-input-area">
      <input class="chatbot-input" id="chatbot-input" type="text" placeholder="Ask me anything..." />
      <button class="chatbot-send">➤</button>
    </div>
  </div>

  <!-- ═══════════════════════════════════ EXIT INTENT -->
  <div id="exit-intent-modal" onclick="if(event.target===this)closeExitModal()">
    <div class="modal-box">
      <span class="modal-close" onclick="closeExitModal()">×</span>
      <div style="font-size:3rem;margin-bottom:1rem">🎁</div>
      <h3>Wait! Get a Free Strategy Audit Worth $500</h3>
      <p>Before you go, let us show you exactly how we can grow your business. No commitment required.</p>
      <form id="exit-form" onsubmit="event.preventDefault();closeExitModal();window.location.href='{{ route('contact') }}'" style="display:flex;flex-direction:column;gap:0.75rem">
        <input type="email" placeholder="Your business email" class="form-input" required />
        <button type="submit" class="btn btn--primary btn--lg">Claim My Free Audit 🚀</button>
      </form>
    </div>
  </div>

  <script src="{{ asset('js/main.js') }}"></script>
  @yield('scripts')
</body>
</html>
