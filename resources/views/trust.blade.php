@extends('layouts.app')

@section('title', 'Trust, Track Record & Client Social Proof — CypressIQ')
@section('meta_description', 'Explore verified client testimonials, delivered enterprise projects including Opero and ITIKIA, and strategic technology partnerships that demonstrate CypressIQ\'s reliability and engineering excellence.')

@section('css')
<style>
  /* ══════════════════════════════════════════════════════════
     CYPRESSIQ TRUST & CREDIBILITY — MASTER STYLESHEET
     ══════════════════════════════════════════════════════════ */

  .trust-hero {
    position: relative;
    padding: calc(var(--nav-h) + 3.5rem) 0 4.5rem;
    overflow: hidden;
    text-align: center;
  }
  .trust-hero__glow {
    position: absolute;
    top: -20%;
    left: 50%;
    transform: translateX(-50%);
    width: 900px;
    height: 550px;
    background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.22) 0%, rgba(0, 212, 170, 0.12) 40%, transparent 70%);
    pointer-events: none;
    z-index: 1;
    filter: blur(40px);
  }

  .trust-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.45rem 1.25rem;
    border-radius: var(--radius-full);
    background: rgba(108, 99, 255, 0.12);
    border: 1px solid rgba(108, 99, 255, 0.35);
    color: var(--clr-primary-light);
    font-size: 0.825rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 1.75rem;
    box-shadow: 0 4px 20px rgba(108, 99, 255, 0.18);
  }
  .trust-hero__badge .pulse-dot {
    width: 8px;
    height: 8px;
    background: var(--clr-accent);
    border-radius: 50%;
    box-shadow: 0 0 10px var(--clr-accent);
    animation: trustPulse 2s infinite ease-in-out;
  }
  @keyframes trustPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.4); opacity: 0.6; }
  }

  .trust-hero__headline {
    font-size: clamp(2.4rem, 5.2vw, 4rem);
    font-weight: 800;
    line-height: 1.15;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
  }

  .trust-hero__sub {
    font-size: 1.15rem;
    color: var(--text-secondary);
    max-width: 720px;
    margin: 0 auto 2.5rem;
    line-height: 1.8;
  }

  .trust-hero__actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3.5rem;
  }

  /* Stats Counter Grid */
  .trust-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    max-width: 1050px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
  }
  .trust-stat-box {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 1.75rem 1.25rem;
    text-align: center;
    backdrop-filter: blur(12px);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
  }
  .trust-stat-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s;
  }
  .trust-stat-box:hover {
    transform: translateY(-4px);
    border-color: rgba(108, 99, 255, 0.4);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
  }
  .trust-stat-box:hover::before {
    opacity: 1;
  }
  .trust-stat-val {
    font-family: var(--font-display);
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1.1;
    margin-bottom: 0.35rem;
  }
  .trust-stat-lbl {
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-muted);
  }

  /* ─── Engineering Commitments Bar ─── */
  .commitments-strip {
    background: var(--bg-surface);
    border-top: 1px solid var(--border-subtle);
    border-bottom: 1px solid var(--border-subtle);
    padding: 2.5rem 0;
    position: relative;
    z-index: 2;
  }
  .commitments-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
  }
  .commitment-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
  }
  .commitment-icon {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-md);
    background: rgba(108, 99, 255, 0.12);
    border: 1px solid rgba(108, 99, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
  }
  .commitment-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
  }
  .commitment-desc {
    font-size: 0.825rem;
    color: var(--text-secondary);
    line-height: 1.55;
  }

  /* ─── Sections Shared Layout ─── */
  .trust-section {
    padding: 6rem 0;
    position: relative;
  }
  .trust-section--alt {
    background: var(--bg-surface);
  }
  .section-head {
    text-align: center;
    max-width: 750px;
    margin: 0 auto 3.5rem;
  }
  .section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 1rem;
    border-radius: var(--radius-full);
    background: rgba(0, 212, 170, 0.1);
    border: 1px solid rgba(0, 212, 170, 0.25);
    color: var(--clr-accent);
    font-size: 0.775rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 1rem;
  }
  .section-title {
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 800;
    line-height: 1.2;
    color: var(--text-primary);
    margin-bottom: 1rem;
  }
  .section-sub {
    font-size: 1.05rem;
    color: var(--text-secondary);
    line-height: 1.7;
  }

  /* ─── Filter Pills Bar ─── */
  .filter-pills {
    display: flex;
    gap: 0.65rem;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 3rem;
  }
  .filter-pill {
    padding: 0.55rem 1.25rem;
    border-radius: var(--radius-full);
    font-size: 0.85rem;
    font-weight: 600;
    border: 1px solid var(--border-mid);
    color: var(--text-secondary);
    background: var(--bg-card);
    cursor: pointer;
    transition: all 0.25s ease;
  }
  .filter-pill:hover,
  .filter-pill.active {
    background: var(--gradient-primary);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 18px rgba(108, 99, 255, 0.3);
    transform: translateY(-2px);
  }

  /* ─── Testimonials Grid ─── */
  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
  }
  .testimonial-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: var(--shadow-card);
  }
  .testimonial-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 10% 10%, rgba(108, 99, 255, 0.08), transparent 60%);
    pointer-events: none;
  }
  .testimonial-card:hover {
    transform: translateY(-5px);
    border-color: rgba(108, 99, 255, 0.45);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4), 0 0 25px rgba(108, 99, 255, 0.15);
  }
  .testimonial-watermark {
    position: absolute;
    right: 1.5rem;
    top: 1rem;
    font-family: Georgia, serif;
    font-size: 7rem;
    line-height: 1;
    color: rgba(255, 255, 255, 0.035);
    pointer-events: none;
    user-select: none;
  }
  .testimonial-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 2;
  }
  .testimonial-stars {
    display: flex;
    gap: 0.25rem;
    color: #f59e0b;
    font-size: 1.05rem;
  }
  .testimonial-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
    background: rgba(16, 185, 129, 0.12);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #34d399;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }
  .testimonial-quote {
    font-size: 1.05rem;
    color: #e2e8f0;
    line-height: 1.8;
    margin: 0 0 2rem;
    position: relative;
    z-index: 2;
    font-style: normal;
  }
  .testimonial-author-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.25rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-subtle);
    margin-top: auto;
    position: relative;
    z-index: 2;
    flex-wrap: wrap;
  }
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .testimonial-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(108, 99, 255, 0.5);
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
    flex-shrink: 0;
  }
  .testimonial-avatar--initials {
    background: linear-gradient(135deg, #6C63FF, #00D4AA);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 800;
    font-size: 1.2rem;
    border: 2px solid rgba(255, 255, 255, 0.15);
  }
  .testimonial-author-info strong {
    display: block;
    color: var(--text-primary);
    font-size: 1rem;
    font-weight: 700;
  }
  .testimonial-author-info span {
    display: block;
    color: var(--text-secondary);
    font-size: 0.825rem;
    margin-top: 0.2rem;
  }
  .testimonial-solution-tag {
    display: inline-block;
    padding: 0.3rem 0.85rem;
    border-radius: var(--radius-full);
    background: rgba(108, 99, 255, 0.12);
    border: 1px solid rgba(108, 99, 255, 0.25);
    color: var(--clr-primary-light);
    font-size: 0.75rem;
    font-weight: 600;
  }
  .testimonial-site-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--clr-accent);
    text-decoration: none;
    transition: color 0.2s;
  }
  .testimonial-site-btn:hover {
    color: var(--clr-accent-light);
    text-decoration: underline;
  }

  /* ─── Projects Showcase Grid ─── */
  .projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 2.25rem;
  }
  .project-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: var(--shadow-card);
  }
  .project-card:hover {
    transform: translateY(-6px);
    border-color: rgba(0, 212, 170, 0.45);
    box-shadow: 0 24px 50px rgba(0, 0, 0, 0.45), 0 0 30px rgba(0, 212, 170, 0.15);
  }
  .project-card__preview {
    height: 220px;
    position: relative;
    overflow: hidden;
    background: #090e1a;
  }
  .project-card__preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .project-card:hover .project-card__preview img {
    transform: scale(1.05);
  }
  .project-card__preview-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(13, 18, 33, 0.95) 0%, rgba(13, 18, 33, 0.2) 60%, transparent 100%);
  }
  .project-card__status-pill {
    position: absolute;
    top: 1rem;
    left: 1rem;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.3rem 0.8rem;
    border-radius: var(--radius-full);
    background: rgba(8, 11, 20, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .project-card__status-pill .status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--clr-accent);
    box-shadow: 0 0 8px var(--clr-accent);
  }
  .project-card__body {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  .project-card__meta-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-bottom: 0.85rem;
  }
  .project-card__category-tag {
    font-size: 0.725rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--clr-accent);
  }
  .project-card__industry-tag {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-weight: 500;
  }
  .project-card__title {
    font-family: var(--font-display);
    font-size: 1.28rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.35;
    margin-bottom: 0.5rem;
  }
  .project-card__client-line {
    font-size: 0.825rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.35rem;
    margin-bottom: 1rem;
  }
  .project-card__summary {
    font-size: 0.885rem;
    color: var(--text-secondary);
    line-height: 1.65;
    margin-bottom: 1.25rem;
  }
  .project-card__tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
    margin-bottom: 1.5rem;
  }
  .project-tech-pill {
    padding: 0.25rem 0.65rem;
    border-radius: var(--radius-sm);
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    font-family: var(--font-mono);
    font-size: 0.725rem;
    color: var(--text-secondary);
  }
  .project-card__outcomes {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 1rem 1.25rem;
  }
  .project-card__outcomes li {
    font-size: 0.825rem;
    color: #cbd5e1;
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    line-height: 1.5;
    margin-bottom: 0.45rem;
  }
  .project-card__outcomes li:last-child {
    margin-bottom: 0;
  }
  .project-card__outcomes li::before {
    content: '✓';
    color: var(--clr-accent);
    font-weight: 800;
    font-size: 0.85rem;
    line-height: 1.4;
    flex-shrink: 0;
  }
  .project-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1.25rem;
    border-top: 1px solid var(--border-subtle);
    margin-top: auto;
    font-size: 0.8rem;
    color: var(--text-muted);
  }
  .project-card__cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--clr-primary-light);
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .project-card__cta-btn:hover {
    color: var(--clr-accent);
    transform: translateX(3px);
  }

  /* ─── Partnerships Grid ─── */
  .partnerships-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.75rem;
  }
  .partner-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 2.25rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }
  .partner-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s;
  }
  .partner-card:hover {
    transform: translateY(-4px);
    border-color: rgba(108, 99, 255, 0.4);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
  }
  .partner-card:hover::before {
    opacity: 1;
  }
  .partner-card__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }
  .partner-card__icon-box {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    background: rgba(108, 99, 255, 0.12);
    border: 1px solid rgba(108, 99, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
  }
  .partner-card__type-badge {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--clr-primary-light);
    background: rgba(108, 99, 255, 0.12);
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
  }
  .partner-card__name {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.65rem;
  }
  .partner-card__desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.65;
    margin-bottom: 1.5rem;
  }
  .partner-card__link {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--clr-accent);
    text-decoration: none;
    transition: color 0.2s;
  }
  .partner-card__link:hover {
    color: var(--clr-accent-light);
    text-decoration: underline;
  }

  /* ─── Bottom CTA Strip ─── */
  .trust-cta {
    position: relative;
    padding: 6.5rem 0;
    overflow: hidden;
    background: radial-gradient(circle at 50% 50%, rgba(108, 99, 255, 0.15) 0%, rgba(13, 18, 33, 0.95) 75%);
    border-top: 1px solid var(--border-subtle);
    text-align: center;
  }
  .trust-cta__inner {
    max-width: 820px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
  }
  .trust-cta h2 {
    font-size: clamp(2.2rem, 4.5vw, 3.2rem);
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1.2;
    margin-bottom: 1.25rem;
  }
  .trust-cta p {
    font-size: 1.125rem;
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: 2.5rem;
  }
  .trust-cta__actions {
    display: flex;
    gap: 1.25rem;
    justify-content: center;
    flex-wrap: wrap;
  }

  /* Responsive Adjustments */
  @media (max-width: 1024px) {
    .trust-stats-grid { grid-template-columns: repeat(2, 1fr); }
    .commitments-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .testimonials-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 768px) {
    .projects-grid { grid-template-columns: 1fr; }
    .commitments-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 480px) {
    .trust-stats-grid { grid-template-columns: 1fr; }
    .trust-hero__actions { flex-direction: column; width: 100%; }
    .trust-hero__actions .btn { width: 100%; justify-content: center; }
  }
