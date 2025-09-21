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

// Generate data dummy untuk 30 hari terakhir (0-5 postingan per hari)
$chart_data = [];
$chart_labels = [];
$chart_values = [];

for ($i = 29; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $day_name = date('D', strtotime($date));
    $day_number = date('j', strtotime($date));
    
    // Generate random posting count (0-5) dengan pola yang lebih realistis
    // Weekend biasanya lebih sedikit posting
    if ($day_name === 'Sat' || $day_name === 'Sun') {
        $post_count = rand(0, 3);
    } else {
        $post_count = rand(0, 5);
    }
    
    $chart_labels[] = $day_number . ' ' . date('M', strtotime($date));
    $chart_values[] = $post_count;
    $chart_data[] = [
        'date' => $date,
        'count' => $post_count,
        'day_name' => $day_name
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pelacak Jumlah Postingan TikTok</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <!-- Chart Section -->
        <div class="chart-section">
            <h2>Grafik Postingan 30 Hari Terakhir</h2>
            <div class="chart-container">
                <canvas id="postingChart" width="400" height="200"></canvas>
            </div>
            <div class="chart-stats">
                <div class="chart-stat-item">
                    <span class="stat-label">Total Posting:</span>
                    <span class="stat-value"><?php echo array_sum($chart_values); ?></span>
                </div>
                <div class="chart-stat-item">
                    <span class="stat-label">Rata-rata per Hari:</span>
                    <span class="stat-value"><?php echo number_format(array_sum($chart_values) / 30, 1); ?></span>
                </div>
                <div class="chart-stat-item">
                    <span class="stat-label">Hari Paling Aktif:</span>
                    <span class="stat-value"><?php 
                        $max_day = array_keys($chart_values, max($chart_values))[0];
                        echo $chart_labels[$max_day] . ' (' . max($chart_values) . ' posting)';
                    ?></span>
                </div>
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
        // Data untuk grafik dari PHP
        const chartLabels = <?php echo json_encode($chart_labels); ?>;
        const chartValues = <?php echo json_encode($chart_values); ?>;
        
        // Konfigurasi Chart.js
        const ctx = document.getElementById('postingChart').getContext('2d');
        const postingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Posting per Hari',
                    data: chartValues,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return 'Tanggal: ' + context[0].label;
                            },
                            label: function(context) {
                                return 'Posting: ' + context.parsed.y + ' video';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Tanggal',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 10,
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Jumlah Posting',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        beginAtZero: true,
                        max: 5,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Auto refresh data setiap 30 detik (opsional)
        setInterval(function() {
            // Di sini bisa ditambahkan AJAX untuk refresh data real-time
            console.log('Data refreshed');
        }, 30000);
    </script>
</body>
</html>
