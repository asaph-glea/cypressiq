@extends('layouts.admin')
@section('title', 'CypressIQ Admin — Sales & Operations Cockpit')
@section('content')

<!-- ─── 1. COMMAND CENTER (DASHBOARD) ─── -->
<div class="admin-panel active" id="panel-dashboard">
    <!-- Follow-Up Action Radar & Real-Time Alert Tracker -->
    <div id="radar-container" style="margin-bottom:1.75rem">
        @include('partials.radar-widget', ['radar' => $radar])
    </div>

    <!-- Top KPI Grid -->
    <div class="admin-stats-grid">
        <div class="admin-stat-card">
            <div class="admin-stat-label">Total Leads Captured</div>
            <div class="admin-stat-value" style="color:var(--clr-primary)">{{ $stats['total_leads'] }}</div>
            <div class="admin-stat-change up">▲ +{{ $stats['new_leads_this_week'] }} new this week</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-label">Active Pipeline Deals</div>
            <div class="admin-stat-value" style="color:var(--clr-accent)">{{ $stats['active_pipeline'] }}</div>
            <div class="admin-stat-change up">● New, Qualified &amp; Proposals</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-label">Product Inquiries (ITIKIA / OPERO)</div>
            <div class="admin-stat-value" style="color:#60a5fa">
                {{ $stats['itikia_leads'] }} <span style="font-size:0.9rem;font-weight:400;color:var(--text-muted)">/</span> {{ $stats['opero_leads'] }}
            </div>
            <div class="admin-stat-change up">▲ Proprietary software demand</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-label">Unread Messages &amp; Bookings</div>
            <div class="admin-stat-value" style="color:var(--clr-success)">
                {{ $stats['unread_messages'] }} <span style="font-size:0.9rem;font-weight:400;color:var(--text-muted)">inbox /</span> {{ $stats['confirmed_bookings'] }} <span style="font-size:0.9rem;font-weight:400;color:var(--text-muted)">calls</span>
            </div>
            <div class="admin-stat-change up">⚡ Direct client touches</div>
        </div>
    </div>

    <!-- Quick Product & Solutions Demand Breakdown -->
    <div class="admin-demand-grid">
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;display:flex;align-items:center;justify-content:space-between">
            <div>
                <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;font-weight:600">🗳️ ITIKIA Engagement</div>
                <div style="font-size:1.5rem;font-weight:700;margin-top:.25rem;color:#c084fc">{{ $stats['itikia_leads'] }} <span style="font-size:.85rem;color:var(--text-muted);font-weight:400">Prospects</span></div>
            </div>
            <button class="btn btn--outline btn--sm" onclick="showPanel('itikia', null)">Inspect ITIKIA →</button>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;display:flex;align-items:center;justify-content:space-between">
            <div>
                <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;font-weight:600">⚙️ OPERO Business ERP</div>
                <div style="font-size:1.5rem;font-weight:700;margin-top:.25rem;color:#38bdf8">{{ $stats['opero_leads'] }} <span style="font-size:.85rem;color:var(--text-muted);font-weight:400">Prospects</span></div>
            </div>
            <button class="btn btn--outline btn--sm" onclick="showPanel('opero', null)">Inspect OPERO →</button>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;display:flex;align-items:center;justify-content:space-between">
            <div>
                <div style="font-size:.8rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;font-weight:600">🛠️ Solutions &amp; Consulting</div>
                <div style="font-size:1.5rem;font-weight:700;margin-top:.25rem;color:#4ade80">{{ $stats['solutions_leads'] }} <span style="font-size:.85rem;color:var(--text-muted);font-weight:400">Inquiries</span></div>
            </div>
            <button class="btn btn--outline btn--sm" onclick="showPanel('leads', null)">View Pipeline →</button>
        </div>
    </div>

    <!-- Active High-Priority Leads & Inquiries -->
    <div class="admin-two-col-grid">
        <!-- High-Intent Pipeline Stream -->
        <div class="admin-table-wrap">
            <div class="admin-table-header">
                <div>
                    <div class="admin-table-title">🎯 High-Intent Lead Pipeline</div>
                    <small style="color:var(--text-muted)">Latest prospects captured from Project Discovery &amp; Product Pages</small>
                </div>
                <button class="btn btn--primary btn--sm" onclick="showPanel('leads', null)">Open Full Pipeline</button>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Contact / Company</th>
                        <th>Interest</th>
                        <th>Stage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leads->take(6) as $lead)
                    <tr>
                        <td>
                            <strong>{{ $lead->name ?: 'Direct Prospect' }}</strong><br>
                            <small style="color:var(--text-muted)">{{ $lead->email }}</small>
                        </td>
                        <td>
                            <span class="lead-source-pill" style="font-weight:600">{{ $lead->product_interest ? strtoupper($lead->product_interest) : ($lead->type ?: 'Inquiry') }}</span>
                            @if($lead->priority === 'urgent' || $lead->priority === 'high')
                                <span class="priority-dot {{ $lead->priority }}" title="Priority: {{ $lead->priority }}"></span>
                            @endif
                        </td>
                        <td>
                            <span class="cockpit-badge {{ $lead->status ?? 'new' }}">● {{ ucfirst($lead->status ?? 'new') }}</span>
                        </td>
                        <td>
                            <button class="btn btn--outline btn--sm" onclick='inspectLeadById({{ $lead->id }})' style="padding:2px 8px;font-size:0.75rem">Inspect</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--text-muted);padding:2rem">No leads captured yet. Submissions from the Project Discovery Engine will appear here in real time.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Inquiries & Strategy Requests -->
        <div class="admin-table-wrap">
            <div class="admin-table-header">
                <div>
                    <div class="admin-table-title">📥 Recent Direct Inquiries</div>
                    <small style="color:var(--text-muted)">General contact messages &amp; strategy bookings</small>
                </div>
                <button class="btn btn--outline btn--sm" onclick="showPanel('messages', null)">All Messages</button>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Topic / Slot</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages->take(5) as $msg)
                    <tr>
                        <td>
                            <strong>{{ $msg->first_name }} {{ $msg->last_name }}</strong><br>
                            <small style="color:var(--text-muted)">{{ $msg->email }}</small>
                        </td>
                        <td>
                            <span style="font-size:0.85rem">{{ Str::limit($msg->service_interest, 25) }}</span>
                        </td>
                        <td>
                            <span class="cockpit-badge {{ $msg->status === 'new' ? 'new' : ($msg->status === 'replied' ? 'won' : 'reviewed') }}">
                                {{ $msg->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center;color:var(--text-muted);padding:2rem">No direct inquiries recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ─── 2. FULL LEAD PIPELINE & DISCOVERY TRIAGE PANEL ─── -->
<div class="admin-panel" id="panel-leads">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">🎯 Sales Pipeline &amp; Project Discovery Triage</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Manage client inquiries, qualify discovery specifications, and assign architecture follow-ups</p>
        </div>
        <div style="display:flex;gap:0.75rem">
            <button class="btn btn--outline btn--sm" onclick="loadLeads()">↻ Refresh Data</button>
            <button class="btn btn--primary btn--sm" onclick="openCreateLeadModal()">+ Add New Lead</button>
        </div>
    </div>

    <!-- Filter & Stage Triage Bar -->
    <div class="lead-filter-bar">
        <input type="text" id="leads-search-input" placeholder="🔍 Search by name, email, company, notes…" class="form-ctrl" style="max-width:280px" oninput="debounceLeadsSearch()" />
        
        <select id="leads-filter-status" class="form-ctrl select" style="max-width:160px" onchange="loadLeads()">
            <option value="all">All Stages</option>
            <option value="new">● New</option>
            <option value="reviewed">● Reviewed</option>
            <option value="qualified">● Qualified</option>
            <option value="proposal">● Proposal</option>
            <option value="won">● Won / Closed</option>
            <option value="lost">● Lost</option>
        </select>

        <select id="leads-filter-product" class="form-ctrl select" style="max-width:180px" onchange="loadLeads()">
            <option value="all">All Products / Scope</option>
            <option value="itikia">ITIKIA Platform</option>
            <option value="opero">OPERO ERP</option>
            <option value="consulting">Technology Consulting</option>
            <option value="solutions">Client Solutions</option>
        </select>

        <select id="leads-filter-priority" class="form-ctrl select" style="max-width:150px" onchange="loadLeads()">
            <option value="all">All Priorities</option>
            <option value="urgent">🔴 Urgent</option>
            <option value="high">🟠 High</option>
            <option value="medium">🔵 Medium</option>
            <option value="low">⚪ Low</option>
        </select>

        <button class="btn btn--outline btn--sm" onclick="resetLeadsFilters()">Clear Filters</button>
    </div>

    <!-- Pipeline Table -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="pipeline-table">
            <thead>
                <tr>
                    <th>Lead / Contact</th>
                    <th>Product &amp; Scope</th>
                    <th>Discovery Specs</th>
                    <th>Stage</th>
                    <th>Priority</th>
                    <th>Assigned</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="pipeline-table-body">
                <tr><td colspan="7" style="text-align:center;padding:2rem">Loading pipeline records...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 3. DEDICATED ITIKIA PROSPECTS PANEL ─── -->
<div class="admin-panel" id="panel-itikia">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">🗳️ ITIKIA Engagement Platform Leads</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Prospective clients and campaigns seeking civic tech, community mobilization &amp; digital engagement</p>
        </div>
        <button class="btn btn--outline btn--sm" onclick="loadItikiaLeads()">↻ Refresh</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Organization / Contact</th>
                    <th>Scale / Focus</th>
                    <th>Bottleneck / Objectives</th>
                    <th>Stage</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="itikia-table-body">
                <tr><td colspan="6" style="text-align:center;padding:2rem">Loading ITIKIA prospects...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 4. DEDICATED OPERO ERP LEADS PANEL ─── -->
<div class="admin-panel" id="panel-opero">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">⚙️ OPERO Business ERP Inquiries</h2>
            <p style="color:var(--text-muted);font-size:.875rem">SMEs and multi-branch enterprises requesting operations management, POS terminals &amp; ledger systems</p>
        </div>
        <button class="btn btn--outline btn--sm" onclick="loadOperoLeads()">↻ Refresh</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Enterprise / Contact</th>
                    <th>Operational Scale</th>
                    <th>Workflow Bottlenecks</th>
                    <th>Stage</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="opero-table-body">
                <tr><td colspan="6" style="text-align:center;padding:2rem">Loading OPERO prospects...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 5. INBOX (MESSAGES) PANEL ─── -->
<div class="admin-panel" id="panel-messages">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">📥 Inquiries Inbox</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Direct messages from the contact page and public intake forms</p>
        </div>
        <button class="btn btn--outline btn--sm" onclick="loadMessages()">↻ Refresh</button>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table" id="messages-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email / Phone</th>
                    <th>Interest</th>
                    <th>Budget / Timeline</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="7" style="text-align:center;padding:2rem">Loading messages...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 6. BOOKINGS PANEL ─── -->
<div class="admin-panel" id="panel-bookings">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">📅 Strategy Call Bookings</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Scheduled 30-minute architectural and scoping sessions</p>
        </div>
        <button class="btn btn--outline btn--sm" onclick="loadBookings()">↻ Refresh</button>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table" id="bookings-table">
            <thead>
                <tr>
                    <th>Prospect Name</th>
                    <th>Email &amp; Phone</th>
                    <th>Requested Time Slot</th>
                    <th>Status</th>
                    <th>Booked At</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="5" style="text-align:center;padding:2rem">Loading bookings...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 7. BLOG POSTS PANEL ─── -->
<div class="admin-panel" id="panel-posts">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">📝 Blog Posts &amp; Insights</h2>
            <p style="color:var(--text-muted);font-size:.875rem">{{ $stats['total_posts'] }} total posts · {{ $stats['published_posts'] }} published · {{ $stats['draft_posts'] }} drafts</p>
        </div>
        <button class="btn btn--primary" onclick="showPanel('editor',null)">✏️ New Post</button>
    </div>

    <div style="display:flex;gap:.75rem;margin-bottom:1.25rem;flex-wrap:wrap">
        <input type="text" placeholder="🔍 Search posts…" class="form-ctrl" style="max-width:280px" oninput="filterPostsTable(this.value)" />
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table" id="posts-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td><strong>{{ Str::limit($post->title, 55) }}</strong></td>
                    <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                    <td>{{ $post->author->name ?? 'Admin' }}</td>
                    <td>
                        @if ($post->status === 'published')
                            <span class="status-pill published">● Published</span>
                        @elseif ($post->status === 'scheduled')
                            <span class="status-pill scheduled">◷ Scheduled</span>
                        @else
                            <span class="status-pill draft">○ Draft</span>
                        @endif
                    </td>
                    <td>{{ $post->created_at->format('M j, Y') }}</td>
                    <td>
                        <button class="table-action-btn" onclick="editPost({{ $post->id }})">✏️ Edit</button>
                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="table-action-btn" style="text-decoration:none">👁 View</a>
                        <form method="POST" action="{{ route('admin.api.posts.destroy', $post) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="table-action-btn danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem;">No posts exist yet. Click "New Post" to publish an engineering insight.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ─── 8. POST EDITOR PANEL ─── -->
<div class="admin-panel" id="panel-editor">
    <input type="hidden" id="post-id" value="" />
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem" id="editor-heading">✏️ Article Editor</h2>
            <p style="color:var(--text-muted);font-size:.875rem" id="editor-subtitle">Author thought leadership articles, case studies &amp; video tutorials</p>
        </div>
        <div style="display:flex;gap:.75rem">
            <button class="btn btn--outline btn--sm" id="btn-cancel-edit" onclick="resetPostEditor()" style="display:none">✕ Cancel Edit</button>
            <button class="btn btn--outline btn--sm" onclick="savePost('draft')">Save Draft</button>
            <button class="btn btn--primary btn--sm" id="btn-save-post" onclick="savePost('published')">Publish Article 🚀</button>
        </div>
    </div>

    <div class="editor-layout">
        <div>
            <input class="editor-title-input" id="post-title" placeholder="Write your insight title here…" type="text" />
            
            <!-- Quick Media Inserter Toolbar -->
            <div class="editor-media-toolbar" style="display:flex;gap:0.5rem;align-items:center;background:rgba(255,255,255,0.03);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.6rem 0.85rem;margin-bottom:0.75rem;flex-wrap:wrap">
                <span style="font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;margin-right:0.35rem">Media Tools:</span>
                <button type="button" class="btn btn--outline btn--sm" onclick="openInsertImageModal()" title="Upload or link an image">🖼️ Insert Image</button>
                <button type="button" class="btn btn--outline btn--sm" onclick="openInsertVideoModal()" title="Upload or link an MP4 video">🎥 Insert Video (MP4)</button>
                <button type="button" class="btn btn--outline btn--sm" onclick="openInsertVideoLinkModal()" title="Embed YouTube, Vimeo, or video link">🔗 YouTube / Video Link</button>
                <button type="button" class="btn btn--outline btn--sm" onclick="insertQuoteBlock()" title="Insert styled quote callout">💬 Quote</button>
                <button type="button" class="btn btn--outline btn--sm" onclick="insertCtaBlock()" title="Insert Call to Action block">⚡ CTA Box</button>
            </div>

            <textarea class="editor-content-area" id="post-content" placeholder="Write article content here… You can type markdown or use the Media Tools above to insert images, videos, and video links." spellcheck="true" rows="18"></textarea>
            
            <div style="margin-top:1rem">
                <label class="form-label-sm" style="font-size:.8rem;font-weight:600;color:var(--text-muted);display:block;margin-bottom:.4rem">📋 EXCERPT (Card Summary)</label>
                <textarea class="excerpt-input" id="post-excerpt" placeholder="1-2 sentences summarizing the core takeaway…"></textarea>
            </div>
        </div>

        <div class="editor-sidebar-sticky">
            <div class="settings-card">
                <div class="settings-title">🚀 Publish Settings</div>
                <div class="form-group-sm">
                    <label class="form-label-sm">Status</label>
                    <select class="form-ctrl select" id="post-status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="scheduled">Scheduled</option>
                    </select>
                </div>
                <div class="form-group-sm">
                    <label class="form-label-sm">Category</label>
                    <select class="form-ctrl select" id="post-category">
                        <option value="">Select Category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-title">🖼️ Featured Cover Image</div>
                <div class="form-group-sm">
                    <input type="text" class="form-ctrl" placeholder="Image URL (e.g. /storage/uploads/cover.jpg)" id="post-featured-image" oninput="updateFeaturedImagePreview(this.value)" />
                </div>
                <div style="display:flex;gap:0.5rem;margin-top:0.5rem">
                    <button type="button" class="btn btn--outline btn--sm" onclick="document.getElementById('file-upload-featured-image').click()" style="width:100%">⬆ Upload Cover Image</button>
                    <input type="file" id="file-upload-featured-image" accept="image/*" style="display:none" onchange="uploadFeaturedImage(this)" />
                </div>
                <div id="preview-featured-image-box" style="margin-top:0.75rem;display:none;position:relative;border-radius:var(--radius-md);overflow:hidden;max-height:120px;border:1px solid var(--border-subtle)">
                    <img id="preview-featured-image" src="" alt="Cover preview" style="width:100%;height:100%;object-fit:cover;display:block" />
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-title">🎥 Featured Video Walkthrough</div>
                <p style="font-size:0.75rem;color:var(--text-muted);margin-bottom:0.5rem">Enter a YouTube, Vimeo, or direct MP4 URL to feature an interactive video on this post.</p>
                <div class="form-group-sm">
                    <input type="text" class="form-ctrl" placeholder="https://www.youtube.com/watch?v=..." id="post-video-url" />
                </div>
                <div style="display:flex;gap:0.5rem;margin-top:0.5rem">
                    <button type="button" class="btn btn--outline btn--sm" onclick="document.getElementById('file-upload-featured-video').click()" style="width:100%">⬆ Upload Video File</button>
                    <input type="file" id="file-upload-featured-video" accept="video/*" style="display:none" onchange="uploadFeaturedVideo(this)" />
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-title">🔍 URL Slug</div>
                <div class="form-group-sm">
                    <input type="text" class="form-ctrl" placeholder="post-slug" id="post-slug" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ─── 9. PRODUCT VIDEOS PANEL ─── -->
<div class="admin-panel" id="panel-videos">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem;display:flex;align-items:center;gap:0.5rem">
                <span>🎥</span> Product Video Walkthroughs &amp; Media Manager
            </h2>
            <p style="color:var(--text-muted);font-size:.875rem">
                Manage high-definition video loops, popup walkthroughs, and poster thumbnails across OPERO ERP, ITIKIA Platform, and Digital Solutions.
            </p>
        </div>
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap">
            <button type="button" class="btn btn--outline btn--sm" onclick="testProductModalDirectly('opero')">▶ Test OPERO Modal</button>
            <button type="button" class="btn btn--outline btn--sm" onclick="testProductModalDirectly('itikia')">▶ Test ITIKIA Modal</button>
            <button type="button" class="btn btn--outline btn--sm" onclick="testProductModalDirectly('solutions')">▶ Test Solutions Modal</button>
        </div>
    </div>

    <!-- Product Video Cards Grid -->
    <div style="display:flex;flex-direction:column;gap:1.75rem">

        @php
            $videoCards = [
                'opero' => [
                    'name' => 'OPERO Business ERP',
                    'icon' => '⚙️',
                    'badge' => 'Enterprise Operations & POS',
                    'badge_color' => '#38bdf8',
                    'preview_id' => 'opero-admin-video',
                ],
                'itikia' => [
                    'name' => 'ITIKIA Movement Engine',
                    'icon' => '🗳️',
                    'badge' => 'Civic Engagement & Campaign Platform',
                    'badge_color' => '#c084fc',
                    'preview_id' => 'itikia-admin-video',
                ],
                'solutions' => [
                    'name' => 'Custom Digital Solutions',
                    'icon' => '🛠️',
                    'badge' => 'Systems Architecture & Cloud Telemetry',
                    'badge_color' => '#4ade80',
                    'preview_id' => 'solutions-admin-video',
                ]
            ];
        @endphp

        @foreach($videoCards as $vKey => $meta)
        @php
            $vRecord = $productVideos[$vKey] ?? null;
            $currentVideoUrl = $vRecord->video_url ?? "/videos/{$vKey}-loop.mp4";
            $currentPosterUrl = $vRecord->poster_url ?? "/images/mockups/{$vKey}-poster.webp";
            $currentTitle = $vRecord->title ?? "{$meta['name']} Walkthrough";
            $currentSubtitle = $vRecord->subtitle ?? "CypressIQ Software System";
        @endphp
        <div class="settings-card" style="padding:1.5rem;background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);display:grid;grid-template-columns:360px 1fr;gap:2rem;align-items:start" id="video-card-{{ $vKey }}">
            <!-- Left: Video Player Preview & Poster Preview -->
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem">
                    <span style="font-weight:700;font-size:0.875rem;display:flex;align-items:center;gap:0.35rem">
                        <span>{{ $meta['icon'] }}</span> {{ $meta['name'] }}
                    </span>
                    <span style="font-size:0.68rem;padding:0.2rem 0.55rem;border-radius:var(--radius-full);background:rgba(255,255,255,0.06);border:1px solid var(--border-subtle);color:{{ $meta['badge_color'] }};font-weight:600">
                        {{ $meta['badge'] }}
                    </span>
                </div>

                <!-- Video Element Preview -->
                <div style="position:relative;width:100%;aspect-ratio:16/10;background:#000;border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--border-subtle);box-shadow:var(--shadow-sm)">
                    <video 
                        id="{{ $meta['preview_id'] }}"
                        controls
                        playsinline
                        poster="{{ asset(ltrim($currentPosterUrl, '/')) }}"
                        style="width:100%;height:100%;object-fit:cover;display:block"
                    >
                        <source src="{{ asset(ltrim($currentVideoUrl, '/')) }}" type="video/mp4">
                    </video>
                </div>

                <div style="margin-top:0.75rem;display:flex;align-items:center;justify-content:space-between;font-size:0.72rem;color:var(--text-muted)">
                    <span id="current-url-display-{{ $vKey }}" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:220px" title="{{ $currentVideoUrl }}">
                        {{ $currentVideoUrl }}
                    </span>
                    <button type="button" class="btn btn--outline btn--sm" style="padding:2px 8px;font-size:0.72rem" onclick="testProductModalDirectly('{{ $vKey }}')">
                        ⛶ Test Popup
                    </button>
                </div>
            </div>

            <!-- Right: Settings & Upload Controls -->
            <form id="form-video-{{ $vKey }}" onsubmit="saveProductVideo('{{ $vKey }}', event)">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
                    <div class="form-group-sm">
                        <label class="form-label-sm">Walkthrough Title</label>
                        <input type="text" class="form-ctrl form-ctrl-sm" name="title" id="input-title-{{ $vKey }}" value="{{ $currentTitle }}" required>
                    </div>
                    <div class="form-group-sm">
                        <label class="form-label-sm">Walkthrough Subtitle</label>
                        <input type="text" class="form-ctrl form-ctrl-sm" name="subtitle" id="input-subtitle-{{ $vKey }}" value="{{ $currentSubtitle }}">
                    </div>
                </div>

                <!-- Video Source: URL or File Upload -->
                <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1rem;margin-bottom:1rem">
                    <div style="font-size:0.75rem;font-weight:700;color:var(--text-primary);text-transform:uppercase;letter-spacing:0.04em;margin-bottom:0.65rem">
                        🎬 Video Source (.mp4 / .webm &bull; up to 100MB)
                    </div>
                    <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:1rem;align-items:center">
                        <div>
                            <label class="form-label-sm" style="font-size:0.7rem">Direct Video URL / CDN Link</label>
                            <input type="text" class="form-ctrl form-ctrl-sm" name="video_url" id="input-video-url-{{ $vKey }}" value="{{ $currentVideoUrl }}" placeholder="https://... or /videos/...">
                        </div>
                        <div>
                            <label class="form-label-sm" style="font-size:0.7rem">Or Upload Video File</label>
                            <input type="file" class="form-ctrl form-ctrl-sm" name="video_file" id="input-video-file-{{ $vKey }}" accept="video/mp4,video/webm,video/ogg,video/quicktime">
                        </div>
                    </div>
                </div>

                <!-- Poster Frame: URL or File Upload -->
                <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1rem;margin-bottom:1.25rem">
                    <div style="font-size:0.75rem;font-weight:700;color:var(--text-primary);text-transform:uppercase;letter-spacing:0.04em;margin-bottom:0.65rem">
                        🖼️ Video Poster Thumbnail (.webp, .png, .jpg &bull; up to 10MB)
                    </div>
                    <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:1rem;align-items:center">
                        <div>
                            <label class="form-label-sm" style="font-size:0.7rem">Poster Image URL</label>
                            <input type="text" class="form-ctrl form-ctrl-sm" name="poster_url" id="input-poster-url-{{ $vKey }}" value="{{ $currentPosterUrl }}" placeholder="/images/mockups/...">
                        </div>
                        <div>
                            <label class="form-label-sm" style="font-size:0.7rem">Or Upload Poster Image</label>
                            <input type="file" class="form-ctrl form-ctrl-sm" name="poster_file" id="input-poster-file-{{ $vKey }}" accept="image/webp,image/png,image/jpeg,image/jpg,image/svg+xml">
                        </div>
                    </div>
                </div>

                <!-- Action Button & Status -->
                <div style="display:flex;align-items:center;gap:1rem">
                    <button type="submit" class="btn btn--primary btn--sm" id="btn-save-{{ $vKey }}">
                        💾 Update {{ $meta['name'] }} Video
                    </button>
                    <span id="save-status-{{ $vKey }}" style="display:none;font-size:0.8rem;color:var(--clr-success);font-weight:600">
                        ✓ Saved &amp; Live!
                    </span>
                </div>
            </form>
        </div>
        @endforeach

    </div>
</div>

<!-- ─── 10. MEDIA PANEL ─── -->
<div class="admin-panel" id="panel-media">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">🖼️ Media Library</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Product screenshots, architectural diagrams, and brand assets</p>
        </div>
        <button class="btn btn--primary btn--sm" onclick="alert('Select files from your device to upload.')">⬆ Upload Asset</button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:1rem">
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.5rem;text-align:center">
            <div style="font-size:2rem">🗳️</div>
            <small style="color:var(--text-muted)">itikia-mockup.png</small>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.5rem;text-align:center">
            <div style="font-size:2rem">⚙️</div>
            <small style="color:var(--text-muted)">opero-pos.png</small>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:1.5rem;text-align:center">
            <div style="font-size:2rem">📊</div>
            <small style="color:var(--text-muted)">architecture-chart.svg</small>
        </div>
    </div>
</div>

<!-- ─── 10. CONTACT SETTINGS PANEL ─── -->
<div class="admin-panel" id="panel-contact-settings">
    <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1.4rem;margin-bottom:.25rem">📞 Contact Info &amp; Office Channels</h2>
        <p style="color:var(--text-muted);font-size:.875rem">Manage company contact points displayed across the header, footer, and contact page</p>
    </div>
    <div class="settings-card" style="max-width: 600px;">
        <form id="contact-settings-form" onsubmit="saveContactSettings(event)">
            <div class="form-group-sm">
                <label class="form-label-sm">Company Email</label>
                <input type="email" id="cs_email" class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Phone Number</label>
                <input type="text" id="cs_phone" class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">WhatsApp Number</label>
                <input type="text" id="cs_whatsapp" class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Head Office Address</label>
                <textarea id="cs_address" class="form-ctrl" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn--primary" style="margin-top: 1rem">Save Global Channels</button>
        </form>
    </div>
</div>

<!-- ─── 11. SEO PANEL ─── -->
<div class="admin-panel" id="panel-seo">
    <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1.4rem;margin-bottom:.25rem">🔍 Global SEO &amp; Meta Settings</h2>
        <p style="color:var(--text-muted);font-size:.875rem">Default metadata for search engines and social sharing</p>
    </div>
    <div class="settings-card" style="max-width:600px">
        <div class="form-group-sm">
            <label class="form-label-sm">Brand Title</label>
            <input class="form-ctrl" value="CypressIQ — Digital Products &amp; Enterprise Software Studio" />
        </div>
        <div class="form-group-sm">
            <label class="form-label-sm">Meta Description</label>
            <textarea class="form-ctrl" rows="3">CypressIQ builds digital products, business systems and custom technology solutions that help organizations operate, engage and grow.</textarea>
        </div>
        <button class="btn btn--primary" onclick="alert('SEO preferences saved!')" style="margin-top:1rem">Save SEO Config</button>
    </div>
</div>

<!-- ─── 12. GENERAL SETTINGS PANEL ─── -->
<div class="admin-panel" id="panel-settings">
    <div style="margin-bottom:1.5rem">
        <h2 style="font-size:1.4rem;margin-bottom:.25rem">⚙️ System Preferences</h2>
        <p style="color:var(--text-muted);font-size:.875rem">Telemetry, lead notifications, and developer settings</p>
    </div>
    <div class="settings-card" style="max-width:600px">
        <div class="toggle-row">
            <span class="toggle-label">Instant Admin Log Alerts on Form Intake</span>
            <label class="toggle-switch"><input type="checkbox" checked /><span class="toggle-slider"></span></label>
        </div>
        <div class="toggle-row">
            <span class="toggle-label">Project Discovery Engine Active</span>
            <label class="toggle-switch"><input type="checkbox" checked /><span class="toggle-slider"></span></label>
        </div>
        <div class="toggle-row">
            <span class="toggle-label">Interactive Product Preview Demos Enabled</span>
            <label class="toggle-switch"><input type="checkbox" checked /><span class="toggle-slider"></span></label>
        </div>
        <button class="btn btn--primary" onclick="alert('Preferences saved!')" style="margin-top:1rem">Save Preferences</button>
    </div>
</div>

<!-- ─── MODAL: LEAD DETAIL & DISCOVERY SPECS INSPECTOR ─── -->
<div class="lead-detail-modal" id="lead-inspector-modal" onclick="if(event.target===this) closeLeadModal()">
    <div class="lead-detail-box">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.25rem">
            <div>
                <h3 style="font-size:1.3rem;margin:0" id="modal-lead-name">Prospect Name</h3>
                <small style="color:var(--text-muted)" id="modal-lead-meta">Email &middot; Date</small>
            </div>
            <button class="btn btn--outline btn--sm" onclick="closeLeadModal()">✕ Close</button>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem">
            <div>
                <div style="font-size:0.75rem;color:var(--text-muted);text-transform:uppercase;font-weight:600">Product / Interest</div>
                <div style="font-size:1rem;font-weight:700;margin-top:0.2rem" id="modal-lead-product">-</div>
            </div>
            <div>
                <div style="font-size:0.75rem;color:var(--text-muted);text-transform:uppercase;font-weight:600">Operational Scale</div>
                <div style="font-size:1rem;font-weight:700;margin-top:0.2rem" id="modal-lead-scale">-</div>
            </div>
            <div>
                <div style="font-size:0.75rem;color:var(--text-muted);text-transform:uppercase;font-weight:600">Direct Phone</div>
                <div style="font-size:1rem;margin-top:0.2rem" id="modal-lead-phone">-</div>
            </div>
            <div>
                <div style="font-size:0.75rem;color:var(--text-muted);text-transform:uppercase;font-weight:600">Timeline / Budget</div>
                <div style="font-size:1rem;margin-top:0.2rem" id="modal-lead-timeline">-</div>
            </div>
        </div>

        <!-- Full Discovery Scope & Message -->
        <div class="discovery-spec-card">
            <div style="font-size:0.8rem;font-weight:700;color:var(--clr-accent);margin-bottom:0.5rem">📐 CLIENT SPECIFICATION / BOTTLENECK DISCOVERY:</div>
            <div style="font-size:0.92rem;line-height:1.6;white-space:pre-wrap;color:var(--text-primary)" id="modal-lead-message">No detailed message recorded.</div>
        </div>

        <!-- Internal Notes Log -->
        <div style="margin-top:1.5rem">
            <label style="font-size:0.8rem;font-weight:700;color:var(--text-muted);display:block;margin-bottom:0.5rem">📝 INTERNAL ENGINEERING NOTES &amp; ACTIVITY LOG:</label>
            <div style="background:rgba(0,0,0,0.25);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:0.75rem;font-size:0.85rem;line-height:1.5;white-space:pre-wrap;max-height:150px;overflow-y:auto;color:var(--text-secondary);margin-bottom:0.75rem" id="modal-lead-notes">No notes yet.</div>
            <div style="display:flex;gap:0.5rem">
                <input type="text" id="modal-new-note" placeholder="Add engineering follow-up note..." class="form-ctrl" style="flex:1" onkeydown="if(event.key==='Enter') submitLeadNote()" />
                <button class="btn btn--primary btn--sm" onclick="submitLeadNote()">Add Note</button>
            </div>
        </div>

        <!-- Stage & Priority Controls -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid var(--border-subtle)">
            <div>
                <label class="form-label-sm">Update Pipeline Stage</label>
                <select id="modal-lead-status-select" class="form-ctrl select" onchange="updateLeadStatusFromModal(this.value)">
                    <option value="new">● New Lead</option>
                    <option value="reviewed">● Reviewed by Engineering</option>
                    <option value="qualified">● Qualified Opportunity</option>
                    <option value="proposal">● Proposal Drafted / Sent</option>
                    <option value="won">● Won / Project Initiated</option>
                    <option value="lost">● Lost / Archived</option>
                </select>
            </div>
            <div>
                <label class="form-label-sm">Update Priority</label>
                <select id="modal-lead-priority-select" class="form-ctrl select" onchange="updateLeadPriorityFromModal(this.value)">
                    <option value="low">⚪ Low</option>
                    <option value="medium">🔵 Medium</option>
                    <option value="high">🟠 High</option>
                    <option value="urgent">🔴 Urgent (Immediate Action)</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- ─── MODAL: CREATE MANUAL LEAD ─── -->
<div class="lead-detail-modal" id="lead-create-modal" onclick="if(event.target===this) closeCreateLeadModal()">
    <div class="lead-detail-box" style="max-width:560px">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.25rem">
            <h3 style="font-size:1.3rem;margin:0">Create Manual Pipeline Lead</h3>
            <button class="btn btn--outline btn--sm" onclick="closeCreateLeadModal()">✕</button>
        </div>
        <form onsubmit="submitCreateLead(event)">
            <div class="form-group-sm">
                <label class="form-label-sm">Contact Name *</label>
                <input type="text" id="new-lead-name" class="form-ctrl" required />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Email Address *</label>
                <input type="email" id="new-lead-email" class="form-ctrl" required />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Phone Number</label>
                <input type="text" id="new-lead-phone" class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Product Scope</label>
                <select id="new-lead-product" class="form-ctrl select">
                    <option value="itikia">ITIKIA Platform</option>
                    <option value="opero">OPERO ERP</option>
                    <option value="solutions">Client Solutions</option>
                    <option value="consulting">Technology Consulting</option>
                </select>
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Project Specifications / Notes</label>
                <textarea id="new-lead-message" class="form-ctrl" rows="3"></textarea>
            </div>
            <div style="text-align:right;margin-top:1.5rem">
                <button type="submit" class="btn btn--primary">Save into Pipeline</button>
            </div>
        </form>
    </div>
</div>

<!-- ─── MODAL: INSERT IMAGE INTO CONTENT ─── -->
<div class="lead-detail-modal" id="insert-image-modal" onclick="if(event.target===this) closeInsertImageModal()">
    <div class="lead-detail-box" style="max-width:560px">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.25rem">
            <h3 style="font-size:1.3rem;margin:0">🖼️ Insert Image into Article</h3>
            <button class="btn btn--outline btn--sm" onclick="closeInsertImageModal()">✕</button>
        </div>
        <form onsubmit="submitInsertImage(event)">
            <div class="form-group-sm">
                <label class="form-label-sm">Upload from Device</label>
                <input type="file" id="modal-image-file" accept="image/*" class="form-ctrl" />
                <small style="color:var(--text-muted)">Supports WebP, PNG, JPG, GIF, SVG (up to 10MB)</small>
            </div>
            <div style="text-align:center;margin:0.75rem 0;color:var(--text-muted);font-size:0.8rem">— OR ENTER DIRECT URL —</div>
            <div class="form-group-sm">
                <label class="form-label-sm">Image URL</label>
                <input type="text" id="modal-image-url" placeholder="https://images.unsplash.com/... or /storage/uploads/..." class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Image Caption / Alt Text</label>
                <input type="text" id="modal-image-caption" placeholder="Describe the image or enter caption" class="form-ctrl" />
            </div>
            <div style="text-align:right;margin-top:1.5rem;display:flex;justify-content:flex-end;gap:0.75rem">
                <button type="button" class="btn btn--outline btn--sm" onclick="closeInsertImageModal()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm" id="btn-submit-insert-image">Insert Image</button>
            </div>
        </form>
    </div>
</div>

<!-- ─── MODAL: INSERT VIDEO INTO CONTENT ─── -->
<div class="lead-detail-modal" id="insert-video-modal" onclick="if(event.target===this) closeInsertVideoModal()">
    <div class="lead-detail-box" style="max-width:560px">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.25rem">
            <h3 style="font-size:1.3rem;margin:0">🎥 Insert Video (MP4 / WebM)</h3>
            <button class="btn btn--outline btn--sm" onclick="closeInsertVideoModal()">✕</button>
        </div>
        <form onsubmit="submitInsertVideo(event)">
            <div class="form-group-sm">
                <label class="form-label-sm">Upload Video File</label>
                <input type="file" id="modal-video-file" accept="video/mp4,video/webm,video/ogg,video/quicktime" class="form-ctrl" />
                <small style="color:var(--text-muted)">Supports MP4, WebM, MOV up to 50MB</small>
            </div>
            <div style="text-align:center;margin:0.75rem 0;color:var(--text-muted);font-size:0.8rem">— OR ENTER DIRECT VIDEO URL —</div>
            <div class="form-group-sm">
                <label class="form-label-sm">Direct Video URL</label>
                <input type="text" id="modal-video-url" placeholder="https://domain.com/video.mp4" class="form-ctrl" />
            </div>
            <div style="text-align:right;margin-top:1.5rem;display:flex;justify-content:flex-end;gap:0.75rem">
                <button type="button" class="btn btn--outline btn--sm" onclick="closeInsertVideoModal()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm" id="btn-submit-insert-video">Insert HTML5 Video Player</button>
            </div>
        </form>
    </div>
</div>

<!-- ─── MODAL: EMBED VIDEO LINK (YOUTUBE / VIMEO) ─── -->
<div class="lead-detail-modal" id="insert-video-link-modal" onclick="if(event.target===this) closeInsertVideoLinkModal()">
    <div class="lead-detail-box" style="max-width:560px">
        <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border-subtle);padding-bottom:1rem;margin-bottom:1.25rem">
            <h3 style="font-size:1.3rem;margin:0">🔗 Embed Video Link</h3>
            <button class="btn btn--outline btn--sm" onclick="closeInsertVideoLinkModal()">✕</button>
        </div>
        <form onsubmit="submitInsertVideoLink(event)">
            <div class="form-group-sm">
                <label class="form-label-sm">Video URL (YouTube, Vimeo, Loom, or web link) *</label>
                <input type="text" id="modal-video-link-url" placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..." class="form-ctrl" required />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Video Title (optional)</label>
                <input type="text" id="modal-video-link-title" placeholder="e.g. CypressIQ Architecture Walkthrough" class="form-ctrl" />
            </div>
            <div class="form-group-sm">
                <label class="form-label-sm">Presentation Format</label>
                <div style="display:flex;flex-direction:column;gap:0.5rem;margin-top:0.25rem">
                    <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;cursor:pointer">
                        <input type="radio" name="video_embed_style" value="iframe" checked />
                        <span><strong>Responsive 16:9 Player Embed</strong> (plays directly inside the article)</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;cursor:pointer">
                        <input type="radio" name="video_embed_style" value="card" />
                        <span><strong>Interactive Video Link Card</strong> (badge, title, and link out)</span>
                    </label>
                </div>
            </div>
            <div style="text-align:right;margin-top:1.5rem;display:flex;justify-content:flex-end;gap:0.75rem">
                <button type="button" class="btn btn--outline btn--sm" onclick="closeInsertVideoLinkModal()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm">Insert Video Embed</button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════════════ CLIENT JAVASCRIPT LOGIC ══════════════════ -->
<script>
    let currentInspectedLeadId = null;
    let leadsSearchTimer = null;
    let cachedLeads = [];

    // ── LEAD PIPELINE FETCH & RENDER ──
    async function loadLeads() {
        const tbody = document.getElementById('pipeline-table-body');
        if (!tbody) return;
        
        const status = document.getElementById('leads-filter-status')?.value || 'all';
        const product = document.getElementById('leads-filter-product')?.value || 'all';
        const priority = document.getElementById('leads-filter-priority')?.value || 'all';
        const search = document.getElementById('leads-search-input')?.value || '';

        try {
            const params = new URLSearchParams();
            if (status !== 'all') params.append('status', status);
            if (product !== 'all') params.append('product_interest', product);
            if (priority !== 'all') params.append('priority', priority);
            if (search.trim()) params.append('search', search.trim());

            const res = await fetch(`/admin/api/leads?${params.toString()}`);
            const data = await res.json();
            cachedLeads = data;

            // Update sidebar badge
            const badge = document.getElementById('nav-badge-leads');
            if (badge) badge.textContent = data.length;

            tbody.innerHTML = '';
            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">No matching leads in pipeline.</td></tr>';
                return;
            }

            data.forEach(lead => {
                const badgeColor = {
                    new: 'new',
                    reviewed: 'reviewed',
                    qualified: 'qualified',
                    proposal: 'proposal',
                    won: 'won',
                    lost: 'lost'
                }[lead.status || 'new'] || 'new';

                const priorityDot = lead.priority ? `<span class="priority-dot ${lead.priority}" title="Priority: ${lead.priority}"></span>` : '';
                const prodBadge = lead.product_interest ? lead.product_interest.toUpperCase() : (lead.type || 'INQUIRY');

                tbody.innerHTML += `
                <tr>
                    <td>
                        <strong>${escapeHtml(lead.name || 'Direct Contact')}</strong><br>
                        <small style="color:var(--text-muted)">${escapeHtml(lead.email)}</small><br>
                        ${lead.phone ? `<small style="color:var(--clr-accent)">${escapeHtml(lead.phone)}</small>` : ''}
                    </td>
                    <td>
                        <span class="lead-source-pill" style="font-weight:700">${escapeHtml(prodBadge)}</span>
                    </td>
                    <td>
                        <div style="font-size:0.8rem;color:var(--text-secondary);max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                            ${lead.project_scale ? `<strong>Scale:</strong> ${escapeHtml(lead.project_scale)}<br>` : ''}
                            ${escapeHtml(lead.message || 'No spec notes')}
                        </div>
                    </td>
                    <td>
                        <select class="form-ctrl select" onchange="updateLeadStatus(${lead.id}, this.value)" style="padding:4px 24px 4px 8px;border-radius:var(--radius-sm);font-weight:600;font-size:0.8rem;width:auto;min-width:105px;display:inline-block">
                            <option value="new" ${lead.status==='new'?'selected':''}>new</option>
                            <option value="reviewed" ${lead.status==='reviewed'?'selected':''}>reviewed</option>
                            <option value="qualified" ${lead.status==='qualified'?'selected':''}>qualified</option>
                            <option value="proposal" ${lead.status==='proposal'?'selected':''}>proposal</option>
                            <option value="won" ${lead.status==='won'?'selected':''}>won</option>
                            <option value="lost" ${lead.status==='lost'?'selected':''}>lost</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-ctrl select" onchange="updateLeadPriority(${lead.id}, this.value)" style="padding:4px 24px 4px 8px;border-radius:var(--radius-sm);font-weight:600;font-size:0.8rem;width:auto;min-width:95px;display:inline-block">
                            <option value="low" ${lead.priority==='low'?'selected':''}>Low</option>
                            <option value="medium" ${lead.priority==='medium'||!lead.priority?'selected':''}>Medium</option>
                            <option value="high" ${lead.priority==='high'?'selected':''}>High</option>
                            <option value="urgent" ${lead.priority==='urgent'?'selected':''}>Urgent</option>
                        </select>
                    </td>
                    <td>
                        <small style="color:var(--text-muted)">${escapeHtml(lead.assigned_to || 'Unassigned')}</small>
                    </td>
                    <td>
                        <button class="btn btn--outline btn--sm" onclick="inspectLeadById(${lead.id})" style="padding:3px 8px;font-size:0.75rem">Inspect</button>
                        <button class="table-action-btn danger" onclick="deleteLead(${lead.id})" title="Delete">🗑</button>
                    </td>
                </tr>`;
            });
        } catch(e) {
            console.error(e);
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#f87171;padding:2rem">Failed to load leads.</td></tr>';
        }
    }

    function debounceLeadsSearch() {
        clearTimeout(leadsSearchTimer);
        leadsSearchTimer = setTimeout(loadLeads, 300);
    }

    function resetLeadsFilters() {
        document.getElementById('leads-search-input').value = '';
        document.getElementById('leads-filter-status').value = 'all';
        document.getElementById('leads-filter-product').value = 'all';
        document.getElementById('leads-filter-priority').value = 'all';
        loadLeads();
    }

    // ── FAST INLINE UPDATES ──
    async function updateLeadStatus(id, status) {
        await fetch(`/admin/api/leads/${id}/status`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({status})
        });
        loadLeads();
    }

    async function updateLeadPriority(id, priority) {
        await fetch(`/admin/api/leads/${id}/priority`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({priority})
        });
        loadLeads();
    }

    async function deleteLead(id) {
        if (!confirm('Permanently remove this lead from the pipeline?')) return;
        await fetch(`/admin/api/leads/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        loadLeads();
    }

    // ── MODAL INSPECTOR ──
    async function inspectLeadById(id) {
        currentInspectedLeadId = id;
        try {
            const res = await fetch(`/admin/api/leads/${id}`);
            const lead = await res.json();
            
            document.getElementById('modal-lead-name').textContent = lead.name || 'Direct Contact';
            document.getElementById('modal-lead-meta').textContent = `${lead.email} · Captured via: ${lead.source || 'Website'}`;
            document.getElementById('modal-lead-product').textContent = (lead.product_interest || lead.type || 'Solutions').toUpperCase();
            document.getElementById('modal-lead-scale').textContent = lead.project_scale || 'Not Specified';
            document.getElementById('modal-lead-phone').textContent = lead.phone || 'None provided';
            document.getElementById('modal-lead-timeline').textContent = lead.timeline || 'Flexible';
            document.getElementById('modal-lead-message').textContent = lead.message || 'No additional scope specifications recorded.';
            document.getElementById('modal-lead-notes').textContent = lead.notes || 'No internal notes recorded yet. Add notes below.';

            document.getElementById('modal-lead-status-select').value = lead.status || 'new';
            document.getElementById('modal-lead-priority-select').value = lead.priority || 'medium';

            document.getElementById('lead-inspector-modal').style.display = 'flex';
        } catch(e) {
            console.error(e);
            alert('Could not inspect lead details.');
        }
    }

    function closeLeadModal() {
        document.getElementById('lead-inspector-modal').style.display = 'none';
        currentInspectedLeadId = null;
    }

    async function submitLeadNote() {
        if (!currentInspectedLeadId) return;
        const input = document.getElementById('modal-new-note');
        const note = input.value.trim();
        if (!note) return;

        try {
            const res = await fetch(`/admin/api/leads/${currentInspectedLeadId}/notes`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({note})
            });
            const data = await res.json();
            if (data.lead) {
                document.getElementById('modal-lead-notes').textContent = data.lead.notes;
                input.value = '';
            }
        } catch(e) {
            console.error(e);
            alert('Failed to save note.');
        }
    }

    async function updateLeadStatusFromModal(val) {
        if (!currentInspectedLeadId) return;
        await updateLeadStatus(currentInspectedLeadId, val);
    }

    async function updateLeadPriorityFromModal(val) {
        if (!currentInspectedLeadId) return;
        await updateLeadPriority(currentInspectedLeadId, val);
    }

    // ── CREATE LEAD MODAL ──
    function openCreateLeadModal() {
        document.getElementById('lead-create-modal').style.display = 'flex';
    }

    function closeCreateLeadModal() {
        document.getElementById('lead-create-modal').style.display = 'none';
    }

    async function submitCreateLead(e) {
        e.preventDefault();
        const payload = {
            name: document.getElementById('new-lead-name').value,
            email: document.getElementById('new-lead-email').value,
            phone: document.getElementById('new-lead-phone').value,
            product_interest: document.getElementById('new-lead-product').value,
            message: document.getElementById('new-lead-message').value,
            source: 'admin_cockpit_manual',
            status: 'new',
            priority: 'medium'
        };

        try {
            const res = await fetch('/admin/api/leads', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify(payload)
            });
            if (res.ok) {
                closeCreateLeadModal();
                loadLeads();
            } else {
                alert('Error creating lead.');
            }
        } catch(err) {
            console.error(err);
            alert('Network error.');
        }
    }

    // ── DEDICATED ITIKIA & OPERO PRODUCT LOADERS ──
    async function loadItikiaLeads() {
        const tbody = document.getElementById('itikia-table-body');
        if (!tbody) return;
        try {
            const res = await fetch('/admin/api/leads?product_interest=itikia');
            const data = await res.json();
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">No specific ITIKIA inquiries yet.</td></tr>';
                return;
            }
            data.forEach(l => {
                tbody.innerHTML += `
                <tr>
                    <td><strong>${escapeHtml(l.name || 'Direct')}</strong><br><small style="color:var(--text-muted)">${escapeHtml(l.email)}</small></td>
                    <td>${escapeHtml(l.project_scale || 'Standard Campaign')}</td>
                    <td><div style="font-size:0.8rem;max-width:260px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${escapeHtml(l.message || '-')}</div></td>
                    <td><span class="cockpit-badge ${l.status||'new'}">● ${l.status||'new'}</span></td>
                    <td><span class="priority-dot ${l.priority||'medium'}"></span> ${l.priority||'medium'}</td>
                    <td><button class="btn btn--outline btn--sm" onclick="inspectLeadById(${l.id})">Inspect</button></td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    async function loadOperoLeads() {
        const tbody = document.getElementById('opero-table-body');
        if (!tbody) return;
        try {
            const res = await fetch('/admin/api/leads?product_interest=opero');
            const data = await res.json();
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">No specific OPERO inquiries yet.</td></tr>';
                return;
            }
            data.forEach(l => {
                tbody.innerHTML += `
                <tr>
                    <td><strong>${escapeHtml(l.name || 'Direct')}</strong><br><small style="color:var(--text-muted)">${escapeHtml(l.email)}</small></td>
                    <td>${escapeHtml(l.project_scale || 'Multi-Outlet / Warehouse')}</td>
                    <td><div style="font-size:0.8rem;max-width:260px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${escapeHtml(l.message || '-')}</div></td>
                    <td><span class="cockpit-badge ${l.status||'new'}">● ${l.status||'new'}</span></td>
                    <td><span class="priority-dot ${l.priority||'medium'}"></span> ${l.priority||'medium'}</td>
                    <td><button class="btn btn--outline btn--sm" onclick="inspectLeadById(${l.id})">Inspect</button></td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    // ── MESSAGES (INBOX) API LOADER ──
    async function loadMessages() {
        const tbody = document.querySelector('#messages-table tbody');
        if (!tbody) return;
        try {
            const res = await fetch('/admin/api/messages');
            const data = await res.json();
            
            const badge = document.getElementById('nav-badge-messages');
            const unreadCount = data.filter(m => m.status === 'new').length;
            if (badge) badge.textContent = unreadCount;

            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">No inquiries in inbox.</td></tr>';
                return;
            }
            data.forEach(m => {
                tbody.innerHTML += `
                <tr>
                    <td><strong>${escapeHtml(m.first_name)} ${escapeHtml(m.last_name)}</strong></td>
                    <td>${escapeHtml(m.email)}<br><small style="color:var(--text-muted)">${escapeHtml(m.phone || '-')}</small></td>
                    <td>${escapeHtml(m.service_interest)}</td>
                    <td><small>${escapeHtml(m.budget_range || 'Flexible')}</small></td>
                    <td>
                        <select class="form-ctrl select" onchange="updateMessageStatus(${m.id}, this.value)" style="padding:4px 24px 4px 8px;border-radius:var(--radius-sm);font-weight:600;font-size:0.8rem;width:auto;min-width:95px;display:inline-block">
                            <option value="new" ${m.status==='new'?'selected':''}>new</option>
                            <option value="read" ${m.status==='read'?'selected':''}>read</option>
                            <option value="replied" ${m.status==='replied'?'selected':''}>replied</option>
                        </select>
                    </td>
                    <td><small>${new Date(m.created_at).toLocaleDateString()}</small></td>
                    <td>
                        <button class="btn btn--outline btn--sm" onclick="alert('Message Details:\\n\\n' + ${JSON.stringify(m.message)})" style="padding:2px 8px;font-size:0.75rem">Read</button>
                    </td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    async function updateMessageStatus(id, status) {
        await fetch(`/admin/api/messages/${id}/status`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({status})
        });
        loadMessages();
    }

    // ── BOOKINGS API LOADER ──
    async function loadBookings() {
        const tbody = document.querySelector('#bookings-table tbody');
        if (!tbody) return;
        try {
            const res = await fetch('/admin/api/bookings');
            const data = await res.json();
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">No strategy bookings scheduled.</td></tr>';
                return;
            }
            data.forEach(b => {
                tbody.innerHTML += `
                <tr>
                    <td><strong>${escapeHtml(b.name)}</strong></td>
                    <td>${escapeHtml(b.email)}<br><small style="color:var(--text-muted)">${escapeHtml(b.phone || '')}</small></td>
                    <td><strong style="color:var(--clr-accent)">${escapeHtml(b.preferred_time_slot)}</strong></td>
                    <td>
                        <select class="form-ctrl select" onchange="updateBookingStatus(${b.id}, this.value)" style="padding:4px 24px 4px 8px;border-radius:var(--radius-sm);font-weight:600;font-size:0.8rem;width:auto;min-width:115px;display:inline-block">
                            <option value="pending" ${b.status==='pending'?'selected':''}>pending</option>
                            <option value="confirmed" ${b.status==='confirmed'?'selected':''}>confirmed</option>
                            <option value="completed" ${b.status==='completed'?'selected':''}>completed</option>
                        </select>
                    </td>
                    <td><small>${new Date(b.created_at).toLocaleDateString()}</small></td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    async function updateBookingStatus(id, status) {
        await fetch(`/admin/api/bookings/${id}/status`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({status})
        });
        loadBookings();
    }

    // ── CONTACT SETTINGS ──
    async function loadContactSettings() {
        if (!document.getElementById('cs_email')) return;
        try {
            const res = await fetch('/admin/api/contact-settings');
            const data = await res.json();
            document.getElementById('cs_email').value = data.company_email || '';
            document.getElementById('cs_phone').value = data.phone_number || '';
            document.getElementById('cs_whatsapp').value = data.whatsapp_number || '';
            document.getElementById('cs_address').value = data.address || '';
        } catch(e) { console.error(e); }
    }

    async function saveContactSettings(e) {
        e.preventDefault();
        const payload = {
            company_email: document.getElementById('cs_email').value,
            phone_number: document.getElementById('cs_phone').value,
            whatsapp_number: document.getElementById('cs_whatsapp').value,
            address: document.getElementById('cs_address').value,
        };
        try {
            const res = await fetch('/admin/api/contact-settings', {
                method: 'PUT',
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify(payload)
            });
            if (res.ok) alert('Company contact channels updated successfully!');
        } catch(e) { console.error(e); }
    }

    // ── BLOG POST EDIT & MEDIA LOGIC ──
    let currentEditingPostId = null;

    async function editPost(id) {
        try {
            const res = await fetch(`/admin/api/posts/${id}`);
            const post = await res.json();
            currentEditingPostId = post.id;

            document.getElementById('post-id').value = post.id;
            document.getElementById('post-title').value = post.title || '';
            document.getElementById('post-slug').value = post.slug || '';
            document.getElementById('post-excerpt').value = post.excerpt || '';
            document.getElementById('post-content').value = post.content || '';
            document.getElementById('post-status').value = post.status || 'draft';
            if (document.getElementById('post-category')) {
                document.getElementById('post-category').value = post.category_id || '';
            }
            document.getElementById('post-featured-image').value = post.featured_image || '';
            updateFeaturedImagePreview(post.featured_image);
            document.getElementById('post-video-url').value = post.video_url || '';

            document.getElementById('editor-heading').textContent = `✏️ Edit Article: ${post.title}`;
            document.getElementById('editor-subtitle').textContent = `Editing ID #${post.id} · Created ${new Date(post.created_at).toLocaleDateString()}`;
            document.getElementById('btn-save-post').textContent = 'Update Article 🚀';
            document.getElementById('btn-cancel-edit').style.display = 'inline-block';

            showPanel('editor', document.querySelector('[onclick*="showPanel(\'editor\'"]'));
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } catch (e) {
            console.error(e);
            alert('Could not load post data for editing.');
        }
    }

    function resetPostEditor() {
        currentEditingPostId = null;
        document.getElementById('post-id').value = '';
        document.getElementById('post-title').value = '';
        document.getElementById('post-slug').value = '';
        document.getElementById('post-excerpt').value = '';
        document.getElementById('post-content').value = '';
        document.getElementById('post-status').value = 'published';
        if (document.getElementById('post-category')) {
            document.getElementById('post-category').value = '';
        }
        document.getElementById('post-featured-image').value = '';
        updateFeaturedImagePreview('');
        document.getElementById('post-video-url').value = '';

        document.getElementById('editor-heading').textContent = '✏️ Article Editor';
        document.getElementById('editor-subtitle').textContent = 'Author thought leadership articles, case studies & video tutorials';
        document.getElementById('btn-save-post').textContent = 'Publish Article 🚀';
        document.getElementById('btn-cancel-edit').style.display = 'none';
    }

    async function savePost(status) {
        const postId = document.getElementById('post-id')?.value;
        const payload = {
            title: document.getElementById('post-title')?.value || '',
            content: document.getElementById('post-content')?.value || '',
            excerpt: document.getElementById('post-excerpt')?.value || '',
            slug: document.getElementById('post-slug')?.value || '',
            category_id: document.getElementById('post-category')?.value || null,
            featured_image: document.getElementById('post-featured-image')?.value || null,
            video_url: document.getElementById('post-video-url')?.value || null,
            status: status,
        };

        if (!payload.title || !payload.content) {
            alert('Article Title and Content are required!');
            return;
        }

        try {
            const url = postId ? `/admin/api/posts/${postId}` : "{{ route('admin.api.posts.store') }}";
            const method = postId ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();
            if (response.ok) {
                alert(result.message || (postId ? 'Article updated successfully!' : 'Article published successfully!'));
                window.location.reload();
            } else {
                alert('Error: ' + (result.message || JSON.stringify(result.errors || result)));
            }
        } catch (error) {
            console.error(error);
            alert('Network error saving article.');
        }
    }

    function updateFeaturedImagePreview(url) {
        const box = document.getElementById('preview-featured-image-box');
        const img = document.getElementById('preview-featured-image');
        if (!box || !img) return;
        if (url && url.trim()) {
            img.src = url.trim().startsWith('http') || url.trim().startsWith('/') ? url.trim() : '/' + url.trim();
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
            img.src = '';
        }
    }

    async function uploadFeaturedImage(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const formData = new FormData();
        formData.append('image', file);

        try {
            const res = await fetch("{{ route('admin.api.upload') }}", {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            });
            const data = await res.json();
            if (data.url || (data.file && data.file.url)) {
                const finalUrl = data.url || data.file.url;
                document.getElementById('post-featured-image').value = finalUrl;
                updateFeaturedImagePreview(finalUrl);
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        } catch(e) {
            console.error(e);
            alert('Error uploading cover image.');
        }
    }

    async function uploadFeaturedVideo(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const formData = new FormData();
        formData.append('file', file);

        try {
            const res = await fetch("{{ route('admin.api.upload') }}", {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            });
            const data = await res.json();
            if (data.url || (data.file && data.file.url)) {
                const finalUrl = data.url || data.file.url;
                document.getElementById('post-video-url').value = finalUrl;
                alert('Video uploaded successfully! It has been set as the featured video walkthrough.');
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        } catch(e) {
            console.error(e);
            alert('Error uploading video file.');
        }
    }

    // ── MEDIA CONTENT INSERTION HELPERS ──
    function insertIntoContent(text) {
        const textarea = document.getElementById('post-content');
        if (!textarea) return;
        const start = textarea.selectionStart || 0;
        const end = textarea.selectionEnd || 0;
        const before = textarea.value.substring(0, start);
        const after = textarea.value.substring(end, textarea.value.length);
        textarea.value = before + text + after;
        textarea.focus();
        textarea.selectionStart = textarea.selectionEnd = start + text.length;
    }

    function openInsertImageModal() {
        document.getElementById('insert-image-modal').style.display = 'flex';
        document.getElementById('modal-image-file').value = '';
        document.getElementById('modal-image-url').value = '';
        document.getElementById('modal-image-caption').value = '';
    }

    function closeInsertImageModal() {
        document.getElementById('insert-image-modal').style.display = 'none';
    }

    async function submitInsertImage(e) {
        e.preventDefault();
        const fileInput = document.getElementById('modal-image-file');
        const urlInput = document.getElementById('modal-image-url');
        const captionInput = document.getElementById('modal-image-caption');
        const caption = captionInput.value.trim();

        let imageUrl = urlInput.value.trim();

        if (fileInput.files && fileInput.files[0]) {
            const btn = document.getElementById('btn-submit-insert-image');
            btn.textContent = 'Uploading...';
            btn.disabled = true;
            try {
                const formData = new FormData();
                formData.append('file', fileInput.files[0]);
                const res = await fetch("{{ route('admin.api.upload') }}", {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                });
                const data = await res.json();
                if (data.url || (data.file && data.file.url)) {
                    imageUrl = data.url || data.file.url;
                } else {
                    alert('Upload failed: ' + (data.message || 'Unknown error'));
                    btn.textContent = 'Insert Image';
                    btn.disabled = false;
                    return;
                }
            } catch(err) {
                console.error(err);
                alert('Upload failed due to network error.');
                btn.textContent = 'Insert Image';
                btn.disabled = false;
                return;
            }
            btn.textContent = 'Insert Image';
            btn.disabled = false;
        }

        if (!imageUrl) {
            alert('Please select an image file to upload or enter an image URL.');
            return;
        }

        let snippet = '';
        if (caption) {
            snippet = `\n\n<figure>\n  <img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(caption)}" />\n  <figcaption>${escapeHtml(caption)}</figcaption>\n</figure>\n\n`;
        } else {
            snippet = `\n\n<img src="${escapeHtml(imageUrl)}" alt="Article image" />\n\n`;
        }

        insertIntoContent(snippet);
        closeInsertImageModal();
    }

    function openInsertVideoModal() {
        document.getElementById('insert-video-modal').style.display = 'flex';
        document.getElementById('modal-video-file').value = '';
        document.getElementById('modal-video-url').value = '';
    }

    function closeInsertVideoModal() {
        document.getElementById('insert-video-modal').style.display = 'none';
    }

    async function submitInsertVideo(e) {
        e.preventDefault();
        const fileInput = document.getElementById('modal-video-file');
        const urlInput = document.getElementById('modal-video-url');
        let videoUrl = urlInput.value.trim();

        if (fileInput.files && fileInput.files[0]) {
            const btn = document.getElementById('btn-submit-insert-video');
            btn.textContent = 'Uploading Video...';
            btn.disabled = true;
            try {
                const formData = new FormData();
                formData.append('file', fileInput.files[0]);
                const res = await fetch("{{ route('admin.api.upload') }}", {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                });
                const data = await res.json();
                if (data.url || (data.file && data.file.url)) {
                    videoUrl = data.url || data.file.url;
                } else {
                    alert('Video upload failed: ' + (data.message || 'Unknown error'));
                    btn.textContent = 'Insert HTML5 Video Player';
                    btn.disabled = false;
                    return;
                }
            } catch(err) {
                console.error(err);
                alert('Upload failed due to network error.');
                btn.textContent = 'Insert HTML5 Video Player';
                btn.disabled = false;
                return;
            }
            btn.textContent = 'Insert HTML5 Video Player';
            btn.disabled = false;
        }

        if (!videoUrl) {
            alert('Please select a video file to upload or enter a video URL.');
            return;
        }

        const snippet = `\n\n<video controls preload="metadata">\n  <source src="${escapeHtml(videoUrl)}" type="video/mp4">\n  Your browser does not support the video tag.\n</video>\n\n`;
        insertIntoContent(snippet);
        closeInsertVideoModal();
    }

    function openInsertVideoLinkModal() {
        document.getElementById('insert-video-link-modal').style.display = 'flex';
        document.getElementById('modal-video-link-url').value = '';
        document.getElementById('modal-video-link-title').value = '';
    }

    function closeInsertVideoLinkModal() {
        document.getElementById('insert-video-link-modal').style.display = 'none';
    }

    function submitInsertVideoLink(e) {
        e.preventDefault();
        const url = document.getElementById('modal-video-link-url').value.trim();
        const title = document.getElementById('modal-video-link-title').value.trim() || 'Architecture / Demo Video';
        const style = document.querySelector('input[name="video_embed_style"]:checked')?.value || 'iframe';

        if (!url) {
            alert('Please enter a video URL.');
            return;
        }

        let snippet = '';
        if (style === 'card') {
            snippet = `\n\n<a href="${escapeHtml(url)}" target="_blank" rel="noopener noreferrer" class="video-link-card">\n  <div class="video-link-icon">▶</div>\n  <div>\n    <strong style="color:var(--text-primary);font-size:1rem;display:block">${escapeHtml(title)}</strong>\n    <span style="color:var(--clr-accent);font-size:0.85rem">${escapeHtml(url)} ↗</span>\n  </div>\n</a>\n\n`;
        } else {
            // Check YouTube
            const ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
            if (ytMatch && ytMatch[1]) {
                snippet = `\n\n<div class="video-container">\n  <iframe src="https://www.youtube-nocookie.com/embed/${ytMatch[1]}?rel=0" title="${escapeHtml(title)}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\n</div>\n\n`;
            } else {
                // Check Vimeo
                const vimeoMatch = url.match(/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)/i);
                if (vimeoMatch) {
                    const vId = vimeoMatch[vimeoMatch.length - 1];
                    snippet = `\n\n<div class="video-container">\n  <iframe src="https://player.vimeo.com/video/${vId}" title="${escapeHtml(title)}" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>\n</div>\n\n`;
                } else if (url.match(/\.(mp4|webm|ogg|mov)($|\?)/i) || url.startsWith('/storage/')) {
                    snippet = `\n\n<video controls preload="metadata">\n  <source src="${escapeHtml(url)}" type="video/mp4">\n  Your browser does not support the video tag.\n</video>\n\n`;
                } else {
                    snippet = `\n\n<div class="video-container">\n  <iframe src="${escapeHtml(url)}" title="${escapeHtml(title)}" allowfullscreen></iframe>\n</div>\n\n`;
                }
            }
        }

        insertIntoContent(snippet);
        closeInsertVideoLinkModal();
    }

    function insertQuoteBlock() {
        const quote = prompt('Enter quote text:');
        if (quote && quote.trim()) {
            insertIntoContent(`\n\n<blockquote>\n  "${escapeHtml(quote.trim())}"\n</blockquote>\n\n`);
        }
    }

    function insertCtaBlock() {
        const title = prompt('CTA Heading:', 'Ready to Scale Your Systems?');
        if (!title) return;
        const text = prompt('CTA Description:', 'Consult with CypressIQ engineering on custom software architecture.');
        const snippet = `\n\n<div class="inline-cta">\n  <h3>⚡ ${escapeHtml(title)}</h3>\n  <p>${escapeHtml(text || '')}</p>\n  <div class="cta-btns">\n    <a href="/contact" class="btn btn--primary">Get in Touch →</a>\n  </div>\n</div>\n\n`;
        insertIntoContent(snippet);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"']/g, function(m) {
            return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'}[m];
        });
    }

    // ── PRODUCT VIDEO MANAGER SCRIPTS ──
    async function saveProductVideo(productKey, event) {
        if (event) event.preventDefault();

        const form = document.getElementById(`form-video-${productKey}`);
        const btn = document.getElementById(`btn-save-${productKey}`);
        const statusEl = document.getElementById(`save-status-${productKey}`);
        const previewVideo = document.getElementById(`${productKey}-admin-video`);
        const displayUrl = document.getElementById(`current-url-display-${productKey}`);

        if (!form || !btn) return;

        const originalBtnText = btn.textContent;
        btn.textContent = '⏳ Uploading & Saving...';
        btn.disabled = true;
        if (statusEl) statusEl.style.display = 'none';

        const formData = new FormData(form);

        try {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const res = await fetch(`/admin/api/product-videos/${productKey}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token || '',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await res.json();

            if (res.ok && data.success) {
                if (statusEl) {
                    statusEl.textContent = '✓ Saved & Live!';
                    statusEl.style.color = 'var(--clr-success)';
                    statusEl.style.display = 'inline-block';
                    setTimeout(() => { statusEl.style.display = 'none'; }, 4000);
                }

                // Update preview video src and poster live in dashboard
                if (data.video && data.video.video_url && previewVideo) {
                    previewVideo.src = data.video.video_url;
                    if (data.video.poster_url) previewVideo.poster = data.video.poster_url;
                    previewVideo.load();
                }
                if (data.video && data.video.video_url && displayUrl) {
                    displayUrl.textContent = data.video.video_url;
                    displayUrl.title = data.video.video_url;
                }

                // Update input URL fields if file was uploaded
                if (data.video && data.video.video_url) {
                    const urlInput = document.getElementById(`input-video-url-${productKey}`);
                    if (urlInput) urlInput.value = data.video.video_url;
                }
                if (data.video && data.video.poster_url) {
                    const posterInput = document.getElementById(`input-poster-url-${productKey}`);
                    if (posterInput) posterInput.value = data.video.poster_url;
                }

                // Reset file inputs
                const vFile = document.getElementById(`input-video-file-${productKey}`);
                if (vFile) vFile.value = '';
                const pFile = document.getElementById(`input-poster-file-${productKey}`);
                if (pFile) pFile.value = '';

                // Also update global modal registry if available
                if (window.CYPRESSIQ_VIDEOS && window.CYPRESSIQ_VIDEOS[productKey]) {
                    window.CYPRESSIQ_VIDEOS[productKey].title = data.video.title;
                    window.CYPRESSIQ_VIDEOS[productKey].subtitle = data.video.subtitle;
                    window.CYPRESSIQ_VIDEOS[productKey].video_url = data.video.video_url;
                    window.CYPRESSIQ_VIDEOS[productKey].poster_url = data.video.poster_url;
                }
            } else {
                alert(data.message || 'Failed to save product video configuration.');
            }
        } catch (err) {
            console.error(err);
            alert('An unexpected network error occurred while uploading.');
        } finally {
            btn.textContent = originalBtnText;
            btn.disabled = false;
        }
    }

    function testProductModalDirectly(key) {
        if (typeof openProductVideoModal === 'function') {
            openProductVideoModal(key);
        } else {
            const previewVideo = document.getElementById(`${key}-admin-video`);
            if (previewVideo) {
                previewVideo.scrollIntoView({ behavior: 'smooth', block: 'center' });
                previewVideo.play().catch(() => {});
            }
        }
    }

    // Initialize data on page load
    document.addEventListener('DOMContentLoaded', () => {
        loadMessages();
        loadContactSettings();
    });
</script>

<!-- Centered Product Video Walkthrough Modal (For Admin Preview Testing) -->
@include('partials.product-video-modal')

<!-- ─────────────────────────────────────────────────────────────────────
     TRUST & SOCIAL PROOF PANELS
───────────────────────────────────────────────────────────────────────── -->

{{-- ══ TESTIMONIALS PANEL ══ --}}
<div class="admin-panel" id="panel-testimonials" style="display:none">
    <div class="admin-table-header" style="margin-bottom:1.5rem">
        <div>
            <div class="admin-table-title">💬 Client Testimonials</div>
            <small style="color:var(--text-muted)">Manage testimonials shown on the /trust page and homepage.</small>
        </div>
        <button class="btn btn--primary btn--sm" onclick="openTestimonialForm()">+ Add Testimonial</button>
    </div>

    <!-- Form -->
    <div id="testimonial-form-wrap" style="display:none;background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.5rem;margin-bottom:1.5rem">
        <h3 style="margin:0 0 1rem;font-size:1rem" id="testimonial-form-title">New Testimonial</h3>
        <form id="testimonial-form" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <input type="hidden" id="t-id" value="">
            <div style="grid-column:1/-1">
                <label class="form-label">Quote *</label>
                <textarea id="t-quote" rows="3" class="form-input" placeholder="What the client said..." required style="width:100%;resize:vertical"></textarea>
            </div>
            <div>
                <label class="form-label">Client Name *</label>
                <input type="text" id="t-name" class="form-input" placeholder="Jane Doe" required>
            </div>
            <div>
                <label class="form-label">Client Role</label>
                <input type="text" id="t-role" class="form-input" placeholder="CEO">
            </div>
            <div>
                <label class="form-label">Company</label>
                <input type="text" id="t-company" class="form-input" placeholder="Acme Ltd">
            </div>
            <div>
                <label class="form-label">Product / Solution</label>
                <input type="text" id="t-product" class="form-input" placeholder="e.g. Opero, Custom Software">
            </div>
            <div>
                <label class="form-label">Avatar URL</label>
                <input type="text" id="t-avatar" class="form-input" placeholder="https://...">
            </div>
            <div>
                <label class="form-label">Rating (1–5)</label>
                <input type="number" id="t-rating" class="form-input" min="1" max="5" value="5">
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" id="t-sort" class="form-input" value="0">
            </div>
            <div style="display:flex;gap:1rem;align-items:center">
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="t-featured" style="width:16px;height:16px"> Featured
                </label>
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="t-published" checked style="width:16px;height:16px"> Published
                </label>
            </div>
            <div style="grid-column:1/-1;display:flex;gap:.75rem;justify-content:flex-end">
                <button type="button" class="btn btn--outline btn--sm" onclick="closeTestimonialForm()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm">Save Testimonial</button>
            </div>
        </form>
    </div>

    <!-- List -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="testimonials-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Company / Role</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Featured</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="testimonials-tbody">
                <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ══ TRUST PROJECTS PANEL ══ --}}
<div class="admin-panel" id="panel-trust-projects" style="display:none">
    <div class="admin-table-header" style="margin-bottom:1.5rem">
        <div>
            <div class="admin-table-title">🚀 Completed Projects</div>
            <small style="color:var(--text-muted)">Showcase delivered work on the /trust page.</small>
        </div>
        <button class="btn btn--primary btn--sm" onclick="openProjectForm()">+ Add Project</button>
    </div>

    <!-- Form -->
    <div id="project-form-wrap" style="display:none;background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.5rem;margin-bottom:1.5rem">
        <h3 style="margin:0 0 1rem;font-size:1rem" id="project-form-title">New Project</h3>
        <form id="project-form" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <input type="hidden" id="p-id" value="">
            <div>
                <label class="form-label">Project Title *</label>
                <input type="text" id="p-title" class="form-input" placeholder="E-Commerce Platform" required>
            </div>
            <div>
                <label class="form-label">Category *</label>
                <input type="text" id="p-category" class="form-input" placeholder="Web App" required>
            </div>
            <div>
                <label class="form-label">Client Name</label>
                <input type="text" id="p-client" class="form-input" placeholder="Company name">
            </div>
            <div>
                <label class="form-label">Industry</label>
                <input type="text" id="p-industry" class="form-input" placeholder="Retail">
            </div>
            <div style="grid-column:1/-1">
                <label class="form-label">Summary *</label>
                <textarea id="p-summary" rows="2" class="form-input" placeholder="Brief project description..." required style="width:100%;resize:vertical"></textarea>
            </div>
            <div style="grid-column:1/-1">
                <label class="form-label">Full Description</label>
                <textarea id="p-description" rows="4" class="form-input" placeholder="Detailed case study body..." style="width:100%;resize:vertical"></textarea>
            </div>
            <div>
                <label class="form-label">Cover Image URL</label>
                <input type="text" id="p-cover" class="form-input" placeholder="https://...">
            </div>
            <div>
                <label class="form-label">Project URL</label>
                <input type="text" id="p-url" class="form-input" placeholder="https://...">
            </div>
            <div>
                <label class="form-label">Technologies (comma-separated)</label>
                <input type="text" id="p-tech" class="form-input" placeholder="Laravel, Vue.js, MySQL">
            </div>
            <div>
                <label class="form-label">Outcomes (comma-separated)</label>
                <input type="text" id="p-outcomes" class="form-input" placeholder="40% faster processing, ...">
            </div>
            <div>
                <label class="form-label">Duration</label>
                <input type="text" id="p-duration" class="form-input" placeholder="3 months">
            </div>
            <div>
                <label class="form-label">Completed Date</label>
                <input type="date" id="p-completed" class="form-input">
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" id="p-sort" class="form-input" value="0">
            </div>
            <div style="display:flex;gap:1rem;align-items:center">
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="p-featured" style="width:16px;height:16px"> Featured
                </label>
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="p-published" checked style="width:16px;height:16px"> Published
                </label>
            </div>
            <div style="grid-column:1/-1;display:flex;gap:.75rem;justify-content:flex-end">
                <button type="button" class="btn btn--outline btn--sm" onclick="closeProjectForm()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm">Save Project</button>
            </div>
        </form>
    </div>

    <!-- List -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="projects-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Client</th>
                    <th>Duration</th>
                    <th>Featured</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="projects-tbody">
                <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ══ PARTNERSHIPS PANEL ══ --}}
<div class="admin-panel" id="panel-partnerships" style="display:none">
    <div class="admin-table-header" style="margin-bottom:1.5rem">
        <div>
            <div class="admin-table-title">🤝 Partnerships</div>
            <small style="color:var(--text-muted)">Add technology partners, clients and strategic allies shown on /trust.</small>
        </div>
        <button class="btn btn--primary btn--sm" onclick="openPartnerForm()">+ Add Partner</button>
    </div>

    <!-- Form -->
    <div id="partner-form-wrap" style="display:none;background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.5rem;margin-bottom:1.5rem">
        <h3 style="margin:0 0 1rem;font-size:1rem" id="partner-form-title">New Partnership</h3>
        <form id="partner-form" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <input type="hidden" id="pp-id" value="">
            <div>
                <label class="form-label">Partner Name *</label>
                <input type="text" id="pp-name" class="form-input" placeholder="Acme Corp" required>
            </div>
            <div>
                <label class="form-label">Partnership Type</label>
                <select id="pp-type" class="form-input">
                    <option value="technology">Technology</option>
                    <option value="client">Client</option>
                    <option value="reseller">Reseller</option>
                    <option value="strategic">Strategic</option>
                </select>
            </div>
            <div>
                <label class="form-label">Logo URL</label>
                <input type="text" id="pp-logo" class="form-input" placeholder="https://...">
            </div>
            <div>
                <label class="form-label">Partner Website</label>
                <input type="url" id="pp-website" class="form-input" placeholder="https://...">
            </div>
            <div style="grid-column:1/-1">
                <label class="form-label">Description</label>
                <textarea id="pp-desc" rows="3" class="form-input" placeholder="Brief description of the partnership..." style="width:100%;resize:vertical"></textarea>
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" id="pp-sort" class="form-input" value="0">
            </div>
            <div style="display:flex;gap:1rem;align-items:center">
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="pp-featured" style="width:16px;height:16px"> Featured
                </label>
                <label style="display:flex;gap:.5rem;align-items:center;cursor:pointer">
                    <input type="checkbox" id="pp-published" checked style="width:16px;height:16px"> Published
                </label>
            </div>
            <div style="grid-column:1/-1;display:flex;gap:.75rem;justify-content:flex-end">
                <button type="button" class="btn btn--outline btn--sm" onclick="closePartnerForm()">Cancel</button>
                <button type="submit" class="btn btn--primary btn--sm">Save Partnership</button>
            </div>
        </form>
    </div>

    <!-- List -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="partnerships-table">
            <thead>
                <tr>
                    <th>Partner</th>
                    <th>Type</th>
                    <th>Website</th>
                    <th>Featured</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="partnerships-tbody">
                <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ══ TEAM & ACCESS CONTROL PANEL (SUPER ADMIN ONLY) ══ --}}
@if(auth()->user()->isSuperAdmin())
<div class="admin-panel" id="panel-team" style="display:none">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">👥 Team Directory &amp; Role-Based Access Control</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Super Admin Governance: Manage organization members, departmental roles, and access credentials.</p>
        </div>
        <div style="display:flex;gap:0.75rem">
            <button class="btn btn--outline btn--sm" onclick="loadTeamMembers()">↻ Refresh</button>
            <button class="btn btn--primary btn--sm" onclick="openNewUserModal()">+ Add Team Member</button>
        </div>
    </div>

    <!-- Department Summary Cards -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem;margin-bottom:1.5rem">
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem">
            <div style="display:flex;align-items:center;justify-content:space-between">
                <span class="role-badge badge-super-admin">Super Admin</span>
                <span style="font-size:1.25rem">👑</span>
            </div>
            <p style="color:var(--text-muted);font-size:.8rem;margin-top:.75rem;line-height:1.4">
                Full root governance, team administration, security audit trails, and global site parameters.
            </p>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem">
            <div style="display:flex;align-items:center;justify-content:space-between">
                <span class="role-badge badge-growth">Growth &amp; Marketing</span>
                <span style="font-size:1.25rem">📈</span>
            </div>
            <p style="color:var(--text-muted);font-size:.8rem;margin-top:.75rem;line-height:1.4">
                Combined Sales &amp; Marketing: Leads pipeline, inquiries inbox, strategy calls, blog posts, trust assets, and SEO.
            </p>
        </div>
        <div style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem">
            <div style="display:flex;align-items:center;justify-content:space-between">
                <span class="role-badge badge-product-engineer">Product &amp; Engineering</span>
                <span style="font-size:1.25rem">⚡</span>
            </div>
            <p style="color:var(--text-muted);font-size:.8rem;margin-top:.75rem;line-height:1.4">
                Combined Product PM &amp; Engineering: OPERO ERP &amp; ITIKIA inquiries, product walkthrough videos, and media uploads.
            </p>
        </div>
    </div>

    <!-- Team Members Table -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="team-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Department &amp; Role</th>
                    <th>Account Status</th>
                    <th>Last Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="team-table-body">
                <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Loading team directory...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add / Edit Team Member -->
<div class="lead-detail-modal" id="team-user-modal">
    <div class="lead-detail-box" style="max-width:520px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem">
            <h3 style="margin:0;font-size:1.15rem" id="team-modal-title">New Team Member</h3>
            <button onclick="closeTeamUserModal()" style="background:none;border:none;color:var(--text-muted);font-size:1.5rem;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="team-user-form" onsubmit="handleTeamUserSubmit(event)">
            <input type="hidden" id="tu-user-id" value="">
            <div style="display:flex;flex-direction:column;gap:1rem">
                <div>
                    <label class="form-label">Full Name *</label>
                    <input type="text" id="tu-name" class="form-input" placeholder="e.g. Jane Doe" required style="width:100%">
                </div>
                <div>
                    <label class="form-label">Work Email *</label>
                    <input type="email" id="tu-email" class="form-input" placeholder="jane@cypressiq.agency" required style="width:100%">
                </div>
                <div>
                    <label class="form-label">Department Role *</label>
                    <select id="tu-role" class="form-input" required style="width:100%">
                        <option value="growth">Growth &amp; Marketing (Sales + Content + SEO)</option>
                        <option value="product_engineer">Product &amp; Engineering (ITIKIA + OPERO + Videos)</option>
                        <option value="super_admin">Super Admin (Universal Root Governance)</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" id="tu-password-label">Password * (min 8 characters)</label>
                    <input type="password" id="tu-password" class="form-input" placeholder="••••••••" style="width:100%">
                    <small style="color:var(--text-muted);display:none" id="tu-password-hint">Leave blank to retain current password.</small>
                </div>
                <div id="tu-error-msg" style="display:none;color:#ef4444;font-size:0.85rem;background:rgba(239,68,68,0.1);padding:0.6rem;border-radius:6px;border:1px solid rgba(239,68,68,0.25)"></div>
                <div style="display:flex;justify-content:flex-end;gap:0.75rem;margin-top:0.5rem">
                    <button type="button" class="btn btn--outline btn--sm" onclick="closeTeamUserModal()">Cancel</button>
                    <button type="submit" class="btn btn--primary btn--sm" id="tu-submit-btn">Save Member</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ══ AUDIT TRAIL PANEL (SUPER ADMIN ONLY) ══ --}}
<div class="admin-panel" id="panel-audit" style="display:none">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.4rem;margin-bottom:.25rem">🛡️ Security Audit Trail &amp; Governance Log</h2>
            <p style="color:var(--text-muted);font-size:.875rem">Immutable record of logins, access violations, lead pipeline updates, and administrative events.</p>
        </div>
        <div style="display:flex;gap:0.75rem">
            <button class="btn btn--outline btn--sm" onclick="loadAuditLogs(1)">↻ Refresh Log</button>
        </div>
    </div>

    <!-- Audit Filters -->
    <div class="lead-filter-bar" style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:0.85rem 1rem">
        <input type="text" id="audit-filter-search" placeholder="🔍 Search IP, user, action or keyword…" class="form-ctrl" style="max-width:280px" oninput="debounceAuditSearch()" />
        
        <select id="audit-filter-role" class="form-ctrl select" style="max-width:180px" onchange="loadAuditLogs(1)">
            <option value="">All Roles</option>
            <option value="super_admin">Super Admin</option>
            <option value="growth">Growth &amp; Marketing</option>
            <option value="product_engineer">Product &amp; Engineering</option>
            <option value="guest">Guest / Unauthenticated</option>
        </select>

        <select id="audit-filter-cat" class="form-ctrl select" style="max-width:180px" onchange="loadAuditLogs(1)">
            <option value="">All Event Categories</option>
            <option value="auth">Authentication (Logins &amp; Security)</option>
            <option value="lead">Lead Pipeline &amp; Triage</option>
            <option value="post">Blog Posts &amp; Insights</option>
            <option value="user">User &amp; Team Management</option>
            <option value="video">Product Walkthrough Videos</option>
        </select>

        <button class="btn btn--outline btn--sm" onclick="resetAuditFilters()">Clear Filters</button>
    </div>

    <!-- Audit Trail Table -->
    <div class="admin-table-wrap">
        <table class="admin-table" id="audit-table">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Actor &amp; Department</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>IP / Details</th>
                </tr>
            </thead>
            <tbody id="audit-table-body">
                <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">Loading audit logs...</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div id="audit-pagination" style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;color:var(--text-muted);font-size:0.85rem"></div>
</div>

<!-- Modal: Audit Payload Details -->
<div class="lead-detail-modal" id="audit-detail-modal">
    <div class="lead-detail-box" style="max-width:620px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
            <h3 style="margin:0;font-size:1.1rem" id="audit-detail-title">Event Payload Details</h3>
            <button onclick="document.getElementById('audit-detail-modal').style.display='none'" style="background:none;border:none;color:var(--text-muted);font-size:1.5rem;cursor:pointer;line-height:1">&times;</button>
        </div>
        <pre id="audit-detail-json" style="background:#0b0f19;border:1px solid rgba(255,255,255,0.1);padding:1rem;border-radius:8px;color:#a5f3fc;font-size:0.8rem;overflow-x:auto;max-height:400px;font-family:monospace"></pre>
        <div style="display:flex;justify-content:flex-end;margin-top:1rem">
            <button class="btn btn--outline btn--sm" onclick="document.getElementById('audit-detail-modal').style.display='none'">Close</button>
        </div>
    </div>
</div>
@endif

<script>
/* ══════════════════════════════════════════════════════════════════
   TRUST & SOCIAL PROOF — Admin JS
══════════════════════════════════════════════════════════════════ */

const CSRF = () => document.querySelector('meta[name="csrf-token"]')?.content || '';

/* ─── Helpers ─── */
function escHtml(s) {
    if (!s) return '';
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
}

function yesNo(val) {
    return val ? '<span style="color:var(--clr-success);font-weight:700">Yes</span>'
               : '<span style="color:var(--text-muted)">No</span>';
}

/* ══════════ TESTIMONIALS ══════════ */

let testimonials = [];

async function loadTestimonials() {
    const tbody = document.getElementById('testimonials-tbody');
    if (!tbody) return;
    try {
        const r = await fetch('/admin/api/testimonials', { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() } });
        testimonials = await r.json();
        renderTestimonials();
    } catch (e) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#ef4444;padding:2rem">Failed to load testimonials.</td></tr>';
    }
}

function renderTestimonials() {
    const tbody = document.getElementById('testimonials-tbody');
    if (!tbody) return;
    if (!testimonials.length) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">No testimonials yet. Add your first one!</td></tr>';
        return;
    }
    tbody.innerHTML = testimonials.map(t => `
        <tr>
            <td><strong>${escHtml(t.client_name)}</strong></td>
            <td>${escHtml(t.client_company || '')}${t.client_role ? '<br><small style="color:var(--text-muted)">' + escHtml(t.client_role) + '</small>' : ''}</td>
            <td>${t.product_or_solution ? '<span style="font-size:.75rem;background:rgba(99,102,241,.15);color:#a5b4fc;padding:2px 8px;border-radius:100px">' + escHtml(t.product_or_solution) + '</span>' : '—'}</td>
            <td>${'★'.repeat(t.rating || 5)}</td>
            <td>${yesNo(t.is_featured)}</td>
            <td>${yesNo(t.is_published)}</td>
            <td>
                <button class="btn btn--outline btn--sm" onclick="editTestimonial(${t.id})">Edit</button>
                <button class="btn btn--sm" style="background:#ef444420;color:#ef4444;border:1px solid #ef444440;margin-left:.25rem" onclick="deleteTestimonial(${t.id})">Delete</button>
            </td>
        </tr>
    `).join('');
}

function openTestimonialForm(id) {
    document.getElementById('testimonial-form-wrap').style.display = 'block';
    if (id) {
        const t = testimonials.find(x => x.id === id);
        if (!t) return;
        document.getElementById('testimonial-form-title').textContent = 'Edit Testimonial';
        document.getElementById('t-id').value   = t.id;
        document.getElementById('t-quote').value = t.quote;
        document.getElementById('t-name').value  = t.client_name;
        document.getElementById('t-role').value  = t.client_role || '';
        document.getElementById('t-company').value = t.client_company || '';
        document.getElementById('t-product').value = t.product_or_solution || '';
        document.getElementById('t-avatar').value  = t.client_avatar || '';
        document.getElementById('t-rating').value  = t.rating || 5;
        document.getElementById('t-sort').value    = t.sort_order || 0;
        document.getElementById('t-featured').checked  = !!t.is_featured;
        document.getElementById('t-published').checked = !!t.is_published;
    } else {
        document.getElementById('testimonial-form-title').textContent = 'New Testimonial';
        document.getElementById('testimonial-form').reset();
        document.getElementById('t-id').value = '';
        document.getElementById('t-rating').value = 5;
        document.getElementById('t-published').checked = true;
    }
    document.getElementById('testimonial-form-wrap').scrollIntoView({ behavior: 'smooth' });
}

function editTestimonial(id) { openTestimonialForm(id); }

function closeTestimonialForm() { document.getElementById('testimonial-form-wrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('testimonial-form');
    if (form) form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('t-id').value;
        const payload = {
            quote:               document.getElementById('t-quote').value,
            client_name:         document.getElementById('t-name').value,
            client_role:         document.getElementById('t-role').value,
            client_company:      document.getElementById('t-company').value,
            product_or_solution: document.getElementById('t-product').value,
            client_avatar:       document.getElementById('t-avatar').value,
            rating:              parseInt(document.getElementById('t-rating').value) || 5,
            sort_order:          parseInt(document.getElementById('t-sort').value) || 0,
            is_featured:         document.getElementById('t-featured').checked,
            is_published:        document.getElementById('t-published').checked,
        };
        const method = id ? 'PUT' : 'POST';
        const url    = id ? `/admin/api/testimonials/${id}` : '/admin/api/testimonials';
        try {
            const r = await fetch(url, { method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() }, body: JSON.stringify(payload) });
            if (!r.ok) { const err = await r.json(); alert(JSON.stringify(err.errors || err.message)); return; }
            closeTestimonialForm();
            await loadTestimonials();
        } catch (err) { alert('Network error. Try again.'); }
    });
});

async function deleteTestimonial(id) {
    if (!confirm('Delete this testimonial? This cannot be undone.')) return;
    await fetch(`/admin/api/testimonials/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF(), 'Accept': 'application/json' } });
    await loadTestimonials();
}

/* ══════════ PROJECTS ══════════ */

let trustProjects = [];

async function loadTrustProjects() {
    const tbody = document.getElementById('projects-tbody');
    if (!tbody) return;
    try {
        const r = await fetch('/admin/api/portfolio-projects', { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() } });
        trustProjects = await r.json();
        renderProjects();
    } catch (e) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#ef4444;padding:2rem">Failed to load projects.</td></tr>';
    }
}

function renderProjects() {
    const tbody = document.getElementById('projects-tbody');
    if (!tbody) return;
    if (!trustProjects.length) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem">No projects yet. Add your first one!</td></tr>';
        return;
    }
    tbody.innerHTML = trustProjects.map(p => `
        <tr>
            <td><strong>${escHtml(p.title)}</strong></td>
            <td>${escHtml(p.category)}</td>
            <td>${p.client_name ? escHtml(p.client_name) : '—'}</td>
            <td>${p.duration ? escHtml(p.duration) : '—'}</td>
            <td>${yesNo(p.is_featured)}</td>
            <td>${yesNo(p.is_published)}</td>
            <td>
                <button class="btn btn--outline btn--sm" onclick="editProject(${p.id})">Edit</button>
                <button class="btn btn--sm" style="background:#ef444420;color:#ef4444;border:1px solid #ef444440;margin-left:.25rem" onclick="deleteProject(${p.id})">Delete</button>
            </td>
        </tr>
    `).join('');
}

