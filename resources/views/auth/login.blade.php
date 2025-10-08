<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Heavenly Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-custom to-mint-custom font-poppins flex items-center justify-center m-0 p-0">
    <div class="flex bg-white-custom rounded-3xl shadow-2xl max-w-4xl w-[90%] h-[500px] overflow-hidden">
        <div class="flex-[1.2] bg-gradient-to-br from-pink-custom to-mint-custom flex flex-col items-center justify-center px-8 py-12">
            <img src="{{ asset('images/ice-cream.svg') }}" alt="Ice Cream" class="w-16 mb-8">
            <div class="text-5xl font-bold text-brown-custom mb-4 tracking-wide text-center leading-tight">Heavenly Ice Cream</div>
            <div class="text-purple-custom text-lg font-medium tracking-wide">Surga Es Krim Terbaik</div>
        </div>
        <div class="flex-1 px-10 py-12 flex flex-col items-center justify-center text-center">
            <div class="text-3xl font-bold text-brown-custom mb-2 tracking-wide">Masuk</div>
            <div class="text-purple-custom text-base mb-8 font-medium">Selamat datang kembali!</div>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 w-full max-w-xs">
                @csrf
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#9993;</span>
                    <input type="email" name="email" placeholder="Email" required autofocus autocomplete="username" 
                           class="w-full pl-10 pr-4 py-4 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
                </div>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-brown-custom opacity-70">&#128274;</span>
                    <input type="password" name="password" placeholder="Password" required autocomplete="current-password"
                           class="w-full pl-10 pr-4 py-4 rounded-2xl bg-pink-custom text-amber-900 font-medium text-base outline-none transition-all duration-300 focus:bg-purple-custom focus:shadow-lg">
                </div>
                <button type="submit" class="bg-mint-custom text-brown-custom font-bold text-base py-4 rounded-2xl mt-2 transition-all duration-300 hover:bg-purple-custom hover:shadow-lg tracking-wide">
                    Masuk
                </button>
            </form>
            <div class="mt-6 text-brown-custom text-sm font-medium">
                Belum punya akun? <a href="{{ route('register') }}" class="text-purple-custom underline font-semibold">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>
</html> 