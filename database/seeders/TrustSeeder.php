<?php

namespace Database\Seeders;

use App\Models\PortfolioProject;
use App\Models\Testimonial;
use App\Models\Partnership;
use Illuminate\Database\Seeder;

class TrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ── 1. PORTFOLIO PROJECTS ───────────────────────────────────────────────
        $projects = [
            [
                'title'          => 'ITIKIA Campaign — Digital Engagement & Public Mobilization Platform',
                'slug'           => 'itikia-campaign',
                'client_name'    => 'CypressIQ Technologies',
                'industry'       => 'Civic Tech & Public Communication',
                'category'       => 'Digital Products',
                'summary'        => 'A specialized digital engagement and communication platform engineered for public campaigns, grassroots advocacy, and voter mobilization with integrated SMS, USSD, and turnout analytics.',
                'description'    => 'ITIKIA Campaign is CypressIQ\'s proprietary engagement platform built to replace fragmented outreach with a unified command center. Designed for public-facing campaigns, civic advocacy groups, and member organizations, ITIKIA delivers sub-second message throughput, geo-segmented member polling, automated USSD workflows, and encrypted supporter databases.',
                'cover_image'    => '/images/mockups/itikia-poster.webp',
                'gallery_images' => ['/images/mockups/itikia-poster.webp'],
                'technologies'   => ['Laravel 12', 'PostgreSQL', 'Redis Queues', 'Twilio / Africa\'s Talking', 'Alpine.js', 'WebSockets'],
                'outcomes'       => [
                    '250,000+ constituent messages processed',
                    '99.98% delivery rate on high-velocity broadcasts',
                    '3.4x higher supporter engagement vs manual outreach'
                ],
                'project_url'    => '/itikia',
                'duration'       => 'Flagship Product',
                'completed_at'   => '2025-11-15',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 1,
            ],
            [
                'title'          => 'OPERO — Enterprise Business Operations & ERP Platform',
                'slug'           => 'opero-erp',
                'client_name'    => 'CypressIQ Technologies',
                'industry'       => 'Retail, Wholesale & Multi-Branch Trade',
                'category'       => 'Business Systems',
                'summary'        => 'A synchronized operational enterprise platform unifying offline-tolerant POS, multi-location warehouse inventory rebalancing, biometric attendance, double-entry payroll, and real-time telemetry.',
                'description'    => 'Opero is CypressIQ\'s flagship business operating system engineered for growing multi-branch enterprises, wholesalers, and retail chains. It replaces fragmented spreadsheets with a synchronized operational engine covering POS, multi-location stock, biometric HR, payroll, and double-entry accounting ledgers.',
                'cover_image'    => '/images/mockups/opero-poster.webp',
                'gallery_images' => ['/images/mockups/opero-poster.webp'],
                'technologies'   => ['Laravel Core', 'PostgreSQL', 'IndexedDB Offline Sync', 'Redis Cache', 'Chart.js Telemetry', 'ESC/POS Thermal Drivers'],
                'outcomes'       => [
                    '14+ live enterprise branch deployments',
                    '42% reduction in stock reconciliation discrepancies',
                    'Zero transactional downtime during ISP connectivity loss'
                ],
                'project_url'    => '/opero',
                'duration'       => 'Continuous Enterprise Release',
                'completed_at'   => '2026-01-20',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 2,
            ],
            [
                'title'          => 'PCEA Neema Church Nakuru — Digital Ministry & Member Portal',
                'slug'           => 'pcea-neema-nakuru',
                'client_name'    => 'PCEA Neema Church Nakuru',
                'industry'       => 'Faith-Based & Community Organizations',
                'category'       => 'Web Development',
                'summary'        => 'An enterprise digital ministry portal with live HD sermon streaming, automated M-Pesa tithes & offerings, interactive event calendars, and archival resource library.',
                'description'    => 'Engineered and deployed for PCEA Neema Church in Nakuru to connect their active congregation locally and across the diaspora. Features mobile-first responsive architecture, seamless M-Pesa Daraja API payment reconciliation for contributions, high-definition YouTube/Vimeo sermon broadcasting, department calendars, and community announcements.',
                'cover_image'    => '/images/projects/pcea-poster.svg',
                'gallery_images' => ['/images/projects/pcea-poster.svg'],
                'technologies'   => ['Modern Web Architecture', 'Laravel', 'M-Pesa Daraja API', 'YouTube Live API', 'Cloudflare CDN', 'Tailwind CSS'],
                'outcomes'       => [
                    '10,000+ monthly online sermon viewers',
                    'Zero payment drop-offs for digital contributions',
                    '65% increase in youth & fellowship event registrations'
                ],
                'project_url'    => 'https://pceaneemanakuru.com/',
                'duration'       => '6 Weeks',
                'completed_at'   => '2025-08-10',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 3,
            ],
            [
                'title'          => 'Amos Karoki — Executive Advisory & Thought Leadership Platform',
                'slug'           => 'amos-karoki-consulting',
                'client_name'    => 'Amos Karoki',
                'industry'       => 'Executive Consulting & Professional Services',
                'category'       => 'Web Development',
                'summary'        => 'A premier personal brand and executive consulting platform with automated client intake, keynote portfolio showcase, book sales funnel, and international payment gateways.',
                'description'    => 'Designed and engineered for business strategist and executive speaker Amos Karoki. The platform combines high-converting typography and minimal cyber-glass aesthetic with automated calendar bookings, structured thought leadership blog engine, book distribution gateway, and corporate advisory inquiry qualification pipelines.',
                'cover_image'    => '/images/projects/amos-poster.svg',
                'gallery_images' => ['/images/projects/amos-poster.svg'],
                'technologies'   => ['Custom Frontend Engineering', 'Laravel API', 'Cal.com Scheduler', 'Stripe / International Billing', 'Technical SEO'],
                'outcomes'       => [
                    '300% surge in qualified corporate advisory inquiries',
                    'Sub-600ms load time worldwide via edge caching',
                    'Top 3 search engine ranking for leadership consulting'
                ],
                'project_url'    => 'https://amoskaroki.com/',
                'duration'       => '4 Weeks',
                'completed_at'   => '2025-10-05',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 4,
            ],
            [
                'title'          => 'ApexLogix — Cold-Chain IoT Telemetry & Logistics ERP',
                'slug'           => 'apexlogix-cold-chain-telemetry',
                'client_name'    => 'ApexLogix Global Logistics',
                'industry'       => 'Supply Chain & Cold Logistics',
                'category'       => 'Automation & Integrations',
                'summary'        => 'IoT-enabled pharmaceutical fleet tracking with automated temperature excursion warnings, dynamic route optimization, and digital customs manifests.',
                'description'    => 'An end-to-end telemetry and logistics platform built for cross-border pharmaceutical cold-chain transport. Integrates vehicle OBD-II and temperature sensors with real-time MQTT message queues, sending instant alerts to drivers and dispatchers upon 0.5°C threshold shifts, while calculating optimal transit routes.',
                'cover_image'    => '/images/projects/apexlogix-poster.svg',
                'gallery_images' => ['/images/projects/apexlogix-poster.svg'],
                'technologies'   => ['IoT MQTT Broker', 'Laravel Microservices', 'TimescaleDB', 'Redis Cluster', 'Mapbox GL', 'Africa\'s Talking SMS'],
                'outcomes'       => [
                    'Zero cargo spoilage across 1.2M kilometers',
                    '28% reduction in fuel consumption via route optimization',
                    '100% compliance with international pharmaceutical logistics audits'
                ],
                'project_url'    => '/automation-integrations',
                'duration'       => '5 Months',
                'completed_at'   => '2025-12-18',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 5,
            ],
            [
                'title'          => 'MedPulse — Multi-Clinic Health Portal & Teleconsultation Core',
                'slug'           => 'medpulse-health-portal',
                'client_name'    => 'MedPulse Healthcare Network',
                'industry'       => 'Healthcare & Life Sciences',
                'category'       => 'Digital Platforms',
                'summary'        => 'HIPAA-aligned multi-specialty clinical operations suite featuring encrypted electronic medical records (EMR), WebRTC video teleconsultations, and automated pharmacy orders.',
                'description'    => 'Engineered for a growing network of outpatient clinics. MedPulse centralizes patient appointment booking, doctor schedules, diagnostic lab test results, and video consultations within a fortified, end-to-end encrypted architecture with complete audit logging and mobile patient access.',
                'cover_image'    => '/images/projects/medpulse-poster.svg',
                'gallery_images' => ['/images/projects/medpulse-poster.svg'],
                'technologies'   => ['Laravel REST API', 'WebRTC Video Engine', 'Vue.js', 'MySQL Encrypted Storage', 'AWS KMS', 'Twilio Voice & Video'],
                'outcomes'       => [
                    '45,000+ encrypted patient records managed seamlessly',
                    '50% reduction in patient clinic waiting times',
                    '12,000+ completed virtual doctor consultations with zero data breaches'
                ],
                'project_url'    => '/digital-platforms',
                'duration'       => '7 Months',
                'completed_at'   => '2026-02-14',
                'is_featured'    => true,
                'is_published'   => true,
                'sort_order'     => 6,
            ],
        ];

        foreach ($projects as $proj) {
            PortfolioProject::updateOrCreate(
                ['slug' => $proj['slug']],
                $proj
            );
        }

        // ── 2. CLIENT TESTIMONIALS ──────────────────────────────────────────────
        $testimonials = [
            [
                'client_name'         => 'Rev. Dr. Patrick M. Gichuki',
                'client_role'         => 'Parish Minister & Secretariat Head',
                'client_company'      => 'PCEA Neema Church Nakuru',
                'client_avatar'       => null,
                'quote'               => 'CypressIQ transformed our church\'s entire digital presence. Our congregation across Nakuru and in the diaspora can now follow live sermons in HD, access ministry resources, and contribute through M-Pesa with absolute ease. The engineering speed, security, and attentiveness to our needs made them an indispensable partner.',
                'rating'              => 5,
                'product_or_solution' => 'Web Development & Digital Ministry Platform',
                'is_featured'         => true,
                'is_published'        => true,
                'sort_order'          => 1,
            ],
            [
                'client_name'         => 'Amos Karoki',
                'client_role'         => 'Founder & Principal Consultant',
                'client_company'      => 'Amos Karoki Leadership Consulting',
                'client_avatar'       => null,
                'quote'               => 'Partnering with CypressIQ was one of the highest-yield decisions I have made for my advisory firm. They don\'t just build websites; they engineer conversion architecture and brand authority. Inquiries from enterprise executives surged by over 300% within the first ninety days of launching our new platform.',
                'rating'              => 5,
                'product_or_solution' => 'Executive Web Platform & Consulting Architecture',
                'is_featured'         => true,
                'is_published'        => true,
                'sort_order'          => 2,
            ],
            [
                'client_name'         => 'David Kipkorir',
                'client_role'         => 'Head of Fleet Operations & Telemetry',
                'client_company'      => 'ApexLogix Global Logistics',
                'client_avatar'       => null,
                'quote'               => 'The cold-chain tracking and dispatch system engineered by CypressIQ has completely modernized our transit operations. Instant temperature alerts and automated customs manifests have prevented millions in potential pharmaceutical cargo losses. Their software simply does not fail.',
                'rating'              => 5,
                'product_or_solution' => 'IoT Fleet Telemetry & Custom Logistics ERP',
                'is_featured'         => true,
                'is_published'        => true,
                'sort_order'          => 3,
            ],
            [
                'client_name'         => 'Dr. Sharon Mwangi',
                'client_role'         => 'Chief Medical Director',
                'client_company'      => 'MedPulse Healthcare Network',
                'client_avatar'       => null,
                'quote'               => 'In healthcare, software failure or data leakage is unacceptable. CypressIQ designed a secure, HIPAA-compliant patient management and telehealth portal that our medical staff and patients genuinely love. Our clinic wait times dropped by 50%, and telehealth adoption exceeded all projections.',
                'rating'              => 5,
                'product_or_solution' => 'MedPulse Health Portal & Clinic EHR Core',
                'is_featured'         => true,
                'is_published'        => true,
                'sort_order'          => 4,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['client_name' => $t['client_name'], 'client_company' => $t['client_company']],
                $t
            );
        }

        // ── 3. TECHNOLOGY PARTNERSHIPS ──────────────────────────────────────────
        $partnerships = [
            [
                'partner_name'     => 'Amazon Web Services (AWS)',
                'partner_logo'     => null,
                'partner_website'  => 'https://aws.amazon.com/',
                'partnership_type' => 'technology',
                'description'      => 'Cloud Infrastructure Partner — Utilizing high-availability RDS PostgreSQL clusters, S3 encrypted object storage, and CloudFront edge CDN distribution for CypressIQ deployments.',
                'is_featured'      => true,
                'is_published'     => true,
                'sort_order'       => 1,
            ],
            [
                'partner_name'     => 'Safaricom Telecommunications & M-Pesa',
                'partner_logo'     => null,
                'partner_website'  => 'https://www.safaricom.co.ke/',
                'partnership_type' => 'strategic',
                'description'      => 'Certified Daraja Enterprise Integration Partner — Powering real-time mobile money payments, automated C2B/B2C disbursements, and STK-push reconciliation across our platforms.',
                'is_featured'      => true,
                'is_published'     => true,
                'sort_order'       => 2,
            ],
            [
                'partner_name'     => 'Stripe Global Financial Infrastructure',
                'partner_logo'     => null,
                'partner_website'  => 'https://stripe.com/',
                'partnership_type' => 'technology',
                'description'      => 'Global Payments Partner — Providing PCI-DSS compliant credit card processing, multi-currency invoicing, and SaaS subscription billing for international clients.',
                'is_featured'      => true,
                'is_published'     => true,
                'sort_order'       => 3,
            ],
            [
                'partner_name'     => 'Twilio & Africa\'s Talking Communications',
                'partner_logo'     => null,
                'partner_website'  => 'https://africastalking.com/',
                'partnership_type' => 'technology',
                'description'      => 'Telecom Connectivity Partner — Providing high-throughput SMS gateways, two-way USSD codes, voice IVR, and WhatsApp Business API pipelines for our civic and enterprise software.',
                'is_featured'      => true,
                'is_published'     => true,
                'sort_order'       => 4,
            ],
        ];

        foreach ($partnerships as $p) {
            Partnership::updateOrCreate(
                ['partner_name' => $p['partner_name']],
                $p
            );
        }
    }
}
