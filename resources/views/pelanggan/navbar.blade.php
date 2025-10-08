<style>
.navbar {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 0;
}
.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
}
.navbar-left {
    display: flex;
    align-items: center;
    gap: 32px;
}
.navbar-logo {
    display: flex;
    align-items: center;
    gap: 8px;
}
.navbar-logo svg {
    width: 20px;
    height: 20px;
    color: #3b82f6;
}
.navbar-logo span {
    font-size: 18px;
    font-weight: 500;
    color: #3b82f6;
}
.navbar-menu {
    display: flex;
    align-items: center;
    gap: 4px;
}
.navbar-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    transition: color 0.2s;
}
.navbar-item:hover {
    color: #3b82f6;
}
.navbar-item.active {
    color: #3b82f6;
}
.navbar-item.highlighted {
    background: #3b82f6;
    color: white;
    border-radius: 20px;
    padding: 8px 16px;
}
.navbar-item.highlighted:hover {
    background: #2563eb;
    color: white;
}
.navbar-item svg {
    width: 16px;
    height: 16px;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <div class="navbar-logo">
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"></path>
                </svg>
                <span>Ice Cream Shop</span>
            </div>
            
            <div class="navbar-menu">
                <a href="{{ route('pelanggan.dashboard') }}" class="navbar-item {{ request()->routeIs('pelanggan.dashboard') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span>Beranda</span>
                </a>
                
                <a href="{{ route('pelanggan.menu') }}" class="navbar-item {{ request()->routeIs('pelanggan.menu') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <span>Menu Ice Cream</span>
                </a>
                
                <a href="{{ route('pelanggan.cart') }}" class="navbar-item {{ request()->routeIs('pelanggan.cart') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                    <span>Keranjang</span>
                </a>
                
                <a href="{{ route('pelanggan.riwayat') }}" class="navbar-item {{ request()->routeIs('pelanggan.riwayat') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Riwayat Transaksi</span>
                </a>
                
                <a href="{{ route('pelanggan.profil') }}" class="navbar-item {{ request()->routeIs('pelanggan.profil') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Profil Saya</span>
                </a>
                
                <a href="{{ route('pelanggan.notifikasi') }}" class="navbar-item {{ request()->routeIs('pelanggan.notifikasi') ? 'highlighted' : '' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                    </svg>
                    <span>Notifikasi</span>
                </a>
            </div>
        </div>
    </div>
</nav>