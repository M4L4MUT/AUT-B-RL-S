<?php

switch ($menu) {
    case 'fooldal':
        require_once './pages/fooldal.php';
        break;
    case 'admin':
        require_once './pages/admin.php';
        break;
    case 'kapcsolat':
        require_once './pages/kapcsolat.php';
        break;
    case 'rolunk':
        require_once './pages/rolunk.php';
        break;
    case 'kivalasztottauto':
        require_once './pages/kivalasztottauto.php';
        break;
    case 'lefoglalas':
        //-- id ellőrzés!!! ----
        $db->foglalas($_GET['id']);
        require_once './pages/kivalasztottauto.php';
        break;
    case 'szurtautok':
        require_once './pages/szurtautok.php';
        break;
    case 'register':
        require_once './pages/register.php';
        break;
    case 'bejelentkezes':
        require_once './pages/login.php';
        break;
    case 'kijelentkezes':
        require_once './pages/logout.php';
        break;
    case 'szerzodes':
        require_once './pages/szerzodes.php';
        break;
    case 'noresult';
        require_once './pages/noresult.php';
        break;
    default:
        require_once './pages/fooldal.php';
        break;
}

