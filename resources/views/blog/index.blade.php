@extends('layouts.app')
@section('title', 'Blog &amp; Insights — Digital Marketing, SEO &amp; ERP Growth | CypressIq')

@section('css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}" />
@endsection

@section('content')
<!-- HERO -->
  <section class="page-hero">
    <div class="hero-bg">
      <div class="hero-grid"></div>
    </div>
    <div class="container" style="position:relative;z-index:2;text-align:center">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">📚 Blog &amp; Insights</span>
      <h1>Insights That <span class="text-gradient">Drive Growth</span></h1>
      <p style="max-width:580px;margin:0 auto">Deep-dive articles, expert strategies, and actionable guides on digital
        marketing, ERP systems, and business growth — from our team to yours.</p>

      <!-- SEARCH -->
      <div class="blog-search-wrap" style="margin-top:2rem">
        <span class="blog-search-icon">🔍</span>
        <input id="blog-search" class="blog-search" type="text" placeholder="Search articles, topics, or keywords…"
          autocomplete="off" />
        <button class="blog-search-clear" id="search-clear" aria-label="Clear search">✕</button>
      </div>
    </div>
  </section>

  <!-- FEATURED + TRENDING -->
  <section class="section">
    <div class="container">

      <!-- FEATURED POST -->
      <a href="article.html" style="text-decoration:none;color:inherit;display:block">
        <div class="featured-post reveal">
          <div class="featured-thumb"><span>🚀</span></div>
          <div class="featured-content">
            <div class="featured-meta">
              <span class="badge badge--accent">⭐ Featured</span>
              <span style="font-size:.75rem;color:var(--text-muted)">March 20, 2026 · 12 min read · 4.2k views</span>
            </div>
            <h2>How African Businesses Can 10x Revenue with Digital Marketing in 2026</h2>
            <p>The African digital economy is growing at 40% annually. We break down the exact strategies working right
              now for SMEs across Ghana, Nigeria, Kenya &amp; beyond — from SEO to social commerce.</p>
            <span class="btn btn--primary" style="align-self:flex-start">Read Full Article →</span>
          </div>
        </div>
      </a>

      <!-- CATEGORIES -->
      <div class="blog-categories reveal">
        <button class="cat-btn active" data-cat="all">🌐 All</button>
        <button class="cat-btn" data-cat="digital marketing">📣 Digital Marketing</button>
        <button class="cat-btn" data-cat="seo">🔍 SEO &amp; Growth</button>
        <button class="cat-btn" data-cat="erp">⚙️ ERP Systems</button>
        <button class="cat-btn" data-cat="business">📈 Business Growth</button>
        <button class="cat-btn" data-cat="ppc">💰 PPC</button>
        <button class="cat-btn" data-cat="web dev">🌐 Web Dev</button>
        <button class="cat-btn" data-cat="social media">📱 Social Media</button>
      </div>

      <!-- TWO COLUMNS: Articles + Trending -->
      <div style="display:grid;grid-template-columns:1fr 330px;gap:3rem;align-items:start">

        <!-- ARTICLES GRID -->
        <div>
          <div class="blog-grid stagger">

            @forelse ($posts as $post)
            <div class="blog-card reveal" data-category="{{ strtolower($post->category->name ?? 'general') }}">
              <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit;display:contents">
                <div class="blog-thumb" style="background:linear-gradient(135deg,#1a0533,#2d1b69)"><span>📝</span>
                  <div
                    style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(108,99,255,.5),rgba(0,212,170,.3))">
                  </div>
                </div>
                <div class="blog-body">
                  <div class="blog-meta"><span class="badge badge--primary" style="font-size:.6rem">{{ $post->category->name ?? 'General' }}</span><span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M j, Y') : $post->created_at->format('M j, Y') }}</span></div>
                  <h3>{{ $post->title }}</h3>
                  <p>{{ \Illuminate\Support\Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
                  <div class="blog-footer">
                    <div class="blog-author">
                      <div class="author-avatar">{{ substr($post->author->name ?? 'A', 0, 1) }}</div><span>{{ $post->author->name ?? 'Admin' }}</span>
                    </div>
                    <span class="blog-read">Read →</span>
                  </div>
                </div>
              </a>
            </div>
            @empty
              <div id="no-results" class="no-results" style="grid-column: 1 / -1;">
                <div class="no-results-icon">🔎</div>
                <h3>No articles published yet</h3>
                <p>Check back soon for new content.</p>
              </div>
            @endforelse

          </div><!-- /blog-grid -->

          <div style="margin-top:2rem">
            {{ $posts->links() }}
          </div>
        </div><!-- /left col -->

        <!-- TRENDING SIDEBAR -->
        <div style="position:sticky;top:5rem">
          <div
            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.5rem;margin-bottom:1.5rem">
            <div
              style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted);margin-bottom:1rem">
              🔥 Trending This Week</div>
            <div class="trending-list">
              <a href="article.html" class="trending-item">
                <div class="trending-rank">1</div>
                <div class="trending-info">
                  <h4>From $50K to $2M: Digital Transformation Playbook</h4><span>6.7k views · 11 min</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#0a1a0a,#1a2e1a)">💰</div>
              </a>
              <a href="article.html" class="trending-item">
                <div class="trending-rank">2</div>
                <div class="trending-info">
                  <h4>Why Every SME Needs an ERP in 2026</h4><span>5.4k views · 10 min</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#001a0d,#003320)">⚙️</div>
              </a>
              <a href="article.html" class="trending-item">
                <div class="trending-rank">3</div>
                <div class="trending-info">
                  <h4>10 SEO Strategies That Tripled Traffic in 90 Days</h4><span>3.1k views · 8 min</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#1a0533,#2d1b69)">🔍</div>
              </a>
              <a href="article.html" class="trending-item">
                <div class="trending-rank">4</div>
                <div class="trending-info">
                  <h4>The Google Ads Strategy That Generated $2.1M</h4><span>2.8k views · 7 min</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#1a0a00,#3d1a00)">📢</div>
              </a>
              <a href="article.html" class="trending-item">
                <div class="trending-rank">5</div>
                <div class="trending-info">
                  <h4>Website Speed: How We Hit 95+ PageSpeed</h4><span>2.1k views · 9 min</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#0a001a,#1a0533)">🌐</div>
              </a>
            </div>
          </div>

          <!-- Newsletter widget -->
          <div
            style="background:var(--gradient-primary);border-radius:var(--radius-xl);padding:1.75rem;text-align:center;color:#fff">
            <div style="font-size:2.5rem;margin-bottom:.75rem">📬</div>
            <h3 style="font-size:1.1rem;margin-bottom:.5rem">Weekly Growth Digest</h3>
            <p style="font-size:.85rem;opacity:.9;margin-bottom:1.25rem;line-height:1.6">Join 8,000+ founders getting
              actionable insights every Tuesday. Free, always.</p>
            <form id="newsletter-form" class="lead-form" style="display:flex;flex-direction:column;gap:.6rem">
              <input type="email" class="form-input" placeholder="your@email.com" required
                style="border-radius:var(--radius-lg);border:2px solid rgba(255,255,255,.4);background:rgba(255,255,255,.15);color:#fff;padding:.65rem 1rem;outline:none;font-family:var(--font-body)" />
              <button type="submit" class="btn"
                style="background:#fff;color:var(--clr-primary);font-weight:700">Subscribe Free ✓</button>
            </form>
            <p style="font-size:.72rem;opacity:.7;margin-top:.5rem">No spam. Unsubscribe anytime.</p>
          </div>
        </div><!-- /trending sidebar -->

      </div><!-- /two columns -->
    </div>
  </section>

  <!-- OPERO ERP CTA BAND -->
  <section class="section-sm" style="background:var(--bg-surface)">
    <div class="container">
      <div class="erp-teaser reveal" style="text-align:center;max-width:700px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">⚙️ Opero ERP</span>
        <h2 style="margin-bottom:.75rem">Reading About ERP? <span class="text-gradient">Try Opero Free</span></h2>
        <p style="color:var(--text-secondary);margin-bottom:1.5rem">Everything you read about — inventory, POS, HR,
          payroll — is live in Opero right now. Book a free 30-minute demo and see it in action.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('opero') }}" class="btn btn--primary btn--lg">⚙️ Explore Opero ERP</a>
          <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">📅 Book Free Demo</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
