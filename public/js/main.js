/**
 * CYPRESSIQ AGENCY — CORE JAVASCRIPT
 * Handles: Theme, Navigation, Animations, Counters, Chatbot, Tools
 */

// ─── THEME MANAGER ──────────────────────────────────────────
const ThemeManager = {
  init() {
    const saved = localStorage.getItem('cypressiq-theme') || 'dark';
    document.documentElement.setAttribute('data-theme', saved);
    this.updateToggle(saved);
  },
  toggle() {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('cypressiq-theme', next);
    this.updateToggle(next);
  },
  updateToggle(theme) {
    const icons = document.querySelectorAll('.theme-icon');
    icons.forEach(icon => {
      icon.textContent = theme === 'dark' ? '🌙' : '☀️';
    });
  }
};

// ─── NAVIGATION ─────────────────────────────────────────────
const NavManager = {
  nav: null,
  hamburger: null,
  mobileMenu: null,
  init() {
    this.nav = document.querySelector('.nav');
    this.hamburger = document.querySelector('.nav__hamburger');
    this.mobileMenu = document.querySelector('.nav__mobile');
    if (!this.nav) return;

    // Scroll effect
    const onScroll = () => {
      if (window.scrollY > 20) {
        this.nav.classList.add('scrolled');
      } else {
        this.nav.classList.remove('scrolled');
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Hamburger
    if (this.hamburger) {
      this.hamburger.addEventListener('click', () => this.toggleMobile());
    }

    // Active link
    this.setActiveLink();
  },
  toggleMobile() {
    this.mobileMenu?.classList.toggle('open');
    const spans = this.hamburger?.querySelectorAll('span');
    if (this.mobileMenu?.classList.contains('open')) {
      spans?.[0]?.style && (spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)');
      spans?.[1]?.style && (spans[1].style.opacity = '0');
      spans?.[2]?.style && (spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)');
    } else {
      spans?.forEach(s => {
        s.style.transform = '';
        s.style.opacity = '';
      });
    }
  },
  setActiveLink() {
    const current = location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav__link').forEach(link => {
      const href = link.getAttribute('href') || '';
      if (href === current || (current === 'index.html' && href === '/') || href.includes(current)) {
        link.classList.add('active');
      }
    });
  }
};

// ─── REVEAL ANIMATIONS ───────────────────────────────────────
const RevealManager = {
  observer: null,
  init() {
    const elements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    if (!elements.length) return;

    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Handle stagger
          const parent = entry.target.closest('.stagger');
          if (parent) {
            const siblings = parent.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            siblings.forEach((el, i) => {
              setTimeout(() => el.classList.add('revealed'), i * 80);
            });
          } else {
            entry.target.classList.add('revealed');
          }
          this.observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    elements.forEach(el => this.observer.observe(el));
  }
};

// ─── ANIMATED COUNTERS ───────────────────────────────────────
const CounterManager = {
  observer: null,
  init() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.animateCounter(entry.target);
          this.observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(c => this.observer.observe(c));
  },
  animateCounter(el) {
    const target = parseFloat(el.getAttribute('data-counter'));
    const suffix = el.getAttribute('data-suffix') || '';
    const prefix = el.getAttribute('data-prefix') || '';
    const decimals = el.getAttribute('data-decimals') || 0;
    const duration = 2000;
    const start = performance.now();

    const update = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = eased * target;

      el.textContent = prefix + value.toFixed(decimals) + suffix;

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        el.textContent = prefix + target.toFixed(decimals) + suffix;
        el.style.animation = 'counter-pop 0.3s ease';
      }
    };

    requestAnimationFrame(update);
  }
};

// ─── PROGRESS BARS ───────────────────────────────────────────
const ProgressManager = {
  observer: null,
  init() {
    const bars = document.querySelectorAll('.progress-bar[data-width]');
    if (!bars.length) return;

    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const width = entry.target.getAttribute('data-width');
          setTimeout(() => {
            entry.target.style.width = width + '%';
          }, 200);
          this.observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    bars.forEach(b => this.observer.observe(b));
  }
};

