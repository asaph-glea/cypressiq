@extends('layouts.app')
@section('title', 'Contact CypressIQ — Technical Consultation & Product Inquiries')

@php
  $settings = $contactSettings ?? \App\Models\ContactSetting::firstOrCreate(['id' => 1], [
    'company_email' => 'hello@cypressiqagency.com',
    'phone_number' => '+254 745 763 093',
    'whatsapp_number' => '+254745763093',
    'address' => 'Pinkam House Nakuru, Kenya'
  ]);
@endphp

@section('css')
  <style>
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 480px;
      gap: 3rem;
      align-items: start;
    }

    .contact-info-card {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-2xl);
      padding: 2.5rem;
    }

    .contact-method {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.25rem;
      background: var(--bg-glass);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-lg);
      margin-bottom: 0.75rem;
      transition: all 0.2s;
      text-decoration: none;
    }

    .contact-method:hover {
      border-color: var(--border-accent);
      background: var(--bg-glass-strong);
      transform: translateY(-2px);
    }

    .contact-method-icon {
      width: 48px;
      height: 48px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .booking-slots {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.5rem;
    }

    .slot-btn {
      padding: 0.85rem 0.5rem;
      background: var(--bg-glass);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-md);
      font-size: 0.82rem;
      color: var(--text-secondary);
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      text-align: center;
    }

    .slot-btn:hover,
    .slot-btn.selected {
      background: rgba(108, 99, 255, 0.15);
      border-color: var(--clr-primary);
      color: var(--clr-primary-light);
      box-shadow: 0 0 15px rgba(108, 99, 255, 0.2);
    }

    .faq-item {
      border-bottom: 1px solid var(--border-subtle);
      padding: 1.25rem 0;
    }

    .faq-item:last-child {
      border-bottom: none;
    }

    .faq-question {
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.95rem;
      color: var(--text-primary);
    }

    .faq-answer {
      display: none;
      color: var(--text-secondary);
      font-size: 0.875rem;
      line-height: 1.7;
      padding-top: 0.75rem;
    }

    .faq-answer.open {
      display: block;
    }

    .faq-icon {
      transition: transform 0.2s;
      flex-shrink: 0;
    }

    .faq-item.open .faq-icon {
      transform: rotate(180deg);
    }

    /* Modal styling for booking */
    .custom-modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(5, 8, 20, 0.85);
      backdrop-filter: blur(8px);
      z-index: 9999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    .custom-modal-backdrop.active {
      display: flex;
      animation: fadeInModal 0.25s ease-out;
    }

    .custom-modal-content {
      background: var(--bg-card);
      border: 1px solid var(--border-subtle);
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 30px rgba(108, 99, 255, 0.15);
      border-radius: var(--radius-2xl);
      max-width: 520px;
      width: 100%;
      padding: 2.5rem;
      position: relative;
    }

    .custom-modal-close {
      position: absolute;
      top: 1.25rem;
      right: 1.25rem;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--text-muted);
      border: none;
      background: transparent;
      line-height: 1;
      padding: 0.25rem 0.5rem;
      border-radius: var(--radius-sm);
    }

    .custom-modal-close:hover {
      color: var(--text-primary);
    }

    .notification-alert {
      padding: 1rem 1.25rem;
      border-radius: var(--radius-md);
      font-size: 0.875rem;
      margin-bottom: 1.25rem;
      display: none;
    }

    .notification-alert.success {
      display: block;
      background: rgba(0, 212, 170, 0.12);
      border: 1px solid rgba(0, 212, 170, 0.4);
      color: #00d4aa;
    }

    .notification-alert.error {
      display: block;
      background: rgba(255, 71, 87, 0.12);
      border: 1px solid rgba(255, 71, 87, 0.4);
      color: #ff6b81;
    }

    @keyframes fadeInModal {
      from { opacity: 0; transform: scale(0.96); }
      to { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 900px) {
      .contact-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .contact-info-card,
      .custom-modal-content {
        padding: 1.5rem 1.25rem;
      }
      .booking-slots {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endsection

@section('content')
  <!-- HERO -->
  <section class="page-hero" style="padding-bottom:var(--space-8)">
    <div class="hero-bg">
      <div class="hero-grid"></div>
    </div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">⚡ Direct Technical Access</span>
      <h1>Start a <span class="text-gradient">Technical Consultation</span></h1>
      <p>Talk directly with engineers and software architects. Whether deploying Opero, launching an ITIKIA campaign, or architecting custom business systems, we help you plan with precision.</p>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section class="section-sm">
    <div class="container">
      <div class="contact-grid reveal">
        <!-- FORM -->
        <div>
          <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-2xl);padding:2.5rem">
            <h2 style="font-size:1.5rem;margin-bottom:0.5rem">Project &amp; Systems Inquiry</h2>
            <p style="color:var(--text-secondary);font-size:0.9rem;margin-bottom:2rem">
              Share details about your operational challenges or technical roadmap. Our technical team reviews and responds within 24 hours.
            </p>

            <div id="contact-alert" class="notification-alert"></div>

            <form id="main-contact-form" class="contact-form" style="display:flex;flex-direction:column;gap:1.25rem" onsubmit="window.submitContactForm(event)">
              @csrf
              <div class="grid grid-2">
                <div class="form-group">
                  <label class="form-label">First Name *</label>
                  <input type="text" name="first_name" class="form-input" placeholder="e.g. David" required />
                </div>
                <div class="form-group">
                  <label class="form-label">Last Name *</label>
                  <input type="text" name="last_name" class="form-input" placeholder="e.g. Omondi" required />
                </div>
              </div>

              <div class="grid grid-2">
                <div class="form-group">
                  <label class="form-label">Work Email *</label>
                  <input type="email" name="email" class="form-input" placeholder="david@organization.com" required />
                </div>
                <div class="form-group">
                  <label class="form-label">Phone / WhatsApp</label>
                  <input type="tel" name="phone" class="form-input" placeholder="+254 700 000000" />
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Primary Interest *</label>
                <select name="service_interest" class="form-select" required>
                  <option value="">Select your area of interest...</option>
                  <option value="Opero ERP — Platform Demo & Deployment">Opero — Business Management Platform (POS, Inventory, Finance, HR)</option>
                  <option value="ITIKIA Campaign — Digital Engagement Platform">ITIKIA Campaign — Engagement, Audience &amp; Field Platform</option>
                  <option value="Custom Web & Mobile Software Development">Custom Web &amp; Mobile Software Development</option>
                  <option value="Enterprise Business Systems & Portals">Enterprise Internal Systems &amp; Portals</option>
                  <option value="Digital Transformation & Legacy Migration">Digital Transformation &amp; Legacy Migration</option>
                  <option value="API Integrations & Cloud Infrastructure">API Integrations &amp; Cloud Infrastructure</option>
                  <option value="General Technical Architecture Consultation">General Technical Architecture Consultation</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label">Estimated Implementation Timeline</label>
                <select name="budget_range" class="form-select">
                  <option value="Immediate (< 30 days)">Immediate (&lt; 30 days)</option>
                  <option value="1 - 3 Months">1 - 3 Months</option>
                  <option value="3 - 6 Months">3 - 6 Months</option>
                  <option value="Strategic Partnership / Ongoing SLA">Strategic Partnership / Ongoing SLA</option>
                  <option value="Exploratory Architecture Review">Exploratory Architecture Review</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label">System Requirements &amp; Goals</label>
                <textarea name="message" class="form-textarea" placeholder="Outline your current technical setup, key challenges (e.g., spreadsheet silos, scaling issues), and target functionality..." rows="4"></textarea>
              </div>

              <button type="submit" id="contact-submit-btn" class="btn btn--primary btn--lg" style="border-radius:var(--radius-md)">
                Submit Technical Inquiry →
              </button>
              <p style="font-size:0.75rem;color:var(--text-muted);text-align:center">
                We respect your privacy. Inquiries are handled strictly by technical leads under non-disclosure standards.
              </p>
            </form>
          </div>
        </div>

        <!-- INFO PANEL -->
        <div>
          <!-- Quick Contact -->
          <div class="contact-info-card" style="margin-bottom:1.5rem">
            <h3 style="font-size:1.25rem;margin-bottom:1.25rem">Direct Channels</h3>
            <a href="mailto:{{ $settings->company_email }}" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(108,99,255,0.15)">📧</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Engineering Desk</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->company_email }}</div>
              </div>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text=Hello%20CypressIQ%20team,%20I%20would%20like%20to%20discuss%20a%20technology%20solution"
              target="_blank" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(0,212,170,0.15)">💬</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Direct WhatsApp &amp; Phone</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->phone_number }}</div>
              </div>
            </a>
            <div class="contact-method" style="cursor:default">
              <div class="contact-method-icon" style="background:rgba(255,107,53,0.15)">📍</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Offices &amp; Delivery</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->address }}</div>
              </div>
            </div>
            <div class="contact-method" style="cursor:default">
              <div class="contact-method-icon" style="background:rgba(46,213,115,0.15)">⚡</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Response Timeframe</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">Within 24 business hours</div>
              </div>
            </div>
          </div>

          <!-- Book a Call -->
          <div class="contact-info-card" style="margin-bottom:1.5rem">
            <h3 style="font-size:1.1rem;margin-bottom:0.5rem">📅 Schedule an Architecture Call</h3>
            <p style="color:var(--text-secondary);font-size:0.85rem;margin-bottom:1.25rem">
              Select an available window to discuss software requirements, platform demos, or transformation roadmaps with an engineering architect.
            </p>
            <div style="font-size:0.8rem;font-weight:600;color:var(--text-secondary);margin-bottom:0.75rem">
              Available Consultation Windows
            </div>
            <div class="booking-slots" id="slots">
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Mon 10:00 AM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Mon 2:00 PM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Tue 11:00 AM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Tue 3:00 PM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Wed 10:00 AM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Thu 2:00 PM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Thu 4:00 PM EAT</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Fri 11:00 AM EAT</button>
            </div>
            <div id="booking-slot-helper" style="font-size:0.75rem;color:var(--clr-primary-light);margin-top:0.75rem;min-height:1.2rem"></div>
            <button type="button" class="btn btn--accent w-full" style="margin-top:0.5rem;border-radius:var(--radius-md)" onclick="window.openBookingModal()">
              Book Strategy Session →
            </button>
          </div>

          <!-- Engineering Approach Card -->
          <div class="contact-info-card" style="background:linear-gradient(135deg,rgba(108,99,255,0.08),rgba(0,212,170,0.05));border-color:var(--border-accent)">
            <div style="font-size:1.8rem;margin-bottom:0.75rem">🛡️</div>
            <h4 style="margin-bottom:0.5rem">Engineer-to-Client Model</h4>
            <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">
              We eliminate non-technical intermediaries. You interface directly with technical architects and software engineers who build, ship, and take ownership of your systems.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section" style="background:var(--bg-surface)">
    <div class="container">
      <div class="section-header reveal">
        <span class="badge badge--primary">Technical FAQ</span>
        <h2>Answers Before We <span class="text-gradient">Begin</span></h2>
      </div>

      <div style="max-width:760px;margin:0 auto" class="reveal">
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">How does CypressIQ structure custom engineering projects?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">
            Every project begins with a structured architecture &amp; discovery phase to align requirements, data schemas, API contracts, and user flows. We then develop in iterative sprints with continuous code deployment, automated testing, and milestone check-ins.
          </div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">How quickly can Opero be deployed for an existing business?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">
            Standard Opero deployments (multi-branch POS, inventory catalog, payroll, basic reporting) take between 2 to 4 weeks. This includes catalog migration from legacy Excel sheets, staff role configuration, and hardware setup (receipt printers, barcode scanners).
          </div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">Can ITIKIA Campaign handle high concurrent traffic and live rallies?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">
            Yes. ITIKIA is engineered on cloud infrastructure with edge caching, automated database replication, and resilient SMS/USSD fallbacks designed specifically to handle traffic spikes during major national broadcasts, manifesto launches, and live rallies.
          </div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">Do you support legacy system migration and API integrations?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">
            Yes. A core part of our digital transformation practice is connecting siloed databases, extracting data from legacy software, and engineering real-time bi-directional integrations with third-party tools, payment gateways, and banking APIs.
          </div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">What does post-launch support and SLA cover?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">
            All custom systems include 30 to 60 days of guaranteed hypercare post-deployment. Afterward, we offer structured engineering maintenance retainers covering security updates, continuous backups, server monitoring, performance tuning, and planned feature expansions.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Ready to Engineer Reliable Systems?</h2>
        <p>Book a technical consultation or send an inquiry. We look forward to building with you.</p>
        <a href="#main-contact-form" class="btn btn--light btn--lg">Start Technical Inquiry →</a>
      </div>
    </div>
  </section>

  <!-- CUSTOM BOOKING MODAL (Zero External Dependencies) -->
  <div id="booking-modal-overlay" class="custom-modal-backdrop" onclick="if(event.target===this)window.closeBookingModal()">
    <div class="custom-modal-content">
      <button type="button" class="custom-modal-close" onclick="window.closeBookingModal()">&times;</button>
      <div style="font-size:2rem;margin-bottom:0.75rem">📅</div>
      <h3 style="font-size:1.35rem;margin-bottom:0.35rem">Confirm Architecture Session</h3>
      <p style="color:var(--text-secondary);font-size:0.875rem;margin-bottom:1.5rem">
        Selected Slot: <strong id="modal-slot-display" style="color:var(--clr-primary-light)">None</strong>
      </p>

      <div id="booking-modal-alert" class="notification-alert"></div>

      <form id="booking-modal-form" onsubmit="window.submitBookingModal(event)" style="display:flex;flex-direction:column;gap:1rem">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" id="bm-name" class="form-input" placeholder="e.g. Jane Doe" required />
        </div>
        <div class="form-group">
          <label class="form-label">Work Email *</label>
          <input type="email" id="bm-email" class="form-input" placeholder="jane@company.com" required />
        </div>
        <div class="form-group">
          <label class="form-label">Phone Number / WhatsApp</label>
          <input type="tel" id="bm-phone" class="form-input" placeholder="+254 700 000 000" />
        </div>
        <button type="submit" id="bm-submit-btn" class="btn btn--primary btn--lg" style="margin-top:0.5rem">
          Confirm Consultation Appointment
        </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    window.toggleFaq = function(element) {
      element.classList.toggle('open');
      const answer = element.querySelector('.faq-answer');
      answer.classList.toggle('open');
    };

    window.selectedTimeSlot = null;

    window.selectSlot = function(button) {
      document.querySelectorAll('.slot-btn').forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');
      window.selectedTimeSlot = button.innerText;
      const helper = document.getElementById('booking-slot-helper');
      if (helper) {
        helper.innerText = `Selected: ${window.selectedTimeSlot}`;
      }
    };

    window.openBookingModal = function() {
      const helper = document.getElementById('booking-slot-helper');
      if (!window.selectedTimeSlot) {
        if (helper) {
          helper.innerText = '⚠️ Please click to select one of the available time slots above first.';
          helper.style.color = '#ff6b81';
        }
        return;
      }
      document.getElementById('modal-slot-display').innerText = window.selectedTimeSlot;
      const alertBox = document.getElementById('booking-modal-alert');
      alertBox.className = 'notification-alert';
      alertBox.style.display = 'none';
      document.getElementById('booking-modal-overlay').classList.add('active');
    };

    window.closeBookingModal = function() {
      document.getElementById('booking-modal-overlay').classList.remove('active');
    };

    window.submitBookingModal = async function(event) {
      event.preventDefault();
      const name = document.getElementById('bm-name').value.trim();
      const email = document.getElementById('bm-email').value.trim();
      const phone = document.getElementById('bm-phone').value.trim();
      const btn = document.getElementById('bm-submit-btn');
      const alertBox = document.getElementById('booking-modal-alert');

      if (!name || !email) {
        alertBox.innerText = 'Name and Work Email are required.';
        alertBox.className = 'notification-alert error';
        return;
      }

      btn.disabled = true;
      btn.innerText = 'Confirming Booking...';

      try {
        const res = await fetch('/booking-submit', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            name: name,
            email: email,
            phone: phone,
            preferred_time_slot: window.selectedTimeSlot
          })
        });

        const data = await res.json();

        if (data.success) {
          alertBox.innerText = data.message || 'Consultation session booked successfully!';
          alertBox.className = 'notification-alert success';
          document.getElementById('booking-modal-form').reset();
          setTimeout(() => {
            window.closeBookingModal();
            document.querySelectorAll('.slot-btn.selected').forEach(b => b.classList.remove('selected'));
            window.selectedTimeSlot = null;
            const helper = document.getElementById('booking-slot-helper');
            if (helper) helper.innerText = '✅ Session confirmed. Check your email for details.';
          }, 2000);
        } else {
          alertBox.innerText = 'There was a problem confirming your booking. Please try again.';
          alertBox.className = 'notification-alert error';
        }
      } catch (err) {
        console.error(err);
        alertBox.innerText = 'Network error. Please try again or email us directly.';
        alertBox.className = 'notification-alert error';
      } finally {
        btn.disabled = false;
        btn.innerText = 'Confirm Consultation Appointment';
      }
    };

    window.submitContactForm = async function(event) {
      event.preventDefault();
      const form = event.target;
      const btn = document.getElementById('contact-submit-btn');
      const alertBox = document.getElementById('contact-alert');

      btn.disabled = true;
      btn.innerText = 'Transmitting Inquiry...';
      alertBox.style.display = 'none';

      try {
        const response = await fetch('/contact-submit', {
          method: 'POST',
          body: new FormData(form),
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        });

        const data = await response.json();

        if (data.success) {
          alertBox.innerText = data.message || 'Thank you! Your message has been sent to our engineering team.';
          alertBox.className = 'notification-alert success';
          form.reset();
        } else {
          alertBox.innerText = 'There was a problem submitting your message. Please review the fields and try again.';
          alertBox.className = 'notification-alert error';
        }
      } catch (error) {
        console.error(error);
        alertBox.innerText = 'Network error. Please reach out via email or phone directly.';
        alertBox.className = 'notification-alert error';
      } finally {
        btn.disabled = false;
        btn.innerText = 'Submit Technical Inquiry →';
      }
    };
  </script>
@endsection