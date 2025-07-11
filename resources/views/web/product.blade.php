<x-layout>
    <x-slot name="title">{{ $product->name }} - Antique Item</x-slot>
    @if(session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="container my-5">
        <div class="row g-5 align-items-start">
            <div class="col-md-6">
                <div class="bg-white shadow rounded p-3">
                    <img src="{{ $product->image_url ? (Str::startsWith($product->image_url, ['http://', 'https://']) ? $product->image_url : Storage::url($product->image_url)) : 'https://via.placeholder.com/500x500' }}"
                        class="img-fluid rounded w-100" alt="{{ $product->name }}">
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary">{{ $product->category->name ?? 'Uncategorized' }}</span>
                    @if($product->year_of_origin)
                        <span class="badge bg-secondary">{{ $product->year_of_origin }}</span>
                    @endif
                    @if($product->condition)
                        <span class="badge bg-info">{{ $product->condition }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="mb-2 fw-bold">{{ $product->name }}</h1>
                <div class="mb-3">
                    <span
                        class="fs-4 text-success fw-semibold">Rp.{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="mb-4">
                    <p class="text-muted">{{ $product->description }}</p>
                </div>
                <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group" style="max-width: 320px;">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" class="form-control" value="1" min="1"
                            max="{{ $product->stock }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-cart-plus me-1"></i> Add to Cart
                        </button>
                    </div>
                </form>

                <!-- Antique Details -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Antique Details</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if($product->year_of_origin)
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Age:</strong>
                                <span>{{ $product->age }} years old ({{ $product->year_of_origin }})</span>
                            </li>
                        @endif
                        @if($product->origin_country)
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Origin:</strong>
                                <span>{{ $product->origin_country }}</span>
                            </li>
                        @endif
                        @if($product->material)
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Material:</strong>
                                <span>{{ $product->material }}</span>
                            </li>
                        @endif
                        @if($product->dimensions_length || $product->dimensions_width || $product->dimensions_height)
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Dimensions:</strong>
                                <span>{{ $product->dimensions }}</span>
                            </li>
                        @endif
                        @if($product->weight)
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Weight:</strong>
                                <span>{{ $product->weight }} kg</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Stock:</strong>
                            <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $product->stock > 0 ? $product->stock : 'Out of Stock' }}
                            </span>
                        </li>
                    </ul>
                </div>

                @if($product->authenticity_info)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Authenticity Information</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $product->authenticity_info }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($product->historical_significance)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">Historical Significance</h4>
                        </div>
                        <div class="card-body">
                            {{ $product->historical_significance }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-5">
            <div class="col-12">
                <h4 class="mb-3">Detailed Description</h4>
                <div class="bg-light p-4 rounded shadow-sm">
                    {!! nl2br(e($product->long_description ?? $product->description)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="container my-5">
        <h3 class="mb-4">Other Antiques You May Like</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $relatedProduct->image_url ? (Str::startsWith($relatedProduct->image_url, ['http://', 'https://']) ? $relatedProduct->image_url : Storage::url($relatedProduct->image_url)) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                            class="card-img-top" alt="{{ $relatedProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            @if($relatedProduct->year_of_origin)
                                <p class="card-text"><small class="text-muted">{{ $relatedProduct->year_of_origin }}</small></p>
                            @endif
                            <p class="card-text text-truncate">{{ $relatedProduct->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">Rp
                                    {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $relatedProduct->slug) }}"
                                    class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($relatedProducts->isEmpty())
                <div class="col">
                    <div class="alert alert-info">No related antiques found.</div>
                </div>
            @endif
        </div>
    </div>
</x-layout>