// ─── CHATBOT ─────────────────────────────────────────────────
const ChatbotManager = {
  isOpen: false,
  messageCount: 0,
  knowledgeBase: {
    hello: "👋 Hi there! I'm Cypressiq AI, your digital growth assistant. I can help you with:\n\n• Digital marketing services\n• Cypressiq ERP information\n• Project quotes\n• Booking a consultation\n\nWhat can I help you with today?",
    services: "🚀 We offer a full suite of digital services:\n\n**Website Development** — Corporate, e-commerce, portals\n**SEO** — Rank higher, get more organic traffic\n**PPC Advertising** — Google & Meta ads that convert\n**Social Media** — Build and grow your brand\n**Content Creation** — Blogs, videos, graphics\n**Branding** — Identity and strategy\n\nWhich service interests you most?",
    erp: "⚙️ **Cypressiq ERP** is our flagship business management system:\n\n• POS with real-time invoicing\n• Inventory & stock management\n• HR & payroll\n• Financial reporting\n• Role-based access control\n• Database backup\n\nBuilt with Laravel 11 for SMEs and growing businesses.\n\nWould you like to book a demo?",
    pricing: "💰 Our pricing varies by project scope:\n\n**Websites:** $500 - $5,000+\n**SEO packages:** From $300/month\n**Cypressiq ERP:** From $49/month\n**PPC management:** 15% of ad spend\n\nUse our **Website Cost Estimator** for a custom quote, or book a free strategy call!",
    demo: "📅 I'd love to schedule an Cypressiq ERP demo for you!\n\nClick below or visit our Contact page to book a 30-minute live demo where we'll show you:\n• Full POS walkthrough\n• Inventory management\n• Financial dashboards\n\n👉 [Book Demo Now](contact.html)",
    contact: "📞 Get in touch with us:\n\n**Email:** hello@cypressiqagency.com\n**Phone:** +1 (555) 0123-4567\n**Working hours:** Mon-Fri, 9am - 6pm\n\nOr visit our [Contact page](contact.html) to book a free strategy audit!",
    roi: "📈 Want to see your potential ROI? Use our interactive **ROI Calculator** on the Tools page!\n\nInput your current:\n• Ad spend\n• Traffic\n• Conversion rate\n\nAnd we'll show you your growth potential. [Try it now →](tools.html)",
    default: "Thanks for your message! 🙏 One of our team members will get back to you shortly.\n\nFor immediate help, you can:\n• Call us: +1 (555) 0123-4567\n• Email: hello@cypressiqagency.com\n• [Book a free consultation](contact.html)"
  },

  init() {
    const trigger = document.querySelector('.chatbot-trigger');
    const closeBtn = document.querySelector('.chatbot-close');
    const sendBtn = document.querySelector('.chatbot-send');
    const input = document.querySelector('.chatbot-input');
    const quickReplies = document.querySelectorAll('.chat-quick-reply');

    trigger?.addEventListener('click', () => this.toggle());
    closeBtn?.addEventListener('click', () => this.close());
    sendBtn?.addEventListener('click', () => this.sendMessage());
    input?.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') this.sendMessage();
    });
    quickReplies.forEach(btn => {
      btn.addEventListener('click', () => {
        const text = btn.textContent;
        this.addUserMessage(text);
        this.processMessage(text.toLowerCase());
      });
    });
  },

  toggle() {
    this.isOpen ? this.close() : this.open();
  },

  open() {
    this.isOpen = true;
    document.querySelector('.chatbot-window')?.classList.add('open');
    if (this.messageCount === 0) {
      setTimeout(() => this.addBotMessage(this.knowledgeBase.hello), 300);
      this.messageCount++;
    }
  },

  close() {
    this.isOpen = false;
    document.querySelector('.chatbot-window')?.classList.remove('open');
  },

  sendMessage() {
    const input = document.querySelector('.chatbot-input');
    const text = input?.value?.trim();
    if (!text) return;
    input.value = '';
    this.addUserMessage(text);
    this.processMessage(text.toLowerCase());
  },

  addUserMessage(text) {
    const messages = document.querySelector('.chatbot-messages');
    if (!messages) return;
    const msg = document.createElement('div');
    msg.className = 'chat-msg chat-msg--user';
    msg.innerHTML = `
      <div class="chat-bubble">${text}</div>
      <div class="chat-avatar">👤</div>
    `;
    messages.appendChild(msg);
    messages.scrollTop = messages.scrollHeight;
  },

  addBotMessage(text) {
    const messages = document.querySelector('.chatbot-messages');
    if (!messages) return;

    // Typing indicator
    const typing = document.createElement('div');
    typing.className = 'chat-msg chat-msg--bot';
    typing.innerHTML = `
      <div class="chat-avatar">🤖</div>
      <div class="chat-bubble" style="display:flex;gap:4px;align-items:center">
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
      </div>
    `;
    messages.appendChild(typing);
    messages.scrollTop = messages.scrollHeight;

    setTimeout(() => {
      typing.remove();
      const msg = document.createElement('div');
      msg.className = 'chat-msg chat-msg--bot';
      // Convert markdown-like bold to HTML
      const formatted = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>');
      msg.innerHTML = `
        <div class="chat-avatar">🤖</div>
        <div class="chat-bubble">${formatted}</div>
      `;
      messages.appendChild(msg);
      messages.scrollTop = messages.scrollHeight;
      this.messageCount++;
    }, 1200);
  },

  processMessage(text) {
    let response = this.knowledgeBase.default;
    if (/hello|hi|hey|greet/i.test(text)) response = this.knowledgeBase.hello;
    else if (/service|offer|do you|what|help/i.test(text)) response = this.knowledgeBase.services;
    else if (/erp|cypressiq|system|software|pos|inventory|hr/i.test(text)) response = this.knowledgeBase.erp;
    else if (/price|cost|how much|pricing|fee|pay/i.test(text)) response = this.knowledgeBase.pricing;
    else if (/demo|trial|see|show|schedule/i.test(text)) response = this.knowledgeBase.demo;
    else if (/contact|phone|email|reach|call/i.test(text)) response = this.knowledgeBase.contact;
    else if (/roi|calculator|return|revenue/i.test(text)) response = this.knowledgeBase.roi;

    setTimeout(() => this.addBotMessage(response), 100);
  }
};

