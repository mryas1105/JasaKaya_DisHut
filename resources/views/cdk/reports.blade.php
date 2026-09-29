@extends('layouts.cdk')

@section('title', 'Laporan - CDK Dashboard')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-file-alt me-2"></i>Laporan Operasional
        <small class="text-muted">{{ $region->name }}</small>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-1"></i>Cetak Laporan
        </button>
    </div>
</div>

<!-- Date Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('cdk.reports') }}" class="row g-3">
            <div class="col-md-4">
                <label for="date_from" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="date_from" name="date_from" value="{{ $dateFrom }}">
            </div>
            <div class="col-md-4">
                <label for="date_to" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="date_to" name="date_to" value="{{ $dateTo }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Generate Laporan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Report Header -->
<div class="card mb-4">
    <div class="card-body text-center">
        <h4>Laporan Operasional CDK {{ $region->name }}</h4>
        <p class="text-muted">Periode: {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}</p>
        <small class="text-muted">Digenerate pada: {{ now()->format('d/m/Y H:i:s') }}</small>
    </div>
</div>

<!-- Approval Report -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-user-check me-2"></i>Laporan Approval
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-success">{{ $approvalReport['kthr_approved'] }}</h3>
                        <small>KTHR Disetujui</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-info">{{ $approvalReport['pbphh_approved'] }}</h3>
                        <small>PBPHH Disetujui</small>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h4 class="text-danger">{{ $approvalReport['total_rejected'] }}</h4>
                    <small>Total Ditolak</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Meeting Report -->
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Laporan Pertemuan
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-warning">{{ $meetingReport['meetings_scheduled'] }}</h3>
                        <small>Dijadwalkan</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-success">{{ $meetingReport['meetings_completed'] }}</h3>
                        <small>Selesai</small>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h4 class="text-primary">{{ $meetingReport['agreements_created'] }}</h4>
                    <small>Kesepakatan Dibuat</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Effectiveness -->
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-handshake me-2"></i>Efektivitas
                </h6>
            </div>
            <div class="card-body">
                @php
                    $totalApprovals = $approvalReport['kthr_approved'] + $approvalReport['pbphh_approved'];
                    $totalRejected = $approvalReport['total_rejected'];
                    $approvalRate = $totalApprovals + $totalRejected > 0 
                        ? round(($totalApprovals / ($totalApprovals + $totalRejected)) * 100) 
                        : 0;

                    $meetingEffectiveness = $meetingReport['meetings_scheduled'] > 0 
                        ? round(($meetingReport['meetings_completed'] / $meetingReport['meetings_scheduled']) * 100) 
                        : 0;
                @endphp
                <div class="text-center mb-3">
                    <h3 class="text-success">{{ $approvalRate }}%</h3>
                    <small>Tingkat Approval</small>
                </div>
                <div class="text-center">
                    <h3 class="text-info">{{ $meetingEffectiveness }}%</h3>
                    <small>Efektivitas Pertemuan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partnership Status Report -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-chart-pie me-2"></i>Status Kemitraan
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            @php
                $statusLabels = [
                    'Terkirim' => ['icon' => 'fa-paper-plane', 'color' => 'warning'],
                    'Ditolak' => ['icon' => 'fa-times-circle', 'color' => 'danger'],
                    'Disetujui' => ['icon' => 'fa-check-circle', 'color' => 'success'],
                    'Dijadwalkan' => ['icon' => 'fa-calendar-check', 'color' => 'primary'],
                    'Selesai' => ['icon' => 'fa-handshake', 'color' => 'dark'],
                    'Dibatalkan' => ['icon' => 'fa-ban', 'color' => 'secondary']
                ];
            @endphp

            @foreach($statusLabels as $status => $config)
                <div class="col-md-2 col-sm-4 mb-3">
                    <div class="text-center">
                        <div class="mb-2">
                            <i class="fas {{ $config['icon'] }} fa-2x text-{{ $config['color'] }}"></i>
                        </div>
                        <h4 class="text-{{ $config['color'] }}">
                            {{ $partnershipReport[$status] ?? 0 }}
                        </h4>
                        <small class="text-muted">{{ $status }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Performance Summary -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-chart-line me-2"></i>Ringkasan Kinerja
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Pencapaian Periode Ini:</h6>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        KTHR Disetujui
                        <span class="badge bg-success">{{ $approvalReport['kthr_approved'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        PBPHH Disetujui
                        <span class="badge bg-info">{{ $approvalReport['pbphh_approved'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pertemuan Selesai
                        <span class="badge bg-success">{{ $meetingReport['meetings_completed'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kesepakatan Dibuat
                        <span class="badge bg-primary">{{ $meetingReport['agreements_created'] }}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6>Statistik Efektivitas:</h6>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tingkat Approval
                        <span class="badge bg-success">{{ $approvalRate }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Efektivitas Pertemuan
                        <span class="badge bg-info">{{ $meetingEffectiveness }}%</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
