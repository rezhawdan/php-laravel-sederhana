<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi User - Laravel Sederhana</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-gradient: radial-gradient(circle at 50% 50%, #1a1a2e 0%, #0f0f1b 100%);
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --accent-primary: #4f46e5;
            --accent-gradient: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
            --glow-color: rgba(99, 102, 241, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Glow Background elements */
        .ambient-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, rgba(0,0,0,0) 70%);
            top: -10%;
            left: -10%;
            z-index: 1;
            animation: drift 25s infinite alternate ease-in-out;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(192, 132, 252, 0.1) 0%, rgba(0,0,0,0) 70%);
            bottom: -15%;
            right: -10%;
            z-index: 1;
            animation: drift 30s infinite alternate-reverse ease-in-out;
        }

        @keyframes drift {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, 80px) scale(1.1); }
            100% { transform: translate(-30px, -40px) scale(0.9); }
        }

        /* Content Container */
        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            padding: 24px;
        }

        /* Glassmorphism Card */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3),
                        0 0 50px var(--glow-color);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Title */
        h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            text-align: center;
        }

        p.subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 32px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }

        .input-wrapper {
            position: relative;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        input:focus {
            outline: none;
            border-color: #818cf8;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 15px rgba(129, 140, 248, 0.25);
        }

        .invalid-feedback {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: var(--accent-gradient);
            border: none;
            border-radius: 12px;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(129, 140, 248, 0.2);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(129, 140, 248, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .footer-links {
            text-align: center;
            margin-top: 24px;
        }

        .back-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--text-primary);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Ambient background glows -->
    <div class="ambient-glow"></div>
    <div class="ambient-glow-2"></div>

    <div class="container">
        <div class="card">
            <h1>Registrasi User</h1>
            <p class="subtitle">Silakan isi formulir di bawah untuk membuat akun baru.</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required autocomplete="name" autofocus>
                    </div>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@domain.com" required autocomplete="email">
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password Anda" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit">Daftar Sekarang</button>
            </form>

            <div class="footer-links">
                <a href="{{ route('home') }}" class="back-link">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</body>
</html>
