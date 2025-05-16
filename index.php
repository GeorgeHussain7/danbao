<?php
// 启动会话
session_start();

// 包含必要的功能文件
require_once 'includes/functions.php';
require_once 'includes/auth.php';
require_once 'includes/transactions.php';

// 引入Telegram配置文件（如果存在）
if (file_exists(__DIR__ . '/config/telegram_config.php')) {
    require_once __DIR__ . '/config/telegram_config.php';
}

// 获取当前页面
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// 检查用户是否已登录
$isLoggedIn = isLoggedIn();
$userData = $isLoggedIn ? getUserData() : null;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>群担保系统</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/telegram-auth.css">
    <!-- 引入Feather图标库 -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- 引入Telegram Mini App脚本 -->
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>
    <div class="container" id="app">
        <?php 
        // 根据页面加载不同的内容
        switch($page) {
            case 'home':
                include 'pages/home.php';
                break;
            case 'create':
                include 'pages/create_transaction.php';
                break;
            case 'transaction':
                include 'pages/transaction_detail.php';
                break;
            case 'profile':
                include 'pages/profile.php';
                break;
            case 'telegram_auth':
                include 'pages/telegram_auth.php';
                break;
            default:
                include 'pages/home.php';
                break;
        }
        ?>
        
        <!-- 底部导航 -->
        <div class="bottom-nav">
            <a href="index.php" class="nav-item <?php echo ($page == 'home') ? 'active' : ''; ?>">
                <i data-feather="home"></i>
                <span>首页</span>
            </a>
            <a href="index.php?page=create" class="nav-item <?php echo ($page == 'create') ? 'active' : ''; ?>">
                <i data-feather="plus-circle"></i>
                <span>创建</span>
            </a>
            <a href="index.php?page=profile" class="nav-item <?php echo ($page == 'profile') ? 'active' : ''; ?>">
                <i data-feather="user"></i>
                <span>我的</span>
            </a>
        </div>
    </div>

    <!-- 初始化图标 -->
    <script>
        feather.replace();
    </script>
    <!-- 主要JavaScript文件 -->
    <script src="js/app.js"></script>
</body>
</html>