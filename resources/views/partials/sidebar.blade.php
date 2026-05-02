<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #FDFBF7 0%, #F5F1E8 100%);
        padding: 0;
        border-right: 1px solid #E0D5C7;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(139, 69, 19, 0.05);
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #D2691E;
        border-radius: 3px;
    }

    .sidebar-header {
        padding: 1.5rem 1.25rem;
        border-bottom: 1px solid #E0D5C7;
        background: white;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-container img {
        height: 50px;
        width: 50px;
        object-fit: contain;
        border-radius: 8px;
        padding: 4px;
        background: white;
        box-shadow: 0 2px 8px rgba(139, 69, 19, 0.1);
    }

    .school-name {
        font-size: 15px;
        font-weight: 700;
        color: #5D4037;
        line-height: 1.3;
    }

    .sidebar-content {
        padding: 1.25rem;
    }

    .menu-section {
        margin-bottom: 1.5rem;
    }

    .dashboard-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #5D4037;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
        background: white;
        border: 1px solid transparent;
    }

    .dashboard-link:hover,
    .dashboard-link.active {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.2);
    }

    .dashboard-link i {
        font-size: 18px;
        width: 20px;
        text-align: center;
    }

    .menu-group {
        margin-bottom: 1rem;
    }

    .menu-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: white;
        border: 1px solid #E0D5C7;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: #5D4037;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .menu-toggle:hover {
        background: #FFF8F0;
        border-color: #D2691E;
        transform: translateX(2px);
    }

    .menu-toggle.active {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        border-color: transparent;
    }

    .menu-toggle-icon {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .menu-toggle-icon i:first-child {
        font-size: 16px;
        width: 20px;
        text-align: center;
    }

    .chevron {
        transition: transform 0.3s ease;
        font-size: 14px;
    }

    .menu-toggle.active .chevron {
        transform: rotate(180deg);
    }

    .submenu {
        list-style: none;
        padding: 0;
        margin: 0 0 0.5rem 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .submenu.show {
        max-height: 800px;
    }

    .submenu li {
        margin-bottom: 4px;
    }

    .submenu > li > a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px 10px 48px;
        color: #6D4C41;
        text-decoration: none;
        font-size: 13px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        background: transparent;
    }

    .submenu > li > a::before {
        content: '';
        position: absolute;
        left: 20px;
        width: 6px;
        height: 6px;
        background: #D2691E;
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .submenu > li > a:hover {
        background: #FFF8F0;
        color: #8B4513;
        padding-left: 52px;
    }

    .submenu > li > a:hover::before {
        opacity: 1;
    }

    .submenu > li > a.active {
        background: linear-gradient(90deg, #FFF8F0 0%, #FFE4B5 100%);
        color: #8B4513;
        font-weight: 600;
        padding-left: 52px;
    }

    .submenu > li > a.active::before {
        opacity: 1;
        background: #8B4513;
    }

    /* ===================== */
    /* NESTED SUBMENU STYLES */
    /* ===================== */

    .nested-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 16px 10px 48px;
        color: #6D4C41;
        font-size: 13px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        user-select: none;
    }

    .nested-toggle::before {
        content: '';
        position: absolute;
        left: 20px;
        width: 6px;
        height: 6px;
        background: #D2691E;
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .nested-toggle:hover,
    .nested-toggle.active {
        background: #FFF8F0;
        color: #8B4513;
    }

    .nested-toggle:hover::before,
    .nested-toggle.active::before {
        opacity: 1;
    }

    .nested-toggle.active {
        font-weight: 600;
        padding-left: 52px;
    }

    .nested-chevron {
        font-size: 11px;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .nested-toggle.open .nested-chevron {
        transform: rotate(180deg);
    }

    .nested-submenu {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .nested-submenu.show {
        max-height: 300px;
    }

    .nested-submenu li {
        margin-bottom: 2px;
    }

    .nested-submenu a {
        display: flex;
        align-items: center;
        padding: 9px 16px 9px 64px;
        color: #6D4C41;
        text-decoration: none;
        font-size: 12px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    .nested-submenu a::before {
        content: '–';
        position: absolute;
        left: 48px;
        color: #D2691E;
        opacity: 0;
        font-size: 11px;
        transition: opacity 0.3s;
    }

    .nested-submenu a:hover {
        background: #FFF8F0;
        color: #8B4513;
        padding-left: 68px;
    }

    .nested-submenu a:hover::before {
        opacity: 1;
    }

    .nested-submenu a.active {
        background: linear-gradient(90deg, #FFF8F0 0%, #FFE4B5 100%);
        color: #8B4513;
        font-weight: 600;
        padding-left: 68px;
    }

    .nested-submenu a.active::before {
        opacity: 1;
    }

    /* Divider */
    .menu-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #E0D5C7 50%, transparent 100%);
        margin: 1rem 0;
    }

    /* Badge */
    .badge-new {
        background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
        color: white;
        font-size: 9px;
        padding: 2px 6px;
        border-radius: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="sidebar">
    {{-- HEADER --}}
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="{{ asset('images/logo/logo_sekolah.png') }}" alt="Logo MTs Mulia Insani">
            <div class="school-name">MTs Mulia Insani</div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="sidebar-content">

        {{-- DASHBOARD --}}
        <div class="menu-section">
            <a href="/dashboard" class="dashboard-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="menu-divider"></div>

        {{-- MASTER DATA --}}
        <div class="menu-group">
            <div class="menu-toggle" onclick="toggleMenu('masterData')" id="toggle-masterData">
                <div class="menu-toggle-icon">
                    <i class="bi bi-database-fill"></i>
                    <span>Master Data</span>
                </div>
                <i class="bi bi-chevron-down chevron"></i>
            </div>

            <ul class="submenu" id="menu-masterData">
                @php
                    $menus = [
                        ['route' => 'coa.index',               'label' => 'Chart Of Account'],
                        ['route' => 'guru.index',              'label' => 'Guru'],
                        ['route' => 'jabatan.index',           'label' => 'Jabatan'],
                        ['route' => 'mata_pelajaran.index',    'label' => 'Mata Pelajaran'],
                        ['route' => 'pengaturan_honor.index',  'label' => 'Pengaturan Honor'],
                        ['route' => 'ekstrakurikuler.index',   'label' => 'Ekstrakurikuler'],
                        ['route' => 'sumber_dana.index',       'label' => 'Jenis Penerimaan Dana'],
                        ['route' => 'jenis_pengeluaran.index', 'label' => 'Jenis Pengeluaran Dana'],
                        ['route' => 'alat_tulis_kantor.index', 'label' => 'Alat Tulis Kantor'],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <li>
                        <a href="{{ route($menu['route']) }}"
                           class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                            {{ $menu['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- TRANSAKSI --}}
        <div class="menu-group">
            <div class="menu-toggle" onclick="toggleMenu('transaksi')" id="toggle-transaksi">
                <div class="menu-toggle-icon">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Transaksi</span>
                </div>
                <i class="bi bi-chevron-down chevron"></i>
            </div>

            <ul class="submenu" id="menu-transaksi">

                {{-- Pemasukan Dana --}}
                <li>
                    <a href="{{ route('pemasukan_dana.index') }}"
                       class="{{ request()->routeIs('pemasukan_dana.index') ? 'active' : '' }}">
                        Pemasukan Dana
                    </a>
                </li>

                {{-- Pengajuan Dana Keluar --}}
                <li>
                    <a href="{{ route('pengajuan_kas_keluar.index') }}"
                       class="{{ request()->routeIs('pengajuan_kas_keluar.index') ? 'active' : '' }}">
                        Pengajuan Dana Keluar
                    </a>
                </li>

                {{-- Pengeluaran Dana (Nested) --}}
                @php
                    $pengeluaranRoutes = [
                        'pengajuan_kas_keluar.index',
                        'pembelian_atk.index',
                        'perhitungan_gaji_guru.index',
                        'biaya_operasional.*',
                    ];
                    $pengeluaranActive = request()->routeIs($pengeluaranRoutes);
                @endphp

                <li>
                    <div class="nested-toggle {{ $pengeluaranActive ? 'active' : '' }}"
                         onclick="toggleNested('pengeluaran')"
                         id="toggle-nested-pengeluaran">
                        <span>Pengeluaran Dana</span>
                        <i class="bi bi-chevron-down nested-chevron"></i>
                    </div>

                    <ul class="nested-submenu" id="nested-pengeluaran">
                        <li>
                            <a href="{{ route('biaya_operasional.index') }}"
                               class="{{ request()->routeIs('biaya_operasional.*') ? 'active' : '' }}">
                                Biaya Operasional
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pembelian_atk.index') }}"
                               class="{{ request()->routeIs('pembelian_atk.index') ? 'active' : '' }}">
                                Pembelian ATK
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('perhitungan_gaji_guru.index') }}"
                               class="{{ request()->routeIs('perhitungan_gaji_guru.index') ? 'active' : '' }}">
                                Perhitungan Gaji Guru
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

        {{-- LAPORAN --}}
        <div class="menu-group">
            <div class="menu-toggle" onclick="toggleMenu('laporan')" id="toggle-laporan">
                <div class="menu-toggle-icon">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Laporan</span>
                </div>
                <i class="bi bi-chevron-down chevron"></i>
            </div>

            <ul class="submenu" id="menu-laporan">
                @php
                    $laporanMenus = [
                        ['route' => 'laporan.kas_masuk',  'label' => 'Laporan Dana Masuk'],
                        ['route' => 'laporan.kas_keluar', 'label' => 'Laporan Dana Keluar'],
                        ['route' => 'laporan.jurnal',     'label' => 'Jurnal Umum'],
                        ['route' => 'laporan.buku_besar', 'label' => 'Buku Besar'],
                    ];
                @endphp

                @foreach ($laporanMenus as $menu)
                    <li>
                        <a href="{{ route($menu['route']) }}"
                           class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                            {{ $menu['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>

<script>
    /* ======================== */
    /* TOGGLE MENU LEVEL 1     */
    /* ======================== */
    function toggleMenu(menuId) {
        const menu   = document.getElementById('menu-' + menuId);
        const toggle = document.getElementById('toggle-' + menuId);

        menu.classList.toggle('show');
        toggle.classList.toggle('active');

        localStorage.setItem('menu-' + menuId, menu.classList.contains('show'));
    }

    /* ======================== */
    /* TOGGLE NESTED LEVEL 2   */
    /* ======================== */
    function toggleNested(id) {
        const menu   = document.getElementById('nested-' + id);
        const toggle = document.getElementById('toggle-nested-' + id);

        menu.classList.toggle('show');
        toggle.classList.toggle('open');

        localStorage.setItem('nested-' + id, menu.classList.contains('show'));
    }

    /* ======================== */
    /* RESTORE STATE ON LOAD   */
    /* ======================== */
    document.addEventListener('DOMContentLoaded', function () {

        const currentRoute = '{{ request()->route()->getName() }}';

        // --- Restore level-1 menus dari localStorage ---
        ['masterData', 'transaksi', 'laporan'].forEach(menuId => {
            if (localStorage.getItem('menu-' + menuId) === 'true') {
                document.getElementById('menu-' + menuId).classList.add('show');
                document.getElementById('toggle-' + menuId).classList.add('active');
            }
        });

        // --- Restore nested menus dari localStorage ---
        ['pengeluaran'].forEach(id => {
            if (localStorage.getItem('nested-' + id) === 'true') {
                document.getElementById('nested-' + id).classList.add('show');
                document.getElementById('toggle-nested-' + id).classList.add('open');
            }
        });

        // --- Auto-open: Master Data ---
        const masterDataRoutes = [
            'coa.', 'guru.', 'jabatan.', 'mata_pelajaran.',
            'pengaturan_honor.', 'ekstrakurikuler.',
            'sumber_dana.', 'jenis_pengeluaran.', 'alat_tulis_kantor.'
        ];
        if (masterDataRoutes.some(r => currentRoute.startsWith(r))) {
            document.getElementById('menu-masterData').classList.add('show');
            document.getElementById('toggle-masterData').classList.add('active');
        }

        // --- Auto-open: Transaksi ---
        const transaksiRoutes = [
            'pemasukan_dana.', 'pengajuan_kas_keluar.',
            'perhitungan_gaji_guru.', 'pembelian_atk.'
        ];
        if (transaksiRoutes.some(r => currentRoute.startsWith(r))) {
            document.getElementById('menu-transaksi').classList.add('show');
            document.getElementById('toggle-transaksi').classList.add('active');
        }

        // --- Auto-open: Nested Pengeluaran Dana ---
        const pengeluaranRoutes = [
            'pengajuan_kas_keluar.', 'pembelian_atk.', 'perhitungan_gaji_guru.', 'biaya_operasional.'
        ];
        if (pengeluaranRoutes.some(r => currentRoute.startsWith(r))) {
            document.getElementById('nested-pengeluaran').classList.add('show');
            document.getElementById('toggle-nested-pengeluaran').classList.add('open');
        }

        // --- Auto-open: Laporan ---
        if (currentRoute.startsWith('laporan.')) {
            document.getElementById('menu-laporan').classList.add('show');
            document.getElementById('toggle-laporan').classList.add('active');
        }
    });
</script>