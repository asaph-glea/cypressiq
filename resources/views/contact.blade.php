@extends('layouts.app')
@section('title', 'Contact Us — Book a Free Strategy Audit')

@php
  $settings = \App\Models\ContactSetting::firstOrCreate(['id' => 1], [
    'company_email' => 'hello@cypressiqagency.com',
    'phone_number' => '+1 (555) 0123-4567',
    'whatsapp_number' => '+155501234567',
    'address' => 'Accra Business District, Ghana'
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
      padding: 0.75rem;
      background: var(--bg-glass);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-md);
      font-size: 0.8rem;
      color: var(--text-secondary);
      cursor: pointer;
      transition: all 0.2s;
      text-align: center;
    }

    .slot-btn:hover,
    .slot-btn.selected {
      background: rgba(108, 99, 255, 0.12);
      border-color: var(--clr-primary);
      color: var(--clr-primary-light);
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
      font-size: 0.9rem;
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

    @media (max-width: 900px) {
      .contact-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
  <!-- HERO -->
  <section class="page-hero" style="padding-bottom:var(--space-8)">
    <div class="hero-bg">
      <div class="hero-grid"></div>
    </div>
    <div class="container" style="position:relative;z-index:2">
      <span class="badge badge--accent" style="margin-bottom:1.5rem">📞 Get In Touch</span>
      <h1>Let's Talk About <span class="text-gradient">Your Growth</span></h1>
      <p>We respond to every inquiry within 24 hours. Book a free strategy call — no sales pressure, just real insights
        for your business.</p>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section class="section-sm">
    <div class="container">
      <div class="contact-grid reveal">
        <!-- FORM -->
        <div>
          <div
            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-2xl);padding:2.5rem">
            <h2 style="font-size:1.5rem;margin-bottom:0.5rem">Send Us a Message</h2>
            <p style="color:var(--text-secondary);font-size:0.9rem;margin-bottom:2rem">Fill out the form below and we'll
              get back to you within 24 hours.</p>

            <form id="main-contact-form" class="contact-form" style="display:flex;flex-direction:column;gap:1.25rem"
              onsubmit="window.submitContactForm(event)">
              @csrf
              <div class="grid grid-2">
                <div class="form-group">
                  <label class="form-label">First Name *</label>
                  <input type="text" name="first_name" class="form-input" placeholder="John" required />
                </div>
                <div class="form-group">
                  <label class="form-label">Last Name *</label>
                  <input type="text" name="last_name" class="form-input" placeholder="Doe" required />
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Business Email *</label>
                <input type="email" name="email" class="form-input" placeholder="john@yourcompany.com" required />
              </div>
              <div class="form-group">
                <label class="form-label">Phone / WhatsApp</label>
                <input type="tel" name="phone" class="form-input" placeholder="+1 555 0123 4567" />
              </div>
              <div class="form-group">
                <label class="form-label">What are you interested in? *</label>
                <select name="service_interest" class="form-select" required>
                  <option value="">Select a service...</option>
                  <option>Website Development</option>
                  <option>SEO Optimization</option>
                  <option>PPC Advertising</option>
                  <option>Social Media Management</option>
                  <option>Content Creation</option>
                  <option>Cypressiq ERP — Demo Request</option>
                  <option>Cypressiq ERP — Subscription</option>
                  <option>Full Digital Strategy</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Monthly Budget Range</label>
                <select name="budget_range" class="form-select">
                  <option>Under $250/month</option>
                  <option>$250 - $500/month</option>
                  <option>$500 - $1,000/month</option>
                  <option>$1,000 - $2,000/month</option>
                  <option>$2,000 - $5,000/month</option>
                  <option>$5,000 - $10,000/month</option>
                  <option>$10,000+/month</option>
                  <option>Prefer not to say</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Tell Us About Your Project</label>
                <textarea name="message" class="form-textarea"
                  placeholder="Describe your business, goals, and what you'd like help with..." rows="4"></textarea>
              </div>
              <button type="submit" id="contact-submit-btn" class="btn btn--primary btn--lg"
                style="border-radius:var(--radius-md)">
                🚀 Send Message & Book Strategy Call
              </button>
              <p style="font-size:0.75rem;color:var(--text-muted);text-align:center">By submitting, you agree to our
                Privacy Policy. We'll never share your data.</p>
            </form>
          </div>
        </div>

        <!-- INFO PANEL -->
        <div>
          <!-- Quick Contact -->
          <div class="contact-info-card" style="margin-bottom:1.5rem">
            <h3 style="font-size:1.25rem;margin-bottom:1.25rem">Reach Us Directly</h3>
            <a href="mailto:{{ $settings->company_email }}" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(108,99,255,0.15)">📧</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Email</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->company_email }}</div>
              </div>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text=Hello,%20I%20would%20like%20to%20inquire%20about%20your%20services"
              target="_blank" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(0,212,170,0.15)">📞</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Phone / WhatsApp</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->phone_number }}</div>
              </div>
            </a>
            <a href="#" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(255,107,53,0.15)">📍</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Head Office</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">{{ $settings->address }}</div>
              </div>
            </a>
            <a href="#" class="contact-method">
              <div class="contact-method-icon" style="background:rgba(46,213,115,0.15)">⏰</div>
              <div>
                <div style="font-weight:600;font-size:0.9rem">Working Hours</div>
                <div style="color:var(--text-secondary);font-size:0.8rem">Mon–Fri: 9am – 6pm GMT</div>
              </div>
            </a>
          </div>

          <!-- Book a Call -->
          <div class="contact-info-card" style="margin-bottom:1.5rem">
            <h3 style="font-size:1.1rem;margin-bottom:0.5rem">📅 Book a 30-Min Free Call</h3>
            <p style="color:var(--text-secondary);font-size:0.85rem;margin-bottom:1.25rem">Pick a date and time that works
              for you. All calls include a free mini-audit of your current digital presence.</p>
            <div style="font-size:0.8rem;font-weight:600;color:var(--text-secondary);margin-bottom:0.75rem">This Week —
              Available Slots</div>
            <div class="booking-slots" id="slots">
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Mon 9:00 AM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Mon 2:00 PM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Tue 10:00 AM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Tue 4:00 PM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Wed 11:00 AM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Thu 9:00 AM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Thu 3:00 PM</button>
              <button type="button" class="slot-btn" onclick="window.selectSlot(this)">Fri 10:00 AM</button>
            </div>
            <button type="button" class="btn btn--accent w-full" style="margin-top:1rem;border-radius:var(--radius-md)"
              onclick="window.bookSlot()">Confirm Booking</button>
          </div>

          <!-- Response Promise -->
          <div class="contact-info-card"
            style="background:linear-gradient(135deg,rgba(108,99,255,0.08),rgba(0,212,170,0.05));border-color:var(--border-accent)">
            <div style="font-size:2rem;margin-bottom:0.75rem">⚡</div>
            <h4 style="margin-bottom:0.5rem">Our Response Promise</h4>
            <p style="color:var(--text-secondary);font-size:0.875rem;line-height:1.7">We respond to every inquiry within
              <strong>24 hours</strong>. For ERP demo requests, you'll hear from us within <strong>4 hours</strong> during
              business days.
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
        <span class="badge badge--primary">❓ FAQ</span>
        <h2>Common <span class="text-gradient">Questions</span></h2>
      </div>

      <div style="max-width:720px;margin:0 auto" class="reveal">
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">How quickly can you start my project?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">For most projects, we can start within 3-5 business days after signing. For urgent
            projects, we offer a rush option with a 50% surcharge that starts within 24 hours.</div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">Do you work with businesses outside Africa?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">Absolutely! While we specialize in the African market, we work with clients globally
            across the UK, USA, Canada, UAE, and more. Our team operates in multiple time zones.</div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">How long does an Cypressiq ERP deployment take?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">A standard Cypressiq ERP deployment typically takes 2-6 weeks depending on your business
            complexity and the number of modules. We provide full training and onboarding support.</div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">Do you offer ongoing support after project completion?<span class="faq-icon">▼</span>
          </div>
          <div class="faq-answer">Yes. All projects include 30 days of post-launch support. We also offer monthly retainer
            packages for ongoing SEO, maintenance, and marketing support.</div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">What's included in the free strategy audit?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">Our free audit includes: website performance analysis, SEO health check, competitor
            benchmarking, social media review, and a personalised 30-minute consultation with a senior strategist. Valued
            at $500, completely free.</div>
        </div>
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">What payment methods do you accept?<span class="faq-icon">▼</span></div>
          <div class="faq-answer">We accept bank transfers, credit/debit cards, PayPal, Stripe, and mobile money (MTN
            MoMo, Flutterwave). Flexible payment plans available for larger projects.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-sm">
    <div class="container">
      <div class="cta-section reveal">
        <h2>Your Growth Journey<br />Starts with One Conversation</h2>
        <p>Book a free 30-minute call. Zero commitment. 100% value.</p>
        <a href="#main-contact-form" class="btn btn--light btn--lg">Book Free Call 📞</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
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
    };

    window.submitContactForm = async function(event) {
      event.preventDefault();
      const form = event.target;
      const btn = document.getElementById('contact-submit-btn');
      btn.disabled = true;
      btn.innerText = 'Sending...';

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
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              title: 'Success!',
              text: data.message,
              icon: 'success',
              confirmButtonText: 'Okay'
            });
          } else {
            alert("Success! " + data.message);
          }
          form.reset();
        } else {
          if (typeof Swal !== 'undefined') Swal.fire('Error', 'There was a problem submitting your message. Please try again.', 'error');
          else alert("Error submitting your message. Please try again.");
        }
      } catch (error) {
        console.error(error);
        if (typeof Swal !== 'undefined') Swal.fire('Error', 'There was a network or server problem submitting your message. Please review the console log.', 'error');
        else alert("Network error. Please try again.");
      } finally {
        btn.disabled = false;
        btn.innerText = '🚀 Send Message & Book Strategy Call';
      }
    };

    window.bookSlot = async function() {
      if (!window.selectedTimeSlot) {
        if (typeof Swal !== 'undefined') Swal.fire('Please select a time slot', 'You need to select an available time before confirming.', 'warning');
        else alert("Please select a time slot before confirming.");
        return;
      }

      if (typeof Swal === 'undefined') {
        alert("Booking system requires SweetAlert to be loaded. Please ensure JavaScript is enabled and disable adblockers.");
        return;
      }

      const { value: formValues } = await Swal.fire({
        title: `Confirm Booking for ${window.selectedTimeSlot}`,
        html: `
                      <input id="swal-name" class="swal2-input" placeholder="Your Full Name">
                      <input id="swal-email" type="email" class="swal2-input" placeholder="Your Email Address">
                      <input id="swal-phone" class="swal2-input" placeholder="Your Phone Number (Optional)">
                  `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Book Strategy Call',
        preConfirm: () => {
          const name = document.getElementById('swal-name').value;
          const email = document.getElementById('swal-email').value;
          const phone = document.getElementById('swal-phone').value;

          if (!name || !email) {
            Swal.showValidationMessage('Name and Email are required!');
            return false;
          }

          return { name, email, phone };
        }
      });

      if (formValues) {
        Swal.fire({ title: 'Booking...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });

        try {
          const res = await fetch('/booking-submit', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              name: formValues.name,
              email: formValues.email,
              phone: formValues.phone,
              preferred_time_slot: window.selectedTimeSlot
            })
          });

          const data = await res.json();

          if (data.success) {
            Swal.fire('Confirmed!', data.message, 'success');
            document.querySelectorAll('.slot-btn.selected').forEach(btn => btn.classList.remove('selected'));
            window.selectedTimeSlot = null;
          } else {
            Swal.fire('Error', 'There was a problem confirming your booking.', 'error');
          }
        } catch (err) {
          console.error(err);
          Swal.fire('Error', 'Network error or server error. Please try again.', 'error');
        }
      }
    };
  </script>
@endsection