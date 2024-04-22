<?php declare(strict_types=1) ?>
<?php
$userAdatok = null;
if ($_SESSION['login']) {
    $userAdatok = $db->getUser($_SESSION['InputUsername']);
}
if ($_SESSION['login']) {
}
?>
<nav>

    <img src="./images/red.png" style="height: auto; width: 10vw;">

    <ul>
        <?php
        if ($_SESSION['login'] && $userAdatok[0]["jogosultsag"] == "admin") {
           echo "<li><a class='nav-link' href='index.php?menu=admin'>Admin</a></li>";
        }
        ?>

        <li>
            <a class="nav-link" href="index.php?menu=fooldal">Kezdőlap</a>
        </li>

        <li>
            <a class="nav-link" href="index.php?menu=szerzodes">Bérlés menete</a>
        </li>
        <li>
            <a class="nav-link" href="index.php?menu=kapcsolat">Kapcsolat</a>
        </li>
        <li>
            <a class="nav-link" href="index.php?menu=rolunk">Rólunk</a>
        </li>
        <li>
            <?php
            if ($_SESSION['login'] == true) {
                echo '<a class="nav-link" href="index.php?menu=kijelentkezes">Kijelentkezés <i class="fa-solid fa-right-from-bracket"></i></a>';
            } else {
                echo '<a class="nav-link" href="index.php?menu=bejelentkezes"><i class="fa-solid fa-right-to-bracket"></i> Bejelentkezés</a>';
            }
            ?>
        </li>
    </ul>
    <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>
</nav>
<div class="menubar">
    <ul>
        <li>
            <a class="nav-link" href="index.php?menu=fooldal">Kezdőlap</a>
        </li>
        <li>
            <?php
            if ($_SESSION['login'] == true) {
                echo '<a class="nav-link" href="index.php?menu=kijelentkezes">Kijelentkezés</a>';
                echo "<script>console.log('User id: " . $_SESSION['user_id'] . "' );</script>";
            } else {
                echo '<a class="nav-link" href="index.php?menu=bejelentkezes">Belépés</a>';
            }
            ?>
        </li>
        <a class="nav-link" href="index.php?menu=szerzodes">Bérlés menete</a>
        </li>
        <li>
            <a class="nav-link" href="index.php?menu=kapcsolat">Kapcsolat</a>
        </li>
        <li>
            <a class="nav-link" href="index.php?menu=rolunk">Rólunk</a>
        </li>
    </ul>
</div>

<script>
    const mobileNav = document.querySelector(".hamburger");
    const navbar = document.querySelector(".menubar");

    const toggleNav = () => {
        navbar.classList.toggle("active");
        mobileNav.classList.toggle("hamburger-active");
    };
    mobileNav.addEventListener("click", () => toggleNav());

</script>

<?= $auto = filter_input(INPUT_GET, "auto"); ?>