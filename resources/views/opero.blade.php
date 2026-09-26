@extends('layouts.app')
@section('title', 'OPERO — Business Operations & Management Platform | CypressIQ')
@section('meta_description', 'Opero is an operational business management platform unifying POS, multi-location inventory, biometric HR, payroll, double-entry accounting, and telemetry reporting.')

@section('css')
<style>
  .opero-hero-grid {
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
    border-color: #6C63FF;
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(108, 99, 255, 0.12);
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
    background: #6C63FF;
  }
  .rbac-table-wrap {
    overflow-x: auto;
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    margin-top: 2rem;
  }
  .rbac-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
    text-align: left;
  }
  .rbac-table th, .rbac-table td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid var(--border-subtle);
  }
  .rbac-table th {
    color: var(--text-muted);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.72rem;
    letter-spacing: 0.05em;
  }
  @media (max-width: 992px) {
    .opero-hero-grid {
      grid-template-columns: 1fr;
      gap: 2.5rem;
    }
  }
</style>
@endsection

@section('content')

  <!-- ══════════════════════════════════════════════════════════
       1. OPERO HERO WITH LIVE INTERACTIVE TERMINAL
       ══════════════════════════════════════════════════════════ -->
  <section class="page-hero" style="text-align:left;padding-bottom:var(--space-12)">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container relative">
      <div class="opero-hero-grid">
        
        <!-- Left: Product Messaging -->
        <div>
          <div style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.4rem 1rem;border-radius:var(--radius-full);background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.3);font-size:0.85rem;color:var(--clr-primary-light);font-weight:600;margin-bottom:1.5rem">
            <span>⚙️</span> CypressIQ Proprietary Software
          </div>
          <h1 style="font-size:clamp(2.4rem,4.8vw,3.6rem);line-height:1.15;margin-bottom:1.25rem">
            OPERO: The Business Operations &amp; <span class="text-gradient">ERP Platform</span>
          </h1>
          <p style="font-size:1.1rem;color:var(--text-secondary);line-height:1.8;margin-bottom:2rem">
            Engineered for growing multi-branch enterprises, wholesalers, and trade companies. Opero replaces fragmented spreadsheets with a synchronized operational engine covering POS, multi-location stock, biometric HR, payroll, and double-entry accounting.
          </p>

          <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem">
            <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Platform Walkthrough →</a>
            <a href="#modules" class="btn btn--secondary btn--lg" onclick="event.preventDefault(); openProductVideoModal('opero');">Review System Modules 🎥</a>
          </div>

          <div style="display:flex;gap:2rem;border-top:1px solid var(--border-subtle);padding-top:1.5rem">
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--text-primary)">14+</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Active Branch Installs</div>
            </div>
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--clr-accent)">99.98%</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">POS Terminal Uptime</div>
            </div>
            <div>
              <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--clr-primary)">0</div>
              <div style="font-size:0.75rem;color:var(--text-muted)">Unreconciled Shift Voids</div>
            </div>
          </div>
        </div>

        <!-- Right: Interactive Product Mockup -->
        <div class="browser-mockup-frame reveal">
          <div class="browser-chrome">
            <div class="browser-dots"><span></span><span></span><span></span></div>
            <div class="browser-address">🔒 https://opero.cypressiq.app/enterprise-cockpit</div>
            <span class="badge badge--success" style="font-size:0.65rem">Cluster Online</span>
          </div>

          <div class="mockup-tab-bar">
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple active" onclick="switchOperoTab('dashboard', this)">📈 Dashboard</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="openProductVideoModal('opero')">🎥 Live Tour</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoTab('sales', this)">🛒 Sales (POS)</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoTab('inventory', this)">📦 Inventory</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoTab('hr', this)">👥 HR</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoTab('finance', this)">💳 Finance</button>
            <button type="button" class="mockup-tab-btn mockup-tab-btn--purple" onclick="switchOperoTab('reports', this)">📋 Reports</button>
          </div>

          <div class="mockup-viewport">
            <!-- View 1: Dashboard -->
            <div id="opero-page-dashboard" class="mockup-pane" style="display:block">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.25rem">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.85rem">
                  <div>
                    <div style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em">Consolidated Monthly Revenue</div>
                    <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--text-primary)">KES 1,245,000 <span style="font-size:0.75rem;color:var(--clr-success);font-weight:700">+18.4%</span></div>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.65rem">4 Outlets Live</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.85rem">
                  <div style="padding:0.65rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);font-size:0.78rem">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Blended Gross Margin:</span> <strong style="color:var(--clr-accent)">32.6%</strong>
                  </div>
                  <div style="padding:0.65rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md);font-size:0.78rem">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Active POS Drawers:</span> <strong style="color:var(--clr-primary)">4 Online</strong>
                  </div>
                </div>
                <div style="padding:0.65rem 0.85rem;background:rgba(255,180,0,0.08);border:1px solid rgba(255,180,0,0.3);border-radius:var(--radius-md);display:flex;align-items:center;gap:0.5rem;font-size:0.75rem">
                  <span>⚠️</span> <span><strong>Automated Restock Alert:</strong> 3 SKUs below safety threshold (Branch: Nairobi Central)</span>
                </div>
              </div>
            </div>

            <!-- View 2: Sales (POS) -->
            <div id="opero-page-sales" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1rem;font-size:0.78rem">
                <div style="display:flex;justify-content:space-between;padding-bottom:0.5rem;border-bottom:1px solid var(--border-subtle);margin-bottom:0.75rem">
                  <span style="font-weight:700;color:var(--text-primary)">POS Terminal #02 &bull; Cart Order #4092</span>
                  <span class="badge badge--success" style="font-size:0.6rem">Tender Reconciled</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:0.35rem;color:var(--text-secondary)">
                  <span>2x Industrial Lubricant (20L Pail)</span><strong style="color:var(--text-primary)">KES 14,000</strong>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:0.75rem;color:var(--text-secondary)">
                  <span>4x Heavy Duty Hydraulic Filter</span><strong style="color:var(--text-primary)">KES 6,800</strong>
                </div>
                <div style="display:flex;justify-content:space-between;padding-top:0.5rem;border-top:1px solid var(--border-subtle);font-weight:700;color:var(--text-primary);font-size:0.85rem">
                  <span>Total Amount Due:</span><span style="color:var(--clr-primary)">KES 20,800</span>
                </div>
                <div style="margin-top:0.5rem;font-size:0.7rem;color:var(--text-muted)">
                  Tender: M-Pesa STK Push (Receipt Ref: QK9182LA) &bull; Thermal Slip #8819 Printed &bull; Cashier: John M.
                </div>
              </div>
            </div>

            <!-- View 3: Inventory -->
            <div id="opero-page-inventory" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.5rem;font-size:0.78rem">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Central Depot (Warehouse A)</strong>
                    <span style="display:block;font-size:0.7rem;color:var(--text-muted)">Main logistics hub &bull; 4,820 units on hand</span>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Adequate</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Nairobi Central Outlet</strong>
                    <span style="display:block;font-size:0.7rem;color:var(--text-muted)">Retail storefront &bull; 1,140 units on hand</span>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.6rem">Nominal</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.85rem;background:rgba(255,71,87,0.06);border-radius:var(--radius-md);border:1px solid rgba(255,71,87,0.25)">
                  <div>
                    <strong style="color:#ff6b81">SKU-2041 (Hydraulic Valve Assembly)</strong>
                    <span style="display:block;font-size:0.7rem;color:var(--text-muted)">Current: 12 units (Reorder Threshold: 20 units)</span>
                  </div>
                  <span class="badge badge--warning" style="font-size:0.6rem">Reorder PO #108 Queued</span>
                </div>
              </div>
            </div>

            <!-- View 4: HR & Payroll -->
            <div id="opero-page-hr" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1rem;font-size:0.78rem">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.75rem">
                  <div>
                    <span style="font-size:0.68rem;color:var(--text-muted);text-transform:uppercase">Shift Attendance Roster</span>
                    <div style="font-weight:700;color:var(--text-primary);font-size:1.05rem">18 / 18 Staff Clocked In</div>
                  </div>
                  <span class="badge badge--success" style="font-size:0.6rem">Biometric Verified</span>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.4rem;font-size:0.75rem;color:var(--text-secondary)">
                  <div style="display:flex;justify-content:space-between;padding:0.3rem 0;border-bottom:1px solid var(--border-subtle)">
                    <span>Active Payroll Period:</span><strong>September 2026</strong>
                  </div>
                  <div style="display:flex;justify-content:space-between;padding:0.3rem 0;border-bottom:1px solid var(--border-subtle)">
                    <span>Statutory Deductions (PAYE, NSSF, NHIF):</span><strong style="color:var(--clr-accent)">Automated &amp; Reconciled</strong>
                  </div>
                  <div style="display:flex;justify-content:space-between;padding:0.3rem 0">
                    <span>Disbursement Authorization:</span><strong style="color:var(--clr-primary)">Dual Signoff Approved</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- View 5: Finance & Ledger -->
            <div id="opero-page-finance" class="mockup-pane" style="display:none">
              <div style="background:var(--bg-glass);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1rem;font-size:0.78rem">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.75rem">
                  <span style="font-weight:700;color:var(--text-primary)">Double-Entry Operational Ledger</span>
                  <span style="font-family:var(--font-mono);font-size:0.65rem;color:var(--clr-accent)">AUDIT-HASH: 7f8a9e4b</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.75rem">
                  <div style="padding:0.6rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Daily Bank Ingestion:</span>
                    <div style="font-weight:700;color:var(--clr-success)">KES 342,000 Reconciled</div>
                  </div>
                  <div style="padding:0.6rem;background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-md)">
                    <span style="font-size:0.68rem;color:var(--text-muted)">Open Accounts Receivable:</span>
                    <div style="font-weight:700;color:var(--text-primary)">KES 180,000 (&lt; 15d)</div>
                  </div>
                </div>
                <div style="font-size:0.7rem;color:var(--text-muted)">
                  Zero unallocated transaction lines &bull; MT940 statement automated parsing active.
                </div>
              </div>
            </div>

            <!-- View 6: Reports -->
            <div id="opero-page-reports" class="mockup-pane" style="display:none">
              <div style="display:flex;flex-direction:column;gap:0.55rem;font-size:0.78rem">
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.75rem 0.95rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>Executive Monthly P&amp;L Statement</strong>
                    <span style="display:block;font-size:0.7rem;color:var(--text-muted)">Branch breakdown with gross &amp; net margin analysis</span>
                  </div>
                  <span class="badge badge--primary" style="font-size:0.6rem">PDF / Excel Export</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.75rem 0.95rem;background:var(--bg-glass);border-radius:var(--radius-md);border:1px solid var(--border-subtle)">
                  <div>
                    <strong>SKU Velocity &amp; Shrinkage Audit</strong>
                    <span style="display:block;font-size:0.7rem;color:var(--text-muted)">High-velocity items &amp; warehouse physical discrepancy log</span>
                  </div>
                  <span class="badge badge--accent" style="font-size:0.6rem">Telemetry Live</span>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       2. MODULAR ARCHITECTURE BREAKDOWN
       ══════════════════════════════════════════════════════════ -->
  <section class="section" id="modules" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto 3.5rem">
        <span class="badge badge--primary">🧩 Modular System Design</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          One Operational Engine. <span class="text-gradient">Every Core Workflow.</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Opero is designed modularly. Activate only the capabilities your operations require today, and scale seamlessly as multi-branch complexity expands.
        </p>
      </div>

      <div class="module-feature-grid stagger">
        <!-- Module 1 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">🛒</div>
          <h4 style="margin-bottom:0.5rem">Point of Sale (POS) Terminal</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Sub-second checkout, barcode scanner integration, split payments (Cash, Card, M-Pesa STK), and immediate ESC/POS thermal receipt printing.
          </p>
        </div>

        <!-- Module 2 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📦</div>
          <h4 style="margin-bottom:0.5rem">Multi-Warehouse Inventory</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Real-time stock tracking across distributed depot and retail locations with automated purchase order generation when SKUs breach reorder floors.
          </p>
        </div>

        <!-- Module 3 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">👥</div>
          <h4 style="margin-bottom:0.5rem">Biometric HR &amp; Attendance</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Hardware biometric scanner sync, shift scheduling, automated overtime calculation, and tamper-proof clock-in logs per outlet.
          </p>
        </div>

        <!-- Module 4 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">💰</div>
          <h4 style="margin-bottom:0.5rem">Statutory Payroll Engine</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            One-click payroll disbursement compliant with statutory deductions (PAYE, NSSF, NHIF / SHA, Housing Levy) with encrypted payslip distribution.
          </p>
        </div>

        <!-- Module 5 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">💳</div>
          <h4 style="margin-bottom:0.5rem">Double-Entry Financial Accounting</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Full general ledger, accounts payable/receivable tracking, automated bank feed reconciliation (MT940/CSV), and real-time trial balance generation.
          </p>
        </div>

        <!-- Module 6 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">🏪</div>
          <h4 style="margin-bottom:0.5rem">Supplier &amp; Procurement Hub</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Vendor master catalogs, goods received notes (GRN), invoice matching, credit terms monitoring, and payment voucher workflows.
          </p>
        </div>

        <!-- Module 7 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">🔐</div>
          <h4 style="margin-bottom:0.5rem">Granular RBAC &amp; Audit Logs</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Departmental isolation, strict permission scopes, supervisor override approvals for refunds, and an immutable transaction audit ledger.
          </p>
        </div>

        <!-- Module 8 -->
        <div class="module-feature-card reveal">
          <div style="font-size:2rem;margin-bottom:1rem">📊</div>
          <h4 style="margin-bottom:0.5rem">Telemetry &amp; Executive Cockpit</h4>
          <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
            Consolidated P&amp;L statements, SKU velocity curves, cashier till balancing metrics, and automated daily close-of-business email summaries.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       3. ARCHITECTURAL TOPOLOGY & FAULT TOLERANCE
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto">
        <span class="badge badge--accent">⚡ Resilient Engineering</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Engineered for <span class="text-gradient">Operational Realities</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Real businesses face intermittent internet, concurrent cashier checkouts, and strict financial compliance. Opero is engineered to guarantee zero data loss.
        </p>
      </div>

      <div class="arch-topology-grid">
        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Offline-Tolerant POS Nodes</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            If an outlet loses internet connectivity, the POS terminal switches seamlessly to local storage caching. Transactions continue without interruption and sync upstream with two-way conflict resolution when reconnected.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Atomic Inventory Transactions</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            All stock deductions occur within strict ACID database transactions with row-level locks. Race conditions are eliminated, guaranteeing that two concurrent checkouts never sell the same physical unit.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Idempotent Payment Webhooks</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            M-Pesa Daraja and payment gateway callbacks are deduplicated using cryptographic transaction hashes. Network retries from telecom servers can never double-credit an invoice or tender.
          </p>
        </div>

        <div class="arch-topology-card reveal">
          <h4 style="margin-bottom:0.5rem">Point-in-Time Ledger Audits</h4>
          <p style="color:var(--text-secondary);font-size:0.85rem;line-height:1.6">
            Financial entries in Opero are append-only. Voids and adjustments create explicit contra entries rather than overwriting historical rows, ensuring strict compliance with external statutory audits.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       4. ENTERPRISE ROLE-BASED ACCESS CONTROL (RBAC)
       ══════════════════════════════════════════════════════════ -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal" style="text-align:center;max-width:760px;margin:0 auto">
        <span class="badge badge--primary">🛡️ Governance &amp; Security</span>
        <h2 style="font-size:clamp(1.9rem,3.8vw,2.8rem);margin-bottom:1rem">
          Strict Departmental <span class="text-gradient">Role Governance</span>
        </h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.75">
          Opero enforces least-privilege security. Staff see only what is required to execute their operational duties, protecting trade secrets and financial statements.
        </p>
      </div>

      <div class="rbac-table-wrap reveal">
        <table class="rbac-table">
          <thead>
            <tr>
              <th>Role</th>
              <th>POS Checkout</th>
              <th>Inventory Transfers</th>
              <th>Payroll &amp; HR</th>
              <th>General Ledger</th>
              <th>Audit Ledgers</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Cashier / Sales Agent</strong></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Full Access</span></td>
              <td><span style="color:var(--text-muted)">— Read Only</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
            </tr>
            <tr>
              <td><strong>Store / Branch Manager</strong></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Void Authorization</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Branch Transfers</span></td>
              <td><span style="color:var(--clr-accent);font-weight:700">✓ Shift Approvals</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--text-muted)">— Branch Only</span></td>
            </tr>
            <tr>
              <td><strong>Accountant / Controller</strong></td>
              <td><span style="color:var(--text-muted)">— Till Balancing</span></td>
              <td><span style="color:var(--clr-accent);font-weight:700">✓ Valuation Audits</span></td>
              <td><span style="color:var(--clr-accent);font-weight:700">✓ Payroll Postings</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Full Access</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Full Access</span></td>
            </tr>
            <tr>
              <td><strong>HR Administrator</strong></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Full Roster &amp; Tax</span></td>
              <td><span style="color:var(--text-muted)">— Restricted</span></td>
              <td><span style="color:var(--clr-accent);font-weight:700">✓ HR Audit Only</span></td>
            </tr>
            <tr>
              <td><strong>Executive Director</strong></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Consolidated</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Global Stock</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Executive Signoff</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ P&amp;L &amp; Balance</span></td>
              <td><span style="color:var(--clr-success);font-weight:700">✓ Cryptographic Hash</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════
       5. DEPLOYMENT & SCOPING CALL TO ACTION
       ══════════════════════════════════════════════════════════ -->
  <section class="section">
    <div class="container">
      <div class="final-tech-cta reveal" style="text-align:center;max-width:820px;margin:0 auto">
        <span class="badge badge--primary" style="margin-bottom:1.25rem">🚀 Platform Scoping &amp; Deployment</span>
        <h2>Deploy Opero across your <span class="text-gradient">enterprise outlets.</span></h2>
        <p style="color:var(--text-secondary);font-size:1.05rem;line-height:1.8;margin-bottom:2rem">
          Consult directly with our systems architecture team. We review your branch count, hardware specifications, data migration from legacy spreadsheets, and deployment timelines.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">
            Schedule Scoping Session →
          </a>
          <a href="{{ route('itikia') }}" class="btn btn--secondary btn--lg">
            Explore ITIKIA Platform
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
  function switchOperoTab(tab, btn) {
    document.querySelectorAll('.mockup-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const panes = ['dashboard', 'sales', 'inventory', 'hr', 'finance', 'reports'];
    panes.forEach(p => {
      const el = document.getElementById('opero-page-' + p);
      if (el) el.style.display = (p === tab) ? 'block' : 'none';
    });
  }
</script>
@endsection
