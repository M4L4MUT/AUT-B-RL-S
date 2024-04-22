<?php

//-- a visszaküldendő fájl tartalmának a beállítása
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Indítjuk a session-t
session_start();
$_SESSION['login'] = $_SESSION['login']?? false;



require_once './classes/Database.php';
$db = new Database("localhost", "root", "", "auto");

require_once './layout/head.php';
$menu = filter_input(INPUT_GET, "menu");
?>
<body>
    <?php
    require_once './layout/menu.php';
    require_once './tartalom.php';
    require_once './layout/footer.php';
    ?>
</body>
</html>
