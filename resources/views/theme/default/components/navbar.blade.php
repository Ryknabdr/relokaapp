<div>
<style>
    /* Ringankan warna hover tombol user dropdown */
    #userDropdown.btn-outline-dark:hover {
        background-color: #e0e0e0;
        color: #000;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm py-3 fixed-top" style="font-family: 'Playfair Display', serif;">
    <div class="container">
        <a class="navbar-brand text-dark fw-bold d-flex align-items-center" href="/">
            <img src="{{ asset('theme/hexashop/assets/images/logo reloka.jpg') }}" alt="Reloka Logo" width="32" height="32" class="me-2">
            <span style="letter-spacing: 1px;">RELOKA</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/categories">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/products">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/contact">Contact</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <x-cart-icon />

                @if(auth()->guard('customer')->check())
                    <div class="dropdown">
                        <a class="btn btn-outline-dark rounded-pill px-3 py-1" href="#" role="button"
                           id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-dark rounded-pill px-3 py-1" href="{{ route('customer.login') }}">Login</a>
                    <a class="btn btn-dark rounded-pill px-3 py-1 text-white" href="{{ route('customer.register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
</div>
