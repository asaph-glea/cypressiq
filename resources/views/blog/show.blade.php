@extends('layouts.app')
@section('title', $post->title . ' — CypressIQ Insights')

@section('css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}" />
<style>
  /* ── Layout & Top Navigation Clearance ── */
  .article-layout {
    display: block !important;
    max-width: 880px !important;
    margin: 0 auto !important;
    padding-top: calc(var(--nav-h, 72px) + 2.75rem) !important;
    padding-bottom: 5rem !important;
    padding-left: 1.5rem !important;
    padding-right: 1.5rem !important;
  }
  @media (max-width: 900px) {
    .article-layout {
      padding-top: calc(var(--nav-h, 72px) + 2rem) !important;
      padding-left: 1.25rem !important;
      padding-right: 1.25rem !important;
    }
  }
  @media (max-width: 600px) {
    .article-layout {
      padding-top: calc(var(--nav-h, 72px) + 1.5rem) !important;
      padding-left: 1rem !important;
      padding-right: 1rem !important;
    }
  }

  .article-body h2 {
    font-size: 1.65rem;
    margin: 2.25rem 0 1rem;
    color: var(--text-primary);
  }
  .article-body h3 {
    font-size: 1.3rem;
    margin: 1.75rem 0 0.75rem;
    color: var(--text-primary);
  }
  .article-body p {
    margin-bottom: 1.35rem;
    line-height: 1.85;
    color: var(--text-secondary);
  }
  .article-body ul, .article-body ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
    color: var(--text-secondary);
  }
  .article-body li {
    margin-bottom: 0.5rem;
    line-height: 1.7;
  }
  .article-body strong {
    color: var(--text-primary);
  }
  .article-body blockquote {
    border-left: 4px solid var(--clr-primary);
    padding: 1rem 1.5rem;
    margin: 2rem 0;
    background: var(--bg-glass);
    border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
    font-style: italic;
    color: var(--text-primary);
  }

  /* ── Responsive Images & Figures ── */
  .article-body img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    margin: 1.75rem 0;
    border: 1px solid var(--border-subtle);
    box-shadow: 0 10px 30px rgba(0,0,0,0.35);
    display: block;
  }
  .article-body figure {
    margin: 2rem 0;
    text-align: center;
  }
  .article-body figure img {
    margin: 0 auto;
  }
  .article-body figcaption {
    margin-top: 0.65rem;
    font-size: 0.85rem;
    color: var(--text-muted);
    font-style: italic;
  }

  /* ── Responsive HTML5 Videos ── */
  .article-body video {
    width: 100%;
    max-height: 540px;
    border-radius: var(--radius-xl);
    margin: 1.75rem 0;
    border: 1px solid var(--border-subtle);
    background: #000;
    box-shadow: 0 12px 40px rgba(0,0,0,0.5);
    display: block;
  }

  /* ── Responsive 16:9 Video Embed Containers (YouTube, Vimeo, etc.) ── */
  .article-body .video-container,
  .featured-video-container {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin: 2rem 0;
    background: #000;
    border: 1px solid var(--border-subtle);
    box-shadow: 0 12px 40px rgba(0,0,0,0.5);
  }
  .article-body .video-container iframe,
  .featured-video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }

  /* ── Rich Video Link Preview Cards ── */
  .article-body .video-link-card,
  .video-link-card {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.5rem;
    margin: 2rem 0;
    text-decoration: none;
    color: inherit;
    transition: all 0.25s ease;
  }
  .article-body .video-link-card:hover,
  .video-link-card:hover {
    border-color: var(--clr-accent);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,212,170,0.15);
  }
  .video-link-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: rgba(108, 99, 255, 0.2);
    color: var(--clr-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
  }
</style>
@endsection

@section('content')
<div class="scroll-progress-bar" id="scroll-progress"></div>

