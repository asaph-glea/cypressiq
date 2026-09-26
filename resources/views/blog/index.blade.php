@extends('layouts.app')
@section('title', 'Technical Insights, Engineering & Systems Architecture — CypressIQ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}" />
@endsection

@section('content')
<!-- HERO -->
  <section class="page-hero">
    <div class="hero-bg">
      <div class="hero-grid"></div>
    </div>
    <div class="container" style="position:relative;z-index:2;text-align:center">
      <span class="badge badge--primary" style="margin-bottom:1.5rem">📚 Engineering &amp; Operations</span>
      <h1>Technical Insights That <span class="text-gradient">Drive Modern Systems</span></h1>
      <p style="max-width:640px;margin:0 auto">Architectural breakdowns, engineering best practices, and operational playbooks on business software, ERP systems, and digital platforms.</p>

      <!-- SEARCH -->
      <div class="blog-search-wrap" style="margin-top:2rem">
        <span class="blog-search-icon">🔍</span>
        <input id="blog-search" class="blog-search" type="text" placeholder="Search articles, architecture topics, or technologies…" autocomplete="off" />
        <button class="blog-search-clear" id="search-clear" aria-label="Clear search">✕</button>
      </div>
    </div>
  </section>

  <!-- FEATURED + TRENDING -->
  <section class="section">
    <div class="container">

      @php
        $featured = $posts->first();
      @endphp

      @if($featured)
      <!-- FEATURED POST -->
      <a href="{{ route('blog.show', $featured->slug) }}" style="text-decoration:none;color:inherit;display:block">
        <div class="featured-post reveal">
          <div class="featured-thumb"><span>⚡</span></div>
          <div class="featured-content">
            <div class="featured-meta">
              <span class="badge badge--accent">⭐ Featured Insight</span>
              <span style="font-size:.75rem;color:var(--text-muted)">
                {{ $featured->published_at ? \Carbon\Carbon::parse($featured->published_at)->format('F j, Y') : $featured->created_at->format('F j, Y') }} &bull; {{ $featured->category->name ?? 'Architecture' }}
              </span>
            </div>
            <h2>{{ $featured->title }}</h2>
            <p>{{ $featured->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($featured->content), 180) }}</p>
            <span class="btn btn--primary" style="align-self:flex-start">Read Full Article →</span>
          </div>
        </div>
      </a>
      @endif

      <!-- CATEGORIES -->
      <div class="blog-categories reveal">
        <button class="cat-btn active" data-cat="all">🌐 All Articles</button>
        <button class="cat-btn" data-cat="erp systems">⚙️ Business Systems &amp; ERP</button>
        <button class="cat-btn" data-cat="custom software">💻 Software Engineering</button>
        <button class="cat-btn" data-cat="digital marketing">📈 Operations &amp; Growth</button>
        <button class="cat-btn" data-cat="web dev">🌐 Web Architecture</button>
      </div>

      <!-- TWO COLUMNS: Articles + Trending -->
      <div style="display:grid;grid-template-columns:1fr 330px;gap:3rem;align-items:start">

        <!-- ARTICLES GRID -->
        <div>
          <div class="blog-grid stagger">

            @forelse ($posts as $post)
            <div class="blog-card reveal" 
                 data-category="{{ strtolower($post->category->name ?? 'general') }}"
                 data-title="{{ strtolower($post->title) }}"
                 data-excerpt="{{ strtolower($post->excerpt ?? strip_tags($post->content)) }}">
              <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit;display:contents">
                <div class="blog-thumb" style="background:linear-gradient(135deg,#1a0533,#2d1b69);position:relative;overflow:hidden">
                  @if(!empty($post->featured_image))
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0" />
                  @else
                    <span>{{ $loop->index % 2 === 0 ? '⚙️' : '💻' }}</span>
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(108,99,255,.5),rgba(0,212,170,.3))"></div>
                  @endif
                  @if(!empty($post->video_url))
                    <span style="position:absolute;bottom:0.6rem;right:0.6rem;background:rgba(0,0,0,0.75);backdrop-filter:blur(4px);color:#fff;font-size:0.68rem;font-weight:700;padding:2px 8px;border-radius:4px;border:1px solid rgba(255,255,255,0.2);display:flex;align-items:center;gap:4px">▶ VIDEO</span>
                  @endif
                </div>
                <div class="blog-body">
                  <div class="blog-meta">
                    <span class="badge badge--primary" style="font-size:.6rem">{{ $post->category->name ?? 'Technology' }}</span>
                    <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M j, Y') : $post->created_at->format('M j, Y') }}</span>
                  </div>
                  <h3>{{ $post->title }}</h3>
                  <p>{{ \Illuminate\Support\Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
                  <div class="blog-footer">
                    <div class="blog-author">
                      <div class="author-avatar">{{ substr($post->author->name ?? 'C', 0, 1) }}</div>
                      <span>{{ $post->author->name ?? 'CypressIQ' }}</span>
                    </div>
                    <span class="blog-read">Read Article →</span>
                  </div>
                </div>
              </a>
            </div>
            @empty
              <div id="no-results" class="no-results" style="grid-column: 1 / -1;">
                <div class="no-results-icon">🔎</div>
                <h3>No articles published yet</h3>
                <p>Check back soon for new architectural insights.</p>
              </div>
            @endforelse

          </div><!-- /blog-grid -->

          <div style="margin-top:2.5rem">
            {{ $posts->links() }}
          </div>
        </div><!-- /left col -->

        <!-- TRENDING SIDEBAR -->
        <div style="position:sticky;top:5rem">
          <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.5rem;margin-bottom:1.5rem">
            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted);margin-bottom:1rem">
              🔥 Recommended Reading
            </div>
            <div class="trending-list">
              @php
                $trendingPosts = $posts->slice(1, 5);
              @endphp
              @foreach($trendingPosts as $tIndex => $tPost)
              <a href="{{ route('blog.show', $tPost->slug) }}" class="trending-item">
                <div class="trending-rank">{{ $tIndex }}</div>
                <div class="trending-info">
                  <h4>{{ \Illuminate\Support\Str::limit($tPost->title, 48) }}</h4>
                  <span>{{ $tPost->category->name ?? 'Tech' }} &bull; {{ $tPost->published_at ? \Carbon\Carbon::parse($tPost->published_at)->format('M j') : $tPost->created_at->format('M j') }}</span>
                </div>
                <div class="trending-thumb" style="background:linear-gradient(135deg,#0a1a0a,#1a2e1a)">
                  {{ $tIndex % 2 === 0 ? '⚙️' : '📑' }}
                </div>
              </a>
              @endforeach
            </div>
          </div>

          <!-- Newsletter widget -->
          <div style="background:linear-gradient(135deg,rgba(108,99,255,0.15),rgba(0,212,170,0.1));border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.75rem;text-align:center">
            <div style="font-size:2rem;margin-bottom:.5rem">📬</div>
            <h3 style="font-size:1.1rem;margin-bottom:.5rem">Technical Digest</h3>
            <p style="font-size:.85rem;color:var(--text-secondary);margin-bottom:1.25rem;line-height:1.6">
              Practical software engineering, database design, and systems architecture insights delivered to your inbox.
            </p>
            <form id="blog-digest-form" onsubmit="window.submitBlogDigest(event)" style="display:flex;flex-direction:column;gap:.6rem">
              <input type="email" id="digest-email" class="form-input" placeholder="work@organization.com" required />
              <button type="submit" class="btn btn--primary" style="font-weight:600">Subscribe to Digest →</button>
            </form>
            <div id="digest-feedback" style="font-size:0.75rem;margin-top:0.5rem;display:none"></div>
          </div>
        </div><!-- /trending sidebar -->

      </div><!-- /two columns -->
    </div>
  </section>

  <!-- OPERO CTA BAND -->
  <section class="section-sm" style="background:var(--bg-surface)">
    <div class="container">
      <div class="erp-teaser reveal" style="text-align:center;max-width:700px;margin:0 auto">
        <span class="badge badge--accent" style="margin-bottom:1rem">⚙️ Opero Platform</span>
        <h2 style="margin-bottom:.75rem">Tired of Disconnected Spreadsheets? <span class="text-gradient">Explore Opero</span></h2>
        <p style="color:var(--text-secondary);margin-bottom:1.5rem">
          Centralize your POS, inventory management, payroll, and financials in one unified platform built for regional business operations.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
          <a href="{{ route('opero') }}" class="btn btn--primary btn--lg">Explore Opero Capabilities →</a>
          <a href="{{ route('contact') }}" class="btn btn--secondary btn--lg">Schedule a Demo Call</a>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('js/blog.js') }}"></script>
<script>
  window.submitBlogDigest = async function(e) {
    e.preventDefault();
    const email = document.getElementById('digest-email').value;
    const feedback = document.getElementById('digest-feedback');
    if (!email) return;

    try {
      const res = await fetch('{{ route('lead.capture') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email, source: 'blog_digest', type: 'newsletter' })
      });
      const data = await res.json();
      feedback.style.display = 'block';
      feedback.style.color = '#00d4aa';
      feedback.innerText = data.message || 'Subscribed successfully!';
      document.getElementById('blog-digest-form').reset();
    } catch(err) {
      feedback.style.display = 'block';
      feedback.style.color = '#ff6b81';
      feedback.innerText = 'Unable to subscribe right now. Please try again.';
    }
  };
</script>
@endsection
