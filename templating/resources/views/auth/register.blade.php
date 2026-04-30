<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Peminjaman Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <div class="flex flex-col justify-center w-full px-8 py-12 bg-white lg:w-5/12 md:px-24">
            <div class="max-w-md mx-auto">
                <h2 class="text-3xl font-bold text-slate-800">Daftar Akun</h2>
                <p class="mt-2 text-slate-500">Lengkapi data di bawah ini untuk mulai meminjam barang.</p>

                <form action="{{ route('register') }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Nama Anda" 
                            class="w-full px-4 py-3 mt-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('name') border-red-500 @enderror" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" placeholder="Email@anda.com" 
                            class="w-full px-4 py-3 mt-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('email') border-red-500 @enderror" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" name="password" placeholder="Minimal 8 karakter" 
                            class="w-full px-4 py-3 mt-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('password') border-red-500 @enderror" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" 
                            class="w-full px-4 py-3 mt-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    </div>

                    <button type="submit" 
                        class="w-full py-3 mt-4 font-semibold text-white transition bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200">
                        Daftar Sekarang
                    </button>

                    <p class="mt-6 text-center text-sm text-slate-600">
                        Sudah punya akun? <a href="/login" class="font-semibold text-indigo-600 hover:underline">Masuk</a>
                    </p>
                </form>
            </div>
        </div>

        <div class="hidden lg:block lg:w-7/12 bg-indigo-50 p-12">
            <div class="h-full w-full rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-600 flex flex-col items-center justify-center text-white text-center p-8 relative overflow-hidden">
                <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 left-10 w-48 h-48 bg-purple-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h3 class="text-4xl font-bold mb-4">"Ease of management"</h3>
                    <p class="text-indigo-100 max-w-md mx-auto italic">
                        Pantau dan kelola semua peminjaman barang hanya dalam satu genggaman tangan.
                    </p>
                </div>
                
                <div class="mt-12 w-64 h-64 bg-white/20 rounded-full animate-pulse flex items-center justify-center">
                     <span class="text-6xl">📦</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>