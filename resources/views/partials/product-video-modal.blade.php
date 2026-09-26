<!-- ══════════════════════════════════════════════════════════
     REUSABLE PRODUCT VIDEO WALKTHROUGH POPUP MODAL (CENTERED)
     ══════════════════════════════════════════════════════════ -->
<div id="product-video-modal" class="product-video-modal-backdrop" aria-hidden="true" role="dialog" aria-modal="true" style="display:none">
  <div class="product-video-modal-dialog">
    <!-- Modal Header -->
    <div class="product-video-modal-header">
      <div style="display:flex;align-items:center;gap:0.75rem">
        <div id="pvm-icon" class="pvm-header-icon">🎥</div>
        <div>
          <h3 id="pvm-title" class="pvm-header-title">Product Walkthrough</h3>
          <p id="pvm-subtitle" class="pvm-header-subtitle">Interactive Feature &amp; Architecture Inspection</p>
        </div>
      </div>
      <button type="button" class="pvm-close-btn" onclick="closeProductVideoModal()" title="Close (Esc)">
        ✕
      </button>
    </div>

    <!-- Modal Video Player Screen -->
    <div class="product-video-modal-screen">
      <video
        id="pvm-video-player"
        controls
        playsinline
        preload="auto"
        style="width:100%;height:100%;object-fit:contain;background:#000;display:block"
      >
        <source id="pvm-video-source" src="" type="video/mp4">
        Your browser does not support high-definition HTML5 video playback.
      </video>
    </div>

    <!-- Modal Footer Controls -->
    <div class="product-video-modal-footer">
      <div class="pvm-footer-meta">
        <span class="pvm-pulse-dot"></span>
        <span id="pvm-meta-text">HD 1080p Stream &bull; Full Audio Walkthrough</span>
      </div>
      <div style="display:flex;align-items:center;gap:0.75rem">
        <button type="button" class="btn btn--outline btn--sm" id="pvm-scroll-modules-btn" onclick="scrollAndCloseToModules()" style="display:none">
          Explore System Modules Below &darr;
        </button>
        <button type="button" class="btn btn--secondary btn--sm" onclick="closeProductVideoModal()">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  .product-video-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(6, 10, 19, 0.88);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    z-index: 100000;
    align-items: center;
    justify-content: center;
    padding: 1.25rem;
    box-sizing: border-box;
    opacity: 0;
    transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .product-video-modal-backdrop.is-active {
    display: flex !important;
    opacity: 1;
  }
  .product-video-modal-dialog {
    width: 100%;
    max-width: 960px;
    background: #0b111e;
    border: 1px solid rgba(255, 255, 255, 0.16);
    border-radius: var(--radius-2xl, 1.25rem);
    box-shadow: 0 24px 70px -12px rgba(0, 0, 0, 0.85), 0 0 40px rgba(108, 99, 255, 0.18);
    overflow: hidden;
    position: relative;
    transform: scale(0.96) translateY(12px);
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
  }
  .product-video-modal-backdrop.is-active .product-video-modal-dialog {
    transform: scale(1) translateY(0);
  }
  .product-video-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: rgba(17, 24, 39, 0.7);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .pvm-header-icon {
    width: 38px;
    height: 38px;
    border-radius: var(--radius-md, 8px);
    background: rgba(108, 99, 255, 0.15);
    border: 1px solid rgba(108, 99, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
  }
  .pvm-header-title {
    font-family: var(--font-display, inherit);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-primary, #f8fafc);
    margin: 0;
    line-height: 1.25;
  }
  .pvm-header-subtitle {
    font-size: 0.75rem;
    color: var(--text-muted, #94a3b8);
    margin: 0.15rem 0 0;
    line-height: 1.3;
  }
  .pvm-close-btn {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-full, 9999px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    background: rgba(255, 255, 255, 0.05);
    color: var(--text-secondary, #cbd5e1);
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .pvm-close-btn:hover {
    background: rgba(255, 107, 122, 0.2);
    border-color: rgba(255, 107, 122, 0.5);
    color: #ff6b7a;
    transform: rotate(90deg);
  }
  .product-video-modal-screen {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 10;
    background: #000;
    max-height: 65vh;
  }
  .product-video-modal-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 1.5rem;
    background: rgba(17, 24, 39, 0.7);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    font-size: 0.8rem;
    flex-wrap: wrap;
    gap: 0.75rem;
  }
  .pvm-footer-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted, #94a3b8);
    font-size: 0.75rem;
  }
  .pvm-pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--clr-accent, #00d4aa);
    box-shadow: 0 0 10px var(--clr-accent, #00d4aa);
    display: inline-block;
  }

  @media (max-width: 640px) {
    .product-video-modal-backdrop {
      padding: 0.5rem;
    }
    .product-video-modal-header,
    .product-video-modal-footer {
      padding: 0.75rem 1rem;
    }
    .pvm-header-title {
      font-size: 0.925rem;
    }
    .product-video-modal-screen {
      aspect-ratio: 16 / 9;
    }
  }
</style>

<script>
  (function() {
    // Registry of product videos from server-side ProductVideo model
    window.CYPRESSIQ_VIDEOS = {
      opero: {
        icon: '⚙️',
        title: @json($productVideos['opero']->title ?? 'OPERO — Business Operations & Management ERP'),
        subtitle: @json($productVideos['opero']->subtitle ?? 'Enterprise POS, Multi-Location Inventory & Real-Time Financials'),
        video_url: @json(asset(ltrim($productVideos['opero']->video_url ?? '/videos/opero-loop.mp4', '/'))),
        poster_url: @json(asset(ltrim($productVideos['opero']->poster_url ?? '/images/mockups/opero-poster.webp', '/'))),
        target_section: '#modules'
      },
      itikia: {
        icon: '🗳️',
        title: @json($productVideos['itikia']->title ?? 'ITIKIA — Digital Engagement & Public Communication Platform'),
        subtitle: @json($productVideos['itikia']->subtitle ?? 'Civic Campaign Infrastructure & Grassroots Mobilization'),
        video_url: @json(asset(ltrim($productVideos['itikia']->video_url ?? '/videos/itikia-loop.mp4', '/'))),
        poster_url: @json(asset(ltrim($productVideos['itikia']->poster_url ?? '/images/mockups/itikia-poster.webp', '/'))),
        target_section: '#modules'
      },
      solutions: {
        icon: '🛠️',
        title: @json($productVideos['solutions']->title ?? 'CypressIQ — Bespoke Enterprise Software & Systems Architecture'),
        subtitle: @json($productVideos['solutions']->subtitle ?? 'High-Concurrency APIs, Cloud Native Infrastructure & Distributed Telemetry'),
        video_url: @json(asset(ltrim($productVideos['solutions']->video_url ?? '/videos/solutions-loop.mp4', '/'))),
        poster_url: @json(asset(ltrim($productVideos['solutions']->poster_url ?? '/images/mockups/solutions-poster.webp', '/'))),
        target_section: '#capabilities'
      }
    };

    let activeTargetSection = null;

    /**
     * Opens the centered product video walkthrough modal.
     * Can be called with a product key ('opero', 'itikia', 'solutions') OR custom arguments.
     */
    window.openProductVideoModal = function(keyOrConfig, customTitle, customUrl, customPoster, customSubtitle) {
      const modal = document.getElementById('product-video-modal');
      const video = document.getElementById('pvm-video-player');
      const titleEl = document.getElementById('pvm-title');
      const subtitleEl = document.getElementById('pvm-subtitle');
      const iconEl = document.getElementById('pvm-icon');
      const scrollBtn = document.getElementById('pvm-scroll-modules-btn');

      if (!modal || !video) return;

      let config = {};
      if (typeof keyOrConfig === 'string' && window.CYPRESSIQ_VIDEOS[keyOrConfig]) {
        config = Object.assign({}, window.CYPRESSIQ_VIDEOS[keyOrConfig]);
      } else if (typeof keyOrConfig === 'object' && keyOrConfig !== null) {
        config = Object.assign({}, keyOrConfig);
      }

      if (customTitle) config.title = customTitle;
      if (customUrl) config.video_url = customUrl;
      if (customPoster) config.poster_url = customPoster;
      if (customSubtitle) config.subtitle = customSubtitle;

      titleEl.textContent = config.title || 'Product Walkthrough';
      subtitleEl.textContent = config.subtitle || 'Interactive Video Walkthrough';
      if (iconEl && config.icon) iconEl.textContent = config.icon;

      activeTargetSection = config.target_section || null;
      if (scrollBtn) {
        const hasTarget = activeTargetSection && document.querySelector(activeTargetSection);
        scrollBtn.style.display = hasTarget ? 'inline-flex' : 'none';
      }

      // Configure video player
      if (config.poster_url) {
        video.poster = config.poster_url;
      }
      if (config.video_url) {
        if (video.src !== config.video_url) {
          video.src = config.video_url;
          video.load();
        }
      }

      // Display centered modal
      modal.style.display = 'flex';
      requestAnimationFrame(function() {
        modal.classList.add('is-active');
      });
      document.body.style.overflow = 'hidden';

      // Play video with audio unmuted for conscious user action
      video.muted = false;
      const playPromise = video.play();
      if (playPromise !== undefined) {
        playPromise.catch(function(err) {
          // In case browser requires explicit click or mute
          console.warn('Autoplay with sound paused by browser policy:', err);
          video.muted = true;
          video.play().catch(function() {});
        });
      }
    };

    /**
     * Closes the product video walkthrough modal and halts video playback.
     */
    window.closeProductVideoModal = function() {
      const modal = document.getElementById('product-video-modal');
      const video = document.getElementById('pvm-video-player');

      if (video) {
        video.pause();
      }

      if (modal) {
        modal.classList.remove('is-active');
        setTimeout(function() {
          modal.style.display = 'none';
          document.body.style.overflow = '';
        }, 220);
      }
    };

    /**
     * Closes modal and smoothly scrolls to the target module section.
     */
    window.scrollAndCloseToModules = function() {
      const target = activeTargetSection;
      closeProductVideoModal();
      if (target) {
        const el = document.querySelector(target);
        if (el) {
          setTimeout(function() {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }, 240);
        }
      }
    };

    // Backdrop click listener to close
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('product-video-modal');
      if (modal) {
        modal.addEventListener('click', function(e) {
          if (e.target === modal) {
            closeProductVideoModal();
          }
        });
      }

      // Escape key listener to close
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('is-active')) {
          closeProductVideoModal();
        }
      });
    });
  })();
</script>
