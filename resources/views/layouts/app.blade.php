<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MTs Mulia Insani</title>

    <link rel="icon" href="{{ asset('images/logo/logo_sekolah.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8F9FA;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* HEADER STYLES */
        .top-header {
            height: 70px;
            background: linear-gradient(135deg, #FFFFFF 0%, #FDFBF7 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            border-bottom: 1px solid #E0D5C7;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(139, 69, 19, 0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .breadcrumb-custom li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 14px;
            color: #6D4C41;
        }

        .breadcrumb-custom li a {
            color: #8B4513;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .breadcrumb-custom li a:hover {
            color: #D2691E;
        }

        .breadcrumb-custom li.active {
            color: #5D4037;
            font-weight: 600;
        }

        .breadcrumb-separator {
            color: #BDBDBD;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Search Bar */
        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 2px solid #E0D5C7;
            border-radius: 25px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #FDFBF7;
        }

        .search-box input:focus {
            outline: none;
            border-color: #8B4513;
            background: white;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #8B4513;
            font-size: 14px;
        }

        /* Notification Bell */
        .notification-icon {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFF8F0;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .notification-icon:hover {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            color: white;
            transform: scale(1.1);
        }

        .notification-icon i {
            font-size: 18px;
            color: #8B4513;
        }

        .notification-icon:hover i {
            color: white;
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* User Profile */
        .user-profile-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.5rem 1rem;
            background: #FFF8F0;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .user-profile-header:hover {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            border-color: transparent;
        }

        .user-avatar-header {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .user-info-header {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name-header {
            font-size: 13px;
            font-weight: 600;
            color: #5D4037;
        }

        .user-profile-header:hover .user-name-header,
        .user-profile-header:hover .user-role-header {
            color: white;
        }

        .user-role-header {
            font-size: 11px;
            color: #9E9E9E;
        }

        .user-profile-header i {
            color: #8B4513;
            font-size: 14px;
        }

        .user-profile-header:hover i {
            color: white;
        }

        /* Quick Actions */
        .quick-action-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFF8F0;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .quick-action-btn:hover {
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            transform: scale(1.1);
        }

        .quick-action-btn i {
            font-size: 18px;
            color: #8B4513;
        }

        .quick-action-btn:hover i {
            color: white;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            overflow: auto;
            background: linear-gradient(135deg, #FFFDF6 0%, #FFF8F0 100%);
        }

        .content-area::-webkit-scrollbar {
            width: 8px;
        }

        .content-area::-webkit-scrollbar-track {
            background: #F5F5F5;
        }

        .content-area::-webkit-scrollbar-thumb {
            background: #D2691E;
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .search-box {
                display: none;
            }

            .user-info-header {
                display: none;
            }

            .header-right {
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>

{{-- WRAPPER UTAMA --}}
<div class="wrapper">

    {{-- SIDEBAR --}}
    @include('partials.sidebar')

    {{-- AREA KANAN --}}
    <div class="main-content">

        {{-- HEADER --}}
        <div class="top-header">
            <div class="header-left">
                {{-- Breadcrumb --}}
                <ul class="breadcrumb-custom">
                    <li>
                        <a href="/dashboard">
                            <i class="bi bi-house-door-fill"></i>
                            Dashboard
                        </a>
                    </li>
                    @if(!request()->is('dashboard'))
                    <li class="breadcrumb-separator">
                        <i class="bi bi-chevron-right"></i>
                    </li>
                    <li class="active">
                        @yield('title')
                    </li>
                    @endif
                </ul>
            </div>

            <div class="header-right">
                {{-- Search Box --}}
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari menu, transaksi, laporan...">
                </div>

                {{-- Notifications --}}
                <div class="notification-icon" title="Notifikasi">
                    <i class="bi bi-bell-fill"></i>
                    <span class="notification-badge">3</span>
                </div>

                {{-- Quick Settings --}}
                <div class="quick-action-btn" title="Pengaturan">
                    <i class="bi bi-gear-fill"></i>
                </div>

                {{-- User Profile --}}
                <div class="user-profile-header">
                    <div class="user-avatar-header">A</div>
                    <div class="user-info-header">
                        <div class="user-name-header">Admin</div>
                        <div class="user-role-header">Administrator</div>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
        </div>

        {{-- KONTEN --}}
        <div class="content-area">
            @yield('content')
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>