function openProjectForm(id) {
    document.getElementById('project-form-wrap').style.display = 'block';
    if (id) {
        const p = trustProjects.find(x => x.id === id);
        if (!p) return;
        document.getElementById('project-form-title').textContent = 'Edit Project';
        document.getElementById('p-id').value          = p.id;
        document.getElementById('p-title').value       = p.title;
        document.getElementById('p-category').value    = p.category;
        document.getElementById('p-client').value      = p.client_name || '';
        document.getElementById('p-industry').value    = p.industry || '';
        document.getElementById('p-summary').value     = p.summary;
        document.getElementById('p-description').value = p.description || '';
        document.getElementById('p-cover').value       = p.cover_image || '';
        document.getElementById('p-url').value         = p.project_url || '';
        document.getElementById('p-tech').value        = (p.technologies || []).join(', ');
        document.getElementById('p-outcomes').value    = (p.outcomes || []).join(', ');
        document.getElementById('p-duration').value    = p.duration || '';
        document.getElementById('p-completed').value   = p.completed_at ? p.completed_at.substring(0,10) : '';
        document.getElementById('p-sort').value        = p.sort_order || 0;
        document.getElementById('p-featured').checked  = !!p.is_featured;
        document.getElementById('p-published').checked = !!p.is_published;
    } else {
        document.getElementById('project-form-title').textContent = 'New Project';
        document.getElementById('project-form').reset();
        document.getElementById('p-id').value = '';
        document.getElementById('p-published').checked = true;
    }
    document.getElementById('project-form-wrap').scrollIntoView({ behavior: 'smooth' });
}

