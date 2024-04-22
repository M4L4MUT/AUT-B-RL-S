<?php
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}

if (filter_input(INPUT_POST, 'belepesiAdatok', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $username = htmlspecialchars(filter_input(INPUT_POST, 'InputUsername'));
    $password = htmlspecialchars(filter_input(INPUT_POST, 'InputPassword'));
    if ($db->login($username, $password)) {
        $_SESSION['login'] = true;
        echo '<script>alert("Sikeres bejelentkezés!");';
        echo 'window.location.href = "index.php";</script>';
        
    } else {
        echo '<script>alert("Hibás felhasználónév vagy jelszó!");</script>';
    }
}
?>

<div id="bg">
    <div style="max-width: 50vw; margin: 10vh auto; padding: 30px; background-color: #000; border: 2px solid #fff; border-radius: 20px; text-align: center; color: #fff;">
        <form action="#" method="post" novalidate>
        <div style="margin-bottom: 30px;">
            <label for="InputUsername" style="color: white;">Felhasználónév</label>
            <div class="input-group">
                <span class="input-group-text" id="inline_elem1" style="background-color: #8B0000; color: #fff;">
                    <i class="fa-solid fa-user"></i>
                </span>
                <input type="username" class="form-control" placeholder="Felhasználónév" id="InputUsername" name="InputUsername" autofocus required>
            </div>
            <hr style="border-color: #8B0000;">
            <label for="InputPassword" style="color: white;">Jelszó:</label>
            <div class="input-group">
                <span class="input-group-text" id="inline_elem2" style="background-color: #8B0000; color: #fff;">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" class="form-control" placeholder="Jelszó" id="InputPassword" name="InputPassword" autofocus required>
            </div>
            <hr style="border-color: #8B0000;">
        </div>
        <br>
        <div class="d-grid">
                <a href="index.php?menu=register" style="color: #fff; text-align: center; margin-bottom: 20px; display: block;">Még nem regisztráltál?</a>
                <button type="submit" name="belepesiAdatok" style="background-color: #8B0000; border: 2px solid #8B0000; color: white;" value="true">Bejelentkezés</button>
            </div>
        </form>
    </div>
</div>