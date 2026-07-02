<?php
session_start();
include '../config/koneksi.php';

$error_msg = ""; // Variabel penampung pesan eror

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Ambil data user berdasarkan email
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (!$query) {
        die("Query Error (SELECT users): " . mysqli_error($conn));
    }

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        // Verifikasi password (Bcrypt hash maupun plain text untuk akun manual)
        if (password_verify($password, $data['password']) || $password === $data['password']) {
            
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            // Redirect sesuai role
            if ($data['role'] == 'seller') {
                header("Location: ../seller/dashboard.php");
            } else {
                header("Location: ../buyer/dashboard.php");
            }
            exit;
        } else {
            $error_msg = "Password yang Anda masukkan salah.";
        }
        $error_msg = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - UMKM Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#00236f",
                        "primary-container": "#1e3a8a",
                        "on-primary": "#ffffff",
                        "background": "#f8f9fb",
                        "on-background": "#191c1e",
                        "outline": "#757682",
                        "outline-variant": "#c5c5d3",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#444651",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "secondary": "#0058be",
                        "surface-container-low": "#f3f4f6"
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fb 0%, #dce1ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 35, 111, 0.05);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-background text-on-background p-4 md:p-0">
    <main class="w-full max-w-md mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-extrabold text-primary tracking-tight">UMKM Market</h1>
            <p class="text-sm text-on-surface-variant mt-1">Connecting local artisans to the world</p>
        </div>
        
        <div class="glass-card rounded-xl p-6 md:p-8">
            <div class="flex flex-col gap-6">
                <div class="space-y-1">
                    <h2 class="text-2xl font-bold text-on-surface">Selamat Datang</h2>
                    <p class="text-sm text-outline">Silakan masuk ke akun Anda</p>
                </div>

                <?php if (!empty($error_msg)): ?>
                <div class="flex items-center gap-3 p-3 bg-error-container text-on-error-container rounded-lg border border-error/20" id="error-alert">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                    <p class="text-xs font-semibold"><?= $error_msg; ?></p>
                </div>
                <?php endif; ?>

                <form class="flex flex-col gap-4" method="POST" action="">

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface" for="email">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition-all outline-none text-sm" id="email" name="email" placeholder="nama@email.com" required type="email" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-bold text-on-surface" for="password">Password</label>
                            <a class="text-xs text-secondary hover:underline" href="#">Lupa Password?</a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition-all outline-none text-sm" id="password" name="password" placeholder="••••••••" required type="password" />
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors" onclick="togglePassword()" type="button">
                                <span class="material-symbols-outlined" id="pw-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" id="remember" type="checkbox" />
                        <label class="text-xs text-on-surface-variant" for="remember">Ingat saya</label>
                    </div>

                    <button class="w-full py-3 bg-primary text-on-primary rounded-lg font-bold text-sm hover:bg-primary-container active:scale-95 transition-all shadow-md mt-2" type="submit" name="login">
                        Masuk
                    </button>
                </form>

                <div class="flex items-center gap-4 py-1">
                    <div class="h-[1px] flex-1 bg-gray-200"></div>
                    <span class="text-xs text-outline">atau masuk dengan</span>
                    <div class="h-[1px] flex-1 bg-gray-200"></div>
                </div>

                <button class="w-full py-2.5 flex items-center justify-center gap-2 border border-outline-variant rounded-lg text-sm font-medium hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"></path>
                    </svg>
                    Google
                </button>

                <p class="text-center text-xs text-on-surface-variant">
                    Belum punya akun?
                    <a class="text-secondary font-bold hover:underline" href="../register_page/regist.php">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const pwInput = document.getElementById('password');
            const pwIcon = document.getElementById('pw-icon');

            if (pwInput.type === 'password') {
                pwInput.type = 'text';
                pwIcon.textContent = 'visibility_off';
            } else {
                pwInput.type = 'password';
                pwIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>