function editProject(id) { openProjectForm(id); }
function closeProjectForm() { document.getElementById('project-form-wrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('project-form');
    if (form) form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('p-id').value;
        const techRaw     = document.getElementById('p-tech').value;
        const outcomesRaw = document.getElementById('p-outcomes').value;
        const payload = {
            title:        document.getElementById('p-title').value,
            category:     document.getElementById('p-category').value,
            client_name:  document.getElementById('p-client').value,
            industry:     document.getElementById('p-industry').value,
            summary:      document.getElementById('p-summary').value,
            description:  document.getElementById('p-description').value,
            cover_image:  document.getElementById('p-cover').value,
            project_url:  document.getElementById('p-url').value,
            technologies: techRaw ? techRaw.split(',').map(s=>s.trim()).filter(Boolean) : [],
            outcomes:     outcomesRaw ? outcomesRaw.split(',').map(s=>s.trim()).filter(Boolean) : [],
            duration:     document.getElementById('p-duration').value,
            completed_at: document.getElementById('p-completed').value || null,
            sort_order:   parseInt(document.getElementById('p-sort').value) || 0,
            is_featured:  document.getElementById('p-featured').checked,
            is_published: document.getElementById('p-published').checked,
        };
        const method = id ? 'PUT' : 'POST';
        const url    = id ? `/admin/api/portfolio-projects/${id}` : '/admin/api/portfolio-projects';
        try {
            const r = await fetch(url, { method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() }, body: JSON.stringify(payload) });
            if (!r.ok) { const err = await r.json(); alert(JSON.stringify(err.errors || err.message)); return; }
            closeProjectForm();
            await loadTrustProjects();
        } catch (err) { alert('Network error. Try again.'); }
    });
});