</style>
@endsection

@section('content')

{{-- ══════════════════════════════════════════════════════════
     1. TRUST HERO SECTION
     ══════════════════════════════════════════════════════════ --}}
<section class="trust-hero">
  <div class="hero-bg"><div class="hero-grid"></div></div>
  <div class="trust-hero__glow"></div>

  <div class="container relative" style="z-index:2">
    <div class="trust-hero__badge reveal">
      <span class="pulse-dot"></span>
      <span>Social Proof &amp; Track Record</span>
    </div>

    <h1 class="trust-hero__headline reveal">
      Built on Proof.<br>
      Proven by <span class="text-gradient">Production Results.</span>
    </h1>

    <p class="trust-hero__sub reveal">
      Explore client testimonials, live software deployments, and strategic technology alliances that demonstrate CypressIQ's disciplined engineering and positive business outcomes.
    </p>

    <div class="trust-hero__actions reveal">
      <a href="#projects" class="btn btn--primary btn--lg">Explore Delivered Work ↓</a>
      <a href="#testimonials" class="btn btn--secondary btn--lg">Read Client Reviews ★</a>
      <a href="{{ route('contact') }}" class="btn btn--outline btn--lg">Partner With Us →</a>
    </div>

    <!-- Live Metric Stat Boxes -->
    <div class="trust-stats-grid reveal">
      <div class="trust-stat-box">
        <div class="trust-stat-val text-gradient">{{ $projects->count() ?: '6+' }}</div>
        <div class="trust-stat-lbl">Enterprise Projects Delivered</div>
      </div>
      <div class="trust-stat-box">
        <div class="trust-stat-val" style="color:var(--clr-accent)">250k+</div>
        <div class="trust-stat-lbl">Active System Users</div>
      </div>
      <div class="trust-stat-box">
        <div class="trust-stat-val" style="color:var(--clr-primary-light)">99.98%</div>
        <div class="trust-stat-lbl">Production Uptime SLA</div>
      </div>
      <div class="trust-stat-box">
        <div class="trust-stat-val" style="color:#f59e0b">5.0 ★</div>
        <div class="trust-stat-lbl">Client Review Score</div>
      </div>
    </div>
  </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     2. ENGINEERING COMMITMENTS STRIP
     ══════════════════════════════════════════════════════════ --}}
