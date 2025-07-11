<x-layout>
    <x-slot name="title"> Homepage</x-slot>

    @if(!isset($categories))
        @php $categories = collect(); @endphp
    @endif

    {{-- Kategori Produk --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="font-family:'Playfair Display', serif; font-size: 1.5rem;">Kategori Produk</h3>
            <a href="{{ URL::to('/categories') }}" class="btn btn-outline-dark btn-sm" style="border-color:#6f4e37; color:#6f4e37;">Lihat Semua</a>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach($categories as $category)
                <div class="col">
                    <a href="{{ URL::to('/category/'.$category->slug) }}" class="card text-decoration-none h-100 border-0 shadow-sm category-card">
                        <div class="card-body text-center">
                            <div class="mb-2 mx-auto" style="width:70px;height:70px;background:#f8f9fa;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width:36px;height:36px;object-fit:contain;">
                            </div>
                            <h6 class="text-dark fw-semibold">{{ $category->name }}</h6>
                            <p class="text-muted small text-truncate">{{ $category->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Produk --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="font-family:'Playfair Display', serif; font-size: 1.5rem;">Produk Kami</h3>
            <a href="{{ URL::to('/products') }}" class="btn btn-outline-dark btn-sm" style="border-color:#6f4e37; color:#6f4e37;">Lihat Semua</a>
        </div>
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100 shadow-sm border-0">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/350x200?text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-family:'Playfair Display', serif;">{{ $product->name }}</h5>
                            <p class="card-text text-muted small text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-outline-dark" style="border-color:#6f4e37; color:#6f4e37;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
                </div>
            @endforelse

            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Tambahan Gaya --}}
    <style>
        .category-card:hover, .product-card:hover {
            transform: scale(1.02);
            transition: 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-outline-dark:hover {
            background-color: #6f4e37 !important;
            color: white !important;
            border-color: #6f4e37 !important;
        }

        .card-title {
            font-size: 1rem;
        }

        .card-text {
            font-size: 0.85rem;
        }
    </style>
</x-layout>