async function deleteProject(id) {
    if (!confirm('Delete this project? This cannot be undone.')) return;
    await fetch(`/admin/api/portfolio-projects/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF(), 'Accept': 'application/json' } });
    await loadTrustProjects();
}

/* ══════════ PARTNERSHIPS ══════════ */

let partnersList = [];

async function loadPartnerships() {
    const tbody = document.getElementById('partnerships-tbody');
    if (!tbody) return;
    try {
        const r = await fetch('/admin/api/partnerships', { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() } });
        partnersList = await r.json();
        renderPartnerships();
    } catch (e) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#ef4444;padding:2rem">Failed to load partnerships.</td></tr>';
    }
}

function renderPartnerships() {
    const tbody = document.getElementById('partnerships-tbody');
    if (!tbody) return;
    if (!partnersList.length) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">No partnerships yet. Add your first one!</td></tr>';
        return;
    }
    tbody.innerHTML = partnersList.map(p => `
        <tr>
            <td><strong>${escHtml(p.partner_name)}</strong></td>
            <td><span style="font-size:.75rem;text-transform:capitalize;background:rgba(99,102,241,.12);color:#a5b4fc;padding:2px 10px;border-radius:100px">${escHtml(p.partnership_type)}</span></td>
            <td>${p.partner_website ? '<a href="' + escHtml(p.partner_website) + '" target="_blank" style="color:var(--clr-accent)">Visit →</a>' : '—'}</td>
            <td>${yesNo(p.is_featured)}</td>
            <td>${yesNo(p.is_published)}</td>
            <td>
                <button class="btn btn--outline btn--sm" onclick="editPartner(${p.id})">Edit</button>
                <button class="btn btn--sm" style="background:#ef444420;color:#ef4444;border:1px solid #ef444440;margin-left:.25rem" onclick="deletePartner(${p.id})">Delete</button>
            </td>
        </tr>
    `).join('');
}

function openPartnerForm(id) {
    document.getElementById('partner-form-wrap').style.display = 'block';
    if (id) {
        const p = partnersList.find(x => x.id === id);
        if (!p) return;
        document.getElementById('partner-form-title').textContent = 'Edit Partnership';
        document.getElementById('pp-id').value      = p.id;
        document.getElementById('pp-name').value    = p.partner_name;
        document.getElementById('pp-type').value    = p.partnership_type;
        document.getElementById('pp-logo').value    = p.partner_logo || '';
        document.getElementById('pp-website').value = p.partner_website || '';
        document.getElementById('pp-desc').value    = p.description || '';
        document.getElementById('pp-sort').value    = p.sort_order || 0;
        document.getElementById('pp-featured').checked  = !!p.is_featured;
        document.getElementById('pp-published').checked = !!p.is_published;
    } else {
        document.getElementById('partner-form-title').textContent = 'New Partnership';
        document.getElementById('partner-form').reset();
        document.getElementById('pp-id').value = '';
        document.getElementById('pp-published').checked = true;
    }
    document.getElementById('partner-form-wrap').scrollIntoView({ behavior: 'smooth' });
}

function editPartner(id) { openPartnerForm(id); }
function closePartnerForm() { document.getElementById('partner-form-wrap').style.display = 'none'; }

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('partner-form');
    if (form) form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('pp-id').value;
        const payload = {
            partner_name:     document.getElementById('pp-name').value,
            partnership_type: document.getElementById('pp-type').value,
            partner_logo:     document.getElementById('pp-logo').value,
            partner_website:  document.getElementById('pp-website').value,
            description:      document.getElementById('pp-desc').value,
            sort_order:       parseInt(document.getElementById('pp-sort').value) || 0,
            is_featured:      document.getElementById('pp-featured').checked,
            is_published:     document.getElementById('pp-published').checked,
        };
        const method = id ? 'PUT' : 'POST';
        const url    = id ? `/admin/api/partnerships/${id}` : '/admin/api/partnerships';
        try {
            const r = await fetch(url, { method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF() }, body: JSON.stringify(payload) });
            if (!r.ok) { const err = await r.json(); alert(JSON.stringify(err.errors || err.message)); return; }
            closePartnerForm();
            await loadPartnerships();
        } catch (err) { alert('Network error. Try again.'); }
    });
});

async function deletePartner(id) {
    if (!confirm('Delete this partnership? This cannot be undone.')) return;
    await fetch(`/admin/api/partnerships/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF(), 'Accept': 'application/json' } });
    await loadPartnerships();
}

