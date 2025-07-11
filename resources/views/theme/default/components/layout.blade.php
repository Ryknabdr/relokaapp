<!doctype html>
<html lang="id">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title ?? 'Toko Antik Kiwil' }}</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   {{-- Font klasik elegan --}}
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Lora&display=swap" rel="stylesheet">

   <style>
      html, body {
         height: 100%;
         margin: 0;
      }
      body {
         font-family: 'Lora', serif;
         background-color: #f5f3eb;
         color: #3c2f2f;
         padding-top: 70px; /* height of fixed navbar */
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         padding-bottom: 0;
      }

      h1, h2, h3, .navbar-brand {
         font-family: 'Playfair Display', serif;
         color: #4b3621;
      }

      .navbar {
         background-color: #ede0d4;
         border-bottom: 1px solid #d6ccc2;
      }

      .navbar a {
         color: #4b3621 !important;
         font-weight: 500;
      }

      .navbar a:hover {
         text-decoration: underline;
      }

      footer {
         background-color: #4b3621;
         color: #f5f3eb;
         position: static;
         width: 100%;
      }

      footer a {
         color: #f5f3eb;
         text-decoration: none;
      }

      footer a:hover {
         text-decoration: underline;
      }

      .card {
         border: 1px solid #d6ccc2;
         border-radius: 12px;
         transition: transform 0.3s ease;
      }

      .card:hover {
         transform: scale(1.02);
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .btn-primary {
         background-color: #a67c52;
         border-color: #a67c52;
      }

      .btn-primary:hover {
         background-color: #8b5e3c;
         border-color: #8b5e3c;
      }

      .section-title {
         font-family: 'Playfair Display', serif;
         font-size: 2rem;
         margin-bottom: 1rem;
         border-bottom: 2px solid #a67c52;
         display: inline-block;
      }
      main.container.my-5 {
         flex: 1 0 auto;
      }
      footer {
         background-color: #4b3621;
-         position: relative;
-         width: 100%;
-         flex-shrink: 0;
+         position: static;
+         width: 100%;
+         flex-shrink: 0;
      }
   </style>
   {{ $style ?? '' }}
</head>
<body>

   {{-- Navbar --}}
   <x-navbar themeFolder="{{ $themeFolder }}"></x-navbar>

   {{-- Konten --}}
   <main class="container my-5">
      {{ $slot }}
   </main>

   {{-- Footer --}}
   <footer class="pt-4 pb-3 mt-5">
      <div class="container">
         <div class="row">
            <div class="col-md-6 mb-3">
               <h5 class="fw-bold">RELOKA</h5>
               <p class="small">Temukan keindahan masa lalu dengan koleksi barang antik pilihan dari seluruh Nusantara.</p>
            </div>
            <div class="col-md-3 mb-3">
               <h6>Navigasi</h6>
               <ul class="list-unstyled small">
                  <li><a href="#">Beranda</a></li>
                  <li><a href="#">Produk</a></li>
                  <li><a href="#">Kategori</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Contact</a></li>
               </ul>
            </div>
            <div class="col-md-3 mb-3">
               <h6>Kontak Kami</h6>
               <ul class="list-unstyled small">
                  <li><i class="bi bi-envelope"></i> info@kiwilantik.com</li>
                  <li><i class="bi bi-telephone"></i> +62 856 6100 994</li>
                  <li><i class="bi bi-geo-alt"></i> Tegal, Indonesia</li>
               </ul>
            </div>
         </div>
         <hr class="border-top border-light">
         <div class="text-center">
            <small>© {{ date('Y') }} Toko Antik Reloka. Hak cipta dilindungi.</small>
         </div>
      </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
