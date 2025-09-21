<?php
// Dashboard setelah login TikTok berhasil
session_start();

// Simulasi data user (dalam implementasi nyata, ini akan didapat dari TikTok API)
$user_data = [
    'username' => 'user_tiktok',
    'display_name' => 'User TikTok',
    'follower_count' => 1250,
    'following_count' => 89,
    'video_count' => 45,
    'total_likes' => 12500,
    'total_views' => 250000
];

// Simulasi data postingan
$posts_data = [
    ['id' => 1, 'caption' => 'Video lucu hari ini #fyp', 'likes' => 250, 'views' => 5000, 'date' => '2024-01-15'],
    ['id' => 2, 'caption' => 'Tutorial masak simple', 'likes' => 180, 'views' => 3200, 'date' => '2024-01-14'],
    ['id' => 3, 'caption' => 'Dance challenge terbaru', 'likes' => 420, 'views' => 8500, 'date' => '2024-01-13'],
    ['id' => 4, 'caption' => 'Tips belajar coding', 'likes' => 95, 'views' => 2100, 'date' => '2024-01-12'],
    ['id' => 5, 'caption' => 'Makanan favorit', 'likes' => 320, 'views' => 6800, 'date' => '2024-01-11']
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pelacak Jumlah Postingan TikTok</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>Dashboard TikTok</h1>
            <div class="user-info">
                <span>Selamat datang, <?php echo htmlspecialchars($user_data['display_name']); ?>!</span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </header>

        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Followers</h3>
                <div class="stat-number"><?php echo number_format($user_data['follower_count']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Following</h3>
                <div class="stat-number"><?php echo number_format($user_data['following_count']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Video</h3>
                <div class="stat-number"><?php echo number_format($user_data['video_count']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Likes</h3>
                <div class="stat-number"><?php echo number_format($user_data['total_likes']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Views</h3>
                <div class="stat-number"><?php echo number_format($user_data['total_views']); ?></div>
            </div>
        </div>

        <!-- Posts Table -->
        <div class="posts-section">
            <h2>Daftar Postingan Terbaru</h2>
            <div class="table-container">
                <table class="posts-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Caption</th>
                            <th>Likes</th>
                            <th>Views</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts_data as $index => $post): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($post['caption']); ?></td>
                            <td><?php echo number_format($post['likes']); ?></td>
                            <td><?php echo number_format($post['views']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($post['date'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="summary-section">
            <h2>Ringkasan</h2>
            <div class="summary-cards">
                <div class="summary-card">
                    <h4>Rata-rata Likes per Video</h4>
                    <div class="summary-number">
                        <?php echo number_format($user_data['total_likes'] / $user_data['video_count']); ?>
                    </div>
                </div>
                <div class="summary-card">
                    <h4>Rata-rata Views per Video</h4>
                    <div class="summary-number">
                        <?php echo number_format($user_data['total_views'] / $user_data['video_count']); ?>
                    </div>
                </div>
                <div class="summary-card">
                    <h4>Engagement Rate</h4>
                    <div class="summary-number">
                        <?php echo number_format(($user_data['total_likes'] / $user_data['total_views']) * 100, 2); ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto refresh data setiap 30 detik (opsional)
        setInterval(function() {
            // Di sini bisa ditambahkan AJAX untuk refresh data real-time
            console.log('Data refreshed');
        }, 30000);
    </script>
</body>
</html>
