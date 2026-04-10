@extends('layouts.admin')
@section('title', 'CypressIq CMS — Dashboard')
@section('content')
<!-- ─── DASHBOARD PANEL ─── -->
                <div class="admin-panel active" id="panel-dashboard">
                    <div class="admin-stats-grid">
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Total Posts</div>
                            <div class="admin-stat-value" style="color:var(--clr-primary)">{{ $stats['total_posts'] }}</div>
                            <div class="admin-stat-change up">▲ Active &amp; Drafts</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Published Posts</div>
                            <div class="admin-stat-value" style="color:var(--clr-accent)">{{ $stats['published_posts'] }}</div>
                            <div class="admin-stat-change up">▲ Live on site</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Email Leads</div>
                            <div class="admin-stat-value" style="color:var(--clr-success)">{{ $stats['total_leads'] }}</div>
                            <div class="admin-stat-change up">▲ Real-time via CRM</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Scheduled / Drafts</div>
                            <div class="admin-stat-value">{{ $stats['draft_posts'] + $stats['scheduled_posts'] }}</div>
                            <div class="admin-stat-change up">▲ Needs review</div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
                        <!-- Recent Posts -->
                        <div class="admin-table-wrap">
                            <div class="admin-table-header">
                                <div class="admin-table-title">📝 Recent Posts</div>
                                <button class="btn btn--outline btn--sm" onclick="showPanel('posts',null)">View
                                    All</button>
                            </div>
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts->take(5) as $post)
                                    <tr>
                                        <td>{{ Str::limit($post->title, 40) }}</td>
                                        <td>
                                            @if ($post->status === 'published')
                                                <span class="status-pill published">● Published</span>
                                            @elseif ($post->status === 'scheduled')
                                                <span class="status-pill scheduled">◷ Scheduled</span>
                                            @else
                                                <span class="status-pill draft">○ Draft</span>
                                            @endif
                                        </td>
                                        <td>0</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" style="text-align:center;color:var(--text-muted)">No posts yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Recent Leads -->
                        <div class="admin-table-wrap">
                            <div class="admin-table-header">
                                <div class="admin-table-title">🎯 Recent Leads</div>
                                <button class="btn btn--outline btn--sm" onclick="showPanel('leads',null)">View
                                    All</button>
                            </div>
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Source</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leads->take(5) as $lead)
                                    <tr>
                                        <td>{{ $lead->email }}</td>
                                        <td><span class="lead-source-pill">{{ $lead->source ?? 'Unknown' }}</span></td>
                                        <td>{{ $lead->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" style="text-align:center;color:var(--text-muted)">No leads captured yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick stats bar -->
                    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:1.5rem">
                        <div
                            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;text-align:center">
                            <div style="font-size:1.75rem;margin-bottom:.25rem">🔍</div>
                            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.25rem">Organic Traffic
                            </div>
                            <div style="font-size:1.25rem;font-weight:700">14.2k</div>
                        </div>
                        <div
                            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;text-align:center">
                            <div style="font-size:1.75rem;margin-bottom:.25rem">📊</div>
                            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.25rem">Avg. Read Time
                            </div>
                            <div style="font-size:1.25rem;font-weight:700">4m 32s</div>
                        </div>
                        <div
                            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;text-align:center">
                            <div style="font-size:1.75rem;margin-bottom:.25rem">🎯</div>
                            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.25rem">Conversion Rate
                            </div>
                            <div style="font-size:1.25rem;font-weight:700">3.8%</div>
                        </div>
                        <div
                            style="background:var(--bg-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);padding:1.25rem;text-align:center">
                            <div style="font-size:1.75rem;margin-bottom:.25rem">⚙️</div>
                            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.25rem">Opero Demo Leads
                            </div>
                            <div style="font-size:1.25rem;font-weight:700">41</div>
                        </div>
                    </div>
                </div>

                <!-- ─── POSTS PANEL ─── -->
                <div class="admin-panel" id="panel-posts">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                        <div>
                            <h2 style="font-size:1.4rem;margin-bottom:.25rem">Blog Posts</h2>
                            <p style="color:var(--text-muted);font-size:.875rem">24 total posts · 18 published · 4
                                drafts · 2 scheduled</p>
                        </div>
                        <button class="btn btn--primary" onclick="showPanel('editor',null)">✏️ New Post</button>
                    </div>

                    <div style="display:flex;gap:.75rem;margin-bottom:1.25rem;flex-wrap:wrap">
                        <input type="text" placeholder="🔍 Search posts…" class="form-ctrl" style="max-width:280px"
                            oninput="filterPostsTable(this.value)" />
                        <select class="form-ctrl select" style="max-width:160px">
                            <option>All Status</option>
                            <option>Published</option>
                            <option>Draft</option>
                            <option>Scheduled</option>
                        </select>
                        <select class="form-ctrl select" style="max-width:180px">
                            <option>All Categories</option>
                            <option>SEO</option>
                            <option>ERP</option>
                            <option>PPC</option>
                            <option>Business</option>
                        </select>
                    </div>

                    <div class="admin-table-wrap">
                        <table class="admin-table" id="posts-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Views</th>
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
                                    <td>0</td>
                                    <td>{{ $post->created_at->format('M j') }}</td>
                                    <td>
                                        <button class="table-action-btn" onclick="showPanel('editor',null)">Edit</button>
                                        <button class="table-action-btn">Preview</button>
                                        <form method="POST" action="{{ route('admin.api.posts.destroy', $post) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="table-action-btn danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem;">No posts exist yet. Click "New Post" to create one.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ─── EDITOR PANEL ─── -->
                <div class="admin-panel" id="panel-editor">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                        <div>
                            <h2 style="font-size:1.4rem;margin-bottom:.25rem">New Post</h2>
                            <p style="color:var(--text-muted);font-size:.875rem">Craft and publish your article</p>
                        </div>
                        <div style="display:flex;gap:.75rem">
                            <button class="btn btn--outline btn--sm" onclick="savePost('draft')">Save Draft</button>
                            <button class="btn btn--secondary btn--sm" style="display:none">Schedule</button>
                            <button class="btn btn--primary btn--sm" onclick="savePost('published')">Publish Now 🚀</button>
                        </div>
                    </div>

                    <div class="editor-layout">
                        <!-- MAIN EDITOR -->
                        <div>
                            <div class="editor-toolbar">
                                <button class="toolbar-btn" title="Bold"><b>B</b></button>
                                <button class="toolbar-btn" title="Italic"><i>I</i></button>
                                <button class="toolbar-btn" title="Underline"><u>U</u></button>
                                <button class="toolbar-btn" title="Strikethrough"><s>S</s></button>
                                <div class="toolbar-divider"></div>
                                <button class="toolbar-btn" title="Heading 1">H1</button>
                                <button class="toolbar-btn" title="Heading 2">H2</button>
                                <button class="toolbar-btn" title="Heading 3">H3</button>
                                <div class="toolbar-divider"></div>
                                <button class="toolbar-btn" title="Bullet List">• List</button>
                                <button class="toolbar-btn" title="Numbered List">1. List</button>
                                <button class="toolbar-btn" title="Blockquote">" Quote</button>
                                <div class="toolbar-divider"></div>
                                <button class="toolbar-btn" title="Link">🔗 Link</button>
                                <button class="toolbar-btn" title="Image">🖼 Image</button>
                                <button class="toolbar-btn" title="Code Block">&lt;/&gt; Code</button>
                                <div class="toolbar-divider"></div>
                                <button class="toolbar-btn" title="Inline CTA Block">⚡ CTA Block</button>
                                <button class="toolbar-btn" title="Quote Block">💬 Quote</button>
                            </div>
                            <input class="editor-title-input" id="post-title" placeholder="Write your post title here…"
                                type="text" />
                            <textarea class="editor-content-area" id="post-content"
                                placeholder="Start writing your article… Use the toolbar above to format text, insert images, add quote blocks, and CTA banners. Supports Markdown."
                                spellcheck="true"></textarea>

                            <!-- EXCERPT -->
                            <div style="margin-top:1rem">
                                <label class="form-label-sm"
                                    style="font-size:.8rem;font-weight:600;color:var(--text-muted);display:block;margin-bottom:.4rem">📋
                                    EXCERPT (shown on blog cards)</label>
                                <textarea class="excerpt-input" id="post-excerpt"
                                    placeholder="Write a 1-2 sentence summary shown on the blog listing page…"></textarea>
                            </div>
                        </div>

                        <!-- EDITOR SIDEBAR -->
                        <div class="editor-sidebar-sticky">

                            <!-- PUBLISH SETTINGS -->
                            <div class="settings-card">
                                <div class="settings-title">🚀 Publish</div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Status</label>
                                    <select class="form-ctrl select" id="post-status">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                        <option value="scheduled">Scheduled</option>
                                    </select>
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Schedule Date &amp; Time</label>
                                    <input type="datetime-local" class="form-ctrl" />
                                </div>
                                <div class="toggle-row">
                                    <span class="toggle-label">Allow Comments</span>
                                    <label class="toggle-switch"><input type="checkbox" checked /><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <span class="toggle-label">Featured Post</span>
                                    <label class="toggle-switch"><input type="checkbox" /><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>

                            <!-- TAXONOMY -->
                            <div class="settings-card">
                                <div class="settings-title">🏷️ Taxonomy</div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Category</label>
                                    <select class="form-ctrl select" id="post-category">
                                        <option value="">Select category…</option>
                                    </select>
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Author</label>
                                    <select class="form-ctrl select">
                                        <option>Kwame Asante</option>
                                        <option>Adaeze Obi</option>
                                        <option>Fatima Al-Rashid</option>
                                        <option>Emeka Nwosu</option>
                                    </select>
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Tags (press Enter to add)</label>
                                    <div class="tags-input-wrap" id="tags-wrap"
                                        onclick="document.getElementById('tags-input').focus()">
                                        <span class="tag-chip">ERP <span class="tag-chip-remove"
                                                onclick="removeTag(this)">×</span></span>
                                        <span class="tag-chip">Business Growth <span class="tag-chip-remove"
                                                onclick="removeTag(this)">×</span></span>
                                        <input type="text" class="tags-input" id="tags-input" placeholder="Add tag…" />
                                    </div>
                                </div>
                            </div>

                            <!-- FEATURED IMAGE -->
                            <div class="settings-card">
                                <div class="settings-title">🖼️ Featured Image</div>
                                <div class="image-upload-area" id="image-upload"
                                    onclick="document.getElementById('image-file').click()">
                                    <span>📸</span>
                                    Click to upload or drag &amp; drop<br><small>WebP, JPG, PNG · Max 2MB</small>
                                </div>
                                <input type="file" id="image-file" accept="image/*" style="display:none"
                                    onchange="previewImage(this)" />
                                <img id="image-preview" src="" alt=""
                                    style="display:none;width:100%;border-radius:var(--radius-lg);margin-top:.75rem;object-fit:cover;max-height:140px" />
                            </div>

                            <!-- SEO SETTINGS -->
                            <div class="settings-card">
                                <div class="settings-title">🔍 SEO &amp; Meta</div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">URL Slug</label>
                                    <input type="text" class="form-ctrl" placeholder="your-post-slug" id="post-slug" />
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Meta Title <small
                                            style="color:var(--text-muted)">(55-60 chars)</small></label>
                                    <input type="text" class="form-ctrl" placeholder="SEO title…" id="meta-title"
                                        maxlength="65" oninput="updateSeoScore()" />
                                    <div style="font-size:.72rem;color:var(--text-muted);margin-top:.25rem"><span
                                            id="meta-title-count">0</span>/65 chars</div>
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Meta Description <small
                                            style="color:var(--text-muted)">(145-160 chars)</small></label>
                                    <textarea class="form-ctrl" placeholder="Meta description…" rows="3" id="meta-desc"
                                        maxlength="165" oninput="updateSeoScore()"></textarea>
                                    <div style="font-size:.72rem;color:var(--text-muted);margin-top:.25rem"><span
                                            id="meta-desc-count">0</span>/165 chars</div>
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">Canonical URL</label>
                                    <input type="url" class="form-ctrl" placeholder="https://cypressiq.agency/blog/…" />
                                </div>
                                <div class="form-group-sm">
                                    <label class="form-label-sm">SEO Score</label>
                                    <div style="display:flex;align-items:center;gap:.5rem">
                                        <div class="seo-score-bar" style="flex:1">
                                            <div class="seo-score-fill" id="seo-score-fill" style="width:20%"></div>
                                        </div>
                                        <span id="seo-score-label"
                                            style="font-size:.8rem;font-weight:700;color:var(--clr-warning)">Needs
                                            Work</span>
                                    </div>
                                </div>
                                <div class="toggle-row">
                                    <span class="toggle-label">Open Graph Tags</span>
                                    <label class="toggle-switch"><input type="checkbox" checked /><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <span class="toggle-label">Twitter Card</span>
                                    <label class="toggle-switch"><input type="checkbox" checked /><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <span class="toggle-label">JSON-LD Schema</span>
                                    <label class="toggle-switch"><input type="checkbox" checked /><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>

                        </div><!-- /editor sidebar -->
                    </div><!-- /editor-layout -->
                </div>

                <!-- ─── MESSAGES PANEL ─── -->
                <div class="admin-panel" id="panel-messages">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                        <div>
                            <h2 style="font-size:1.4rem;margin-bottom:.25rem">Inbox (Messages)</h2>
                            <p style="color:var(--text-muted);font-size:.875rem">Lead capture forms and contact inquiries</p>
                        </div>
                        <button class="btn btn--outline btn--sm" onclick="loadMessages()">↻ Refresh</button>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table" id="messages-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Interest</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="6" style="text-align:center">Loading messages...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ─── BOOKINGS PANEL ─── -->
                <div class="admin-panel" id="panel-bookings">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                        <div>
                            <h2 style="font-size:1.4rem;margin-bottom:.25rem">Strategy Bookings</h2>
                            <p style="color:var(--text-muted);font-size:.875rem">Requested 30-min strategy calls</p>
                        </div>
                        <button class="btn btn--outline btn--sm" onclick="loadBookings()">↻ Refresh</button>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table" id="bookings-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email / Phone</th>
                                    <th>Time Slot</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="4" style="text-align:center">Loading bookings...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ─── CONTACT SETTINGS PANEL ─── -->
                <div class="admin-panel" id="panel-contact-settings">
                    <div style="margin-bottom:1.5rem">
                        <h2 style="font-size:1.4rem;margin-bottom:.25rem">Contact Info Settings</h2>
                        <p style="color:var(--text-muted);font-size:.875rem">Manage your company details shown globally</p>
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
                            <button type="submit" class="btn btn--primary" style="margin-top: 1rem">Save Settings</button>
                        </form>
                    </div>
                </div>

                <!-- ─── NEWSLETTER PANEL ─── -->
                <div class="admin-panel" id="panel-newsletter">
                    <div style="margin-bottom:1.5rem">
                        <h2 style="font-size:1.4rem;margin-bottom:.25rem">Newsletter Management</h2>
                        <p style="color:var(--text-muted);font-size:.875rem">8,241 active subscribers across all lists
                        </p>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-bottom:2rem">
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Total Subscribers</div>
                            <div class="admin-stat-value" style="color:var(--clr-primary)">8,241</div>
                            <div class="admin-stat-change up">▲ +120 this week</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Avg. Open Rate</div>
                            <div class="admin-stat-value" style="color:var(--clr-accent)">38.4%</div>
                            <div class="admin-stat-change up">▲ Above industry avg</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Avg. Click Rate</div>
                            <div class="admin-stat-value" style="color:var(--clr-success)">6.2%</div>
                            <div class="admin-stat-change up">▲ +1.2% vs last month</div>
                        </div>
                    </div>
                    <div class="admin-table-wrap">
                        <div class="admin-table-header">
                            <div class="admin-table-title">📋 Subscriber Segments</div><button
                                class="btn btn--primary btn--sm">+ New Campaign</button>
                        </div>
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Segment</th>
                                    <th>Subscribers</th>
                                    <th>Open Rate</th>
                                    <th>Last Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>All Subscribers</strong></td>
                                    <td>8,241</td>
                                    <td>38.4%</td>
                                    <td>Mar 25, 2026</td>
                                </tr>
                                <tr>
                                    <td>Business Owners</td>
                                    <td>3,105</td>
                                    <td>42.1%</td>
                                    <td>Mar 25, 2026</td>
                                </tr>
                                <tr>
                                    <td>Developers</td>
                                    <td>1,872</td>
                                    <td>35.8%</td>
                                    <td>Mar 25, 2026</td>
                                </tr>
                                <tr>
                                    <td>Marketers</td>
                                    <td>2,140</td>
                                    <td>39.6%</td>
                                    <td>Mar 25, 2026</td>
                                </tr>
                                <tr>
                                    <td>Opero ERP Prospects</td>
                                    <td>1,124</td>
                                    <td>51.3%</td>
                                    <td>Mar 20, 2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ─── ANALYTICS PANEL ─── -->
                <div class="admin-panel" id="panel-analytics">
                    <div style="margin-bottom:1.5rem">
                        <h2 style="font-size:1.4rem;margin-bottom:.25rem">Content Analytics</h2>
                        <p style="color:var(--text-muted);font-size:.875rem">Performance metrics for all published
                            content</p>
                    </div>
                    <div class="admin-stats-grid">
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Total Views (All Time)</div>
                            <div class="admin-stat-value" style="color:var(--clr-primary)">142k</div>
                            <div class="admin-stat-change up">▲ +18% MoM</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Avg. Scroll Depth</div>
                            <div class="admin-stat-value" style="color:var(--clr-accent)">64%</div>
                            <div class="admin-stat-change up">▲ +8% MoM</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Blog Conversion Rate</div>
                            <div class="admin-stat-value" style="color:var(--clr-success)">3.8%</div>
                            <div class="admin-stat-change up">▲ +0.4%</div>
                        </div>
                        <div class="admin-stat-card">
                            <div class="admin-stat-label">Opero Demo Requests</div>
                            <div class="admin-stat-value">41</div>
                            <div class="admin-stat-change up">▲ +12 this month</div>
                        </div>
                    </div>
                    <div class="admin-table-wrap" style="margin-top:1.5rem">
                        <div class="admin-table-header">
                            <div class="admin-table-title">📊 Top Performing Articles</div>
                        </div>

<script>
    async function savePost(status) {
        const payload = {
            title: document.getElementById('post-title')?.value || '',
            content: document.getElementById('post-content')?.value || '',
            excerpt: document.getElementById('post-excerpt')?.value || '',
            slug: document.getElementById('post-slug')?.value || '',
            meta_title: document.getElementById('meta-title')?.value || '',
            meta_description: document.getElementById('meta-desc')?.value || '',
            status: status,
            category_id: document.getElementById('post-category')?.value || null,
        };

        if (!payload.title || !payload.content) {
            alert('Title and Content are required!');
            return;
        }

        try {
            const response = await fetch("{{ route('admin.api.posts.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();
            
            if (response.ok) {
                alert(result.message);
                window.location.reload(); // Reload to show new post in data table
            } else {
                alert('Error processing request: ' + (result.message || JSON.stringify(result.errors || result)));
            }
        } catch (error) {
            console.error(error);
            alert('Network error occurred.');
        }
    }
</script>

<script>
    // System API Fetchers
    async function loadMessages() {
        const tbody = document.querySelector('#messages-table tbody');
        if(!tbody) return;
        try {
            const res = await fetch('/admin/api/messages');
            const data = await res.json();
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center">No messages found.</td></tr>';
                return;
            }
            data.forEach(m => {
                let badgeClass = m.status === 'new' ? 'color:#FF6B7A' : (m.status === 'replied' ? 'color:var(--clr-success)' : '');
                tbody.innerHTML += `
                <tr>
                    <td><strong>${m.first_name} ${m.last_name}</strong></td>
                    <td>${m.email}</td>
                    <td>${m.phone || '-'}</td>
                    <td>${m.service_interest}</td>
                    <td>
                        <select onchange="updateMessageStatus(${m.id}, this.value)" style="padding: 4px; border-radius:4px; font-weight:600; border:1px solid var(--border-subtle); background:var(--bg-glass); ${badgeClass}">
                            <option value="new" ${m.status==='new'?'selected':''}>new</option>
                            <option value="read" ${m.status==='read'?'selected':''}>read</option>
                            <option value="replied" ${m.status==='replied'?'selected':''}>replied</option>
                        </select>
                    </td>
                    <td>${new Date(m.created_at).toLocaleDateString()}</td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    async function updateMessageStatus(id, status) {
        await fetch(`/admin/api/messages/${id}/status`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({status})
        });
        loadMessages();
    }

    async function loadBookings() {
        const tbody = document.querySelector('#bookings-table tbody');
        if(!tbody) return;
        try {
            const res = await fetch('/admin/api/bookings');
            const data = await res.json();
            tbody.innerHTML = '';
            if(data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" style="text-align:center">No bookings found.</td></tr>';
                return;
            }
            data.forEach(b => {
                let badgeClass = b.status === 'pending' ? 'color:var(--clr-warning)' : (b.status === 'confirmed' ? 'color:var(--clr-success)' : '');
                tbody.innerHTML += `
                <tr>
                    <td><strong>${b.name}</strong></td>
                    <td>${b.email}<br><small style="color:var(--text-muted)">${b.phone||''}</small></td>
                    <td>${b.preferred_time_slot}</td>
                    <td>
                        <select onchange="updateBookingStatus(${b.id}, this.value)" style="padding: 4px; border-radius:4px; font-weight:600; border:1px solid var(--border-subtle); background:var(--bg-glass); ${badgeClass}">
                            <option value="pending" ${b.status==='pending'?'selected':''}>pending</option>
                            <option value="confirmed" ${b.status==='confirmed'?'selected':''}>confirmed</option>
                            <option value="completed" ${b.status==='completed'?'selected':''}>completed</option>
                        </select>
                    </td>
                </tr>`;
            });
        } catch(e) { console.error(e); }
    }

    async function updateBookingStatus(id, status) {
        await fetch(`/admin/api/bookings/${id}/status`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({status})
        });
        loadBookings();
    }

    async function loadContactSettings() {
        if(!document.getElementById('cs_email')) return;
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
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify(payload)
            });
            if(res.ok) alert('Settings saved successfully!');
        } catch(e) { console.error(e); }
    }

    // Call them once to populate on load
    document.addEventListener('DOMContentLoaded', () => {
        loadMessages();
        loadBookings();
        loadContactSettings();
    });
</script>
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Views</th>
                                    <th>Avg. Time</th>
                                    <th>Scroll Depth</th>
                                    <th>Leads</th>
                                    <th>Conversions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>From $50K to $2M: Digital Transformation</td>
                                    <td>6,712</td>
                                    <td>6m 12s</td>
                                    <td>78%</td>
                                    <td>24</td>
                                    <td>4.2%</td>
                                </tr>
                                <tr>
                                    <td>Why Every SME Needs an ERP in 2026</td>
                                    <td>5,412</td>
                                    <td>5m 48s</td>
                                    <td>82%</td>
                                    <td>41</td>
                                    <td>6.1%</td>
                                </tr>
                                <tr>
                                    <td>10 SEO Strategies That Tripled Traffic</td>
                                    <td>3,108</td>
                                    <td>4m 31s</td>
                                    <td>69%</td>
                                    <td>18</td>
                                    <td>3.4%</td>
                                </tr>
                                <tr>
                                    <td>The Google Ads Strategy: $2.1M</td>
                                    <td>2,831</td>
                                    <td>4m 02s</td>
                                    <td>61%</td>
                                    <td>12</td>
                                    <td>2.8%</td>
                                </tr>
                                <tr>
                                    <td>Website Speed: Hitting 95+ PageSpeed</td>
                                    <td>2,114</td>
                                    <td>3m 55s</td>
                                    <td>57%</td>
                                    <td>8</td>
                                    <td>2.1%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ─── SEO PANEL ─── -->
                <div class="admin-panel" id="panel-seo">
                    <div style="margin-bottom:1.5rem">
                        <h2 style="font-size:1.4rem;margin-bottom:.25rem">SEO Settings</h2>
                        <p style="color:var(--text-muted);font-size:.875rem">Global SEO configuration for the blog</p>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
                        <div class="settings-card">
                            <div class="settings-title">🌐 Global Meta</div>
                            <div class="form-group-sm"><label class="form-label-sm">Site Title</label><input
                                    class="form-ctrl" value="CypressIq — Digital Growth &amp; ERP Solutions" /></div>
                            <div class="form-group-sm"><label class="form-label-sm">Blog Base Title Suffix</label><input
                                    class="form-ctrl" value="| CypressIq Blog" /></div>
                            <div class="form-group-sm"><label class="form-label-sm">Default Meta
                                    Description</label><textarea class="form-ctrl"
                                    rows="3">Expert insights on digital marketing, SEO, ERP systems &amp; business growth from CypressIq.</textarea>
                            </div>
                            <div class="form-group-sm"><label class="form-label-sm">Canonical Base URL</label><input
                                    class="form-ctrl" value="https://cypressiq.agency" /></div>
                        </div>
                        <div class="settings-card">
                            <div class="settings-title">📊 Structured Data</div>
                            <div class="toggle-row"><span class="toggle-label">Article Schema (JSON-LD)</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Breadcrumb Schema</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">FAQ Schema (where
                                    applicable)</span><label class="toggle-switch"><input type="checkbox"
                                        checked /><span class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Open Graph Tags</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Twitter Cards</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Auto XML Sitemap</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                        </div>
                    </div>
                    <div style="margin-top:1rem;text-align:right"><button class="btn btn--primary">Save SEO
                            Settings</button></div>
                </div>

                <!-- ─── MEDIA PANEL ─── -->
                <div class="admin-panel" id="panel-media">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
                        <div>
                            <h2 style="font-size:1.4rem;margin-bottom:.25rem">Media Library</h2>
                            <p style="color:var(--text-muted);font-size:.875rem">Upload and manage images for blog posts
                            </p>
                        </div>
                        <button class="btn btn--primary btn--sm">⬆ Upload Files</button>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:1rem">
                        <div
                            style="background:linear-gradient(135deg,#1a0533,#2d1b69);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            🔍</div>
                        <div
                            style="background:linear-gradient(135deg,#001a0d,#003320);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            ⚙️</div>
                        <div
                            style="background:linear-gradient(135deg,#1a0a00,#3d1a00);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            📢</div>
                        <div
                            style="background:linear-gradient(135deg,#0a001a,#1a0533);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            🌐</div>
                        <div
                            style="background:linear-gradient(135deg,#001a1a,#003333);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            📱</div>
                        <div
                            style="background:linear-gradient(135deg,#0a1a0a,#1a2e1a);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:3rem;cursor:pointer;border:1px solid var(--border-subtle)">
                            💰</div>
                        <div
                            style="background:var(--bg-glass);border:2px dashed var(--border-mid);border-radius:var(--radius-xl);aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:2rem;cursor:pointer;color:var(--text-muted)">
                            +</div>
                    </div>
                </div>

                <!-- ─── SETTINGS PANEL ─── -->
                <div class="admin-panel" id="panel-settings">
                    <div style="margin-bottom:1.5rem">
                        <h2 style="font-size:1.4rem;margin-bottom:.25rem">General Settings</h2>
                        <p style="color:var(--text-muted);font-size:.875rem">Configure your blog and CMS preferences</p>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
                        <div class="settings-card">
                            <div class="settings-title">⚙️ Blog Configuration</div>
                            <div class="form-group-sm"><label class="form-label-sm">Posts Per Page</label><input
                                    type="number" class="form-ctrl" value="9" /></div>
                            <div class="form-group-sm"><label class="form-label-sm">Default Category</label><select
                                    class="form-ctrl select">
                                    <option>Digital Marketing</option>
                                    <option>ERP Systems</option>
                                </select></div>
                            <div class="toggle-row"><span class="toggle-label">Comments Enabled</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Lazy Load Images</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Dark Mode Default</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                        </div>
                        <div class="settings-card">
                            <div class="settings-title">📬 Lead Capture</div>
                            <div class="toggle-row"><span class="toggle-label">Sticky Newsletter Bar</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Exit Intent Popup</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Mid-Article Lead Form</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="toggle-row"><span class="toggle-label">Opero Demo CTA Sidebar</span><label
                                    class="toggle-switch"><input type="checkbox" checked /><span
                                        class="toggle-slider"></span></label></div>
                            <div class="form-group-sm" style="margin-top:1rem"><label class="form-label-sm">CTA Trigger
                                    Scroll Depth</label><input type="number" class="form-ctrl" value="600" /></div>
                        </div>
                    </div>
                    <div style="margin-top:1rem;text-align:right"><button class="btn btn--primary">Save
                            Settings</button></div>
                </div>

            
@endsection