<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Po. Rizky Putra 168 | Booking Bus Pariwisata Online</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_rizky_putra_168.svg') }}">
    <style>
        .navbar-scrolled {
          background-color: #2196F3; /* Change this to your desired blue color */
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-scrolled a {
          color: #ffffff; /* White text color */
        }
        .navbar-scrolled img {
          filter: invert(100%); /* Invert logo color to white */
        }

      </style>
</head>
<body class="flex flex-col h-screen">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full py-4 transition duration-300 bg-transparent">
        <div class="container flex justify-between p-0.5 mx-auto">
          <a href="#" class="text-lg font-bold text-white">
            <img src="{{ asset('images/logo_rizky_putra_168.svg') }}" alt="Po. Rizky Putra 168" class="inline-block w-10 h-12 text-white">
          </a>
          <ul class="flex justify-end">
            <li class="px-2 mr-4"><a href="#" class="text-white hover:text-gray-200">Beranda</a></li>
            <li class="px-2 mr-4"><a href="#" class="text-white hover:text-gray-200">Tentang Kami</a></li>
            <li class="px-2"><a href="#" class="text-white hover:text-gray-200">Hubungi Kami</a></li>
          </ul>
        </div>
      </nav>


    <!-- Hero Section -->
<section class="h-screen bg-center bg-cover hero" style="background-image: url('{{ asset('images/bgimg.jpg') }}'); min-height: 90vh">
  <div class="container flex items-center justify-center h-full p-4 mx-auto">
    <div class="flex flex-col">
      <div class="flex flex-col mb-4">
        <h1 class="text-4xl font-bold text-white">Booking Bus Pariwisata Online yang Mudah dan Aman</h1>
        <p class="text-lg text-white">Dapatkan harga terbaik untuk perjalanan pariwisata Anda dengan Po. Rizky Putra 168</p>
      </div>
      <div class="flex flex-row space-x-4">
        <a href="/admin" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700">Masuk Sekarang</a>
        <button type="button" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700" onclick="location.href='{{ route('chatbot') }}'">Tanya CS</button>
      </div>
    </div>
  </div>
</section>


    <!-- Features Section -->
    <section class="py-12 bg-white">
        <div class="container p-4 mx-auto">
            <h2 class="text-3xl font-bold text-blue-600">Kenapa Memilih Kami?</h2>
            <ul class="flex flex-wrap justify-center">
                <li class="w-1/3 p-4 lg:w-1/4">
                    <i class="text-4xl text-blue-600 fas fa-lock"></i>
                    <h3 class="text-lg font-bold text-blue-600">Aman dan Terpercaya</h3>
                    <p class="text-gray-600">Kami memastikan keselamatan dan keamanan dalam setiap perjalanan pariwisata Anda.</p>
                </li>
                <li class="w-1/3 p-4 lg:w-1/4">
                    <i class="text-4xl text-blue-600 fas fa-clock"></i>
                    <h3 class="text-lg font-bold text-blue-600">Cepat dan Efisien</h3>
                    <p class="text-gray-600">Kami membantu Anda mencari bus pariwisata dengan cepat dan efisien.</p>
                </li>
                <li class="w-1/3 p-4 lg:w-1/4">
                    <i class="text-4xl text-blue-600 fas fa-money-bill-alt"></i>
                    <h3 class="text-lg font-bold text-blue-600">Harga Yang Kompetitif</h3>
                    <p class="text-gray-600">Kami menawarkan harga terbaik untuk perjalanan pariwisata Anda.</p>
                </li>
            </ul>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-12 bg-blue-600">
        <div class="container p-4 mx-auto">
            <h2 class="text-3xl font-bold text-white">Mulai Booking Bus Pariwisata Anda Sekarang!</h2>
            <button class="btn btn-white">Booking Sekarang</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-gray-200">
        <div class="container p-4 mx-auto">
            <p class="text-gray-600">copyright {{ date('Y') }} Po. Rizky Putra 168. All rights reserved.</p>
        </div>
    </footer>


    <script>
        const navbar = document.querySelector('nav');

        window.addEventListener('scroll', () => {
          if (window.scrollY > 200) {
            navbar.classList.add('navbar-scrolled');
          } else {
            navbar.classList.remove('navbar-scrolled');
          }
        });
      </script>
</body>
</html>
