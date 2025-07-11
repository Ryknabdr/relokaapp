<x-layout>
    <x-slot name="title">Antique Collection</x-slot>

    <div class="container-fluid my-5">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.index') }}" method="GET">
                            <!-- Search -->
                            <div class="mb-3">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search antiques...">
                            </div>

                            <!-- Categories -->
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Era -->
                            <div class="mb-3">
                                <label class="form-label">Era</label>
                                <select name="era" class="form-select">
                                    <option value="">All Eras</option>
                                    <option value="victorian" {{ request('era') == 'victorian' ? 'selected' : '' }}>Victorian (1837-1901)</option>
                                    <option value="edwardian" {{ request('era') == 'edwardian' ? 'selected' : '' }}>Edwardian (1901-1910)</option>
                                    <option value="art_nouveau" {{ request('era') == 'art_nouveau' ? 'selected' : '' }}>Art Nouveau (1890-1910)</option>
                                    <option value="art_deco" {{ request('era') == 'art_deco' ? 'selected' : '' }}>Art Deco (1920-1939)</option>
                                    <option value="mid_century" {{ request('era') == 'mid_century' ? 'selected' : '' }}>Mid-Century (1940-1970)</option>
                                </select>
                            </div>

                            <!-- Custom Year Range -->
                            <div class="mb-3">
                                <label class="form-label">Year Range</label>
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="number" name="year_from" class="form-control" placeholder="From" value="{{ request('year_from') }}" min="1000" max="{{ date('Y') }}">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="year_to" class="form-control" placeholder="To" value="{{ request('year_to') }}" min="1000" max="{{ date('Y') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-3">
                                <label class="form-label">Price Range (Rp)</label>
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="number" name="price_min" class="form-control" placeholder="Min" value="{{ request('price_min') }}" min="0">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="price_max" class="form-control" placeholder="Max" value="{{ request('price_max') }}" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Condition -->
                            <div class="mb-3">
                                <label class="form-label">Condition</label>
                                <select name="condition" class="form-select">
                                    <option value="">All Conditions</option>
                                    <option value="Excellent" {{ request('condition') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                                    <option value="Very Good" {{ request('condition') == 'Very Good' ? 'selected' : '' }}>Very Good</option>
                                    <option value="Good" {{ request('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Fair" {{ request('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                    <option value="Poor" {{ request('condition') == 'Poor' ? 'selected' : '' }}>Poor</option>
                                </select>
                            </div>

                            <!-- Material -->
                            <div class="mb-3">
                                <label class="form-label">Material</label>
                                <input type="text" name="material" class="form-control" value="{{ request('material') }}" placeholder="e.g., wood, silver, porcelain">
                            </div>

                            <!-- Origin -->
                            <div class="mb-3">
                                <label class="form-label">Origin</label>
                                <input type="text" name="origin" class="form-control" value="{{ request('origin') }}" placeholder="Country of origin">
                            </div>

                            <!-- Sort -->
                            <div class="mb-3">
                                <label class="form-label">Sort By</label>
                                <select name="sort" class="form-select">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            @if(request()->hasAny(['search', 'category', 'era', 'year_from', 'year_to', 'price_min', 'price_max', 'condition', 'material', 'origin', 'sort']))
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                @if($products->isEmpty())
                    <div class="alert alert-info">
                        No antiques found matching your criteria.
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($products as $product)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $product->image_url ? Storage::url($product->image_url) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                         class="card-img-top" alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <div class="mb-2">
                                            @if($product->year_of_origin)
                                                <span class="badge bg-secondary">{{ $product->year_of_origin }}</span>
                                            @endif
                                            @if($product->condition)
                                                <span class="badge bg-info">{{ $product->condition }}</span>
                                            @endif
                                        </div>
                                        <p class="card-text text-truncate">{{ $product->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary">View Details</a>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $product->origin_country ?? 'Origin unknown' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>