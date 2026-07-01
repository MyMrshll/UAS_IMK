<?php
include '../config/koneksi.php';

if (isset($_POST['register'])) {

    $nama = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Encrypt password
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek email sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        echo "
        <script>
            alert('Email sudah digunakan!');
            window.location='register.php';
        </script>
        ";
    } else {

        // Insert data
        $query = mysqli_query($conn, "INSERT INTO users 
        (nama, email, password, role) 
        VALUES 
        ('$nama','$email','$hash_password','$role')");

        if ($query) {
            echo "
            <script>
                alert('Register berhasil!');
                window.location='login.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Register gagal!');
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Register | UMKM Market</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#ffdbcb",
                        "secondary-fixed-dim": "#adc6ff",
                        "outline": "#757682",
                        "secondary-fixed": "#d8e2ff",
                        "tertiary-container": "#6e2c00",
                        "surface-variant": "#e1e2e4",
                        "inverse-on-surface": "#f0f1f3",
                        "secondary-container": "#2170e4",
                        "error-container": "#ffdad6",
                        "on-primary-fixed-variant": "#264191",
                        "inverse-surface": "#2e3132",
                        "primary-fixed-dim": "#b6c4ff",
                        "primary-fixed": "#dce1ff",
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "surface-tint": "#4059aa",
                        "surface-container-low": "#f3f4f6",
                        "background": "#f8f9fb",
                        "surface-container-highest": "#e1e2e4",
                        "secondary": "#0058be",
                        "surface-dim": "#d9dadc",
                        "on-primary-container": "#90a8ff",
                        "surface-bright": "#f8f9fb",
                        "tertiary-fixed-dim": "#ffb691",
                        "on-tertiary-fixed-variant": "#773205",
                        "primary-container": "#1e3a8a",
                        "error": "#ba1a1a",
                        "on-surface": "#191c1e",
                        "outline-variant": "#c5c5d3",
                        "surface": "#f8f9fb",
                        "on-surface-variant": "#444651",
                        "surface-container-high": "#e7e8ea",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#b6c4ff",
                        "on-tertiary": "#ffffff",
                        "primary": "#00236f",
                        "on-background": "#191c1e",
                        "tertiary": "#4b1c00",
                        "surface-container": "#edeef0",
                        "on-secondary-container": "#fefcff",
                        "on-primary-fixed": "#00164e",
                        "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#004395",
                        "on-tertiary-fixed": "#341100",
                        "on-tertiary-container": "#f39461",
                        "on-secondary-fixed": "#001a42",
                        "on-secondary": "#ffffff",
                        "emerald-success": "#10B981"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "sm": "8px",
                        "xs": "4px",
                        "2xl": "48px",
                        "md": "16px",
                        "xl": "32px",
                        "3xl": "64px",
                        "lg": "24px",
                        "base": "4px",
                        "gutter": "24px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-xl": ["Plus Jakarta Sans"],
                        "body-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fb;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .form-input-focus:focus {
            border-color: #2170e4;
            box-shadow: 0 0 0 4px rgba(33, 112, 228, 0.1);
        }

        .role-card.active {
            border-color: #00236f;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-md relative overflow-x-hidden">
    <!-- Animated background element -->
    <div class="fixed inset-0 -z-10">

    </div>
    <!-- Main Registration Container -->
    <main class="w-full max-w-[1100px] grid md:grid-cols-2 shadow-2xl rounded-xl overflow-hidden glass-panel">
        <!-- Left Side: Visual/Branding (Hidden on mobile) -->
        <section class="hidden md:flex flex-col justify-between p-2xl bg-primary text-white relative overflow-hidden">
            <div class="z-10">
                <div class="flex items-center gap-sm mb-3xl">
                    <span class="material-symbols-outlined text-[32px] text-primary-fixed">storefront</span>
                    <h1 class="font-headline-md text-headline-md font-bold tracking-tight">UMKM Market</h1>
                </div>
                <h2 class="font-headline-xl text-headline-xl mb-md">Empowering Local Artisans Worldwide.</h2>
                <p class="font-body-lg text-body-lg text-primary-fixed-dim max-w-sm opacity-90">
                    Join a community of over 10,000 sellers bridging the gap between traditional craftsmanship and the
                    modern digital economy.
                </p>
            </div>
            <!-- Testimonial or Stat -->
            <div class="z-10 glass-panel !bg-white/10 p-lg rounded-xl border-white/20">
                <div class="flex items-center gap-sm mb-xs">
                    <div class="flex text-tertiary-fixed">
                        <span class="material-symbols-outlined fill-1"
                            style="font-variation-settings: 'FILL' 1">star</span>
                        <span class="material-symbols-outlined fill-1"
                            style="font-variation-settings: 'FILL' 1">star</span>
                        <span class="material-symbols-outlined fill-1"
                            style="font-variation-settings: 'FILL' 1">star</span>
                        <span class="material-symbols-outlined fill-1"
                            style="font-variation-settings: 'FILL' 1">star</span>
                        <span class="material-symbols-outlined fill-1"
                            style="font-variation-settings: 'FILL' 1">star</span>
                    </div>
                </div>
                <p class="font-body-md text-body-md italic mb-sm">"UMKM Market transformed my small pottery workshop
                    into a national brand. Registration was the best decision for my business."</p>
                <div class="flex items-center gap-sm">
                    <div class="w-10 h-10 rounded-full bg-surface-container"
                        data-alt="A professional studio portrait of a smiling middle-aged Indonesian woman artisan, wearing traditional batik clothing, in a brightly lit pottery studio with soft-focus clay vessels in the background. High-end editorial photography style with warm, natural lighting."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBnakaK-DHKzvLLyxfsvkp495WjbiW16PJIg5TLm-K8oLL1e4zUS5cedw7GS5cltnJTd8OaC7tU_o7jGdq1NvY7wcH_67pgECFQjv5dHGeeBzlD3866kNKUnl2pyAN2hl1U9xSw0-8TNmxdcAOSdj1WEv1KlKPyzcl-sqkl6GCSw9IGEaMFH45CUyPMRzgC6ZlCrnxD1debSPpOwgQKc-vPJFq4khplZJCNh7rB062e1y5gPE29EZgM')">
                    </div>
                    <div>
                        <p class="font-label-lg text-label-lg">Siti Aminah</p>
                        <p class="font-label-md text-label-md text-primary-fixed-dim">Master Crafter</p>
                    </div>
                </div>
            </div>
            <!-- Background Decoration -->
            <div
                class="absolute bottom-[-10%] right-[-10%] w-64 h-64 bg-secondary rounded-full blur-[100px] opacity-30">
            </div>
        </section>
        <!-- Right Side: Form -->
        <section class="p-lg md:p-2xl flex flex-col justify-center bg-white">
            <div class="mb-xl">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Create Account</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Start your journey with the local
                    craftsmanship community.</p>
            </div>
            <form class="space-y-md" id="registerForm" method="POST">
                <!-- Role Selection -->
                <div class="grid grid-cols-2 gap-sm mb-lg">
                    <button
                        class="role-card active group flex flex-col items-center p-md border-2 rounded-xl transition-all duration-200 hover:bg-surface-container-low"
                        id="role-buyer" onclick="selectRole('buyer')" type="button">
                        <span
                            class="material-symbols-outlined text-3xl mb-xs text-primary group-[.active]:text-secondary">shopping_bag</span>
                        <span class="font-label-lg text-label-lg">Buyer</span>
                    </button>
                    <button
                        class="role-card group flex flex-col items-center p-md border-2 border-outline-variant rounded-xl transition-all duration-200 hover:bg-surface-container-low"
                        id="role-seller" onclick="selectRole('seller')" type="button">
                        <span
                            class="material-symbols-outlined text-3xl mb-xs text-outline group-[.active]:text-secondary">storefront</span>
                        <span class="font-label-lg text-label-lg">Seller</span>
                    </button>
                    <input id="selected-role" name="role" type="hidden" value="buyer" />
                </div>
                <!-- Full Name -->
                <div class="space-y-xs">
                    <label class="font-label-lg text-label-lg text-on-surface" for="fullname">Full Name</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">person</span>
                        <input
                            class="w-full pl-11 pr-md py-3 bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-body-md form-input-focus outline-none transition-all"
                            id="fullname" name="fullname" placeholder="John Doe" required="" type="text" />
                    </div>
                </div>
                <!-- Email -->
                <div class="space-y-xs">
                    <label class="font-label-lg text-label-lg text-on-surface" for="email">Email Address</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
                        <input
                            class="w-full pl-11 pr-md py-3 bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-body-md form-input-focus outline-none transition-all"
                            id="email" name="email" placeholder="name@example.com" required="" type="email" />
                    </div>
                    <p class="hidden text-error font-label-md text-label-md mt-1" id="email-error">Please enter a valid
                        email address.</p>
                </div>
                <!-- Password -->
                <div class="space-y-xs">
                    <label class="font-label-lg text-label-lg text-on-surface" for="password">Password</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                        <input
                            class="w-full pl-11 pr-xl py-3 bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-body-md form-input-focus outline-none transition-all"
                            id="password" name="password" placeholder="••••••••" required="" type="password" />
                        <button
                            class="absolute right-md top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                            onclick="togglePassword()" type="button">
                            <span class="material-symbols-outlined text-[20px]"
                                id="password-toggle-icon">visibility</span>
                        </button>
                    </div>
                    <div class="flex gap-xs mt-sm">
                        <div class="h-1 flex-1 bg-surface-container rounded-full transition-colors" id="strength-1">
                        </div>
                        <div class="h-1 flex-1 bg-surface-container rounded-full transition-colors" id="strength-2">
                        </div>
                        <div class="h-1 flex-1 bg-surface-container rounded-full transition-colors" id="strength-3">
                        </div>
                        <div class="h-1 flex-1 bg-surface-container rounded-full transition-colors" id="strength-4">
                        </div>
                    </div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Minimum 8 characters with mix of
                        letters and numbers.</p>
                </div>
                <!-- Terms -->
                <div class="flex items-start gap-sm py-sm">
                    <div class="flex items-center h-5">
                        <input
                            class="w-4 h-4 text-secondary border-outline-variant rounded focus:ring-secondary cursor-pointer"
                            id="terms" name="terms" required="" type="checkbox" />
                    </div>
                    <label class="font-body-sm text-body-sm text-on-surface-variant" for="terms">
                        I agree to the <a class="text-secondary font-semibold hover:underline" href="#">Terms of
                            Service</a> and <a class="text-secondary font-semibold hover:underline" href="#">Privacy
                            Policy</a>.
                    </label>
                </div>
                <!-- Submit Button -->
                <button
                    class="w-full py-3 px-xl bg-primary text-white font-label-lg text-label-lg rounded-lg shadow-lg shadow-primary/20 hover:bg-primary-container active:scale-[0.98] transition-all flex justify-center items-center gap-sm"
                    id="submitBtn" type="submit" name="register">

                    Create Account
                    <span class="material-symbols-outlined text-[20px]">
                        arrow_forward
                    </span>
                </button>

                <!-- Social Register -->
                <div class="relative py-lg">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant/30"></div>
                    </div>
                    <div class="relative flex justify-center text-label-md text-label-md uppercase tracking-wider"><span
                            class="bg-white px-md text-outline">Or register with</span></div>
                </div>
                <div class="grid grid-cols-2 gap-md">
                    <button
                        class="flex items-center justify-center gap-sm py-2.5 px-md border border-outline-variant rounded-lg hover:bg-surface-container-low transition-all"
                        type="button">
                        <img alt="Google" class="w-5 h-5"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFvyMERCVkXt9qWFJlvTFOLi45dRMme9j9rvtiP51yU9T1FhMoKo7PxKXuHTm77QHAhVzxd671CGwJT7h03OR81Wo3Z5HtVP4IkbRU84H2XlK4RerE8fciR1f3YUhgkGpOe3iy1r5Sz4ljY4RNWuOnCLs2FY7gOhozEuZgAYytzWjpg3Dfwfb-SMCKAsYV6PZdLigUiEL8K8-4L-22ASWLd0nTEzAJw2bX2xRqI-6ioirSWUwMi_T8" />
                        <span class="font-label-lg text-label-lg">Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-sm py-2.5 px-md border border-outline-variant rounded-lg hover:bg-surface-container-low transition-all"
                        type="button">
                        <img alt="Facebook" class="w-5 h-5"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCa_s0RQeyYccBPu4fXzDeborNerYn-TLuYdtAuVQpUgjnKUP9DoSPZ-AA0mR8stR_9-qsdjPZd8wGG3WfD3t3OpA5JH5C9nV45dJWJE5y7HmXILkJcQJrYjRFuXQbUvcUvKOXYdC5NGdzYT-Smaq3D1j9yZrLgIDDKsyp7oG7GD40ED0Su53Ldx0Qc4Pvz9jz_E1FueO5Os48X6arRCaHnYX_sBA0Dcula4wNdnpGsVV1qyF_W1Yre" />
                        <span class="font-label-lg text-label-lg">Facebook</span>
                    </button>
                </div>
            </form>
            <p class="mt-2xl text-center font-body-md text-body-md text-on-surface-variant">
                Already have an account? <a class="text-secondary font-bold hover:underline" href="../login_page/login.php">Login here</a>
            </p>
        </section>
    </main>
    <!-- Feedback Toasts Container -->
    <div class="fixed bottom-xl right-xl z-[100] flex flex-col gap-sm" id="toast-container"></div>
    <script>
        function selectRole(role) {
            document.getElementById('selected-role').value = role;
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('active', 'border-secondary', 'bg-surface-container-low');
                card.classList.add('border-outline-variant');
            });
            const activeCard = document.getElementById(`role-${role}`);
            activeCard.classList.add('active', 'border-secondary', 'bg-surface-container-low');
            activeCard.classList.remove('border-outline-variant');
        }

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('password-toggle-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Password strength meter logic
        const passwordInput = document.getElementById('password');
        passwordInput.addEventListener('input', function () {
            const val = this.value;
            const strengths = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];

            // Reset
            strengths.forEach(s => s.className = 'h-1 flex-1 bg-surface-container rounded-full transition-all');

            let score = 0;
            if (val.length > 5) score++;
            if (val.length > 8) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[!@#$%^&*]/.test(val)) score++;

            const colors = ['bg-error', 'bg-tertiary-fixed-dim', 'bg-secondary-fixed-dim', 'bg-emerald-success'];
            for (let i = 0; i < score; i++) {
                strengths[i].classList.remove('bg-surface-container');
                strengths[i].classList.add(colors[score - 1]);
            }
        });

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            const colorClass = type === 'success' ? 'bg-emerald-success' : 'bg-error';
            const icon = type === 'success' ? 'check_circle' : 'error';

            toast.className = `flex items-center gap-sm ${colorClass} text-white px-lg py-md rounded-xl shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 ease-out`;
            toast.innerHTML = `
                <span class="material-symbols-outlined">${icon}</span>
                <span class="font-label-lg text-label-lg">${message}</span>
            `;

            container.appendChild(toast);

            // Animate In
            setTimeout(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
            }, 10);

            // Auto Remove
            setTimeout(() => {
                toast.classList.add('translate-y-[-20px]', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function handleRegister(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const originalContent = btn.innerHTML;

            // Simulate Loading
            btn.disabled = true;
            btn.innerHTML = `<span class="animate-spin material-symbols-outlined">progress_activity</span> Processing...`;

            setTimeout(() => {
                const email = document.getElementById('email').value;
                if (!email.includes('@')) {
                    document.getElementById('email-error').classList.remove('hidden');
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                    showToast('Registration failed. Please check your details.', 'error');
                } else {
                    document.getElementById('email-error').classList.add('hidden');
                    showToast('Account created successfully! Redirecting...', 'success');

                    // Trigger some sparkle effect or minor confetti could go here

                    setTimeout(() => {
                        btn.innerHTML = `<span class="material-symbols-outlined">verified</span> Account Verified`;
                        // Real app: window.location.href = 'dashboard.php';
                    }, 1000);
                }
            }, 1500);

            return false;
        }

        // Initialize micro-interactions
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#2170e4';
            });
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#757682';
            });
        });
    </script>
</body>

</html>