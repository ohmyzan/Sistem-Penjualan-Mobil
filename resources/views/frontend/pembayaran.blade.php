@extends('frontend.v_layouts.app')
@section('content')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <style>
        body {
            background-color: #f4f6f9;
        }

        .payment-card {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .payment-header {
            background: linear-gradient(135deg, #001437, #0a2b6d);
            padding: 30px;
        }

        .btn-pay {
            background-color: #EA5555;
            color: white;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-pay:hover {
            background-color: #d14040;
            transform: translateY(-2px);
        }
    </style>

    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-lg-6 col-md-8">

            <div class="card payment-card shadow-lg">
                <div class="payment-header text-center text-white">
                    <i class="bi bi-shield-lock text-warning mb-2" style="font-size: 2.5rem;"></i>
                    <h4 class="fw-bold mb-0">Selesaikan Pembayaran</h4>
                    <small class="opacity-75">Sistem pembayaran aman oleh Midtrans</small>
                </div>

                <div class="card-body p-5 text-center">
                    <h6 class="text-muted text-uppercase fw-bold mb-1">Kode Booking</h6>
                    <h5 class="fw-bold text-dark mb-4">{{ $transaksi->kode_booking }}</h5>

                    <div class="p-4 mb-4"
                        style="background-color: #f8f9fa; border-radius: 15px; border: 1px dashed #ced4da;">
                        <span class="text-muted d-block mb-1">Total Tagihan (Booking Fee)</span>
                        <h2 class="fw-bold mb-0" style="color: #001437;">Rp 5.000.000</h2>
                    </div>

                    <p class="small text-muted mb-4">
                        Silakan klik tombol di bawah ini untuk memilih metode pembayaran (Transfer Bank, QRIS, GoPay, dll).
                    </p>

                    <button id="pay-button"
                        class="btn btn-pay w-100 py-3 shadow-sm d-flex justify-content-center align-items-center">
                        <i class="bi bi-wallet2 me-2"></i> Bayar Sekarang
                    </button>

                    <div class="mt-3">
                        <a href="{{ route('booking.cancel', $transaksi->kode_booking) }}"
                            class="small text-muted text-decoration-none"
                            onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            Batal dan kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        // Menangkap klik pada tombol bayar
        document.getElementById('pay-button').onclick = function() {
            // Memanggil fungsi pay dari Midtrans menggunakan snapToken dari Controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* Jika pembayaran berhasil (misal: sukses scan QRIS) */
                    window.location.href = "{{ route('pesanan.saya') }}";
                },
                onPending: function(result) {
                    /* Jika pembayaran tertunda (misal: pilih transfer VA tapi belum bayar di ATM) */
                    window.location.href = "{{ route('pesanan.saya') }}";
                },
                onError: function(result) {
                    /* Jika terjadi kesalahan */
                    alert("Pembayaran gagal! Silakan coba lagi.");
                    console.log(result);
                },
                onClose: function() {
                    if (confirm('Anda menutup jendela pembayaran. Batalkan pesanan ini?')) {
                        window.location.href = "{{ route('booking.cancel', $transaksi->kode_booking) }}";
                    }
                }
            });
        };
    </script>
@endsection
