<x-layout>
    <x-slot name="title">Checkout</x-slot>

    <div class="container my-5">
        <div class="row">
            <!-- Detail Penagihan -->
            <div class="col-md-7">
                <h4 class="mb-4 fw-bold" style="font-family: 'Playfair Display', serif;">Detail Penagihan</h4>
                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="anda@contoh.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Jl. Contoh 1234" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Kota" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Provinsi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Kode Pos" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="mb-3 fw-semibold" style="font-family: 'Playfair Display', serif;">Pembayaran</h5>
                    <div class="mb-3">
                        <label for="cardName" class="form-label">Nama di Kartu</label>
                        <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Nama sesuai kartu" required>
                    </div>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Nomor Kartu Kredit</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Nomor kartu" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cardExp" class="form-label">Masa Berlaku</label>
                            <input type="text" class="form-control" id="cardExp" name="cardExp" placeholder="MM/YY" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cardCvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cardCvv" name="cardCvv" placeholder="CVV" required>
                        </div>
                    </div>
                    <button class="btn btn-dark w-100 mt-3" type="submit" style="background-color:#6f4e37; border:none;">Pesan Sekarang</button>
                </form>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card border-0 shadow-sm" style="background-color: #fefefe;">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif;">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $item->itemable->name }}</h6>
                                    <small class="text-muted">{{ $item->itemable->description ?? '' }}</small>
                                </div>
                                <span class="text-muted">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between border-top pt-2">
                                <span>Subtotal</span>
                                <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Ongkir</span>
                                <strong>Rp{{ number_format($shippingCost, 0, ',', '.') }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between border-top pt-2">
                                <span>Total</span>
                                <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                            </li>
                        </ul>
                        <div class="alert alert-warning mt-3 small" role="alert">
                            Gratis ongkir untuk pesanan di atas <strong>Rp50.000</strong>!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahan gaya --}}
    <style>
        input.form-control {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
        }

        label.form-label {
            font-weight: 500;
        }

        .btn-dark:hover {
            background-color: #563826 !important;
        }
    </style>
</x-layout>