// ─── ROI CALCULATOR ─────────────────────────────────────────
const ROICalculator = {
  init() {
    const form = document.getElementById('roi-calc-form');
    const resultSection = document.getElementById('roi-result');
    const emailGate = document.getElementById('roi-email-gate');

    if (!form) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      if (emailGate && !emailGate.classList.contains('bypassed')) {
        emailGate.style.display = 'flex';
      } else {
        this.calculate();
      }
    });

    const emailSubmit = document.getElementById('roi-email-submit');
    emailSubmit?.addEventListener('click', () => {
      const email = document.getElementById('roi-email')?.value;
      if (email && email.includes('@')) {
        emailGate.style.display = 'none';
        emailGate.classList.add('bypassed');
        this.calculate();
      }
    });

    // Live preview update
    const inputs = form.querySelectorAll('input[type="range"], input[type="number"]');
    inputs.forEach(inp => inp.addEventListener('input', () => this.updateSliderDisplay(inp)));
  },

  updateSliderDisplay(input) {
    const display = document.getElementById(input.id + '-display');
    if (display) {
      const prefix = input.getAttribute('data-prefix') || '';
      const suffix = input.getAttribute('data-suffix') || '';
      display.textContent = prefix + Number(input.value).toLocaleString() + suffix;
    }
  },

  calculate() {
    const adSpend = parseFloat(document.getElementById('ad-spend')?.value) || 0;
    const traffic = parseFloat(document.getElementById('current-traffic')?.value) || 0;
    const convRate = parseFloat(document.getElementById('conv-rate')?.value) || 0;
    const avgOrder = parseFloat(document.getElementById('avg-order')?.value) || 50;

    const currentRevenue = traffic * (convRate / 100) * avgOrder;
    const optimizedTraffic = traffic * 2.8;
    const optimizedConv = Math.min(convRate * 1.6, 15);
    const projectedRevenue = (optimizedTraffic * (optimizedConv / 100) * avgOrder) + (adSpend * 4.2);
    const roiMultiple = projectedRevenue / Math.max(currentRevenue + adSpend, 1);
    const increase = projectedRevenue - currentRevenue;

    const result = document.getElementById('roi-result');
    if (!result) return;

    result.style.display = 'block';
    result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    const animate = (id, value, prefix = '', suffix = '') => {
      const el = document.getElementById(id);
      if (!el) return;
      el.setAttribute('data-counter', value.toFixed(0));
      el.setAttribute('data-prefix', prefix);
      el.setAttribute('data-suffix', suffix);
      CounterManager.animateCounter(el);
    };

    animate('roi-projected', projectedRevenue, '$');
    animate('roi-increase', increase, '+$');
    animate('roi-multiple', roiMultiple.toFixed(1), '', 'x');
    animate('roi-traffic', optimizedTraffic.toFixed(0), '', ' visitors');
  }
};

