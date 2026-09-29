@extends('layouts.kthr')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kthr-dashboard.css') }}">
@endpush

@section('title', 'Kemitraan - JASA KAYA')

@section('dashboard-content')
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-primary mb-1">Manajemen Kemitraan</h2>
        <p class="text-muted mb-0">Kelola kemitraan yang telah disetujui dan kesepakatan</p>
    </div>
    <div>
        <span class="badge bg-light text-dark">
            <i class="fas fa-handshake me-1"></i>
            {{ $partnerships->total() }} Total Kemitraan
        </span>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($partnerships->count() > 0)
            <div class="row">
                @foreach($partnerships as $partnership)
                    <div class="col-lg-6 mb-4">
                        <div class="partnership-card">
                            <div class="partnership-status">
                                @if($partnership->status == 'active')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                                @elseif($partnership->status == 'completed')
                                    <span class="badge bg-primary"><i class="fas fa-flag-checkered me-1"></i>Selesai</span>
                                @else
                                    <span class="badge bg-warning"><i class="fas fa-clock me-1"></i>{{ ucfirst($partnership->status) }}</span>
                                @endif
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $partnership->pbphhProfile->company_name }}</h5>
                                    <p class="text-muted mb-0">{{ $partnership->pbphhProfile->user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tree text-success me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Jenis Kayu</small>
                                            <span class="fw-semibold">{{ $partnership->wood_type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-cube text-info me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Volume Bulanan</small>
                                            <span class="fw-semibold">{{ number_format($partnership->monthly_volume_m3, 2) }} m³</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($partnership->pertemuan)
                                <div class="meeting-info">
                                    <h6 class="fw-bold mb-2">
                                        <i class="fas fa-calendar-check me-2"></i>Informasi Pertemuan
                                    </h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="text-center">
                                                <i class="fas fa-calendar text-primary mb-1"></i>
                                                <small class="text-muted d-block">Tanggal</small>
                                                <span class="small fw-semibold">{{ ($partnership->pertemuan->scheduled_time && is_object($partnership->pertemuan->scheduled_time)) ? $partnership->pertemuan->scheduled_time->format('d M Y') : '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-center">
                                                <i class="fas fa-clock text-warning mb-1"></i>
                                                <small class="text-muted d-block">Waktu</small>
                                                <span class="small fw-semibold">{{ ($partnership->pertemuan->scheduled_time && is_object($partnership->pertemuan->scheduled_time)) ? $partnership->pertemuan->scheduled_time->format('H:i') : '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-center">
                                                @if($partnership->pertemuan->method === 'online')
                                                    <i class="fas fa-video text-primary mb-1"></i>
                                                    <small class="text-muted d-block">Online</small>
                                                @else
                                                    <i class="fas fa-map-marker-alt text-success mb-1"></i>
                                                    <small class="text-muted d-block">Lapangan</small>
                                                @endif
                                                <span class="small fw-semibold">{{ $partnership->pertemuan->location }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @if($partnership->pertemuan->kesepakatan)
                                <div class="agreement-details">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-handshake me-2"></i>Detail Kesepakatan
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Harga Disepakati</small>
                                                    <span class="fw-bold text-success">Rp {{ number_format($partnership->pertemuan->kesepakatan->agreed_price_per_m3, 0, ',', '.') }}/m³</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-credit-card text-info me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Pembayaran</small>
                                                    <span class="fw-semibold">{{ $partnership->pertemuan->kesepakatan->payment_mechanism }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-truck text-warning me-2"></i>
                                                <div>
                                                    <small class="text-muted d-block">Jadwal Pengiriman</small>
                                                    <span class="fw-semibold">{{ $partnership->pertemuan->kesepakatan->delivery_schedule }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($partnership->pertemuan->kesepakatan->other_notes)
                                        <div class="mt-2 p-2 bg-light rounded">
                                            <small class="text-muted d-block mb-1">Catatan Tambahan:</small>
                                            <span class="small">{{ $partnership->pertemuan->kesepakatan->other_notes }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mt-3 pt-3 border-top">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-signature me-2"></i>Status Penandatanganan
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="signature-status {{ $partnership->pertemuan->kesepakatan->signed_by_kthr_at ? 'signed' : 'pending' }}">
                                                @if($partnership->pertemuan->kesepakatan->signed_by_kthr_at)
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>KTHR: Ditandatangani</span>
                                                @else
                                                    <i class="fas fa-clock"></i>
                                                    <span>KTHR: Menunggu</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="signature-status {{ $partnership->pertemuan->kesepakatan->signed_by_pbphh_at ? 'signed' : 'pending' }}">
                                                @if($partnership->pertemuan->kesepakatan->signed_by_pbphh_at)
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>PBPHH: Ditandatangani</span>
                                                @else
                                                    <i class="fas fa-clock"></i>
                                                    <span>PBPHH: Menunggu</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(!$partnership->pertemuan->kesepakatan->signed_by_kthr_at)
                                        <div class="text-center mt-3">
                                            <button class="btn btn-primary" onclick="signAgreement('{{ $partnership->request_id }}')">
                                                <i class="fas fa-signature me-2"></i>Tanda Tangan Digital
                                            </button>
                                        </div>
                                    @elseif($partnership->pertemuan->kesepakatan->signed_by_kthr_at && $partnership->pertemuan->kesepakatan->signed_by_pbphh_at)
                                        <div class="alert alert-success mb-0 mt-3">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <strong>Kesepakatan Lengkap!</strong><br>
                                            <small>Ditandatangani pada {{ ($partnership->pertemuan->kesepakatan->signed_by_kthr_at && is_object($partnership->pertemuan->kesepakatan->signed_by_kthr_at)) ? $partnership->pertemuan->kesepakatan->signed_by_kthr_at->format('d M Y, H:i') : '-' }}</small>
                                        </div>
                                    @else
                                        <div class="alert alert-info mb-0 mt-3">
                                            <i class="fas fa-clock me-2"></i>
                                            <strong>Menunggu Tanda Tangan PBPHH</strong><br>
                                            <small>Anda telah menandatangani pada {{ ($partnership->pertemuan->kesepakatan->signed_by_kthr_at && is_object($partnership->pertemuan->kesepakatan->signed_by_kthr_at)) ? $partnership->pertemuan->kesepakatan->signed_by_kthr_at->format('d M Y, H:i') : '-' }}</small>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $partnerships->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-handshake fa-4x"></i>
                <h5>Belum Ada Kemitraan</h5>
                <p>Kemitraan yang telah disetujui akan muncul di sini</p>
                <div class="mt-3">
                    <a href="{{ route('kthr.requests') }}" class="btn btn-primary">
                        <i class="fas fa-inbox me-2"></i>Lihat Permintaan Masuk
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function signAgreement(requestId) {
    if (confirm('Apakah Anda yakin ingin menandatangani kesepakatan ini? Tindakan ini tidak dapat dibatalkan.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/kthr/partnerships/' + requestId + '/sign';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
@endsection