/* ─── Escape HTML helper (may already be defined elsewhere; guard against redeclaration) ─── */
if (typeof escHtml === 'undefined') {
    function escHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
}

/* ─── Intercept showPanel to lazy-load trust data ─── */
const _origShowPanel = typeof showPanel === 'function' ? showPanel : null;
document.addEventListener('DOMContentLoaded', () => {
    const adminNavItems = document.querySelectorAll('.admin-nav-item');
    adminNavItems.forEach(btn => {
        const origClick = btn.onclick;
        // Lazy-load trust panels on first visit
    });
});

/* Hook into the existing showPanel to trigger lazy loads */
const _trustPanelLoaded = { testimonials: false, 'trust-projects': false, partnerships: false };
const _origShowPanelRef = window.showPanel;
window.showPanel = function(panel, el) {
    if (typeof _origShowPanelRef === 'function') _origShowPanelRef(panel, el);
    if (panel === 'testimonials' && !_trustPanelLoaded.testimonials) {
        _trustPanelLoaded.testimonials = true;
        loadTestimonials();
    }
    if (panel === 'trust-projects' && !_trustPanelLoaded['trust-projects']) {
        _trustPanelLoaded['trust-projects'] = true;
        loadTrustProjects();
    }
    if (panel === 'partnerships' && !_trustPanelLoaded.partnerships) {
        _trustPanelLoaded.partnerships = true;
        loadPartnerships();
    }
    if (panel === 'team' && typeof loadTeamMembers === 'function') {
        loadTeamMembers();
    }
    if (panel === 'audit' && typeof loadAuditLogs === 'function') {
        loadAuditLogs(1);
    }
};