// ─── WEBSITE COST ESTIMATOR ──────────────────────────────────
const CostEstimator = {
  basePrice: { basic: 500, business: 1500, ecommerce: 3000, enterprise: 6000, portfolio: 800 },
  featurePrices: {
    cms: 300, seo: 400, payment: 600, 'user-auth': 500,
    blog: 250, chat: 400, multilang: 600, analytics: 150
  },
  init() {
    const form = document.getElementById('estimator-form');
    if (!form) return;
    form.querySelectorAll('input, select').forEach(el => {
      el.addEventListener('change', () => this.calculate());
    });
    this.calculate(); // Initial calc
  },

  calculate() {
    const type = document.getElementById('site-type')?.value || 'basic';
    const pages = parseInt(document.getElementById('page-count')?.value) || 5;
    const timeline = document.getElementById('timeline')?.value || 'standard';
    const checkedFeatures = document.querySelectorAll('#estimator-form input[name="features"]:checked');

    let base = this.basePrice[type] || 1000;
    // Pages modifier
    if (pages > 10) base += (pages - 10) * 100;
    if (pages > 5 && pages <= 10) base += (pages - 5) * 50;
    // Features
    let featTotal = 0;
    checkedFeatures.forEach(f => {
      featTotal += this.featurePrices[f.value] || 0;
    });
    // Timeline modifier
    let total = base + featTotal;
    if (timeline === 'rush') total *= 1.5;
    if (timeline === 'flexible') total *= 0.9;

    const low = Math.round(total * 0.85);
    const high = Math.round(total * 1.25);

    const rangeEl = document.getElementById('estimate-range');
    const breakdownEl = document.getElementById('estimate-breakdown');
    if (rangeEl) rangeEl.textContent = `$${low.toLocaleString()} – $${high.toLocaleString()}`;
    if (breakdownEl) {
      breakdownEl.innerHTML = `
        <div class="estimate-row"><span>Base (${type})</span><span>$${base.toLocaleString()}</span></div>
        <div class="estimate-row"><span>Features (${checkedFeatures.length})</span><span>$${featTotal.toLocaleString()}</span></div>
        <div class="estimate-row"><span>Timeline (${timeline})</span><span>${timeline === 'rush' ? '+50%' : timeline === 'flexible' ? '-10%' : 'standard'}</span></div>
      `;
    }
  }
};

