@extends('layouts.app')
@section('title', 'Interactive Tools — ROI Calculator & Website Cost Estimator')

@section('css')
<style>
.tool-card {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl);
      padding: var(--space-10);
      backdrop-filter: blur(20px);
    }
    .tool-card h2 { font-size: 1.75rem; margin-bottom: 0.5rem; }
    .range-wrap { display: flex; flex-direction: column; gap: 0.5rem; }
    .range-header { display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; }
    .range-val { font-weight: 700; color: var(--clr-primary); font-family: var(--font-mono); }
    input[type="range"] {
      width: 100%;
      -webkit-appearance: none;
      appearance: none;
      height: 4px;
      background: var(--border-mid);
      border-radius: 2px;
      outline: none;
    }
    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 18px; height: 18px;
      border-radius: 50%;
      background: var(--clr-primary);
      cursor: pointer;
      box-shadow: 0 0 0 3px var(--clr-primary-glow);
      transition: box-shadow 0.2s;
    }
    input[type="range"]::-webkit-slider-thumb:hover { box-shadow: 0 0 0 6px var(--clr-primary-glow); }
    .result-box {
      background: linear-gradient(135deg, rgba(108,99,255,0.1), rgba(0,212,170,0.06));
      border: 1px solid var(--border-accent);
      border-radius: var(--radius-xl);
      padding: 2rem;
      text-align: center;
      display: none;
    }
    .result-metric {
      text-align: center;
      padding: 1rem;
    }
    .result-metric .num {
      font-family: var(--font-display);
      font-size: 2.5rem;
      font-weight: 800;
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: block;
    }
    .result-metric .lbl { font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem; }
    .email-gate {
      position: fixed; inset: 0; background: rgba(0,0,0,0.7);
      backdrop-filter: blur(10px); z-index: 9000;
      display: none; align-items: center; justify-content: center;
    }
    .email-gate-box {
      background: var(--bg-surface); border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl); padding: 2.5rem;
      max-width: 440px; width: 100%; margin: 1rem;
      text-align: center;
    }
    .feature-check {
      display: flex; align-items: center; gap: 0.75rem;
      padding: 0.75rem; background: var(--bg-glass);
      border-radius: var(--radius-md); margin-bottom: 0.5rem;
      font-size: 0.875rem;
    }
    .estimator-options {
      display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 0.75rem;
      margin-bottom: 1.5rem;
    }
    .estimator-option {
      display: flex; align-items: center; gap: 0.75rem;
      padding: 0.875rem; background: var(--bg-glass);
      border: 1px solid var(--border-subtle); border-radius: var(--radius-md);
      cursor: pointer; transition: all 0.2s; font-size: 0.85rem;
    }
    .estimator-option:has(input:checked) {
      background: rgba(108,99,255,0.12); border-color: var(--clr-primary);
      color: var(--clr-primary-light);
    }
    .estimator-option input { width: 16px; height: 16px; accent-color: var(--clr-primary); }
    .estimate-display {
      background: var(--gradient-primary);
      border-radius: var(--radius-xl);
      padding: 2rem;
      text-align: center;
      color: white;
    }
    .estimate-display .amount {
      font-family: var(--font-display);
      font-size: 2.5rem;
      font-weight: 800;
      display: block;
      margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('content')
<!-- PAGE HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">🛠️ Free Tools</span>
      <h1>Know Your Numbers. <span class="text-gradient">Make Smarter Decisions.</span></h1>
      <p>Use our free interactive tools to calculate your potential ROI, estimate your website cost, and discover exactly what's possible for your business.</p>
    </div>
  </section>

  <!-- ═══════════ ROI CALCULATOR -->
  <section class="section" id="roi">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">💰 Tool 1</span>
        <h2>ROI <span class="text-gradient">Calculator</span></h2>
        <p>Find out how much more revenue you could generate with optimised digital marketing.</p>
      </div>

      <div style="max-width:900px;margin:0 auto">
        <div class="tool-card reveal">
          <form id="roi-calc-form">
            <div class="grid grid-2" style="gap:2rem;margin-bottom:2rem">
              <div class="range-wrap">
                <div class="range-header">
                  <label for="ad-spend">Monthly Ad Spend</label>
                  <span class="range-val" id="ad-spend-display">$1,000</span>
                </div>
                <input type="range" id="ad-spend" name="ad-spend" min="100" max="50000" value="1000" step="100" data-prefix="$" />
                <div style="display:flex;justify-content:space-between;font-size:0.7rem;color:var(--text-muted)"><span>$100</span><span>$50,000</span></div>
              </div>

              <div class="range-wrap">
                <div class="range-header">
                  <label for="current-traffic">Monthly Website Visitors</label>
                  <span class="range-val" id="current-traffic-display">5,000</span>
                </div>
                <input type="range" id="current-traffic" name="current-traffic" min="100" max="200000" value="5000" step="100" />
                <div style="display:flex;justify-content:space-between;font-size:0.7rem;color:var(--text-muted)"><span>100</span><span>200,000</span></div>
              </div>

              <div class="range-wrap">
                <div class="range-header">
                  <label for="conv-rate">Current Conversion Rate</label>
                  <span class="range-val" id="conv-rate-display">2%</span>
                </div>
                <input type="range" id="conv-rate" name="conv-rate" min="0.1" max="15" value="2" step="0.1" data-suffix="%" />
                <div style="display:flex;justify-content:space-between;font-size:0.7rem;color:var(--text-muted)"><span>0.1%</span><span>15%</span></div>
              </div>

              <div class="range-wrap">
                <div class="range-header">
                  <label for="avg-order">Average Order / Lead Value</label>
                  <span class="range-val" id="avg-order-display">$50</span>
                </div>
                <input type="range" id="avg-order" name="avg-order" min="10" max="10000" value="50" step="10" data-prefix="$" />
                <div style="display:flex;justify-content:space-between;font-size:0.7rem;color:var(--text-muted)"><span>$10</span><span>$10,000</span></div>
              </div>
            </div>

            <button type="submit" class="btn btn--primary btn--lg w-full">
              🚀 Calculate My Revenue Potential
            </button>
          </form>

          <!-- Email Gate -->
          <div class="email-gate" id="roi-email-gate">
            <div class="email-gate-box">
              <div style="font-size:2.5rem;margin-bottom:1rem">📊</div>
              <h3 style="font-size:1.5rem;margin-bottom:0.5rem">Your Results Are Ready!</h3>
              <p style="color:var(--text-secondary);margin-bottom:1.5rem">Enter your email to unlock your personalised revenue projection:</p>
              <div style="display:flex;flex-direction:column;gap:0.75rem">
                <input type="email" id="roi-email" class="form-input" placeholder="your@email.com" required />
                <button id="roi-email-submit" class="btn btn--primary btn--lg">Unlock My Results →</button>
                <p style="font-size:0.75rem;color:var(--text-muted)">No spam. Unsubscribe anytime.</p>
              </div>
            </div>
          </div>

          <!-- Results -->
          <div class="result-box" id="roi-result" style="margin-top:2rem">
            <h3 style="font-size:1.25rem;margin-bottom:1.5rem;color:var(--text-primary)">🎯 Your Revenue Projection with Cypressiq</h3>
            <div class="grid grid-2" style="gap:1rem;margin-bottom:1.5rem">
              <div class="result-metric">
                <span class="num" id="roi-projected">$0</span>
                <span class="lbl">Projected Monthly Revenue</span>
              </div>
              <div class="result-metric">
                <span class="num" id="roi-increase">+$0</span>
                <span class="lbl">Revenue Increase</span>
              </div>
              <div class="result-metric">
                <span class="num" id="roi-multiple">0x</span>
                <span class="lbl">Return on Investment</span>
              </div>
              <div class="result-metric">
                <span class="num" id="roi-traffic">0</span>
                <span class="lbl">Optimised Monthly Visitors</span>
              </div>
            </div>
            <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.5rem">These projections are based on our average client results. Actual results may vary.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Start Growing My Revenue Today 🚀</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════ WEBSITE COST ESTIMATOR -->
  <section class="section" id="estimator" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--accent">🌐 Tool 2</span>
        <h2>Website Cost <span class="text-gradient">Estimator</span></h2>
        <p>Get an instant price estimate for your web project. Fully customisable, no strings attached.</p>
      </div>

      <div style="max-width:900px;margin:0 auto">
        <div style="display:grid;grid-template-columns:1fr 350px;gap:2rem" class="reveal">
          <div class="tool-card">
            <form id="estimator-form">
              <div style="margin-bottom:1.5rem">
                <label class="form-label" style="margin-bottom:1rem;display:block">Website Type</label>
                <select id="site-type" class="form-select">
                  <option value="basic">Basic / Landing Page</option>
                  <option value="portfolio">Portfolio / Personal Brand</option>
                  <option value="business" selected>Business / Corporate</option>
                  <option value="ecommerce">E-Commerce Store</option>
                  <option value="enterprise">Enterprise / SaaS Platform</option>
                </select>
              </div>

              <div style="margin-bottom:1.5rem">
                <label class="form-label" style="margin-bottom:1rem;display:block">Number of Pages</label>
                <select id="page-count" class="form-select">
                  <option value="1">1-3 pages</option>
                  <option value="5" selected>4-7 pages</option>
                  <option value="10">8-10 pages</option>
                  <option value="15">11-20 pages</option>
                  <option value="30">20+ pages</option>
                </select>
              </div>

              <div style="margin-bottom:1.5rem">
                <label class="form-label" style="margin-bottom:1rem;display:block">Timeline</label>
                <select id="timeline" class="form-select">
                  <option value="flexible">Flexible (10% off)</option>
                  <option value="standard" selected>Standard (3-6 weeks)</option>
                  <option value="rush">Rush (50% surcharge)</option>
                </select>
              </div>

              <div style="margin-bottom:2rem">
                <label class="form-label" style="margin-bottom:1rem;display:block">Additional Features</label>
                <div class="estimator-options">
                  <label class="estimator-option"><input type="checkbox" name="features" value="cms" /><span>CMS / Blog</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="seo" /><span>SEO Setup</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="payment" /><span>Payments</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="user-auth" /><span>User Auth</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="multilang" /><span>Multilang</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="chat" /><span>Live Chat</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="analytics" /><span>Analytics</span></label>
                  <label class="estimator-option"><input type="checkbox" name="features" value="blog" /><span>Blog / News</span></label>
                </div>
              </div>
            </form>
          </div>

          <div style="display:flex;flex-direction:column;gap:1.25rem">
            <div class="estimate-display">
              <span style="font-size:0.85rem;opacity:0.8;margin-bottom:0.5rem;display:block">Estimated Project Cost</span>
              <span class="amount" id="estimate-range">$750 – $1,875</span>
              <p style="font-size:0.8rem;opacity:0.75;margin-top:0.5rem">Final price depends on exact requirements</p>
            </div>

            <div class="tool-card" style="padding:1.25rem">
              <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.08em">Cost Breakdown</div>
              <div id="estimate-breakdown"></div>
            </div>

            <div class="tool-card" style="padding:1.25rem;text-align:center">
              <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1rem">Get a detailed, personalised quote in 24 hours</p>
              <a href="{{ route('contact') }}" class="btn btn--primary w-full">Get Exact Quote 📋</a>
            </div>

            <div class="tool-card" style="padding:1.25rem">
              <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.08em">Always Included Free</div>
              <div class="feature-check"><span style="color:var(--clr-accent)">✓</span>Mobile responsive design</div>
              <div class="feature-check"><span style="color:var(--clr-accent)">✓</span>SSL & security setup</div>
              <div class="feature-check"><span style="color:var(--clr-accent)">✓</span>Speed optimisation</div>
              <div class="feature-check"><span style="color:var(--clr-accent)">✓</span>30-day post-launch support</div>
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
        <h2>Ready to Grow Your Business?</h2>
        <p>Get a free, no-obligation strategy consultation and custom proposal.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">Book Free Consultation 🚀</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
