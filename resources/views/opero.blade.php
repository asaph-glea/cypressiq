@extends('layouts.app')
@section('title', 'Cypressiq ERP — Powerful Business Management System | Laravel 11')

@section('css')
<style>
.erp-feature-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--space-12);
      align-items: center;
      padding: var(--space-16) 0;
      border-bottom: 1px solid var(--border-subtle);
    }
    .erp-feature-section:last-child { border-bottom: none; }
    .erp-feature-section.reverse { direction: rtl; }
    .erp-feature-section.reverse > * { direction: ltr; }
    .erp-mock {
      background: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-xl);
      padding: var(--space-5);
      box-shadow: var(--shadow-md);
    }
    .erp-mock-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: var(--space-4);
      padding-bottom: var(--space-4);
      border-bottom: 1px solid var(--border-subtle);
      font-size: var(--text-sm);
      font-weight: 600;
    }
    .workflow-step {
      display: flex;
      align-items: center;
      gap: var(--space-3);
      padding: var(--space-4);
      background: var(--bg-glass);
      border-radius: var(--radius-md);
      margin-bottom: var(--space-2);
    }
    .workflow-icon {
      width: 36px;
      height: 36px;
      border-radius: var(--radius-md);
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 1rem;
    }
    .flow-arrow {
      text-align: center;
      color: var(--clr-primary);
      font-size: 1.25rem;
      margin: var(--space-1) 0;
    }
    @media (max-width: 900px) {
      .erp-feature-section { grid-template-columns: 1fr; direction: ltr !important; }
    }
</style>
@endsection

