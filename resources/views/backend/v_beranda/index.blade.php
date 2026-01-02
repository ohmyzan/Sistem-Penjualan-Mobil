@extends('backend.v_layouts.app')
@section('content')

<style>
.dashboard-banner{
    background:linear-gradient(120deg,#001437,#0a2b6d,#7898FB);
    color:#fff;
    padding:30px;
    border-radius:18px;
    margin-bottom:25px;
}
.info-box{
    background:#fff;
    padding:18px;
    border-radius:15px;
    border-left:6px solid #7898FB;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}
.info-title{font-weight:600;color:#001437}
.info-number{font-size:22px;font-weight:bold;color:#001437}
</style>

<h3 class="fw-bold mb-3">{{ $judul }}</h3>

<div class="dashboard-banner">
    <h2>Dashboard Penjualan Mobil</h2>
    <span>Monitoring Data Penjualan</span>
    <!-- Welcome card (punyamu tetap) -->
<div class="welcome-card">
    <p class="m-0" style="font-size: 15.5px;">
        Selamat Datang, <b>{{ Auth::user()->nama }}</b> pada aplikasi Penjualan Mobil dengan hak 
        akses sebagai 
        <b>
            @if (Auth::user()->role == 1)
                Super Admin
            @elseif(Auth::user()->role == 0)
                Admin
            @else
                User
            @endif
        </b>
        . Ini adalah halaman utama dari aplikasi ini.
    </p>
</div>
</div>

<!-- INFO BOX -->
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="info-box">
            <div class="info-title">Total Mobil</div>
            <div class="info-number">38</div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="info-box">
            <div class="info-title">Total Merk</div>
            <div class="info-number">7</div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="info-box">
            <div class="info-title">Total User</div>
            <div class="info-number">12</div>
        </div>
    </div>
</div>

<!-- GRAFIK BATANG -->
<div class="mt-5">
    <h4 class="fw-bold mb-3">Grafik Penjualan Mobil (Bulanan)</h4>
    <div class="card p-4 shadow-sm rounded-4">
        <canvas id="grafikBatang" height="120"></canvas>
    </div>
</div>

<!-- DIAGRAM LINGKARAN -->
<div class="mt-5">
    <h4 class="fw-bold mb-3">Diagram Lingkaran Merk Terbanyak</h4>
    <div class="card p-4 shadow-sm rounded-4">
        <canvas id="grafikLingkaran" height="120"></canvas>
    </div>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ================= BAR CHART ================= */
    new Chart(document.getElementById('grafikBatang'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [{
                label: 'Mobil Terjual',
                data: [120, 180, 150, 230, 200, 260], // 🔥 ANGKA BESAR
                backgroundColor: '#7898FB',
                borderRadius: 10
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#001437',
                    font: { weight: 'bold' }
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        },
        plugins: [ChartDataLabels]
    });

    /* ================= PIE CHART ================= */
    new Chart(document.getElementById('grafikLingkaran'), {
        type: 'pie',
        data: {
            labels: [
                'Toyota','Honda','Mitsubishi',
                'BMW','Mercedes','Tesla','Porsche'
            ],
            datasets: [{
                data: [320, 280, 210, 180, 160, 120, 90],
                backgroundColor: [
                    '#001437','#7898FB','#ff9f40',
                    '#0a2b6d','#e63946','#4dabf7','#faa307'
                ]
            }]
        },
        options: {
            plugins: {
                legend: { position: 'right' },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold' }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

});
</script>

@endsection