<div class="article-layout">
  <main>
    <div class="article-breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>/</span>
      <a href="{{ route('blog.index') }}">Blog</a>
      <span>/</span>
      <span>{{ \Illuminate\Support\Str::limit($post->title, 35) }}</span>
    </div>

    <div class="article-category-pill">{{ $post->category->name ?? 'Technology & Systems' }}</div>

    <h1 class="article-title">{{ $post->title }}</h1>

    @if(!empty($post->excerpt))
      <p class="article-subtitle">{{ $post->excerpt }}</p>
    @endif

    <!-- META ROW -->
    <div class="article-meta-row">
      <div class="article-author-block">
        <div class="article-author-avatar">{{ substr($post->author->name ?? 'C', 0, 2) }}</div>
        <div>
          <div class="article-author-name">{{ $post->author->name ?? 'CypressIQ Engineering' }}</div>
          <div class="article-author-role">Technology &amp; Systems Team</div>
        </div>
      </div>
      <div class="article-stat">
        📅 {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F j, Y') : $post->created_at->format('F j, Y') }}
      </div>
      <div class="article-stat">
        ⏱ {{ max(1, round(str_word_count(strip_tags($post->content)) / 200)) }} min read
      </div>
    </div>

    <!-- FEATURED VIDEO (IF SET) -->
    @php
      $featuredVideoHtml = null;
      if (!empty($post->video_url)) {
          $vUrl = trim($post->video_url);
          // YouTube
          if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $vUrl, $matches)) {
              $youtubeId = $matches[1];
              $featuredVideoHtml = '<div class="featured-video-container"><iframe src="https://www.youtube-nocookie.com/embed/' . $youtubeId . '?rel=0" title="' . e($post->title) . '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
          } 
          // Vimeo
          elseif (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)/i', $vUrl, $matches)) {
              $vimeoId = end($matches);
              $featuredVideoHtml = '<div class="featured-video-container"><iframe src="https://player.vimeo.com/video/' . $vimeoId . '" title="' . e($post->title) . '" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>';
          } 
          // Direct MP4 / WebM / storage video
          elseif (preg_match('/\.(mp4|webm|ogg|mov)($|\?)/i', $vUrl) || str_starts_with($vUrl, '/storage/')) {
              $videoSrc = str_starts_with($vUrl, 'http') ? $vUrl : asset($vUrl);
              $featuredVideoHtml = '<div style="margin:2rem 0"><video controls preload="metadata"><source src="' . e($videoSrc) . '" type="video/mp4">Your browser does not support HTML5 video.</video></div>';
          } 
          // Fallback video link card
          else {
              $featuredVideoHtml = '<a href="' . e($vUrl) . '" target="_blank" rel="noopener noreferrer" class="video-link-card"><div class="video-link-icon">▶</div><div><strong style="color:var(--text-primary);font-size:1rem;display:block">Watch Walkthrough / Demo Video</strong><span style="color:var(--clr-accent);font-size:0.85rem">' . e($vUrl) . ' ↗</span></div></a>';
          }
      }
    @endphp

    @if($featuredVideoHtml)
      {!! $featuredVideoHtml !!}
    @elseif(!empty($post->featured_image))
      <!-- FEATURED IMAGE -->
      <div class="article-featured-image">
        <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0" />
      </div>
    @else
      <div class="article-featured-image">
        <span>⚡</span>
      </div>
    @endif

    <!-- SHARE BUTTONS TOP -->
    <div class="share-section">
      <span class="share-label">Share:</span>
      <button class="share-btn" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent('{{ addslashes($post->title) }}') + '&url=' + encodeURIComponent(window.location.href), '_blank')">𝕏 Twitter</button>
      <button class="share-btn" onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(window.location.href), '_blank')">in LinkedIn</button>
      <button class="share-btn" onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Article link copied to clipboard!'))">🔗 Copy Link</button>
    </div>

    <!-- DYNAMIC ARTICLE BODY -->
    <article class="article-body" id="article-body">
      {!! $post->content !!}
    </article>

    <!-- INLINE PLATFORM PROMOTION -->
    <div class="inline-cta" style="margin-top:3rem">
      <h3>⚙️ Looking to Unify Your Business Operations?</h3>
      <p>Opero is CypressIQ's proprietary platform that unites POS, inventory, payroll, and financials in one cohesive system.</p>
      <div class="cta-btns">
        <a href="{{ route('opero') }}" class="btn btn--primary">Explore Opero →</a>
        <a href="{{ route('contact') }}" class="btn btn--secondary">Request Architecture Demo</a>
      </div>
    </div>

    <!-- SHARE BUTTONS BOTTOM -->
    <div class="share-section" style="margin-top:2.5rem">
      <span class="share-label">Share this article:</span>
      <button class="share-btn" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent('{{ addslashes($post->title) }}') + '&url=' + encodeURIComponent(window.location.href), '_blank')">𝕏 Twitter</button>
      <button class="share-btn" onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(window.location.href), '_blank')">in LinkedIn</button>
      <button class="share-btn" onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Article link copied to clipboard!'))">🔗 Copy Link</button>
    </div>

    @php
      $relatedPosts = \App\Models\Post::where('id', '!=', $post->id)
        ->where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    @endphp

    @if($relatedPosts->count() > 0)
    <!-- RELATED POSTS -->
    <div class="related-posts-section reveal" style="margin-top:4rem">
      <h2 style="font-size:1.5rem;margin-bottom:.25rem">Related Articles</h2>
      <p style="color:var(--text-muted);margin-bottom:1.5rem">Continue exploring systems, software, and technology insights</p>
      <div class="related-posts-grid">
        @foreach($relatedPosts as $rPost)
        <a href="{{ route('blog.show', $rPost->slug) }}" class="blog-card" style="text-decoration:none;color:inherit">
          <div class="blog-thumb" style="background:linear-gradient(135deg,#1a0533,#2d1b69);position:relative;overflow:hidden">
            @if(!empty($rPost->featured_image))
              <img src="{{ asset($rPost->featured_image) }}" alt="{{ $rPost->title }}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0" />
            @else
              <span>💻</span>
              <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(108,99,255,.5),rgba(0,212,170,.3))"></div>
            @endif
          </div>
          <div class="blog-body">
            <div class="blog-meta">
              <span class="badge badge--accent" style="font-size:.6rem">{{ $rPost->category->name ?? 'Technology' }}</span>
              <span>{{ $rPost->published_at ? \Carbon\Carbon::parse($rPost->published_at)->format('M j, Y') : $rPost->created_at->format('M j, Y') }}</span>
            </div>
            <h3>{{ \Illuminate\Support\Str::limit($rPost->title, 55) }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($rPost->excerpt ?? strip_tags($rPost->content), 90) }}</p>
          </div>
        </a>
        @endforeach
      </div>
    </div>
    @endif
  </main>
</div>

<script>
  // Ensure any standalone iframes inside the article are responsively wrapped
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#article-body iframe').forEach(iframe => {
      if (!iframe.parentElement.classList.contains('video-container')) {
        const wrapper = document.createElement('div');
        wrapper.className = 'video-container';
        iframe.parentNode.insertBefore(wrapper, iframe);
        wrapper.appendChild(iframe);
      }
    });
  });
</script>
@endsection
