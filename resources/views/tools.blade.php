@extends('layouts.app')
@section('title', 'Project Discovery & Systems Scoping Engine — CypressIQ')
@section('meta_description', 'Define your technology requirements, diagnose operational bottlenecks, and receive preliminary architectural scoping from CypressIQ engineers.')

@section('css')
<style>
  .discovery-hub-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    padding: 3rem;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
    max-width: 960px;
    margin: 0 auto;
  }
  .discovery-step {
    margin-bottom: 2.75rem;
    padding-bottom: 2.25rem;
    border-bottom: 1px solid var(--border-subtle);
  }
  .discovery-step:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }
  .step-header {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-bottom: 1.25rem;
  }
  .step-num {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(0, 212, 170, 0.15);
    color: var(--clr-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
  }
  .step-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
  }
  .objective-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
  }
  .objective-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.6rem;
  }
  .objective-card:hover {
    border-color: var(--border-accent);
    background: var(--bg-glass-strong);
    transform: translateY(-2px);
  }
  .objective-card.selected {
    border-color: var(--clr-accent);
    background: rgba(0, 212, 170, 0.08);
    box-shadow: 0 0 15px rgba(0, 212, 170, 0.2);
  }
  .objective-card .icon { font-size: 1.75rem; }
  .objective-card .label { font-size: 0.875rem; font-weight: 600; color: var(--text-primary); }
  .objective-card .sub { font-size: 0.72rem; color: var(--text-muted); }
  .scale-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
  }
  .scale-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem 1rem;
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-md);
    cursor: pointer;
    font-size: 0.825rem;
    transition: all 0.2s;
  }
  .scale-option:hover, .scale-option.selected {
    border-color: var(--clr-primary);
    background: rgba(108, 99, 255, 0.08);
  }
  .contact-inputs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
  }
  .form-label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 0.4rem;
  }
  .form-input {
    width: 100%;
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-md);
    color: var(--text-primary);
    padding: 0.75rem 1rem;
    font-family: inherit;
    font-size: 0.9rem;
    transition: border-color 0.2s;
  }
  .form-input:focus {
    outline: none;
    border-color: var(--clr-accent);
  }
  @media (max-width: 768px) {
    .discovery-hub-card { padding: 1.75rem; }
  }
</style>
@endsection