// ─── TABS ────────────────────────────────────────────────────
const TabsManager = {
  init() {
    document.querySelectorAll('[data-tabs]').forEach(wrapper => {
      const tabs = wrapper.querySelectorAll('.tab');
      const panels = document.querySelectorAll(`[data-tab-panel]`);
      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const target = tab.getAttribute('data-tab');
          tabs.forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
          panels.forEach(panel => {
            panel.style.display = panel.getAttribute('data-tab-panel') === target ? 'block' : 'none';
          });
        });
      });
    });
  }
};

// ─── SMOOTH SCROLL FOR ANCHORS ────────────────────────────────
const SmoothScroll = {
  init() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', (e) => {
        const target = document.querySelector(anchor.getAttribute('href'));
        if (target) {
          e.preventDefault();
          const offset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-h')) + 20;
          const targetPos = target.getBoundingClientRect().top + window.scrollY - offset;
          window.scrollTo({ top: targetPos, behavior: 'smooth' });
        }
      });
    });
  }
};

// ─── TYPING ANIMATION ─────────────────────────────────────────
const TypingAnimation = {
  init() {
    const els = document.querySelectorAll('[data-typing]');
    els.forEach(el => {
      const words = el.getAttribute('data-typing').split(',').map(w => w.trim());
      let wordIndex = 0;
      let charIndex = 0;
      let isDeleting = false;

      const type = () => {
        const current = words[wordIndex];
        if (isDeleting) {
          el.textContent = current.substring(0, charIndex - 1);
          charIndex--;
        } else {
          el.textContent = current.substring(0, charIndex + 1);
          charIndex++;
        }

        if (!isDeleting && charIndex === current.length) {
          setTimeout(() => { isDeleting = true; }, 1800);
        } else if (isDeleting && charIndex === 0) {
          isDeleting = false;
          wordIndex = (wordIndex + 1) % words.length;
        }

        const speed = isDeleting ? 60 : 100;
        setTimeout(type, speed);
      };

      type();
    });
  }
};

// ─── PARALLAX ─────────────────────────────────────────────────
const ParallaxManager = {
  init() {
    const parallaxEls = document.querySelectorAll('[data-parallax]');
    if (!parallaxEls.length) return;

    window.addEventListener('scroll', () => {
      const scrolled = window.scrollY;
      parallaxEls.forEach(el => {
        const speed = parseFloat(el.getAttribute('data-parallax')) || 0.4;
        el.style.transform = `translateY(${scrolled * speed}px)`;
      });
    }, { passive: true });
  }
};

// ─── CHART ANIMATION ─────────────────────────────────────────
const ChartManager = {
  init() {
    // Animate dashboard chart bars
    const bars = document.querySelectorAll('.chart-bar');
    bars.forEach((bar, i) => {
      bar.style.animationDelay = `${i * 0.1}s`;
    });

    // Animate skill bars / progress indicators
    const skillBars = document.querySelectorAll('.skill-bar');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const bars = entry.target.querySelectorAll('.progress-bar');
          bars.forEach(bar => {
            const width = bar.getAttribute('data-width') || '80';
            setTimeout(() => { bar.style.width = width + '%'; }, 300);
          });
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });

    document.querySelectorAll('.skills-section').forEach(s => observer.observe(s));
  }
};

// ─── EXIT INTENT ─────────────────────────────────────────────
const ExitIntent = {
  triggered: false,
  init() {
    if (sessionStorage.getItem('exitIntentShown')) return;
    document.addEventListener('mouseleave', (e) => {
      if (e.clientY <= 0 && !this.triggered) {
        this.triggered = true;
        this.show();
        sessionStorage.setItem('exitIntentShown', '1');
      }
    });
  },
  show() {
    const modal = document.getElementById('exit-intent-modal');
    if (modal) {
      modal.style.display = 'flex';
      setTimeout(() => modal.classList.add('open'), 10);
    }
  },
  hide() {
    const modal = document.getElementById('exit-intent-modal');
    if (modal) {
      modal.classList.remove('open');
      setTimeout(() => { modal.style.display = 'none'; }, 300);
    }
  }
};