/* ══════════════════════════════════════════════════════════
   INBOUND LEAD ALERTING & FOLLOW-UP RADAR ENGINE
   ══════════════════════════════════════════════════════════ */
let _currentLatestLeadId = {{ $radar['latest_lead_id'] ?? 0 }};
let _audioCtx = null;

function getAudioContext() {
    if (!_audioCtx) {
        _audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    if (_audioCtx.state === 'suspended') {
        _audioCtx.resume();
    }
    return _audioCtx;
}

window.playLeadChime = function() {
    try {
        const ctx = getAudioContext();
        const now = ctx.currentTime;
        
        // Tone 1: D5 (587.33 Hz)
        const osc1 = ctx.createOscillator();
        const gain1 = ctx.createGain();
        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(587.33, now);
        gain1.gain.setValueAtTime(0.2, now);
        gain1.gain.exponentialRampToValueAtTime(0.01, now + 0.35);
        osc1.connect(gain1);
        gain1.connect(ctx.destination);
        osc1.start(now);
        osc1.stop(now + 0.35);

        // Tone 2: A5 (880.00 Hz) slightly delayed
        const osc2 = ctx.createOscillator();
        const gain2 = ctx.createGain();
        osc2.type = 'triangle';
        osc2.frequency.setValueAtTime(880.00, now + 0.12);
        gain2.gain.setValueAtTime(0.25, now + 0.12);
        gain2.gain.exponentialRampToValueAtTime(0.01, now + 0.55);
        osc2.connect(gain2);
        gain2.connect(ctx.destination);
        osc2.start(now + 0.12);
        osc2.stop(now + 0.55);
    } catch(err) {
        console.warn('Audio chime error:', err);
    }
};

window.enableDesktopNotifications = function() {
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notifications.");
        return;
    }
    Notification.requestPermission().then(permission => {
        const btn = document.getElementById('btn-desktop-notif');
        if (permission === 'granted') {
            if (btn) btn.textContent = '✓ Push Enabled';
            new Notification("⚡ CypressIQ Radar Active", {
                body: "Desktop alerts enabled! You will be notified instantly when new leads arrive.",
                icon: "/favicon.ico"
            });
            playLeadChime();
        } else {
            if (btn) btn.textContent = '✕ Push Denied';
            alert("Desktop notifications were disabled or denied in your browser settings.");
        }
    });
};

