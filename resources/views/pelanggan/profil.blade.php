<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Pelanggan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    @include('pelanggan.navbar')
    <main class="p-6 max-w-6xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-3" style="color: #3a7bd5;">Profil Saya</h1>
            <p class="text-gray-600 text-lg">Kelola informasi profil dan lihat statistik akun Anda</p>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex items-center">
                <div class="text-green-500 text-xl mr-3">✅</div>
                <div class="font-medium">{{ session('success') }}</div>
            </div>
        @endif
        
        <!-- Profile Header Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                <div class="text-center">
                    <div class="w-40 h-40 rounded-full flex items-center justify-center text-5xl font-bold text-white mb-4 shadow-xl" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div class="inline-block px-6 py-2 rounded-full text-sm font-bold uppercase shadow-md {{ strtolower($membershipStatus) === 'bronze' ? 'bg-yellow-600 text-white' : (strtolower($membershipStatus) === 'silver' ? 'bg-gray-400 text-white' : 'bg-yellow-400 text-gray-800') }}">{{ $membershipStatus }} Member</div>
                </div>
                
                <div class="flex-1 w-full">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                        <p class="text-gray-600">Bergabung sejak {{ $user->created_at->format('d F Y') }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <label class="block text-sm font-bold mb-2" style="color: #3a7bd5;">📧 Email</label>
                                <div class="text-gray-800 font-medium">{{ $user->email }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <label class="block text-sm font-bold mb-2" style="color: #3a7bd5;">📱 Nomor Telepon</label>
                                <div class="text-gray-800 font-medium">{{ $user->phone ?? 'Belum diisi' }}</div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <label class="block text-sm font-bold mb-2" style="color: #3a7bd5;">🏠 Alamat</label>
                                <div class="text-gray-800 font-medium">{{ $user->address ?? 'Belum diisi' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <button class="text-white font-bold px-8 py-3 rounded-xl transition-all hover:shadow-lg transform hover:-translate-y-1" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);" onclick="toggleEditForm()">✏️ Edit Profil</button>
                    </div>
                </div>
            </div>
            
            <!-- Edit Form -->
            <form class="edit-form hidden mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200" method="POST" action="{{ route('pelanggan.profil.update') }}">
                @csrf
                @method('PUT')
                
                <h3 class="text-xl font-bold mb-6" style="color: #3a7bd5;">Edit Informasi Profil</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold mb-2" style="color: #3a7bd5;">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-bold mb-2" style="color: #3a7bd5;">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors" required>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-bold mb-2" style="color: #3a7bd5;">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}" placeholder="Contoh: 0812-3456-7890" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-bold mb-2" style="color: #3a7bd5;">Alamat</label>
                        <textarea id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors">{{ $user->address ?? '' }}</textarea>
                    </div>
                </div>
                
                <div class="flex gap-4 mt-6">
                    <button type="button" class="bg-gray-500 text-white font-bold px-6 py-3 rounded-xl hover:bg-gray-600 transition-colors" onclick="toggleEditForm()">❌ Batal</button>
                    <button type="submit" class="text-white font-bold px-6 py-3 rounded-xl transition-all hover:shadow-lg" style="background: linear-gradient(135deg, #3a7bd5 0%, #1e40af 100%);">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
        
        <!-- Stats and Transactions Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Statistics Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h3 class="text-2xl font-bold mb-6 text-center" style="color: #3a7bd5;">📊 Statistik Saya</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-6 rounded-2xl" style="background: linear-gradient(135deg, #e3f0fc 0%, #dbeafe 100%);">
                        <div class="text-4xl font-bold mb-2" style="color: #3a7bd5;">{{ $totalTransactions }}</div>
                        <div class="text-sm text-gray-600 font-bold">Total Transaksi</div>
                    </div>
                    <div class="text-center p-6 rounded-2xl" style="background: linear-gradient(135deg, #e3f0fc 0%, #dbeafe 100%);">
                        <div class="text-2xl font-bold mb-2" style="color: #3a7bd5;">Rp {{ number_format($totalSpending, 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-600 font-bold">Total Pembelanjaan</div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Transactions Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h3 class="text-2xl font-bold mb-6" style="color: #3a7bd5;">🛒 Transaksi Terbaru</h3>
                
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @if($recentTransactions->count() > 0)
                        @foreach($recentTransactions as $transaction)
                            <div class="p-4 rounded-xl border-2 border-gray-100 hover:border-blue-200 transition-colors" style="background: linear-gradient(135deg, #f8fafc 0%, #e3f0fc 100%);">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-bold text-lg" style="color: #3a7bd5;">TRX{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-sm text-gray-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-gray-800">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-green-600 font-medium">✅ Selesai</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">🛍️</div>
                            <div class="text-gray-500 font-medium">Belum ada transaksi</div>
                            <div class="text-gray-400 text-sm mt-2">Mulai berbelanja sekarang!</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <script>
    function toggleEditForm() {
        const form = document.querySelector('.edit-form');
        form.classList.toggle('hidden');
    }
    </script>
</body>
</html> 