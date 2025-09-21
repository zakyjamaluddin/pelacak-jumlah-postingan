<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login TikTok - Pelacak Jumlah Postingan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h1>Pelacak Jumlah Postingan TikTok</h1>
            <p>Silakan login dengan akun TikTok Anda untuk melanjutkan</p>
            
            <!-- TikTok Login Button -->
            <div class="tiktok-login">
                <button id="tiktok-login-btn" class="tiktok-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                    </svg>
                    Login dengan TikTok
                </button>
            </div>
            
            <!-- Status Message -->
            <div id="status-message" class="status-message"></div>
            
            <!-- Legal Links -->
            <div class="legal-links">
                <p>Dengan menggunakan aplikasi ini, Anda menyetujui</p>
                <a href="terms-of-service.php" target="_blank">Terms of Service</a> dan 
                <a href="privacy-policy.php" target="_blank">Privacy Policy</a> kami.
            </div>
        </div>
    </div>

    <!-- TikTok Login Kit Script -->
    <script>
        // TikTok Login Kit Configuration
        const tiktokLoginConfig = {
            clientKey: 'YOUR_TIKTOK_CLIENT_KEY', // Ganti dengan Client Key Anda
            redirectUri: 'http://localhost/pelacak-jumlah-postingan/dashboard.php', // URL redirect setelah login
            scope: 'user.info.basic', // Scope yang diperlukan
            state: 'random_state_string' // State untuk keamanan
        };

        // Function untuk handle TikTok login
        function initTikTokLogin() {
            const loginBtn = document.getElementById('tiktok-login-btn');
            const statusMessage = document.getElementById('status-message');
            
            loginBtn.addEventListener('click', function() {
                // URL untuk TikTok OAuth
                const authUrl = `https://www.tiktok.com/auth/authorize/` +
                    `?client_key=${tiktokLoginConfig.clientKey}` +
                    `&scope=${tiktokLoginConfig.scope}` +
                    `&response_type=code` +
                    `&redirect_uri=${encodeURIComponent(tiktokLoginConfig.redirectUri)}` +
                    `&state=${tiktokLoginConfig.state}`;
                
                // Redirect ke TikTok OAuth
                window.location.href = authUrl;
            });
        }

        // Initialize TikTok Login saat halaman dimuat
        document.addEventListener('DOMContentLoaded', initTikTokLogin);

        // Handle callback dari TikTok (jika ada error)
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const errorDescription = urlParams.get('error_description');
        
        if (error) {
            document.getElementById('status-message').innerHTML = 
                `<div class="error">Error: ${errorDescription || error}</div>`;
        }
    </script>
</body>
</html>