<div class="commitments-strip">
  <div class="container">
    <div class="commitments-grid">
      <div class="commitment-item reveal">
        <div class="commitment-icon">🛡️</div>
        <div>
          <div class="commitment-title">Production-First Reliability</div>
          <div class="commitment-desc">Zero unmonitored code. Instrumented with telemetry, offline resilience, and healthchecks.</div>
        </div>
      </div>
      <div class="commitment-item reveal">
        <div class="commitment-icon">🔒</div>
        <div>
          <div class="commitment-title">IP &amp; Data Security</div>
          <div class="commitment-desc">Strict mutual NDAs, dedicated VPC infrastructure, and encrypted patient/financial data stores.</div>
        </div>
      </div>
      <div class="commitment-item reveal">
        <div class="commitment-icon">⚡</div>
        <div>
          <div class="commitment-title">Post-Launch Warranty</div>
          <div class="commitment-desc">Continuous performance monitoring, automated offsite backups, and incident response SLAs.</div>
        </div>
      </div>
      <div class="commitment-item reveal">
        <div class="commitment-icon">📜</div>
        <div>
          <div class="commitment-title">Full Code Ownership</div>
          <div class="commitment-desc">100% intellectual property transfer, clean Git repositories, and complete CI/CD documentation.</div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     3. CLIENT TESTIMONIALS SECTION
     ══════════════════════════════════════════════════════════ --}}