@section('content')
<!-- HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">⚙️ Cypressiq ERP Platform</span>
      <h1>The Business OS for <span class="text-gradient">Modern Enterprises</span></h1>
      <p>Manage your entire business from one powerful, modular platform. POS, inventory, HR, payroll, and financial reporting — all in real-time.</p>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn btn--accent btn--lg">🚀 Book Free Demo</a>
        <a href="#pricing" class="btn btn--secondary btn--lg">View Pricing</a>
      </div>
    </div>
  </section>

  <!-- MODULES OVERVIEW -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">🧩 Modules</span>
        <h2>One Platform. <span class="text-gradient">Every Business Function.</span></h2>
        <p>Cypressiq ERP is fully modular — use only what you need today, and add more as you grow.</p>
      </div>

      <div class="grid grid-4 stagger">
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🛒</div>
          <h4 style="margin-bottom:0.5rem">POS System</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Real-time sales, cart management, and instant invoicing</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">📦</div>
          <h4 style="margin-bottom:0.5rem">Inventory</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Stock management with automated low-stock alerts</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">👥</div>
          <h4 style="margin-bottom:0.5rem">HR & Payroll</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Employee management, attendance, and payroll processing</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">💰</div>
          <h4 style="margin-bottom:0.5rem">Financials</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Expense tracking and real-time financial reports</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🏪</div>
          <h4 style="margin-bottom:0.5rem">CRM</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Customer & supplier management with full history</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🔐</div>
          <h4 style="margin-bottom:0.5rem">RBAC</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Role-based access control with granular permissions</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">🗄️</div>
          <h4 style="margin-bottom:0.5rem">Backups</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Automated database backups with restore functionality</p>
        </div>
        <div class="card reveal" style="text-align:center">
          <div style="font-size:2.5rem;margin-bottom:1rem">⚙️</div>
          <h4 style="margin-bottom:0.5rem">Settings</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem">Company-wide config with branding and preferences</p>
        </div>
      </div>
    </div>
  </section>

  <!-- POS FEATURE -->
  <section class="section" id="pos" style="background:var(--bg-surface)">
    <div class="container">
      <div class="erp-feature-section reveal">
        <div>
          <span class="badge badge--primary" style="margin-bottom:1rem">🛒 POS System</span>
          <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Real-Time Point of Sale</h2>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">Handle sales at lightning speed with our intuitive POS interface. Real-time cart, instant invoicing, multiple payment methods, and automatic inventory deduction — all in one smooth workflow.</p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Barcode/QR code scanning</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Multiple payment methods (cash, card, mobile)</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Instant PDF/print receipts & invoices</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Daily sales summaries and shift reports</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Automatic stock deduction per sale</span></li>
          </ul>
        </div>
        <div class="erp-mock">
          <div class="erp-mock-header">
            <span>🛒 New Sale — POS Terminal</span>
            <span class="badge badge--success">Active</span>
          </div>
          <div style="background:var(--bg-glass);border-radius:var(--radius-md);padding:1rem;margin-bottom:1rem">
            <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:0.75rem">CART ITEMS</div>
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;padding:0.5rem 0;border-bottom:1px solid var(--border-subtle)"><span>Laptop Stand Pro</span><span style="color:var(--clr-primary)">$34.99</span></div>
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;padding:0.5rem 0;border-bottom:1px solid var(--border-subtle)"><span>USB-C Hub × 2</span><span style="color:var(--clr-primary)">$49.98</span></div>
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;padding:0.5rem 0"><span>Wireless Mouse</span><span style="color:var(--clr-primary)">$29.99</span></div>
          </div>
          <div style="background:linear-gradient(135deg,rgba(108,99,255,0.15),rgba(0,212,170,0.1));border:1px solid var(--border-accent);border-radius:var(--radius-md);padding:1rem">
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;margin-bottom:0.5rem"><span style="color:var(--text-muted)">Subtotal</span><span>$114.96</span></div>
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;margin-bottom:0.75rem"><span style="color:var(--text-muted)">Tax (8%)</span><span>$9.20</span></div>
            <div style="display:flex;justify-content:space-between;font-size:1.25rem;font-weight:700"><span>Total</span><span style="color:var(--clr-accent)">$124.16</span></div>
          </div>
          <button class="btn btn--accent w-full" style="margin-top:1rem;border-radius:var(--radius-md)">Complete Sale ✓</button>
        </div>
      </div>
    </div>
  </section>

  <!-- INVENTORY FEATURE -->
  <section class="section" id="inventory">
    <div class="container">
      <div class="erp-feature-section reverse reveal">
        <div>
          <span class="badge badge--accent" style="margin-bottom:1rem">📦 Inventory</span>
          <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Smart Stock Management</h2>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">Never run out of stock again. Cypressiq's inventory module tracks every item in real-time, alerts you when stock is low, and gives you complete visibility across all your locations.</p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Multi-location stock tracking</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Automated low-stock email/SMS alerts</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Purchase order management</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Product categories and variations</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-accent);font-size:1.25rem">✓</span><span>Stock movement audit trail</span></li>
          </ul>
        </div>
        <div class="erp-mock">
          <div class="erp-mock-header"><span>📦 Inventory Overview</span><span style="color:var(--clr-accent);font-size:0.75rem">3,421 items</span></div>
          <div style="display:flex;flex-direction:column;gap:0.5rem">
            <div style="display:grid;grid-template-columns:1fr auto auto;gap:0.5rem;font-size:0.7rem;color:var(--text-muted);padding-bottom:0.5rem;border-bottom:1px solid var(--border-subtle)">
              <span>PRODUCT</span><span>STOCK</span><span>STATUS</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr auto auto;gap:0.5rem;font-size:0.8rem;padding:0.4rem 0;border-bottom:1px solid var(--border-subtle)">
              <span>iPhone 15 Case</span><span>284</span><span class="badge badge--success" style="font-size:0.65rem">OK</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr auto auto;gap:0.5rem;font-size:0.8rem;padding:0.4rem 0;border-bottom:1px solid var(--border-subtle)">
              <span>USB Hub 7-Port</span><span style="color:var(--clr-warning)">8</span><span class="badge badge--warning" style="font-size:0.65rem">Low</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr auto auto;gap:0.5rem;font-size:0.8rem;padding:0.4rem 0;border-bottom:1px solid var(--border-subtle)">
              <span>Wireless Headset</span><span>126</span><span class="badge badge--success" style="font-size:0.65rem">OK</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr auto auto;gap:0.5rem;font-size:0.8rem;padding:0.4rem 0">
              <span>Laptop Stand</span><span style="color:var(--clr-danger)">2</span><span class="badge" style="background:rgba(255,71,87,0.1);color:var(--clr-danger);border:1px solid rgba(255,71,87,0.3);font-size:0.65rem">Urgent</span>
            </div>
          </div>
          <div style="margin-top:1rem;padding:0.75rem;background:rgba(255,107,53,0.1);border:1px solid rgba(255,107,53,0.3);border-radius:var(--radius-md);font-size:0.8rem;color:var(--clr-warning)">
            ⚠️ 8 items below reorder point — auto-alerts sent to procurement
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- HR FEATURE -->
  <section class="section" id="hr" style="background:var(--bg-surface)">
    <div class="container">
      <div class="erp-feature-section reveal">
        <div>
          <span class="badge badge--warning" style="margin-bottom:1rem">👥 HR & Payroll</span>
          <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:1rem">Full HR Without the Headache</h2>
          <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:1.5rem">From hiring to payroll, manage your entire workforce in Cypressiq. Track attendance, manage leaves, process payroll with automatic deductions, and generate payslips in seconds.</p>
          <ul style="display:flex;flex-direction:column;gap:0.75rem">
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-warning);font-size:1.25rem">✓</span><span>Employee profiles and document management</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-warning);font-size:1.25rem">✓</span><span>Attendance tracking and leave management</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-warning);font-size:1.25rem">✓</span><span>Automated payroll with tax calculations</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-warning);font-size:1.25rem">✓</span><span>Payslip generation (PDF download)</span></li>
            <li style="display:flex;align-items:center;gap:0.75rem"><span style="color:var(--clr-warning);font-size:1.25rem">✓</span><span>Department and role structure</span></li>
          </ul>
        </div>
        <div class="erp-mock">
          <div class="erp-mock-header"><span>👥 HR Dashboard</span><span style="color:var(--clr-primary);font-size:0.75rem">48 employees</span></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:1rem">
            <div style="background:var(--bg-glass);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
              <div style="font-size:1.5rem;font-weight:800;color:var(--clr-success)">46</div>
              <div style="font-size:0.7rem;color:var(--text-muted)">Present Today</div>
            </div>
            <div style="background:var(--bg-glass);border-radius:var(--radius-md);padding:0.75rem;text-align:center">
              <div style="font-size:1.5rem;font-weight:800;color:var(--clr-warning)">2</div>
              <div style="font-size:0.7rem;color:var(--text-muted)">On Leave</div>
            </div>
          </div>
          <div style="background:var(--bg-glass);border-radius:var(--radius-md);padding:1rem">
            <div style="font-size:0.7rem;color:var(--text-muted);margin-bottom:0.75rem">PAYROLL SUMMARY — MARCH 2026</div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;margin-bottom:0.5rem"><span>Gross Salaries</span><span style="font-weight:600">$84,200</span></div>
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;margin-bottom:0.5rem"><span>Tax Deductions</span><span style="color:var(--clr-warning)">-$12,320</span></div>
            <div style="display:flex;justify-content:space-between;font-size:0.875rem;font-weight:700;border-top:1px solid var(--border-subtle);padding-top:0.5rem"><span>Net Payroll</span><span style="color:var(--clr-accent)">$71,880</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section class="section" id="pricing">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">💰 Pricing</span>
        <h2>Simple, Transparent <span class="text-gradient">Pricing</span></h2>
        <p>No hidden fees. No surprise charges. Start free, scale as you grow.</p>
      </div>

      <div class="grid grid-3 stagger" style="max-width:1000px;margin:0 auto;align-items:start">
        <div class="card pricing-card reveal">
          <h3 style="font-size:1.25rem;margin-bottom:0.5rem">Starter</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.5rem">Perfect for small businesses getting started</p>
          <div class="pricing-price"><sup>$</sup>49<span>/mo</span></div>
          <div class="pricing-features">
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>POS System</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Inventory (500 items)</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Basic Reports</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>5 User Accounts</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Email Support</div>
            <div class="pricing-feature"><span style="color:var(--text-muted)">✗</span><span style="color:var(--text-muted)">HR & Payroll</span></div>
            <div class="pricing-feature"><span style="color:var(--text-muted)">✗</span><span style="color:var(--text-muted)">Advanced Analytics</span></div>
          </div>
          <a href="{{ route('contact') }}" class="btn btn--outline w-full">Get Started</a>
        </div>

        <div class="card pricing-card pricing-card--featured reveal">
          <div class="pricing-badge"><span class="badge badge--accent">Most Popular</span></div>
          <h3 style="font-size:1.25rem;margin-bottom:0.5rem">Business</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.5rem">For growing SMEs needing full management</p>
          <div class="pricing-price"><sup>$</sup>129<span>/mo</span></div>
          <div class="pricing-features">
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Everything in Starter</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>HR & Payroll Module</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Unlimited Inventory</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>25 User Accounts</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Customer/Supplier CRM</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Advanced Reports</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Priority Support</div>
          </div>
          <a href="{{ route('contact') }}" class="btn btn--primary w-full">Start Free Trial</a>
        </div>

        <div class="card pricing-card reveal">
          <h3 style="font-size:1.25rem;margin-bottom:0.5rem">Enterprise</h3>
          <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.5rem">For large operations needing custom setup</p>
          <div class="pricing-price"><sup>$</sup>299<span>/mo</span></div>
          <div class="pricing-features">
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Everything in Business</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Multi-branch support</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Unlimited Users</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Custom Integrations</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>Dedicated Manager</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>On-premise Option</div>
            <div class="pricing-feature"><span style="color:var(--clr-success)">✓</span>SLA Guarantee</div>
          </div>
          <a href="{{ route('contact') }}" class="btn btn--outline w-full">Contact Sales</a>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>See Cypressiq ERP in Action</h2>
        <p>Book a free 30-minute live demo with one of our product specialists.</p>
        <a href="{{ route('contact') }}" class="btn btn--light btn--lg">🎯 Book Free Demo</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
