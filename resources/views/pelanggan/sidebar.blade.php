<aside style="position: fixed; top: 0; left: 0; width: 256px; height: 100vh; background: #e3f0fc; border-right: 1px solid #dbeafe; display: flex; flex-direction: column; z-index: 50;">
    <!-- Header -->
    <div style="padding: 24px 16px; border-bottom: 1px solid #dbeafe;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 32px; height: 32px; background: #3a7bd5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 20px; height: 20px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"></path>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 16px; font-weight: 600; color: #3a7bd5; margin: 0; line-height: 1.2;">Heavenly</h1>
                <p style="font-size: 12px; color: #3a7bd5; opacity: 0.7; margin: 0;">Pelanggan Panel</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <div style="flex: 1; overflow-y: auto; padding: 24px 16px;">
        <h2 style="font-size: 11px; font-weight: 500; color: #3a7bd5; opacity: 0.5; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 8px;">MENU PELANGGAN</h2>
        <nav>
            <a href="/pelanggan/dashboard" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/dashboard') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('dashboard') || !{{ request()->is('pelanggan/dashboard') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <span>Beranda</span>
                </div>
            </a>
            
            <a href="/pelanggan/menu" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/menu') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('menu') || !{{ request()->is('pelanggan/menu') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 4.414L5 8v8h10V8l-5-3.586z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Menu Ice Cream</span>
                </div>
            </a>
            
            <a href="/pelanggan/cart" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/cart') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('cart') || !{{ request()->is('pelanggan/cart') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                    <span>Keranjang</span>
                    @php
                        $cartCount = count(session()->get('cart', []));
                    @endphp
                    @if($cartCount > 0)
                        <span style="background: #ef4444; color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; margin-left: auto; display: inline-block; min-width: 18px; text-align: center;">{{ $cartCount }}</span>
                    @endif
                </div>
            </a>
            
            <a href="/pelanggan/riwayat" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/riwayat') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('riwayat') || !{{ request()->is('pelanggan/riwayat') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Riwayat Transaksi</span>
                </div>
            </a>
            
            <a href="/pelanggan/profil" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/profil') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('profil') || !{{ request()->is('pelanggan/profil') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Profil Saya</span>
                </div>
            </a>
            
            <a href="/pelanggan/notifikasi" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('pelanggan/notifikasi') ? 'background: white; color: #3a7bd5;' : 'color: #3a7bd5;' }}" onmouseover="if(!this.style.background.includes('white')) this.style.background='white'" onmouseout="if(!this.getAttribute('href').includes('notifikasi') || !{{ request()->is('pelanggan/notifikasi') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                    </svg>
                    <span>Notifikasi</span>
                </div>
            </a>
        </nav>
    </div>
    
    <!-- Logout -->
    <div style="margin-top: auto; padding: 16px; border-top: 1px solid #dbeafe;">
        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
            @csrf
            <button type="submit" style="display: flex; align-items: center; gap: 12px; width: 100%; color: #dc2626; font-weight: 500; padding: 10px 12px; border-radius: 8px; font-size: 14px; transition: all 0.2s; background: none; border: none; cursor: pointer;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside> 