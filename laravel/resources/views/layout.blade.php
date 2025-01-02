<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarı Taksi - Güvenilir ve Hızlı Ulaşım</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    @yield('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        header {
            background-color: #FFD700;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }
        nav a {
            color: #333;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s;
            font-weight: 600;
        }
        nav a:hover {
            color: #1abc9c;
        }
        .hero {
            background-image: linear-gradient(rgba(167, 142, 0, 0.7), rgba(199, 169, 0, 0.7)), url();
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 120px 0;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1abc9c;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            transition: transform 0.3s, background-color 0.3s;
            font-weight: bold;
        }
        .btn:hover {
            transform: scale(1.1);
            background-color: #16a085;
        }
        .features {
            padding: 60px 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        .features h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        .feature {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .feature:hover {
            transform: translateY(-10px);
        }
        .feature h3 {
            margin-bottom: 15px;
            color: #1abc9c;
        }
        footer {
            background-color: #FFD700;
            color: #333;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        footer p {
            margin: 0;
            font-size: 14px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert-success {
            color:rgb(28, 114, 31);
            background-color:rgb(220, 248, 215);
            border: 1px solid rgb(220, 248, 215);
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            font-size: 14px;
        }

        .user-menu-btn {
            color: #333;
            transition: color 0.3s;
        }
        .user-menu-btn:hover {
            color: #1abc9c;
        }
        .user-dropdown button:hover {
            background-color: #f5f5f5;
        }
        .user-menu-btn svg {
            transition: transform 0.3s;
        }
        .user-menu:hover .user-menu-btn svg {
            transform: scale(1.1);
        }

    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Sarı Taksi</div>
            
            <nav>
                <a href="/" class="nav active">Anasayfa</a>
                <a href="/services" class="nav">Hizmetler</a>
                <a href="/drivers" class="nav">Şoförler</a>
                <a href="/contact" class="nav">İletişim</a>
                @guest
                    <a href="/login" class="nav">Giriş</a>
                @else
                <div class="user-menu" style="position: relative; display: inline-block;">
                    <button onclick="toggleUserMenu()" class="user-menu-btn" style="background: none; border: none; cursor: pointer; padding: 8px 15px; display: flex; align-items: center; gap: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <div id="userDropdown" class="user-dropdown" style="display: none; position: absolute; right: 0; background-color: white; box-shadow: 0 8px 16px rgba(0,0,0,0.1); border-radius: 4px; min-width: 160px; z-index: 1000;">
                        

                        <form action="{{ route('call') }}" method="GET" style="padding: 8px;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 8px 16px; background: none; border: none; cursor: pointer; text-align: left; color: #333;">
                                Taksi Çağır
                            </button>
                        </form>

                        <form action="{{ route('ridehistory') }}" method="GET" style="padding: 8px;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 8px 16px; background: none; border: none; cursor: pointer; text-align: left; color: #333;">
                                Yolculuklarım
                            </button>
                        </form>

                        @if(Auth::user()->canDrive == 0)
                            <form action="{{ route('driverForm') }}" method="GET" style="padding: 8px;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 8px 16px; background: none; border: none; cursor: pointer; text-align: left; color: #333;">
                                Şoför Ol
                            </button>
                        </form>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" style="padding: 8px;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 8px 16px; background: none; border: none; cursor: pointer; text-align: left; color: #333;">
                                Çıkış Yap
                            </button>
                        </form>
                    </div>
                </div>

                @endguest
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif
        <section class="hero">
            @yield('hero')
        </section>

        <section class="features container">
            @yield('features')
        </section>
    </main>

    <footer>
        <div class="container">
            &copy; 2024 Sarı Taksi - Tüm Hakları Saklıdır
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

    <script>
    
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user-menu-btn') && !event.target.parentNode.matches('.user-menu-btn')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
