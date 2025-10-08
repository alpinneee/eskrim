<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex">
    @include('admin.sidebar')
    <main class="flex-1 min-h-screen" style="margin-left: 256px;">
        <!-- Header -->
        <div class="bg-white-custom shadow-sm border-b border-pink-custom p-6">
            <h1 class="text-3xl font-bold text-brown-custom">Data Pengguna</h1>
            <p class="text-brown-custom opacity-70 mt-1">Kelola data pengguna sistem</p>
        </div>
        
        <div class="p-6">
            @if(session('success'))
                <div class="bg-mint-custom border border-brown-custom text-amber-900 px-4 py-3 rounded-lg mb-4 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-pink-custom border border-brown-custom text-amber-900 px-4 py-3 rounded-lg mb-4 font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-purple-custom text-amber-900 font-semibold px-4 py-2 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Pengguna
                </a>
            </div>

            <div class="bg-white-custom rounded-xl shadow-sm border border-pink-custom overflow-hidden">
                @if($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-purple-custom">
                                    <th class="px-6 py-4 text-left text-amber-900 font-bold">Nama</th>
                                    <th class="px-6 py-4 text-left text-amber-900 font-bold">Email</th>
                                    <th class="px-6 py-4 text-left text-amber-900 font-bold">Peran</th>
                                    <th class="px-6 py-4 text-left text-amber-900 font-bold">Tanggal Dibuat</th>
                                    <th class="px-6 py-4 text-left text-amber-900 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="{{ $loop->even ? 'bg-mint-custom' : 'bg-pink-custom' }} hover:bg-purple-custom transition-colors duration-200">
                                        <td class="px-6 py-4 text-amber-900 font-medium">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-amber-900 font-medium">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $user->role === 'admin' ? 'bg-purple-custom text-amber-900' : '' }}
                                                {{ $user->role === 'kasir' ? 'bg-pink-custom text-amber-900' : '' }}
                                                {{ $user->role === 'pelanggan' ? 'bg-mint-custom text-amber-900' : '' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-amber-900 font-medium">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-1 bg-mint-custom text-amber-900 font-semibold px-3 py-1 rounded-lg hover:bg-brown-custom hover:text-white-custom transition-all duration-200 text-sm">
                                                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0l-9.5 9.5A2 2 0 004 13.914V16a1 1 0 001 1h2.086a2 2 0 001.414-.586l9.5-9.5a2 2 0 000-2.828l-2.5-2.5z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 bg-pink-custom text-amber-900 font-semibold px-3 py-1 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-200 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                        <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 8a1 1 0 011 1v6a1 1 0 001 1h2a1 1 0 001-1V9a1 1 0 112 0v6a3 3 0 01-3 3H9a3 3 0 01-3-3V9a1 1 0 112 0z"/>
                                                            <path d="M4 6a1 1 0 011-1h10a1 1 0 011 1v1H4V6z"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-pink-custom rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brown-custom" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-brown-custom mb-2">Tidak ada data pengguna</h3>
                        <p class="text-brown-custom opacity-60">Belum ada pengguna yang terdaftar dalam sistem.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html> 