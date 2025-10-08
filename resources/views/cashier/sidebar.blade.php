<aside style="position: fixed; top: 0; left: 0; width: 256px; height: 100vh; background: #FAFAFA; border-right: 1px solid #f3f4f6; display: flex; flex-direction: column; z-index: 50;">
    <!-- Header -->
    <div style="padding: 24px 16px; border-bottom: 1px solid #f3f4f6;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 32px; height: 32px; background: #FADADD; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 20px; height: 20px; color: #CBA37C;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"></path>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 16px; font-weight: 600; color: #CBA37C; margin: 0; line-height: 1.2;">Heavenly</h1>
                <p style="font-size: 12px; color: #CBA37C; opacity: 0.7; margin: 0;">Kasir Panel</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <div style="flex: 1; overflow-y: auto; padding: 24px 16px;">
        <h2 style="font-size: 11px; font-weight: 500; color: #CBA37C; opacity: 0.5; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 8px;">MENU KASIR</h2>
        <nav>
            <a href="/cashier/dashboard" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('cashier/dashboard') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('dashboard') || !{{ request()->is('cashier/dashboard') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <span>Beranda</span>
                </div>
            </a>
            
            <a href="/cashier/transactions" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('cashier/transactions*') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('transactions') || !{{ request()->is('cashier/transactions*') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                    </svg>
                    <span>Transaksi</span>
                </div>
            </a>
            
            <a href="/cashier/products" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('cashier/products') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('products') || !{{ request()->is('cashier/products') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 4.414L5 8v8h10V8l-5-3.586z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Produk</span>
                </div>
            </a>
            
            <a href="/cashier/reports" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('cashier/reports') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('reports') || !{{ request()->is('cashier/reports') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Laporan</span>
                </div>
            </a>
        </nav>
    </div>
    
    <!-- Logout -->
    <div style="margin-top: auto; padding: 16px; border-top: 1px solid #f3f4f6;">
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