window.showLeadToast = function(title, body, leadId) {
    let container = document.getElementById('cockpit-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'cockpit-toast-container';
        container.style.cssText = 'position:fixed;top:20px;right:24px;z-index:99999;display:flex;flex-direction:column;gap:10px;pointer-events:none;';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.style.cssText = 'background:#111827;border:1px solid #6C63FF;border-radius:12px;padding:16px 20px;color:#fff;box-shadow:0 15px 35px rgba(0,0,0,0.5),0 0 15px rgba(108,99,255,0.4);max-width:380px;pointer-events:auto;cursor:pointer;transform:translateX(100%);transition:transform 0.3s cubic-bezier(0.16,1,0.3,1);';
    toast.innerHTML = `
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
            <span style="font-size:0.75rem;font-weight:700;color:#00D4AA;text-transform:uppercase;letter-spacing:0.05em">⚡ New Inbound Lead</span>
            <span style="font-size:0.7rem;color:#94a3b8">Just now</span>
        </div>
        <div style="font-weight:700;font-size:0.95rem;margin-bottom:4px;color:#f8fafc">${escapeHtml(title)}</div>
        <div style="font-size:0.8rem;color:#94a3b8;line-height:1.4">${escapeHtml(body)}</div>
    `;

    toast.onclick = () => {
        if (leadId && typeof inspectLeadById === 'function') inspectLeadById(leadId);
        toast.remove();
    };

    container.appendChild(toast);
    setTimeout(() => { toast.style.transform = 'translateX(0)'; }, 20);
    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        setTimeout(() => toast.remove(), 350);
    }, 8000);
};

