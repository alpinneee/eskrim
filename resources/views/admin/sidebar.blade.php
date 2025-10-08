<aside style="background: #FAFAFA; width: 256px; min-height: 100vh; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; flex-direction: column; position: fixed; left: 0; top: 0; z-index: 10; border-right: 1px solid #f3f4f6;">
    <!-- Header -->
    <div style="padding: 24px; border-bottom: 1px solid #f3f4f6;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="background: #CBA37C; padding: 10px; border-radius: 12px;">
                <img src="{{ asset('images/ice-cream.svg') }}" alt="Logo" style="width: 20px; height: 20px; filter: brightness(0) invert(1);">
            </div>
            <div>
                <h1 style="font-size: 16px; font-weight: 700; color: #CBA37C; margin: 0; line-height: 1.2;">AdminPanel</h1>
                <p style="font-size: 14px; color: #CBA37C; opacity: 0.7; margin: 0; line-height: 1.2;">Dashboard</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Section -->
    <div style="padding: 24px 16px;">
        <h2 style="font-size: 11px; font-weight: 500; color: #CBA37C; opacity: 0.5; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 8px;">NAVIGATION</h2>
        <nav>
            <a href="/admin/dashboard" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('admin/dashboard') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('dashboard') || !{{ request()->is('admin/dashboard') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <span>Beranda</span>
                </div>
            </a>
            
            <a href="/admin/users" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('admin/users') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('users') || !{{ request()->is('admin/users') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                    <span>Data Pengguna</span>
                </div>
            </a>
            
            <a href="/admin/cashiers" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('admin/cashiers') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('cashiers') || !{{ request()->is('admin/cashiers') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                    <span>Data Kasir</span>
                </div>
            </a>
            
            <a href="/admin/transactions" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('admin/transactions') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('transactions') || !{{ request()->is('admin/transactions') ? 'true' : 'false' }}) this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                    </svg>
                    <span>Transaksi</span>
                </div>
            </a>
            
            <a href="/admin/reports" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; {{ request()->is('admin/reports') ? 'background: #FADADD; color: #CBA37C;' : 'color: #CBA37C;' }}" onmouseover="if(!this.style.background.includes('#FADADD')) this.style.background='#FADADD'" onmouseout="if(!this.getAttribute('href').includes('reports') || !{{ request()->is('admin/reports') ? 'true' : 'false' }}) this.style.background='transparent'">
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
    
    <!-- Settings Section -->
    <div style="padding: 0 16px 24px;">
        <h2 style="font-size: 11px; font-weight: 500; color: #CBA37C; opacity: 0.5; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 8px;">SETTINGS</h2>
        <nav>
            <a href="/admin/billing" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; color: #CBA37C; transition: all 0.2s;" onmouseover="this.style.background='#FADADD'" onmouseout="this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                    </svg>
                    <span>Billing</span>
                </div>
            </a>
            
            <a href="/admin/security" style="display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; color: #CBA37C; transition: all 0.2s;" onmouseover="this.style.background='#FADADD'" onmouseout="this.style.background='transparent'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Security</span>
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