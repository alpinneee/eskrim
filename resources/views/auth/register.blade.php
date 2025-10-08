<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex">
    <div class="flex-[1.2] flex flex-col items-center justify-center px-8 py-12">
        <img src="{{ asset('images/ice-cream.svg') }}" alt="Ice Cream" class="w-16 mb-8">
        <div class="text-5xl font-bold text-brown-custom mb-4 tracking-wide text-center leading-tight">Heavenly Ice Cream</div>
        <div class="text-purple-custom text-lg font-medium tracking-wide">Surga Es Krim Terbaik</div>
    </div>
    <div class="flex-1 bg-white-custom px-10 py-8 flex flex-col items-center justify-center text-center">
        <div class="text-3xl font-bold text-brown-custom mb-2 tracking-wide">Daftar</div>
        <div class="text-purple-custom text-base mb-6 font-medium">Bergabung dengan surga es krim!</div>
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3 w-full max-w-xs">
            @csrf
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#128100;</span>
                <input type="text" name="name" placeholder="Nama Lengkap" required autofocus
                       class="w-full pl-10 pr-4 py-3 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
            </div>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#9993;</span>
                <input type="email" name="email" placeholder="Email" required
                       class="w-full pl-10 pr-4 py-3 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
            </div>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#128274;</span>
                <input type="password" name="password" placeholder="Password" required
                       class="w-full pl-10 pr-4 py-3 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
            </div>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#128274;</span>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                       class="w-full pl-10 pr-4 py-3 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
            </div>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#128100;</span>
                <select name="role" required
                        class="w-full pl-10 pr-4 py-3 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg appearance-none">
                    <option value="" disabled selected>Pilih Peran</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="pelanggan">Pelanggan</option>
                </select>
            </div>
            <button type="submit" class="bg-mint-custom text-brown-custom font-bold text-base py-3 rounded-2xl mt-2 transition-all duration-300 hover:bg-purple-custom hover:shadow-lg tracking-wide">
                Daftar
            </button>
        </form>
        <div class="mt-4 text-brown-custom text-sm font-medium">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-purple-custom underline font-semibold">Masuk di sini</a>
        </div>
    </div>
</body>
</html> 