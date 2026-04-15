<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify | Premium Event Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --spotify-green: #1DB954;
            --spotify-dark: #121212;
            --spotify-light-black: #181818;
            --spotify-grey: #b3b3b3;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--spotify-dark);
            color: var(--white);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            /* Efek cahaya hijau di pojok layar */
            background: radial-gradient(circle at top left, rgba(29, 185, 84, 0.15) 0%, rgba(18, 18, 18, 1) 40%);
        }

        .login-card {
            background: var(--spotify-light-black);
            padding: 3rem;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-name {
            font-weight: 800;
            font-size: 3rem;
            color: var(--spotify-green);
            letter-spacing: -2px;
            margin-bottom: 5px;
            transition: 0.3s;
            cursor: default;
        }

        .brand-name:hover {
            text-shadow: 0 0 20px rgba(29, 185, 84, 0.6);
        }

        .tagline {
            color: var(--spotify-grey);
            font-size: 0.9rem;
            margin-bottom: 2.5rem;
            font-weight: 300;
        }

        /* Styling Input Field */
        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #282828 !important;
            border: 1px solid transparent !important;
            color: var(--white) !important;
            border-radius: 8px !important;
            padding: 14px 18px !important;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--spotify-green) !important;
            box-shadow: 0 0 0 4px rgba(29, 185, 84, 0.1) !important;
            background-color: #333 !important;
        }

        .form-control::placeholder {
            color: #777;
        }

        /* Tombol Login Utama */
        .btn-login {
            background-color: var(--spotify-green);
            color: var(--white);
            border: none;
            border-radius: 500px;
            padding: 14px;
            width: 100%;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 10px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-login:hover {
            transform: scale(1.04);
            background-color: #1ed760;
            box-shadow: 0 10px 20px rgba(29, 185, 84, 0.3);
            color: black;
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* Garis Pemisah */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #444;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #333;
        }

        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }

        /* Tombol Sign Up */
        .signup-text {
            color: var(--spotify-grey);
            font-size: 0.9rem;
        }

        .btn-signup {
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            border-bottom: 2px solid transparent;
        }

        .btn-signup:hover {
            color: var(--spotify-green);
            border-bottom: 2px solid var(--spotify-green);
        }

        /* Link Lupa Password */
        .forgot-password {
            display: block;
            margin-top: 15px;
            font-size: 0.8rem;
            color: var(--spotify-grey);
            text-decoration: none;
            transition: 0.3s;
        }

        .forgot-password:hover {
            color: var(--white);
            text-decoration: underline;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem;
                margin: 15px;
            }
            .brand-name { font-size: 2.2rem; }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1 class="brand-name">Ticketify</h1>
        <p class="tagline">Hi! welcome to the website that provide your event and ticket things</p>

        <form>
            <div class="input-group-custom">
                <input type="email" class="form-control" placeholder="Email or username" required>
            </div>

            <div class="input-group-custom">
                <input type="password" class="form-control" placeholder="Password" required maxlength="20">
            </div>

            <button type="submit" class="btn btn-login">Log In</button>

            <a href="#" class="forgot-password">Forgot your password?</a>
        </form>

        <div class="divider">or</div>

        <div class="signup-section">
            <span class="signup-text">Don't have an account?</span><br>
            <a href="#" class="btn-signup mt-2 d-inline-block">SIGN UP FOR TICKETIFY</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
