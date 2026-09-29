@extends('layouts.app')

@section('title', 'Alur Proses - JASA KAYA')

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-5 fw-bold mb-4">Alur Proses Kemitraan</h1>
            <p class="lead">Langkah demi langkah menuju kemitraan kehutanan yang berkelanjutan</p>
        </div>
    </div>
</section>

<!-- Process Steps -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @foreach($processSteps as $index => $step)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm position-relative">
                    <!-- Step Number -->
                    <div class="position-absolute top-0 start-50 translate-middle">
                        <div class="bg-{{ $step['color'] }} text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <span class="fw-bold fs-4">{{ $step['step'] }}</span>
                        </div>
                    </div>
                    
                    <div class="card-body text-center pt-5">
                        <i class="{{ $step['icon'] }} fa-3x text-{{ $step['color'] }} mb-3"></i>
                        <h5 class="fw-bold">{{ $step['title'] }}</h5>
                        <p class="text-muted">{{ $step['description'] }}</p>
                    </div>
                    
                    @if($index < count($processSteps) - 1)
                    <div class="position-absolute top-50 start-100 translate-middle d-none d-lg-block">
                        <i class="fas fa-arrow-right fa-2x text-muted"></i>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Process -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Detail Proses untuk Setiap Peran</h2>
            <p class="lead text-muted">Pahami peran dan tanggung jawab masing-masing pihak</p>
        </div>
        
        <div class="row">
            <!-- KTHR Process -->
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card border-success h-100">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-users me-2"></i>Proses untuk KTHR/Penyuluh
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Pendaftaran</h6>
                                    <p class="small text-muted mb-1">Upload KTP Ketua dan SK Register KTHR</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Menunggu Verifikasi CDK</h6>
                                    <p class="small text-muted mb-1">CDK akan memverifikasi dokumen dalam 1-3 hari</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Lengkapi Profil</h6>
                                    <p class="small text-muted mb-1">Isi data lengkap KTHR dan jenis tanaman</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Terima Permintaan</h6>
                                    <p class="small text-muted mb-1">Evaluasi dan respon permintaan dari industri</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Tanda Tangan Kontrak</h6>
                                    <p class="small text-muted mb-1">Setelah pertemuan dan negosiasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- PBPHH Process -->
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card border-primary h-100">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-industry me-2"></i>Proses untuk PBPHH/Industri
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Pendaftaran</h6>
                                    <p class="small text-muted mb-1">Upload NIB dan SK PBPHH</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Menunggu Verifikasi Dinas</h6>
                                    <p class="small text-muted mb-1">Dinas Provinsi verifikasi dalam 3-5 hari</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Lengkapi Profil</h6>
                                    <p class="small text-muted mb-1">Isi data perusahaan dan kebutuhan bahan baku</p>
                                </div>
                            </div>
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Cari & Ajukan Kemitraan</h6>
                                    <p class="small text-muted mb-1">Eksplorasi KTHR dan ajukan permintaan</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">Tanda Tangan Kontrak</h6>
                                    <p class="small text-muted mb-1">Setelah pertemuan dan negosiasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Requirements -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Persyaratan Pendaftaran</h2>
            <p class="lead text-muted">Dokumen yang diperlukan untuk bergabung</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card border-success">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-success">
                            <i class="fas fa-users me-2"></i>KTHR/Penyuluh
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>KTP Ketua KTHR</strong>
                                    <div class="small text-muted">Format: PDF, JPG, PNG (Max: 2MB)</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>SK Pendaftaran KTHR</strong>
                                    <div class="small text-muted">Format: PDF (Max: 2MB)</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>Email Aktif</strong>
                                    <div class="small text-muted">Untuk komunikasi dan notifikasi</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card border-primary">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-industry me-2"></i>PBPHH/Industri
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>NIB (Nomor Induk Berusaha)</strong>
                                    <div class="small text-muted">Format: PDF, JPG, PNG (Max: 2MB)</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>SK PBPHH</strong>
                                    <div class="small text-muted">Format: PDF (Max: 2MB)</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Email Perusahaan</strong>
                                    <div class="small text-muted">Untuk komunikasi resmi</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Pertanyaan Umum</h2>
            <p class="lead text-muted">Jawaban untuk pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama proses verifikasi?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Proses verifikasi untuk KTHR memakan waktu 1-3 hari kerja oleh CDK, sedangkan untuk industri PBPHH memakan waktu 3-5 hari kerja oleh Dinas Provinsi.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah ada biaya untuk menggunakan platform ini?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Platform JASA KAYA sepenuhnya gratis untuk digunakan. Tidak ada biaya pendaftaran, verifikasi, atau penggunaan fitur-fitur yang tersedia.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Bagaimana jika dokumen saya ditolak?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Jika dokumen ditolak, Anda akan menerima notifikasi dengan alasan penolakan yang jelas. Anda dapat memperbaiki dokumen dan mendaftar ulang.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Siap Memulai Proses Kemitraan?</h2>
        <p class="lead mb-4">Bergabunglah dengan ribuan KTHR dan industri yang telah merasakan manfaat kemitraan berkelanjutan</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">
            <i class="fas fa-rocket me-2"></i>Mulai Pendaftaran
        </a>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50
        });
    });
</script>
<style>
.timeline {
    position: relative;
}

.timeline-item {
    position: relative;
    padding-left: 30px;
    transition: all 0.3s ease;
}

.timeline-item:hover {
    transform: translateX(10px);
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 7px;
    top: 20px;
    bottom: -15px;
    width: 2px;
    background: linear-gradient(to bottom, #198652, #198652);
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 5px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.timeline-item:hover .timeline-marker {
    transform: scale(1.2);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #198652, #198652);
    position: relative;
    overflow: hidden;
}

.bg-gradient-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>') repeat;
    animation: patternMove 30s linear infinite;
}

@keyframes patternMove {
    from { background-position: 0 0; }
    to { background-position: 100% 100%; }
}

.card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.card-header {
    border-bottom: none;
    background: transparent;
    position: relative;
    overflow: hidden;
}

.card-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(to right, #198652, #198652);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.card:hover .card-header::after {
    transform: scaleX(1);
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #19865220, #19865220);
    color: #198652;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(76, 187, 125, 0.25);
}

.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endpush
@endsection