<section class="trust-section" id="testimonials">
  <div class="container">
    <div class="section-head reveal">
      <div class="section-badge">⭐ Client Feedback &amp; Endorsements</div>
      <h2 class="section-title">What organizations say about partnering with CypressIQ</h2>
      <p class="section-sub">Direct feedback from executives, ministry leaders, and operational directors who rely on our software and custom technology.</p>
    </div>

    @if($testimonials->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--text-muted);background:var(--bg-card);border-radius:var(--radius-xl);border:1px solid var(--border-subtle)">
      <div style="font-size:3rem;margin-bottom:1rem">💬</div>
      <p>Testimonial records are currently syncing. Please refresh or check back shortly.</p>
    </div>
    @else
    <div class="testimonials-grid">
      @foreach($testimonials as $t)
      <article class="testimonial-card reveal">
        <div class="testimonial-watermark">“</div>

        <div>
          <div class="testimonial-top">
            <div class="testimonial-stars">
              @for($i = 1; $i <= 5; $i++)
                <span>{{ $i <= $t->rating ? '★' : '☆' }}</span>
              @endfor
            </div>
            <div class="testimonial-badge">✓ Verified Engagement</div>
          </div>

          <blockquote class="testimonial-quote">
            "{!! e($t->quote) !!}"
          </blockquote>
        </div>

        <div class="testimonial-author-wrap">
          <div class="testimonial-author">
            @if($t->client_avatar)
              <img src="{{ $t->client_avatar }}" alt="{{ $t->client_name }}" class="testimonial-avatar" loading="lazy">
            @else
              <div class="testimonial-avatar testimonial-avatar--initials">
                {{ strtoupper(substr($t->client_name, 0, 1)) }}
              </div>
            @endif
            <div class="testimonial-author-info">
              <strong>{{ $t->client_name }}</strong>
              <span>
                {{ implode(' • ', array_filter([$t->client_role, $t->client_company])) }}
              </span>
            </div>
          </div>

          <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.4rem">
            @if($t->product_or_solution)
              <span class="testimonial-solution-tag">{{ $t->product_or_solution }}</span>
            @endif

            {{-- Link directly to client websites if recognized --}}
            @if(str_contains(strtolower($t->client_company), 'neema') || str_contains(strtolower($t->client_name), 'pcea'))
              <a href="https://pceaneemanakuru.com/" target="_blank" rel="noopener" class="testimonial-site-btn">Visit pceaneemanakuru.com ↗</a>
            @elseif(str_contains(strtolower($t->client_company), 'karoki') || str_contains(strtolower($t->client_name), 'karoki'))
              <a href="https://amoskaroki.com/" target="_blank" rel="noopener" class="testimonial-site-btn">Visit amoskaroki.com ↗</a>
            @endif
          </div>
        </div>
      </article>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     4. DELIVERED PROJECTS & CASE STUDIES SECTION
     ══════════════════════════════════════════════════════════ --}}
