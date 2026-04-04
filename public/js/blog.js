/* ============================================================
   CYPRESSIQ BLOG ENGINE — blog.js
   ============================================================ */

(function () {
  'use strict';

  /* ── SCROLL PROGRESS BAR ─────────────────────────────── */
  const progressBar = document.getElementById('scroll-progress');
  function updateProgress() {
    if (!progressBar) return;
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = Math.min(pct, 100) + '%';
  }

  /* ── STICKY NEWSLETTER BAR ──────────────────────────── */
  const stickyBar = document.getElementById('newsletter-sticky');
  let stickyShown = false;
  function checkStickyBar() {
    if (stickyBar && !stickyShown && window.scrollY > 600) {
      stickyBar.classList.add('visible');
      stickyShown = true;
    }
  }
  window.closeStickyBar = function () {
    if (stickyBar) { stickyBar.classList.remove('visible'); }
  };

  /* ── BLOG SEARCH & FILTER ────────────────────────────── */
  const searchInput = document.getElementById('blog-search');
  const searchClear = document.getElementById('search-clear');
  const cards       = document.querySelectorAll('.blog-card[data-category]');
  const noResults   = document.getElementById('no-results');
  const catBtns     = document.querySelectorAll('.cat-btn');
  let   activeCategory = 'all';

  function filterCards() {
    const q = searchInput ? searchInput.value.toLowerCase().trim() : '';
    let visible = 0;
    cards.forEach(card => {
      const title    = (card.dataset.title    || '').toLowerCase();
      const excerpt  = (card.dataset.excerpt  || '').toLowerCase();
      const category = (card.dataset.category || '').toLowerCase();
      const matchQ   = !q || title.includes(q) || excerpt.includes(q);
      const matchCat = activeCategory === 'all' || category === activeCategory;
      const show     = matchQ && matchCat;
      card.classList.toggle('hidden', !show);
      if (show) visible++;
    });
    if (noResults) noResults.classList.toggle('visible', visible === 0);
    if (searchClear) searchClear.classList.toggle('visible', q.length > 0);
  }

  if (searchInput) {
    searchInput.addEventListener('input', filterCards);
    searchInput.addEventListener('keydown', e => { if (e.key === 'Escape') { searchInput.value = ''; filterCards(); } });
  }
  if (searchClear) {
    searchClear.addEventListener('click', () => { if (searchInput) { searchInput.value = ''; filterCards(); searchInput.focus(); } });
  }

  catBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      catBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeCategory = (btn.dataset.cat || 'all').toLowerCase();
      filterCards();
    });
  });

  /* ── TABLE OF CONTENTS (AUTO-GENERATED) ──────────────── */
  function buildTOC() {
    const tocList    = document.getElementById('toc-list');
    const articleBody = document.getElementById('article-body');
    if (!tocList || !articleBody) return;
    const headings = articleBody.querySelectorAll('h2, h3');
    if (headings.length === 0) { document.getElementById('toc-widget') && (document.getElementById('toc-widget').style.display = 'none'); return; }
    headings.forEach((h, i) => {
      const id = 'heading-' + i;
      h.id = id;
      const li = document.createElement('li');
      const a  = document.createElement('a');
      a.href = '#' + id;
      a.textContent = h.textContent;
      if (h.tagName === 'H3') a.classList.add('toc-h3');
      a.addEventListener('click', e => { e.preventDefault(); h.scrollIntoView({ behavior: 'smooth', block: 'start' }); });
      li.appendChild(a);
      tocList.appendChild(li);
    });
  }

  /* ── TOC ACTIVE HIGHLIGHT ─────────────────────────────── */
  function updateTOC() {
    const links    = document.querySelectorAll('#toc-list a');
    const headings = document.querySelectorAll('#article-body h2, #article-body h3');
    if (!links.length) return;
    let current = '';
    headings.forEach(h => { if (window.scrollY >= h.offsetTop - 120) current = h.id; });
    links.forEach(a => { a.classList.toggle('active', a.hash === '#' + current); });
  }

  /* ── MID-ARTICLE FORM SUBMISSION ─────────────────────── */
  function interceptForms() {
    document.querySelectorAll('.lead-form, #newsletter-form, #sticky-newsletter-form, #mid-cta-form, #sidebar-nl-form').forEach(form => {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const emailInput = this.querySelector('input[type="email"]');
        if (!emailInput || !emailInput.value) return;
        const btn = this.querySelector('button[type="submit"]');
        const originalText = btn ? btn.textContent : '';
        if (btn) { btn.textContent = '✓ Subscribed!'; btn.style.background = 'var(--clr-success)'; }
        setTimeout(() => { if (btn) { btn.textContent = originalText; btn.style.background = ''; } emailInput.value = ''; }, 3000);
      });
    });
  }

  /* ── EXIT INTENT (Article page) ──────────────────────── */
  let exitShown = false;
  function setupExitIntent() {
    const modal = document.getElementById('exit-intent-modal');
    if (!modal) return;
    document.addEventListener('mouseleave', e => {
      if (e.clientY <= 5 && !exitShown) {
        exitShown = true;
        setTimeout(() => { modal.style.display = 'flex'; setTimeout(() => modal.classList.add('modal--open'), 10); }, 200);
      }
    });
  }
  window.closeExitModal = function () {
    const modal = document.getElementById('exit-intent-modal');
    if (modal) { modal.classList.remove('modal--open'); setTimeout(() => { modal.style.display = 'none'; }, 300); }
  };

  /* ── COPY LINK SHARE ─────────────────────────────────── */
  window.copyLink = function () {
    navigator.clipboard.writeText(window.location.href).then(() => {
      const btn = document.getElementById('copy-link-btn');
      if (btn) { const t = btn.textContent; btn.textContent = '✓ Copied!'; setTimeout(() => btn.textContent = t, 2000); }
    });
  };
  window.shareToTwitter = function () {
    const text = encodeURIComponent(document.title);
    const url  = encodeURIComponent(window.location.href);
    window.open('https://twitter.com/intent/tweet?text=' + text + '&url=' + url, '_blank');
  };
  window.shareToLinkedIn = function () {
    const url = encodeURIComponent(window.location.href);
    window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + url, '_blank');
  };
  window.shareToFacebook = function () {
    const url = encodeURIComponent(window.location.href);
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '_blank');
  };

  /* ── SCROLL LISTENER ─────────────── */
  window.addEventListener('scroll', () => {
    updateProgress();
    checkStickyBar();
    updateTOC();
  }, { passive: true });

  /* ── INIT ─────────────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', () => {
    buildTOC();
    interceptForms();
    setupExitIntent();
    updateProgress();
  });

})();
