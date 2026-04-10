<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- AUTH GUARD: must load first -->
    
    <title>Blog CMS — Admin Dashboard | CypressIq</title>
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}" />
</head>

<body style="margin:0;padding:0">

    <div class="admin-layout">

        <!-- ══════════════════ SIDEBAR ══════════════════ -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="admin-logo">
                <div class="admin-logo-icon">⚡</div>
                <span>CypressIq <span style="color:var(--clr-accent);font-size:.75rem;font-weight:500">CMS</span></span>
            </div>

            <nav class="admin-nav">
                <div class="admin-nav-label">Overview</div>
                <button class="admin-nav-item active" onclick="showPanel('dashboard',this)">
                    <span class="nav-icon">📊</span> Dashboard
                </button>

                <div class="admin-nav-label">Content</div>
                <button class="admin-nav-item" onclick="showPanel('posts',this)">
                    <span class="nav-icon">📝</span> Blog Posts
                    <span class="admin-nav-badge">6</span>
                </button>
                <button class="admin-nav-item" onclick="showPanel('editor',this)">
                    <span class="nav-icon">✏️</span> New Post
                </button>
                <button class="admin-nav-item" onclick="showPanel('media',this)">
                    <span class="nav-icon">🖼️</span> Media Library
                </button>

                <div class="admin-nav-label">Growth & CRM</div>
                <button class="admin-nav-item" onclick="showPanel('messages',this)">
                    <span class="nav-icon">📥</span> Inbox (Messages)
                </button>
                <button class="admin-nav-item" onclick="showPanel('bookings',this)">
                    <span class="nav-icon">📅</span> Bookings
                </button>
                <button class="admin-nav-item" onclick="showPanel('newsletter',this)">
                    <span class="nav-icon">📬</span> Newsletter
                </button>
                <button class="admin-nav-item" onclick="showPanel('analytics',this)">
                    <span class="nav-icon">📈</span> Analytics
                </button>

                <div class="admin-nav-label">Settings</div>
                <button class="admin-nav-item" onclick="showPanel('contact-settings',this)">
                    <span class="nav-icon">📞</span> Contact Settings
                </button>
                <button class="admin-nav-item" onclick="showPanel('seo',this)">
                    <span class="nav-icon">🔍</span> SEO Settings
                </button>
                <button class="admin-nav-item" onclick="showPanel('settings',this)">
                    <span class="nav-icon">⚙️</span> General Settings
                </button>
            </nav>

            <div class="admin-user-section" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Click to Sign Out"
                style="cursor:pointer">
                <div class="admin-user-avatar">AD</div>
                <div>
                    <div class="admin-user-name" id="admin-username">{{ auth()->user()->name }}</div>
                    <div class="admin-user-role">Super Admin &middot; <span style="color:#FF6B7A;font-weight:600">Sign
                            Out</span></div>
                </div>
            </div>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
        </aside>

        <!-- ══════════════════ MAIN ══════════════════ -->
        <div class="admin-main">

            <!-- TOPBAR -->
            <div class="admin-topbar">
                <div style="display:flex;align-items:center;gap:1rem">
                    <button onclick="toggleSidebar()"
                        style="display:none;background:none;border:none;color:var(--text-primary);font-size:1.25rem;cursor:pointer"
                        id="sidebar-toggle">☰</button>
                    <div class="admin-topbar-title" id="panel-title">Dashboard</div>
                </div>
                <div class="admin-topbar-actions">
                    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme"
                        style="margin-right:.25rem"></button>
                    <span class="theme-icon" style="font-size:.9rem">🌙</span>
                    <a href="{{ route('blog.index') }}" target="_blank" class="btn btn--outline btn--sm">👁 View Blog</a>
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn--sm"
                        style="background:rgba(255,71,87,.12);color:#FF6B7A;border:1px solid rgba(255,71,87,.25);">🔓
                        Sign Out</button>
                    <button class="btn btn--primary btn--sm" onclick="showPanel('editor',null)">✏️ New Post</button>
                </div>
            </div>

            <!-- ══════ CONTENT AREA ══════ -->
            <div class="admin-content">

                                @yield('content')
            </div><!-- /admin-content -->
        </div><!-- /admin-main -->
    </div><!-- /admin-layout -->

    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        // Panel navigation
        function showPanel(id, btn) {
            document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('active'));
            const panel = document.getElementById('panel-' + id);
            if (panel) panel.classList.add('active');
            document.querySelectorAll('.admin-nav-item').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');
            const titles = { dashboard: 'Dashboard', posts: 'Blog Posts', editor: 'New Post', media: 'Media Library', messages: 'Inbox (Messages)', bookings: 'Bookings', newsletter: 'Newsletter', analytics: 'Analytics', seo: 'SEO Settings', settings: 'General Settings', 'contact-settings': 'Contact Settings' };
            document.getElementById('panel-title').textContent = titles[id] || id;
        }

        // Sidebar mobile toggle
        function toggleSidebar() {
            document.getElementById('admin-sidebar').classList.toggle('open');
        }
        window.addEventListener('resize', () => {
            const t = document.getElementById('sidebar-toggle');
            if (t) t.style.display = window.innerWidth < 900 ? 'block' : 'none';
        });
        if (document.getElementById('sidebar-toggle')) {
            document.getElementById('sidebar-toggle').style.display = window.innerWidth < 900 ? 'block' : 'none';
        }

        // Post title → slug auto-gen
        const titleInput = document.getElementById('post-title');
        const slugInput = document.getElementById('post-slug');
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').slice(0, 60);
            });
        }

        // SEO score updater
        function updateSeoScore() {
            const mt = document.getElementById('meta-title');
            const md = document.getElementById('meta-desc');
            const fill = document.getElementById('seo-score-fill');
            const label = document.getElementById('seo-score-label');
            const mtc = document.getElementById('meta-title-count');
            const mdc = document.getElementById('meta-desc-count');
            if (!mt) return;
            mtc && (mtc.textContent = mt.value.length);
            md && mdc && (mdc.textContent = md.value.length);
            let score = 20;
            if (mt.value.length >= 30) score += 30;
            if (md && md.value.length >= 80) score += 30;
            if (document.getElementById('post-title') && document.getElementById('post-title').value.length > 10) score += 20;
            fill && (fill.style.width = score + '%');
            if (label) {
                if (score >= 80) { label.textContent = '✓ Good'; label.style.color = 'var(--clr-success)'; }
                else if (score >= 50) { label.textContent = 'OK'; label.style.color = 'var(--clr-warning)'; }
                else { label.textContent = 'Needs Work'; label.style.color = '#FF4757'; }
            }
        }

        // Tag chip system
        const tagsInput = document.getElementById('tags-input');
        if (tagsInput) {
            tagsInput.addEventListener('keydown', function (e) {
                if ((e.key === 'Enter' || e.key === ',') && this.value.trim()) {
                    e.preventDefault();
                    const chip = document.createElement('span');
                    chip.className = 'tag-chip';
                    chip.innerHTML = this.value.trim() + ' <span class="tag-chip-remove" onclick="removeTag(this)">×</span>';
                    document.getElementById('tags-wrap').insertBefore(chip, this);
                    this.value = '';
                }
                if (e.key === 'Backspace' && !this.value) {
                    const chips = document.querySelectorAll('#tags-wrap .tag-chip');
                    if (chips.length) chips[chips.length - 1].remove();
                }
            });
        }
        function removeTag(el) { el.closest('.tag-chip').remove(); }

        // Image preview
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const upload = document.getElementById('image-upload');
            if (input.files && input.files[0] && preview) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; if (upload) upload.style.display = 'none'; };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Posts table search
        function filterPostsTable(q) {
            const rows = document.querySelectorAll('#posts-table tbody tr');
            rows.forEach(row => { row.style.display = row.textContent.toLowerCase().includes(q.toLowerCase()) ? '' : 'none'; });
        }
    </script>
</body>

</html>