<x-layout>
    <x-slot name="title">Categories</x-slot>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title">Kategori Produk</h3>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($categories as $category)
                <div class="col">
                    <a href="{{ URL::to('/category/'.$category->slug) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 border rounded-3 shadow-sm category-card-classic">
                            <div class="text-center pt-3">
                                <div class="d-flex justify-content-center align-items-center rounded-circle border border-3 border-secondary-subtle bg-light" style="width: 80px; height: 80px; margin: auto;">
                                    <img src="{{ $category->image ? Storage::url($category->image) : 'https://via.placeholder.com/100?text=No+Image' }}"
                                         alt="{{ $category->name }}"
                                         style="width: 72px; height: 72px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>
                            <div class="card-body text-center py-2">
                                <h6 class="fw-semibold mb-1" style="font-family: 'Playfair Display', serif;">
                                    {{ $category->name }}
                                </h6>
                                <p class="card-text text-muted small text-truncate px-2">
                                    {{ $category->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center w-100 mt-4">
            {{ $categories->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>

    {{-- Tambahan gaya klasik --}}
    <style>
        .category-card-classic {
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fefefe;
        }

        .category-card-classic:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.08);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            border-bottom: 2px solid #a67c52;
            display: inline-block;
            color: #4b3621;
        }
    </style>
</x-layout>
