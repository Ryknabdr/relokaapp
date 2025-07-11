<x-layout>
<x-slot:title>{{$title}}</x-slot>

<div class="container mt-4">
    <h3>Keranjang Belanja</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($cart && $cart->items->count() > 0)
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart->items as $item)
                        @php
                            $itemTotal = ($item->itemable->price ?? 0) * $item->quantity;
                            $total += $itemTotal;
                        @endphp
                        <tr>
                            <td>
                                @if(isset($item->itemable->image))
                                    <img src="{{ asset('storage/' . $item->itemable->image) }}" alt="{{ $item->itemable->name }}" style="width: 60px; height: 60px; object-fit: cover; margin-right: 10px;">
                                @endif
                                {{ $item->itemable->name ?? 'Produk tidak ditemukan' }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('cart.update', $item->itemable->id) }}" method="POST" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                    </form>
                                    <span>{{ $item->quantity }}</span>
                                    <form action="{{ route('cart.update', $item->itemable->id) }}" method="POST" class="ms-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->itemable->price ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->itemable->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total</td>
                        <td colspan="2" class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-end">
                <form action="{{ route('checkout.index') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Lanjut ke Checkout</button>
                </form>
            </div>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif
</div>

</x-layout>