// ─── NOTIFICATION TOAST ───────────────────────────────────────
const Toast = {
  show(message, type = 'success', duration = 4000) {
    const container = document.getElementById('toast-container') || (() => {
      const c = document.createElement('div');
      c.id = 'toast-container';
      c.style.cssText = 'position:fixed;top:90px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:12px;';
      document.body.appendChild(c);
      return c;
    })();

    const icons = { success: '✅', error: '❌', info: 'ℹ️', warning: '⚠️' };
    const colors = {
      success: '#2ED573', error: '#FF4757', info: '#6C63FF', warning: '#FF6B35'
    };

    const toast = document.createElement('div');
    toast.style.cssText = `
      display:flex;align-items:center;gap:12px;
      background:var(--bg-surface);border:1px solid ${colors[type]}40;
      border-left:3px solid ${colors[type]};
      border-radius:12px;padding:14px 18px;
      box-shadow:var(--shadow-md);
      font-size:14px;color:var(--text-primary);
      animation:slideInRight 0.3s ease;
      max-width:320px;
    `;
    toast.innerHTML = `<span>${icons[type]}</span><span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(20px)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, duration);
  }
};

// ─── FORM HANDLERS ───────────────────────────────────────────
const FormManager = {
  init() {
    // Disabled to allow real backend submission
  }
};

// ─── TYPING DOTS (CSS) ────────────────────────────────────────
const addTypingDotStyles = () => {
  const style = document.createElement('style');
  style.textContent = `
    .typing-dot {
      width: 6px; height: 6px;
      background: var(--text-muted);
      border-radius: 50%;
      display: inline-block;
      animation: typing-bounce 1.2s infinite;
    }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typing-bounce {
      0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
      40% { transform: scale(1.2); opacity: 1; }
    }
    .estimate-row {
      display: flex; justify-content: space-between;
      font-size: 13px; padding: 8px 0;
      border-bottom: 1px solid var(--border-subtle);
      color: var(--text-secondary);
    }
    .estimate-row:last-child { border-bottom: none; }
    #exit-intent-modal {
      position: fixed; inset: 0; z-index: 9999;
      background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);
      display: none; align-items: center; justify-content: center;
      padding: 1rem;
    }
    #exit-intent-modal .modal-box {
      background: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl);
      padding: 2.5rem;
      max-width: 480px;
      width: 100%;
      text-align: center;
      position: relative;
      transform: scale(0.9);
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #exit-intent-modal.open .modal-box {
      transform: scale(1);
      opacity: 1;
    }
    #exit-intent-modal h3 { font-size: 1.5rem; margin-bottom: 0.75rem; }
    #exit-intent-modal p { color: var(--text-secondary); margin-bottom: 1.5rem; }
    #exit-intent-modal .modal-close {
      position: absolute; top: 1rem; right: 1.25rem;
      font-size: 1.5rem; cursor: pointer; color: var(--text-muted);
      transition: color 0.2s;
    }
    #exit-intent-modal .modal-close:hover { color: var(--text-primary); }
  `;
  document.head.appendChild(style);
};

// ─── INIT ALL ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  addTypingDotStyles();
  ThemeManager.init();
  NavManager.init();
  RevealManager.init();
  CounterManager.init();
  ProgressManager.init();
  ChatbotManager.init();
  TabsManager.init();
  SmoothScroll.init();
  TypingAnimation.init();
  ParallaxManager.init();
  ChartManager.init();
  ExitIntent.init();
  FormManager.init();
  ROICalculator.init();
  CostEstimator.init();
});

// ─── THEME TOGGLE GLOBAL ──────────────────────────────────────
window.toggleTheme = () => ThemeManager.toggle();
window.closeChatbot = () => ChatbotManager.close();
window.closeExitModal = () => ExitIntent.hide();
