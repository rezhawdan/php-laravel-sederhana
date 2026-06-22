<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World - Laravel Sederhana</title>
    
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
            overflow: hidden;
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
            padding: 48px 32px;
            text-align: center;
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

        /* Laravel Logo styling */
        .logo-container {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--card-border);
            margin-bottom: 28px;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.05);
            transition: all 0.4s ease;
        }

        .logo-container:hover {
            transform: rotate(10deg) scale(1.05);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
        }

        .logo-svg {
            width: 36px;
            height: 36px;
            fill: #ff2d20;
            filter: drop-shadow(0 2px 8px rgba(255, 45, 32, 0.3));
        }

        /* Hello World Title */
        h1 {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 16px;
            animation: pulseText 3s infinite alternate;
        }

        @keyframes pulseText {
            0% { filter: drop-shadow(0 2px 10px rgba(129, 140, 248, 0.15)); }
            100% { filter: drop-shadow(0 2px 20px rgba(192, 132, 252, 0.3)); }
        }

        /* Subtitle */
        p {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Action Badge / Details */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--card-border);
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            cursor: default;
        }

        .status-badge:hover {
            color: var(--text-primary);
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.04);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }

        /* Register Button */
        .btn-register {
            display: inline-block;
            margin-bottom: 24px;
            padding: 12px 28px;
            background: var(--accent-gradient);
            border-radius: 12px;
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(129, 140, 248, 0.2);
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(129, 140, 248, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Success Alert */
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 24px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Ambient background glows -->
    <div class="ambient-glow"></div>
    <div class="ambient-glow-2"></div>

    <div class="container">
        <div class="card">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="flex-shrink: 0;">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Laravel Logo -->
            <div class="logo-container">
                <svg class="logo-svg" viewBox="0 0 62 65" xmlns="http://www.w3.org/2000/svg">
                    <path d="M61.817 15.414L32.49 1.4L3.163 15.414a3.02 3.02 0 00-1.745 2.712v28.026a3.02 3.02 0 001.745 2.712L32.49 62.88l29.327-14.015a3.02 3.02 0 001.745-2.712V18.126a3.02 3.02 0 00-1.745-2.712zM32.49 6.275l23.57 11.272-9.67 4.625-23.57-11.272 9.67-4.625zm-23.57 16.5l23.57 11.272v21.57L8.92 44.345V22.775zm47.14 21.57L36.06 55.617V34.047l23.57-11.272v21.57z"/>
                </svg>
            </div>

            <!-- Main Heading -->
            <h1>Hello World</h1>

            <!-- Description -->
            <p>Aplikasi web berbasis PHP Laravel sederhana berhasil disiapkan tanpa tool npm. Tampilan dimodifikasi menggunakan HTML &amp; CSS murni.</p>

            <!-- Action Button -->
            <div>
                <a href="{{ route('register') }}" class="btn-register">Registrasi User</a>
            </div>

            <!-- Status Badge -->
            <div class="status-badge">
                <span class="status-dot"></span>
                <span>Laravel v{{ app()->version() }} &bull; PHP v{{ PHP_VERSION }}</span>
            </div>
        </div>
    </div>

</body>
</html>
