<?php
// Logout script
session_start();

// Hapus semua data session
session_destroy();

// Redirect ke halaman login
header('Location: index.php');
exit();
?>