<section class="trust-section trust-section--alt" id="projects">
  <div class="container">
    <div class="section-head reveal">
      <div class="section-badge">🏗️ Verified Production Track Record</div>
      <h2 class="section-title">Projects &amp; Systems We Have Delivered</h2>
      <p class="section-sub">A curated portfolio of proprietary software products, enterprise client platforms, and high-concurrency systems currently in production.</p>
    </div>

    <!-- Filter Buttons -->
    <div class="filter-pills reveal">
      <button class="filter-pill active" onclick="filterProjects('all', this)">All Deployments ({{ $projects->count() }})</button>
      <button class="filter-pill" onclick="filterProjects('Digital Products', this)">Proprietary Products</button>
      <button class="filter-pill" onclick="filterProjects('Web Development', this)">Web Platforms</button>
      <button class="filter-pill" onclick="filterProjects('Business Systems', this)">Business Systems</button>
      <button class="filter-pill" onclick="filterProjects('Automation & Integrations', this)">Automation &amp; IoT</button>
      <button class="filter-pill" onclick="filterProjects('Digital Platforms', this)">Healthcare &amp; Portals</button>
    </div>

    @if($projects->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--text-muted);background:var(--bg-card);border-radius:var(--radius-xl);border:1px solid var(--border-subtle)">
      <div style="font-size:3rem;margin-bottom:1rem">🚀</div>
      <p>Project records are syncing. Please refresh or check back shortly.</p>
    </div>
    @else
    <div class="projects-grid">
      @foreach($projects as $proj)
      <article class="project-card reveal" data-category="{{ $proj->category }}">
        <div class="project-card__preview">
          @if($proj->cover_image)
            <img src="{{ $proj->cover_image }}" alt="{{ $proj->title }}" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#0d1221,#1e1b4b);display:flex;align-items:center;justify-content:center;color:var(--clr-primary);font-size:2.5rem;font-weight:800">
              {{ strtoupper(substr($proj->category, 0, 2)) }}
            </div>
          @endif
          <div class="project-card__preview-overlay"></div>
          
          <div class="project-card__status-pill">
            <span class="status-dot"></span>
            <span>{{ $proj->category === 'Digital Products' ? 'Proprietary Software' : 'Live Client Platform' }}</span>
          </div>
        </div>

        <div class="project-card__body">
          <div class="project-card__meta-bar">
            <span class="project-card__category-tag">{{ $proj->category }}</span>
            @if($proj->industry)
              <span class="project-card__industry-tag">{{ $proj->industry }}</span>
            @endif
          </div>

          <h3 class="project-card__title">{{ $proj->title }}</h3>

          @if($proj->client_name)
            <div class="project-card__client-line">
              <span>🏛️</span>
              <span>Client / Organization: <strong>{{ $proj->client_name }}</strong></span>
            </div>
          @endif

          <p class="project-card__summary">{{ $proj->summary }}</p>

          @if($proj->technologies && count($proj->technologies) > 0)
          <div class="project-card__tech-tags">
            @foreach(array_slice($proj->technologies, 0, 6) as $tech)
              <span class="project-tech-pill">{{ $tech }}</span>
            @endforeach
          </div>
          @endif

          @if($proj->outcomes && count($proj->outcomes) > 0)
          <ul class="project-card__outcomes">
            @foreach($proj->outcomes as $outcome)
              <li>{{ $outcome }}</li>
            @endforeach
          </ul>
          @endif

          <div class="project-card__footer">
            <div>
              @if($proj->duration)
                <span>⏱ {{ $proj->duration }}</span>
              @elseif($proj->completed_at)
                <span>📅 {{ $proj->completed_at->format('M Y') }}</span>
              @else
                <span>⚡ Active Production</span>
              @endif
            </div>

            @if($proj->project_url)
              @php
                $isExternal = str_starts_with($proj->project_url, 'http');
              @endphp
              <a href="{{ $proj->project_url }}" 
                 @if($isExternal) target="_blank" rel="noopener" @endif 
                 class="project-card__cta-btn">
                {{ $isExternal ? 'Visit Live Platform ↗' : 'Explore Platform →' }}
              </a>
            @endif
          </div>
        </div>
      </article>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     5. STRATEGIC TECHNOLOGY PARTNERSHIPS SECTION
     ══════════════════════════════════════════════════════════ --}}