window.quickMarkContacted = async function(leadId) {
    try {
        const item = document.getElementById(`radar-item-${leadId}`);
        if (item) {
            item.style.opacity = '0.5';
            item.style.pointerEvents = 'none';
        }

        await fetch(`/admin/api/leads/${leadId}/status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: 'reviewed' })
        });

        await fetch(`/admin/api/leads/${leadId}/notes`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ note: 'Initial client follow-up completed via Action Radar.' })
        });

        if (item) {
            item.style.transition = 'all 0.35s ease';
            item.style.transform = 'scale(0.95)';
            item.style.opacity = '0';
            setTimeout(() => {
                item.remove();
            }, 350);
        }

        if (typeof loadLeads === 'function') loadLeads();
    } catch(err) {
        console.error('Error marking lead as contacted:', err);
    }
};

window.fetchRadarData = async function(manual = false) {
    try {
        const res = await fetch('/admin/api/radar', {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) return;
        const data = await res.json();

        if (data.latest_lead_id > _currentLatestLeadId && _currentLatestLeadId !== 0) {
            playLeadChime();
            
            const newest = (data.urgent_leads && data.urgent_leads[0]) || (data.overdue_leads && data.overdue_leads[0]) || null;
            const leadName = newest ? newest.name : 'Prospective Client';
            const leadInterest = newest ? newest.product_interest : 'New Inquiry';

            showLeadToast(leadName, `Interest: ${leadInterest}. Click to inspect details.`, data.latest_lead_id);

            if ("Notification" in window && Notification.permission === "granted") {
                new Notification("⚡ CypressIQ: New Inbound Lead", {
                    body: `${leadName} submitted an inquiry for ${leadInterest}.`,
                    icon: "/favicon.ico"
                });
            }

            if (typeof loadLeads === 'function') loadLeads();
            if (typeof loadMessages === 'function') loadMessages();
            if (typeof loadBookings === 'function') loadBookings();
        }

        _currentLatestLeadId = Math.max(_currentLatestLeadId, data.latest_lead_id);

        if (manual) {
            const syncBtn = document.querySelector('#radar-container button[onclick*="fetchRadarData"]');
            if (syncBtn) {
                const orig = syncBtn.textContent;
                syncBtn.textContent = '✓ Synced!';
                setTimeout(() => syncBtn.textContent = orig, 1200);
            }
        }
    } catch(err) {
        console.warn('Radar poll failed:', err);
    }
};

// Start background poller every 15 seconds
setInterval(() => {
    fetchRadarData(false);
}, 15000);

@if(auth()->user()->isSuperAdmin())
/* ══════════════════════════════════════════════════════════════════
   TEAM MANAGEMENT & ROLE-BASED ACCESS CONTROL (SUPER ADMIN)
══════════════════════════════════════════════════════════════════ */
let teamMembers = [];

async function loadTeamMembers() {
    const tbody = document.getElementById('team-table-body');
    if (!tbody) return;
    try {
        const res = await fetch('/admin/api/users', {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#ef4444;padding:2rem">Failed to load team directory.</td></tr>';
            return;
        }
        const data = await res.json();
        teamMembers = data.users || [];
        renderTeamMembers();
    } catch(err) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#ef4444;padding:2rem">Network error loading team members.</td></tr>';
    }
}

function renderTeamMembers() {
    const tbody = document.getElementById('team-table-body');
    if (!tbody) return;
    if (!teamMembers.length) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">No team members found.</td></tr>';
        return;
    }

    const currentUserId = {{ auth()->id() ?? 0 }};

    tbody.innerHTML = teamMembers.map(u => {
        const isSelf = u.id === currentUserId;
        const statusBadge = u.is_active 
            ? '<span class="cockpit-badge won">● Active</span>' 
            : '<span class="cockpit-badge lost">✕ Suspended</span>';
        
        const toggleBtnLabel = u.is_active ? 'Suspend' : 'Reactivate';
        const toggleBtnStyle = u.is_active 
            ? 'background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3)' 
            : 'background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3)';

        return `
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:0.75rem">
                        <div style="width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;color:#f8fafc;border:1px solid var(--border-subtle)">
                            ${escHtml(u.name.substring(0, 2).toUpperCase())}
                        </div>
                        <div>
                            <strong>${escHtml(u.name)}</strong>
                            ${isSelf ? '<span style="font-size:0.7rem;color:var(--clr-accent);margin-left:4px;font-weight:700">(You)</span>' : ''}
                        </div>
                    </div>
                </td>
                <td><span style="font-family:monospace;font-size:0.85rem">${escHtml(u.email)}</span></td>
                <td><span class="role-badge ${u.role_badge}">${escHtml(u.role_label)}</span></td>
                <td>${statusBadge}</td>
                <td>
                    <span style="font-size:0.85rem">${escHtml(u.last_login_at)}</span><br>
                    <small style="color:var(--text-muted)">IP: ${escHtml(u.last_login_ip)}</small>
                </td>
                <td>
                    <div style="display:flex;gap:0.35rem">
                        <button class="btn btn--outline btn--sm" style="padding:3px 8px;font-size:0.75rem" onclick="openEditUserModal(${u.id})">Edit</button>
                        ${!isSelf ? `
                            <button class="btn btn--sm" style="padding:3px 8px;font-size:0.75rem;${toggleBtnStyle}" onclick="toggleUserStatus(${u.id}, ${u.is_active ? 1 : 0}, '${escHtml(u.name)}')">${toggleBtnLabel}</button>
                        ` : ''}
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

function openNewUserModal() {
    document.getElementById('tu-user-id').value = '';
    document.getElementById('team-modal-title').textContent = 'Add New Team Member';
    document.getElementById('tu-name').value = '';
    document.getElementById('tu-email').value = '';
    document.getElementById('tu-role').value = 'growth';
    document.getElementById('tu-password').value = '';
    document.getElementById('tu-password').required = true;
    document.getElementById('tu-password-label').textContent = 'Password * (min 8 characters)';
    document.getElementById('tu-password-hint').style.display = 'none';
    document.getElementById('tu-error-msg').style.display = 'none';
    document.getElementById('team-user-modal').style.display = 'flex';
}

function openEditUserModal(userId) {
    const user = teamMembers.find(u => u.id === userId);
    if (!user) return;
    document.getElementById('tu-user-id').value = user.id;
    document.getElementById('team-modal-title').textContent = `Edit Team Member: ${user.name}`;
    document.getElementById('tu-name').value = user.name;
    document.getElementById('tu-email').value = user.email;
    document.getElementById('tu-role').value = user.role;
    document.getElementById('tu-password').value = '';
    document.getElementById('tu-password').required = false;
    document.getElementById('tu-password-label').textContent = 'Reset Password (optional)';
    document.getElementById('tu-password-hint').style.display = 'block';
    document.getElementById('tu-error-msg').style.display = 'none';
    document.getElementById('team-user-modal').style.display = 'flex';
}

function closeTeamUserModal() {
    document.getElementById('team-user-modal').style.display = 'none';
}

async function handleTeamUserSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('tu-user-id').value;
    const name = document.getElementById('tu-name').value.trim();
    const email = document.getElementById('tu-email').value.trim();
    const role = document.getElementById('tu-role').value;
    const password = document.getElementById('tu-password').value;
    const errBox = document.getElementById('tu-error-msg');
    errBox.style.display = 'none';

    const payload = { name, email, role };
    if (password) payload.password = password;

    const url = id ? `/admin/api/users/${id}` : '/admin/api/users';
    const method = id ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (!res.ok) {
            const errs = data.errors ? Object.values(data.errors).flat().join('<br>') : (data.message || 'Operation failed');
            errBox.innerHTML = errs;
            errBox.style.display = 'block';
            return;
        }

        closeTeamUserModal();
        await loadTeamMembers();
    } catch(err) {
        errBox.textContent = 'Network error. Please try again.';
        errBox.style.display = 'block';
    }
}

async function toggleUserStatus(userId, currentStatus, userName) {
    const actionWord = currentStatus ? 'suspend' : 'reactivate';
    if (!confirm(`Are you sure you want to ${actionWord} account for "${userName}"?`)) return;

    try {
        const res = await fetch(`/admin/api/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        const data = await res.json();
        if (!res.ok) {
            alert(data.message || 'Failed to update user status.');
            return;
        }
        await loadTeamMembers();
    } catch(err) {
        alert('Network error updating user status.');
    }
}

/* ══════════════════════════════════════════════════════════════════
   SECURITY AUDIT TRAIL & ACTIVITY LOG (SUPER ADMIN)
══════════════════════════════════════════════════════════════════ */
let auditLogs = [];
let auditPaginationData = {};
let auditSearchTimer = null;

function debounceAuditSearch() {
    clearTimeout(auditSearchTimer);
    auditSearchTimer = setTimeout(() => {
        loadAuditLogs(1);
    }, 350);
}

function resetAuditFilters() {
    document.getElementById('audit-filter-search').value = '';
    document.getElementById('audit-filter-role').value = '';
    document.getElementById('audit-filter-cat').value = '';
    loadAuditLogs(1);
}

async function loadAuditLogs(page = 1) {
    const tbody = document.getElementById('audit-table-body');
    if (!tbody) return;

    const search = document.getElementById('audit-filter-search')?.value.trim() || '';
    const role = document.getElementById('audit-filter-role')?.value || '';
    const category = document.getElementById('audit-filter-cat')?.value || '';

    const params = new URLSearchParams();
    params.set('page', page);
    if (search) params.set('search', search);
    if (role) params.set('role', role);
    if (category) params.set('action_category', category);

    try {
        const res = await fetch(`/admin/api/audit-logs?${params.toString()}`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) {
            tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:#ef4444;padding:2rem">Failed to load audit logs.</td></tr>';
            return;
        }
        const data = await res.json();
        auditLogs = (data.logs && data.logs.data) || [];
        auditPaginationData = data.logs || {};
        renderAuditLogs();
        renderAuditPagination();
    } catch(err) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:#ef4444;padding:2rem">Network error loading audit logs.</td></tr>';
    }
}

function renderAuditLogs() {
    const tbody = document.getElementById('audit-table-body');
    if (!tbody) return;
    if (!auditLogs.length) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">No audit activity matching your criteria.</td></tr>';
        return;
    }

    tbody.innerHTML = auditLogs.map(log => {
        let badgeClass = 'audit-badge generic';
        if (log.action.includes('login') || log.action.includes('auth.login')) badgeClass = 'audit-badge auth-success';
        if (log.action.includes('failed') || log.action.includes('unauthorized')) badgeClass = 'audit-badge auth-danger';
        if (log.action.includes('lead.') || log.action.includes('post.') || log.action.includes('user.') || log.action.includes('video.')) badgeClass = 'audit-badge mutation';

        const roleBadge = log.role ? `<span class="role-badge badge-${log.role.replace('_','-')}">${escHtml(log.role)}</span>` : '<span style="color:var(--text-muted)">Guest</span>';
        const hasProps = log.properties && Object.keys(log.properties).length > 0;

        return `
            <tr>
                <td style="white-space:nowrap">
                    <strong>${escHtml(log.time_ago)}</strong><br>
                    <small style="color:var(--text-muted)">${escHtml(log.date)}</small>
                </td>
                <td>
                    <strong>${escHtml(log.user_name || 'System / Unauth')}</strong><br>
                    ${roleBadge}
                </td>
                <td><span class="${badgeClass}">${escHtml(log.action)}</span></td>
                <td><div style="max-width:380px;line-height:1.4">${escHtml(log.description)}</div></td>
                <td style="white-space:nowrap">
                    <span style="font-family:monospace;font-size:0.8rem">${escHtml(log.ip_address || '—')}</span><br>
                    ${hasProps ? `<button class="btn btn--outline btn--sm" style="padding:2px 6px;font-size:0.7rem;margin-top:4px" onclick="viewAuditDetails(${log.id})">🔍 Payload</button>` : ''}
                </td>
            </tr>
        `;
    }).join('');
}

function renderAuditPagination() {
    const pContainer = document.getElementById('audit-pagination');
    if (!pContainer) return;
    const current = auditPaginationData.current_page || 1;
    const last = auditPaginationData.last_page || 1;
    const total = auditPaginationData.total || 0;

    if (total === 0) {
        pContainer.innerHTML = '';
        return;
    }

    pContainer.innerHTML = `
        <div>Showing page ${current} of ${last} (${total} total audit records)</div>
        <div style="display:flex;gap:0.5rem">
            <button class="btn btn--outline btn--sm" ${current <= 1 ? 'disabled' : ''} onclick="loadAuditLogs(${current - 1})">← Previous</button>
            <button class="btn btn--outline btn--sm" ${current >= last ? 'disabled' : ''} onclick="loadAuditLogs(${current + 1})">Next →</button>
        </div>
    `;
}

function viewAuditDetails(logId) {
    const log = auditLogs.find(l => l.id === logId);
    if (!log) return;
    document.getElementById('audit-detail-title').textContent = `Payload: ${log.action} (#${log.id})`;
    document.getElementById('audit-detail-json').textContent = JSON.stringify({
        actor: { name: log.user_name, email: log.user_email, role: log.role },
        ip: log.ip_address,
        timestamp: log.date,
        properties: log.properties
    }, null, 2);
    document.getElementById('audit-detail-modal').style.display = 'flex';
}
@endif
</script>

@endsection