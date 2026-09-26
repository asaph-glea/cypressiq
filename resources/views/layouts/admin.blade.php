<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CypressIQ Admin — Sales & Operations Cockpit</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}?v={{ filemtime(public_path('css/design-system.css')) }}" />
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}" />
    <style>
        .cockpit-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .cockpit-badge.new { background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .cockpit-badge.reviewed { background: rgba(234, 179, 8, 0.15); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.3); }
        .cockpit-badge.qualified { background: rgba(168, 85, 247, 0.15); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.3); }
        .cockpit-badge.proposal { background: rgba(249, 115, 22, 0.15); color: #fb923c; border: 1px solid rgba(249, 115, 22, 0.3); }
        .cockpit-badge.won { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .cockpit-badge.lost { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }

        /* ── Role Badges ── */
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .role-badge.badge-super-admin {
            background: rgba(168, 85, 247, 0.18);
            color: #c084fc;
            border: 1px solid rgba(168, 85, 247, 0.35);
        }
        .role-badge.badge-growth {
            background: rgba(56, 189, 248, 0.18);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.35);
        }
        .role-badge.badge-product-engineer {
            background: rgba(74, 222, 128, 0.18);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.35);
        }
        .role-badge.badge-staff {
            background: rgba(148, 163, 184, 0.18);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        /* ── Audit Badges ── */
        .audit-badge {
            display: inline-block;
            padding: 0.18rem 0.5rem;
            border-radius: 6px;
            font-size: 0.72rem;
            font-family: monospace;
            font-weight: 600;
        }
        .audit-badge.auth-success { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .audit-badge.auth-danger { background: rgba(239, 68, 68, 0.18); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.35); }
        .audit-badge.mutation { background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
        .audit-badge.generic { background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.25); }

        .admin-panel.active {
            display: block !important;
        }

        .priority-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        .priority-dot.urgent { background: #ef4444; box-shadow: 0 0 8px rgba(239, 68, 68, 0.8); }
        .priority-dot.high { background: #f97316; }
        .priority-dot.medium { background: #3b82f6; }
        .priority-dot.low { background: #64748b; }

        .lead-detail-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(6px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .lead-detail-box {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-xl);
            max-width: 720px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.6);
        }
        .discovery-spec-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-lg);
            padding: 1rem;
            margin-top: 1rem;
        }
        .lead-filter-bar {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            align-items: center;
        }

        /* ── Dark Mode Dropdown Selects & Option Contrast Fix ── */
        select,
        select.form-ctrl,
        .form-ctrl.select,
        .admin-table select {
            color-scheme: dark !important;
            background-color: #111827 !important;
            color: #f8fafc !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
        }

        select option,
        select.form-ctrl option,
        .form-ctrl.select option,
        .admin-table select option {
            background-color: #0b0f19 !important;
            color: #f8fafc !important;
            padding: 8px 12px !important;
        }

        select option:checked,
        select option:hover {
            background-color: #1e293b !important;
            color: #38bdf8 !important;
        }

        .lead-filter-bar select {
            background-color: #111827 !important;
            color: #f8fafc !important;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            font-weight: 500;
        }

        .lead-filter-bar select option {
            background-color: #0b0f19 !important;
            color: #f8fafc !important;
        }
    </style>
</head>

<body style="margin:0;padding:0">

    <div class="admin-layout">

        <!-- ══════════════════ SIDEBAR ══════════════════ -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="admin-logo">
                <div class="admin-logo-icon">⚡</div>
                <span>CypressIQ <span style="color:var(--clr-accent);font-size:.72rem;font-weight:700;letter-spacing:.08em">COCKPIT</span></span>
            </div>

            <nav class="admin-nav">
                <div class="admin-nav-label">Command Center</div>
                <button class="admin-nav-item active" onclick="showPanel('dashboard',this)">
                    <span class="nav-icon">📊</span> Overview
                </button>

                @if(auth()->user()->canAccessPanel('leads') || auth()->user()->canAccessPanel('messages') || auth()->user()->canAccessPanel('bookings'))
                <div class="admin-nav-label">Pipeline & Leads</div>
                @if(auth()->user()->canAccessPanel('leads'))
                <button class="admin-nav-item" onclick="showPanel('leads',this)">
                    <span class="nav-icon">🎯</span> Lead Pipeline
                    <span class="admin-nav-badge" id="nav-badge-leads" style="background:var(--clr-accent);color:#0d1117">●</span>
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('messages'))
                <button class="admin-nav-item" onclick="showPanel('messages',this)">
                    <span class="nav-icon">📥</span> Inquiries (Inbox)
                    <span class="admin-nav-badge" id="nav-badge-messages" style="background:#FF6B7A;color:#fff">●</span>
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('bookings'))
                <button class="admin-nav-item" onclick="showPanel('bookings',this)">
                    <span class="nav-icon">📅</span> Strategy Calls
                </button>
                @endif
                @endif

                @if(auth()->user()->canAccessPanel('itikia') || auth()->user()->canAccessPanel('opero'))
                <div class="admin-nav-label">Product Intelligence</div>
                @if(auth()->user()->canAccessPanel('itikia'))
                <button class="admin-nav-item" onclick="showPanel('itikia',this)">
                    <span class="nav-icon">🗳️</span> ITIKIA Leads
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('opero'))
                <button class="admin-nav-item" onclick="showPanel('opero',this)">
                    <span class="nav-icon">⚙️</span> OPERO Leads
                </button>
                @endif
                @endif

                @if(auth()->user()->canAccessPanel('posts') || auth()->user()->canAccessPanel('editor') || auth()->user()->canAccessPanel('videos') || auth()->user()->canAccessPanel('media'))
                <div class="admin-nav-label">Content & Media</div>
                @if(auth()->user()->canAccessPanel('posts'))
                <button class="admin-nav-item" onclick="showPanel('posts',this)">
                    <span class="nav-icon">📝</span> Blog Posts
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('editor'))
                <button class="admin-nav-item" onclick="showPanel('editor',this)">
                    <span class="nav-icon">✏️</span> Write Post
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('videos'))
                <button class="admin-nav-item" onclick="showPanel('videos',this)">
                    <span class="nav-icon">🎥</span> Product Videos
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('media'))
                <button class="admin-nav-item" onclick="showPanel('media',this)">
                    <span class="nav-icon">🖼️</span> Media Library
                </button>
                @endif
                @endif

                @if(auth()->user()->canAccessPanel('testimonials') || auth()->user()->canAccessPanel('trust-projects') || auth()->user()->canAccessPanel('partnerships'))
                <div class="admin-nav-label">Trust & Social Proof</div>
                @if(auth()->user()->canAccessPanel('testimonials'))
                <button class="admin-nav-item" onclick="showPanel('testimonials',this)">
                    <span class="nav-icon">💬</span> Testimonials
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('trust-projects'))
                <button class="admin-nav-item" onclick="showPanel('trust-projects',this)">
                    <span class="nav-icon">🚀</span> Projects
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('partnerships'))
                <button class="admin-nav-item" onclick="showPanel('partnerships',this)">
                    <span class="nav-icon">🤝</span> Partnerships
                </button>
                @endif
                @endif

                @if(auth()->user()->isSuperAdmin())
                <div class="admin-nav-label">Governance & Security</div>
                <button class="admin-nav-item" onclick="showPanel('team',this)">
                    <span class="nav-icon">👥</span> Team &amp; Access
                </button>
                <button class="admin-nav-item" onclick="showPanel('audit',this)">
                    <span class="nav-icon">🛡️</span> Audit Trail
                </button>
                @endif

                @if(auth()->user()->canAccessPanel('contact-settings') || auth()->user()->canAccessPanel('seo') || auth()->user()->canAccessPanel('settings'))
                <div class="admin-nav-label">Settings & SEO</div>
                @if(auth()->user()->canAccessPanel('contact-settings'))
                <button class="admin-nav-item" onclick="showPanel('contact-settings',this)">
                    <span class="nav-icon">📞</span> Contact Info
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('seo'))
                <button class="admin-nav-item" onclick="showPanel('seo',this)">
                    <span class="nav-icon">🔍</span> SEO Settings
                </button>
                @endif
                @if(auth()->user()->canAccessPanel('settings'))
                <button class="admin-nav-item" onclick="showPanel('settings',this)">
                    <span class="nav-icon">⚙️</span> General Config
                </button>
                @endif
                @endif
            </nav>

            <div class="admin-user-section" style="padding:1rem;display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--border-subtle);background:rgba(255,255,255,0.02)">
                <div style="display:flex;align-items:center;gap:0.75rem;min-width:0">
                    <div class="admin-user-avatar" style="width:36px;height:36px;border-radius:50%;background:rgba(108,99,255,0.2);color:#818cf8;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;border:1px solid rgba(108,99,255,0.4);flex-shrink:0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div style="min-width:0;overflow:hidden">
                        <div class="admin-user-name" id="admin-username" style="font-weight:600;font-size:0.85rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div style="margin-top:2px">
                            <span class="role-badge {{ auth()->user()->roleBadgeClass() }}">{{ auth()->user()->roleLabel() }}</span>
                        </div>
                    </div>
                </div>
                <button onclick="document.getElementById('logout-form').submit();" title="Sign Out Securely" class="btn btn--outline btn--sm" style="padding:4px 8px;font-size:0.75rem;border-color:rgba(239,68,68,0.4);color:#f87171" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">
                    🚪
                </button>
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
                    <div class="admin-topbar-title" id="panel-title">Command Center</div>
                </div>
                <div class="admin-topbar-actions">
                    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme"
                        style="margin-right:.25rem"></button>
                    <span class="theme-icon" style="font-size:.9rem">🌙</span>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn--outline btn--sm">🌐 Public Site</a>
                    @if(auth()->user()->canAccessPanel('leads'))
                    <button class="btn btn--secondary btn--sm" onclick="showPanel('leads', document.querySelector('[onclick*=\"showPanel(\\\'leads\\\'\"]'))">🎯 Pipeline</button>
                    @endif
                    @if(auth()->user()->canAccessPanel('editor'))
                    <button class="btn btn--primary btn--sm" onclick="showPanel('editor', document.querySelector('[onclick*=\"showPanel(\\\'editor\\\'\"]'))">✏️ New Post</button>
                    @elseif(auth()->user()->canAccessPanel('videos'))
                    <button class="btn btn--primary btn--sm" onclick="showPanel('videos', document.querySelector('[onclick*=\"showPanel(\\\'videos\\\'\"]'))">🎥 Product Videos</button>
                    @endif
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
            document.querySelectorAll('.admin-panel').forEach(p => {
                p.classList.remove('active');
                p.style.display = 'none';
            });
            const panel = document.getElementById('panel-' + id);
            if (panel) {
                panel.classList.add('active');
                panel.style.display = 'block';
            }
            document.querySelectorAll('.admin-nav-item').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');
            
            const titles = { 
                dashboard: 'Command Center — Executive Overview', 
                leads: 'Sales Pipeline & Project Discovery Triage', 
                messages: 'Inquiries Inbox', 
                bookings: 'Strategy Call Bookings', 
                itikia: 'ITIKIA — Platform Inquiries',
                opero: 'OPERO — Operations & ERP Inquiries',
                posts: 'Blog Posts & Insights', 
                editor: 'Article Editor', 
                videos: 'Product Video Walkthroughs & Media Manager',
                media: 'Media Asset Library', 
                newsletter: 'Newsletter Management', 
                analytics: 'Performance Analytics', 
                seo: 'Global SEO Configuration', 
                settings: 'System Preferences', 
                'contact-settings': 'Company Contact Information',
                testimonials: 'Client Testimonials & Feedback',
                'trust-projects': 'Showcase Projects & Deliveries',
                partnerships: 'Strategic Partnerships & Alliances',
                team: 'Team Directory & Role-Based Access Control',
                audit: 'Security Audit Trail & Governance Log'
            };
            document.getElementById('panel-title').textContent = titles[id] || (id.charAt(0).toUpperCase() + id.slice(1));

            // Dynamic panel load triggers
            if (id === 'leads') loadLeads();
            if (id === 'itikia') loadItikiaLeads();
            if (id === 'opero') loadOperoLeads();
            if (id === 'messages') loadMessages();
            if (id === 'bookings') loadBookings();
            if (id === 'testimonials') loadTestimonials();
            if (id === 'trust-projects') loadTrustProjects();
            if (id === 'partnerships') loadPartnerships();
            if (id === 'team') loadTeamMembers();
            if (id === 'audit') loadAuditLogs();
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

        // Posts table search
        function filterPostsTable(q) {
            const rows = document.querySelectorAll('#posts-table tbody tr');
            rows.forEach(row => { row.style.display = row.textContent.toLowerCase().includes(q.toLowerCase()) ? '' : 'none'; });
        }
    </script>
</body>

</html>