<section class="trust-section" id="partnerships">
  <div class="container">
    <div class="section-head reveal">
      <div class="section-badge">🤝 Strategic Alliances &amp; Integrations</div>
      <h2 class="section-title">Technology Partners &amp; Ecosystem</h2>
      <p class="section-sub">We integrate and collaborate with globally trusted cloud, telecom, and payment infrastructure leaders to guarantee extreme resilience.</p>
    </div>

    @if($partnerships->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--text-muted);background:var(--bg-card);border-radius:var(--radius-xl);border:1px solid var(--border-subtle)">
      <div style="font-size:3rem;margin-bottom:1rem">🤝</div>
      <p>Partnership profiles are syncing. Please refresh or check back shortly.</p>
    </div>
    @else
    <div class="partnerships-grid">
      @foreach($partnerships as $partner)
      <div class="partner-card reveal">
        <div>
          <div class="partner-card__header">
            <div class="partner-card__icon-box">
              @if(str_contains(strtolower($partner->partner_name), 'aws') || str_contains(strtolower($partner->partner_name), 'amazon'))
                ☁️
              @elseif(str_contains(strtolower($partner->partner_name), 'safaricom') || str_contains(strtolower($partner->partner_name), 'mpesa'))
                📱
              @elseif(str_contains(strtolower($partner->partner_name), 'stripe') || str_contains(strtolower($partner->partner_name), 'payment'))
                💳
              @elseif(str_contains(strtolower($partner->partner_name), 'twilio') || str_contains(strtolower($partner->partner_name), 'africa'))
                📡
              @else
                ⚡
              @endif
            </div>
            <span class="partner-card__type-badge">{{ ucfirst($partner->partnership_type) }}</span>
          </div>

          <h3 class="partner-card__name">{{ $partner->partner_name }}</h3>

          @if($partner->description)
            <p class="partner-card__desc">{{ $partner->description }}</p>
          @endif
        </div>

        @if($partner->partner_website)
          <div>
            <a href="{{ $partner->partner_website }}" target="_blank" rel="noopener" class="partner-card__link">
              Explore Integration Specs ↗
            </a>
          </div>
        @endif
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     6. HIGH-CONVERTING BOTTOM CTA SECTION
     ══════════════════════════════════════════════════════════ --}}
