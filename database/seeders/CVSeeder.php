<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Certificate;

class CVSeeder extends Seeder
{
    public function run(): void
    {
        // Profile
        Profile::create([
            'name'         => 'Nama Anda',
            'tagline'      => 'Full Stack Web Developer & UI/UX Enthusiast',
            'email'        => 'nama@email.com',
            'phone'        => '+62 812-3456-7890',
            'location'     => 'Jakarta, Indonesia',
            'website'      => 'https://namaanda.dev',
            'github'       => 'https://github.com/namaanda',
            'linkedin'     => 'https://linkedin.com/in/namaanda',
            'twitter'      => 'https://twitter.com/namaanda',
            'instagram'    => 'https://instagram.com/namaanda',
            'about'        => 'Saya adalah seorang Full Stack Web Developer dengan pengalaman lebih dari 3 tahun dalam membangun aplikasi web modern yang scalable dan user-friendly. Saya bersemangat dalam mengeksplorasi teknologi terbaru dan selalu berusaha menulis kode yang bersih dan efisien. Di luar coding, saya aktif berkontribusi di komunitas open-source dan senang berbagi ilmu melalui tulisan teknis.',
            'open_to_work' => true,
        ]);

        // Skills
        $skills = [
            ['name' => 'PHP',         'category' => 'Backend',  'level' => 90, 'icon' => 'fab fa-php'],
            ['name' => 'Laravel',     'category' => 'Backend',  'level' => 92, 'icon' => 'fab fa-laravel'],
            ['name' => 'MySQL',       'category' => 'Backend',  'level' => 85, 'icon' => 'fas fa-database'],
            ['name' => 'Node.js',     'category' => 'Backend',  'level' => 75, 'icon' => 'fab fa-node-js'],
            ['name' => 'REST API',    'category' => 'Backend',  'level' => 88, 'icon' => 'fas fa-plug'],
            ['name' => 'HTML5',       'category' => 'Frontend', 'level' => 95, 'icon' => 'fab fa-html5'],
            ['name' => 'CSS3',        'category' => 'Frontend', 'level' => 90, 'icon' => 'fab fa-css3-alt'],
            ['name' => 'JavaScript',  'category' => 'Frontend', 'level' => 85, 'icon' => 'fab fa-js'],
            ['name' => 'Vue.js',      'category' => 'Frontend', 'level' => 80, 'icon' => 'fab fa-vuejs'],
            ['name' => 'React',       'category' => 'Frontend', 'level' => 72, 'icon' => 'fab fa-react'],
            ['name' => 'Tailwind CSS','category' => 'Frontend', 'level' => 88, 'icon' => 'fas fa-wind'],
            ['name' => 'Git',         'category' => 'Tools',    'level' => 88, 'icon' => 'fab fa-git-alt'],
            ['name' => 'Docker',      'category' => 'Tools',    'level' => 72, 'icon' => 'fab fa-docker'],
            ['name' => 'Linux',       'category' => 'Tools',    'level' => 78, 'icon' => 'fab fa-linux'],
            ['name' => 'Figma',       'category' => 'Tools',    'level' => 75, 'icon' => 'fab fa-figma'],
        ];
        foreach ($skills as $i => $skill) {
            Skill::create(array_merge($skill, ['sort_order' => $i + 1]));
        }

        // Experiences (sebagai proyek, bukan karyawan)
        $experiences = [
            [
                'client_name'  => 'Dinas Komunikasi dan Informatika Kota X',
                'position'     => 'Full Stack Developer',
                'project_type' => 'Proyek Pemerintah',
                'start_date'   => '2024-03-01',
                'end_date'     => null,
                'is_current'   => true,
                'location'     => 'On-site / Remote',
                'description'  => "Membangun Sistem Informasi Manajemen Surat berbasis web untuk digitalisasi tata naskah dinas.\nMengimplementasikan fitur e-signature, alur disposisi multi-level, dan notifikasi real-time.\nIntegrasi dengan SSO (Single Sign-On) instansi menggunakan OAuth2.\nMenyediakan dashboard statistik surat masuk/keluar untuk pimpinan.",
                'technologies' => 'Laravel, Livewire, MySQL, Redis, Tailwind CSS',
                'sort_order'   => 1,
            ],
            [
                'client_name'  => 'PT Maju Bersama Tbk',
                'position'     => 'Backend Developer',
                'project_type' => 'Proyek Perusahaan',
                'start_date'   => '2023-06-01',
                'end_date'     => '2024-02-28',
                'is_current'   => false,
                'location'     => 'Remote',
                'description'  => "Membangun sistem inventory management untuk pergudangan 3 cabang.\nMerancang REST API yang dikonsumsi oleh aplikasi mobile Android/iOS.\nMengimplementasikan laporan stok otomatis dalam format PDF & Excel.\nOptimasi query database sehingga performa laporan meningkat 60%.",
                'technologies' => 'Laravel, MySQL, Laravel Excel, Postman, Git',
                'sort_order'   => 2,
            ],
            [
                'client_name'  => 'RS Sehat Sejahtera',
                'position'     => 'Full Stack Developer',
                'project_type' => 'Proyek Swasta',
                'start_date'   => '2022-09-01',
                'end_date'     => '2023-05-31',
                'is_current'   => false,
                'location'     => 'On-site',
                'description'  => "Membangun Sistem Informasi Manajemen Rumah Sakit (SIMRS) modul rawat jalan.\nFitur meliputi: pendaftaran pasien, rekam medis elektronik, antrian dokter, dan billing.\nIntegrasi dengan alat laboratorium untuk input hasil pemeriksaan otomatis.\nDeployment dan maintenance di server internal rumah sakit.",
                'technologies' => 'Laravel, Vue.js, MySQL, Vite, Bootstrap',
                'sort_order'   => 3,
            ],
            [
                'client_name'  => 'Berbagai UMKM & Startup Lokal',
                'position'     => 'Web Developer',
                'project_type' => 'Freelance',
                'start_date'   => '2020-01-01',
                'end_date'     => '2022-08-31',
                'is_current'   => false,
                'location'     => 'Remote',
                'description'  => "Mengerjakan 20+ proyek website untuk UMKM, toko online, dan startup lokal.\nMembangun website company profile, landing page, dan sistem informasi sederhana.\nIntegrasi payment gateway Midtrans untuk toko online klien.\nMengelola hosting, domain, dan deployment di VPS/shared hosting.",
                'technologies' => 'PHP, CodeIgniter, Laravel, JavaScript, Bootstrap, MySQL',
                'sort_order'   => 4,
            ],
        ];
        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // Education
        $educations = [
            [
                'institution'    => 'Universitas Indonesia',
                'degree'         => 'Sarjana (S1)',
                'field_of_study' => 'Ilmu Komputer',
                'start_date'     => '2016-08-01',
                'end_date'       => '2020-07-31',
                'is_current'     => false,
                'gpa'            => 3.72,
                'description'    => 'Fokus pada algoritma, rekayasa perangkat lunak, dan basis data. Aktif di UKM Programming dan meraih juara 2 lomba hackathon tingkat nasional.',
                'sort_order'     => 1,
            ],
            [
                'institution'    => 'SMA Negeri 1 Jakarta',
                'degree'         => 'SMA / IPA',
                'field_of_study' => 'Ilmu Pengetahuan Alam',
                'start_date'     => '2013-07-01',
                'end_date'       => '2016-05-31',
                'is_current'     => false,
                'gpa'            => null,
                'description'    => null,
                'sort_order'     => 2,
            ],
        ];
        foreach ($educations as $edu) {
            Education::create($edu);
        }

        // Portfolio
        $portfolios = [
            [
                'title'             => 'SiKasir - Point of Sale System',
                'slug'              => 'sikasir-pos',
                'short_description' => 'Aplikasi kasir modern berbasis web dengan fitur manajemen stok, laporan penjualan, dan multi-user.',
                'description'       => '<p>SiKasir adalah aplikasi Point of Sale (POS) berbasis web yang dirancang untuk membantu UMKM mengelola transaksi penjualan secara efisien.</p><h3>Fitur Utama:</h3><ul><li>Transaksi penjualan real-time</li><li>Manajemen produk & kategori</li><li>Laporan penjualan harian/bulanan</li><li>Multi-user dengan role management</li><li>Cetak struk thermal printer</li></ul>',
                'category'          => 'Web Application',
                'technologies'      => 'Laravel, Vue.js, MySQL, Tailwind CSS',
                'demo_url'          => 'https://demo-sikasir.example.com',
                'github_url'        => 'https://github.com/namaanda/sikasir',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
                'completed_at'      => '2024-03-15',
            ],
            [
                'title'             => 'EduTrack - Learning Management System',
                'slug'              => 'edutrack-lms',
                'short_description' => 'Platform e-learning dengan fitur video course, quiz interaktif, dan sertifikat otomatis.',
                'description'       => '<p>EduTrack adalah platform Learning Management System (LMS) yang memungkinkan instruktur membuat kursus online dan siswa belajar secara terstruktur.</p>',
                'category'          => 'Web Application',
                'technologies'      => 'Laravel, React, PostgreSQL, AWS S3',
                'demo_url'          => 'https://edutrack.example.com',
                'github_url'        => 'https://github.com/namaanda/edutrack',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
                'completed_at'      => '2024-06-20',
            ],
            [
                'title'             => 'GeoTrack - Fleet Management',
                'slug'              => 'geotrack-fleet',
                'short_description' => 'Sistem monitoring armada kendaraan real-time menggunakan GPS tracking dan dashboard analitik.',
                'description'       => '<p>GeoTrack membantu perusahaan logistik memantau posisi kendaraan secara real-time.</p>',
                'category'          => 'Web Application',
                'technologies'      => 'Laravel, Socket.io, Google Maps API, MySQL',
                'demo_url'          => null,
                'github_url'        => null,
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 3,
                'completed_at'      => '2023-11-10',
            ],
            [
                'title'             => 'Personal Finance Tracker',
                'slug'              => 'personal-finance-tracker',
                'short_description' => 'Aplikasi mobile-first untuk mencatat pengeluaran, pemasukan, dan membuat anggaran bulanan.',
                'description'       => '<p>Aplikasi keuangan personal yang membantu pengguna mengelola keuangan sehari-hari.</p>',
                'category'          => 'Web Application',
                'technologies'      => 'Laravel, Vue.js, Chart.js, SQLite',
                'demo_url'          => 'https://fintrack.example.com',
                'github_url'        => 'https://github.com/namaanda/fintrack',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 4,
                'completed_at'      => '2023-08-05',
            ],
            [
                'title'             => 'Company Profile - PT Sejahtera',
                'slug'              => 'company-profile-sejahtera',
                'short_description' => 'Website company profile modern dengan CMS sederhana untuk klien konstruksi.',
                'description'       => '<p>Website company profile responsif dengan panel admin untuk mengelola konten secara mandiri.</p>',
                'category'          => 'Website',
                'technologies'      => 'Laravel, Blade, Bootstrap 5, MySQL',
                'demo_url'          => 'https://pt-sejahtera.example.com',
                'github_url'        => null,
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 5,
                'completed_at'      => '2023-04-12',
            ],
            [
                'title'             => 'REST API - E-Commerce',
                'slug'              => 'rest-api-ecommerce',
                'short_description' => 'RESTful API lengkap untuk platform e-commerce dengan dokumentasi Swagger.',
                'description'       => '<p>API backend lengkap dengan fitur autentikasi JWT, manajemen produk, cart, order, dan integrasi payment gateway.</p>',
                'category'          => 'API',
                'technologies'      => 'Laravel, JWT, Midtrans, Swagger',
                'demo_url'          => null,
                'github_url'        => 'https://github.com/namaanda/ecommerce-api',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 6,
                'completed_at'      => '2022-09-30',
            ],
        ];
        foreach ($portfolios as $item) {
            Portfolio::create($item);
        }

        // Certificates
        $certs = [
            [
                'title'          => 'Laravel Certified Developer',
                'issuer'         => 'Laravel',
                'issued_date'    => '2023-05-15',
                'expiry_date'    => null,
                'credential_id'  => 'LCD-2023-XXXXX',
                'credential_url' => 'https://laravel.com/certification',
                'sort_order'     => 1,
            ],
            [
                'title'          => 'AWS Certified Solutions Architect – Associate',
                'issuer'         => 'Amazon Web Services',
                'issued_date'    => '2022-11-20',
                'expiry_date'    => '2025-11-20',
                'credential_id'  => 'AWS-SAA-XXXXX',
                'credential_url' => 'https://aws.amazon.com/verification',
                'sort_order'     => 2,
            ],
            [
                'title'          => 'Google IT Support Professional Certificate',
                'issuer'         => 'Google / Coursera',
                'issued_date'    => '2022-03-10',
                'expiry_date'    => null,
                'credential_id'  => 'GITS-XXXXX',
                'credential_url' => 'https://coursera.org/verify/XXXXX',
                'sort_order'     => 3,
            ],
            [
                'title'          => 'JavaScript Algorithms and Data Structures',
                'issuer'         => 'freeCodeCamp',
                'issued_date'    => '2021-08-05',
                'expiry_date'    => null,
                'credential_id'  => 'FCC-JSADS-XXXXX',
                'credential_url' => 'https://freecodecamp.org/certification',
                'sort_order'     => 4,
            ],
        ];
        foreach ($certs as $cert) {
            Certificate::create($cert);
        }
    }
}