@section('content')
  <!-- HERO -->
  <section class="page-hero">
    <div class="hero-bg"><div class="hero-grid"></div></div>
    <div class="container relative" style="text-align:center;max-width:860px;margin:0 auto">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">⚡ Interactive Sales &amp; Discovery System</span>
      <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);line-height:1.15;margin-bottom:1.5rem">
        Project Discovery &amp; <span class="text-gradient">Systems Scoping</span>
      </h1>
      <p style="font-size:1.15rem;color:var(--text-secondary);line-height:1.8;margin-bottom:1rem">
        Translate your operational objectives into a concrete technical roadmap. Tell us what you are trying to solve to receive an initial architecture scoping session with our lead engineering team.
      </p>
    </div>
  </section>

  <!-- DISCOVERY ENGINE FORM -->
  <section class="section" style="padding-top:0">
    <div class="container">
      <div class="discovery-hub-card reveal">
        <form id="discovery-engine-form" onsubmit="handleDiscoveryEngineSubmit(event)">
          <input type="hidden" name="service_interest" id="engine-selected-service" value="Business Operations (Opero ERP)">
          <input type="hidden" name="scale_scope" id="engine-selected-scale" value="Multi-Branch (2-10 Outlets)">

          <!-- Step 1: What are you trying to build? -->
          <div class="discovery-step">
            <div class="step-header">
              <div class="step-num">1</div>
              <h3 class="step-title">What are you trying to build or solve?</h3>
            </div>
            <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.25rem">
              Select your primary technology requirement:
            </p>
            <div class="objective-grid">
              <div class="objective-card selected" onclick="selectEngineObjective('Business Operations (Opero ERP)', this)">
                <span class="icon">🏢</span>
                <span class="label">Opero Operations</span>
                <span class="sub">POS, Inventory, HR, Ledger</span>
              </div>
              <div class="objective-card" onclick="selectEngineObjective('Digital Engagement (ITIKIA Platform)', this)">
                <span class="icon">📣</span>
                <span class="label">ITIKIA Platform</span>
                <span class="sub">Public Hub, Manifesto, Volunteers</span>
              </div>
              <div class="objective-card" onclick="selectEngineObjective('Custom Software Engineering', this)">
                <span class="icon">💻</span>
                <span class="label">Custom Software</span>
                <span class="sub">Bespoke Portal, SaaS, App</span>
              </div>
              <div class="objective-card" onclick="selectEngineObjective('API & Payment Integrations', this)">
                <span class="icon">🔌</span>
                <span class="label">APIs &amp; Payments</span>
                <span class="sub">M-Pesa Daraja, Bank Rails</span>
              </div>
              <div class="objective-card" onclick="selectEngineObjective('Technology Consulting & Modernization', this)">
                <span class="icon">🔄</span>
                <span class="label">Systems Audit</span>
                <span class="sub">Modernize Spreadsheets</span>
              </div>
            </div>
          </div>

          <!-- Step 2: What is the bottleneck? -->
          <div class="discovery-step">
            <div class="step-header">
              <div class="step-num">2</div>
              <h3 class="step-title">Tell us about the problem or objective</h3>
            </div>
            <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:0.75rem">
              Describe your current operational bottlenecks, friction points, or target milestone:
            </p>
            <textarea name="message" id="engine-message" rows="4" class="form-input" style="resize:vertical" placeholder="e.g. We operate 5 physical branches and track inventory in manual Excel sheets. We experience weekly stockout surprises, lack real-time visibility into cashier shifts, and spend 8 days reconciling M-Pesa receipts with bank statements. We need a unified real-time system..." required></textarea>
          </div>

          <!-- Step 3: Operational Scale -->
          <div class="discovery-step">
            <div class="step-header">
              <div class="step-num">3</div>
              <h3 class="step-title">Estimated Scale &amp; Target Timeline</h3>
            </div>
            <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1rem">
              Indicate the approximate scale of the implementation:
            </p>
            <div class="scale-grid">
              <div class="scale-option selected" onclick="selectEngineScale('Single Location / Startup Pilot', this)">
                <span>📍 Single Location / Pilot</span>
              </div>
              <div class="scale-option" onclick="selectEngineScale('Multi-Branch (2-10 Outlets)', this)">
                <span>🏬 Multi-Branch (2-10)</span>
              </div>
              <div class="scale-option" onclick="selectEngineScale('Regional Enterprise (10+ Outlets)', this)">
                <span>🏢 Regional Enterprise (10+)</span>
              </div>
              <div class="scale-option" onclick="selectEngineScale('Public / Mass Audience (100k+ Users)', this)">
                <span>👥 Mass Audience (100k+)</span>
              </div>
            </div>
          </div>

          <!-- Step 4: Contact & Conversation -->
          <div class="discovery-step">
            <div class="step-header">
              <div class="step-num">4</div>
              <h3 class="step-title">Get a Conversation with CypressIQ</h3>
            </div>
            <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.25rem">
              Where should our systems engineering team send your preliminary scoping architecture?
            </p>

            <div class="contact-inputs-grid">
              <div>
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" id="engine-name" class="form-input" placeholder="e.g. David Mwangi" required>
              </div>
              <div>
                <label class="form-label">Work Email *</label>
                <input type="email" name="email" id="engine-email" class="form-input" placeholder="david@organization.com" required>
              </div>
              <div>
                <label class="form-label">Phone / WhatsApp</label>
                <input type="text" name="phone" id="engine-phone" class="form-input" placeholder="+254 700 000000">
              </div>
            </div>

            <div id="engine-alert" style="display:none;padding:1rem 1.25rem;border-radius:var(--radius-md);font-size:0.9rem;margin-bottom:1.5rem"></div>

            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem">
              <div style="font-size:0.75rem;color:var(--text-muted);display:flex;align-items:center;gap:0.4rem">
                <span>🔒</span> Strict NDA confidentiality. Technical follow-up within 24 business hours.
              </div>
              <button type="submit" id="engine-submit-btn" class="btn btn--accent btn--lg" style="padding:0.9rem 2.25rem">
                Submit Discovery &amp; Schedule Architecture Call →
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script>
  function selectEngineObjective(service, card) {
    document.querySelectorAll('.objective-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    document.getElementById('engine-selected-service').value = service;
  }

  function selectEngineScale(scale, option) {
    document.querySelectorAll('.scale-option').forEach(o => o.classList.remove('selected'));
    option.classList.add('selected');
    document.getElementById('engine-selected-scale').value = scale;
  }

  async function handleDiscoveryEngineSubmit(event) {
    event.preventDefault();
    const btn = document.getElementById('engine-submit-btn');
    const alertBox = document.getElementById('engine-alert');

    btn.disabled = true;
    btn.innerText = 'Transmitting Discovery Specifications...';
    alertBox.style.display = 'none';

    const fullName = document.getElementById('engine-name').value.trim();
    const parts = fullName.split(' ');
    const firstName = parts[0] || 'Client';
    const lastName = parts.slice(1).join(' ') || '-';

    const scale = document.getElementById('engine-selected-scale').value;
    const baseMessage = document.getElementById('engine-message').value;
    const fullMessage = `[Operational Scale: ${scale}]\n\n${baseMessage}`;

    const formData = new FormData();
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('email', document.getElementById('engine-email').value);
    formData.append('phone', document.getElementById('engine-phone').value || '');
    formData.append('service_interest', document.getElementById('engine-selected-service').value);
    formData.append('message', fullMessage);
    formData.append('source', 'project_discovery_engine');

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
        alertBox.innerHTML = `<strong>✅ Project Discovery Scoping Received!</strong><br><br>
        Thank you, <strong>${firstName}</strong>. Your operational specifications have been dispatched to our lead engineering team.<br>
        We are preparing a preliminary architecture outline tailored to your requirements and will reach out to <strong>${document.getElementById('engine-email').value}</strong> to coordinate your technical consultation.`;
        alertBox.style.display = 'block';
        alertBox.style.background = 'rgba(0, 212, 170, 0.12)';
        alertBox.style.border = '1px solid rgba(0, 212, 170, 0.35)';
        alertBox.style.color = 'var(--clr-accent)';
        document.getElementById('discovery-engine-form').reset();
      } else {
        alertBox.innerText = '⚠️ There was a problem submitting your specifications. Please check the fields and try again.';
        alertBox.style.display = 'block';
        alertBox.style.background = 'rgba(255, 71, 87, 0.12)';
        alertBox.style.border = '1px solid rgba(255, 71, 87, 0.35)';
        alertBox.style.color = '#ff6b81';
      }
    } catch (err) {
      console.error(err);
      alertBox.innerText = '⚠️ Network error. Please reach out to us directly at inquiries@cypressiq.com.';
      alertBox.style.display = 'block';
      alertBox.style.background = 'rgba(255, 71, 87, 0.12)';
      alertBox.style.border = '1px solid rgba(255, 71, 87, 0.35)';
      alertBox.style.color = '#ff6b81';
    } finally {
      btn.disabled = false;
      btn.innerText = 'Submit Discovery & Schedule Architecture Call →';
    }
  }
</script>
@endsection