<section class="trust-cta">
  <div class="hero-bg"><div class="hero-grid"></div></div>
  <div class="container">
    <div class="trust-cta__inner reveal">
      <div class="section-badge" style="margin-bottom:1.25rem">🚀 Build With Confidence</div>
      <h2>Ready to Architect Your Next Reliable System?</h2>
      <p>Join forward-thinking companies, ministries, and campaigns that rely on CypressIQ for mission-critical software, custom business portals, and operational scale.</p>
      
      <div class="trust-cta__actions">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Schedule Engineering Consultation →</a>
        <a href="{{ route('portfolio') }}" class="btn btn--secondary btn--lg">Review Case Studies</a>
        <a href="{{ route('opero') }}" class="btn btn--outline btn--lg">Explore Opero ERP</a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  function filterProjects(category, btn) {
    // Update active button state
    document.querySelectorAll('.filter-pill').forEach(function(el) {
      el.classList.remove('active');
    });
    btn.classList.add('active');

    // Filter project cards
    var cards = document.querySelectorAll('.project-card');
    cards.forEach(function(card) {
      var cardCat = card.getAttribute('data-category') || '';
      if (category === 'all' || cardCat.toLowerCase().indexOf(category.toLowerCase()) !== -1) {
        card.style.display = 'flex';
        card.style.opacity = '0';
        setTimeout(function() {
          card.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
          card.style.opacity = '1';
        }, 30);
      } else {
        card.style.display = 'none';
      }
    });
  }
</script>
@endsection
