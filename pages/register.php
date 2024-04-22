<?php
if (filter_input(INPUT_POST, 'register', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
 // Get the form data 
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sziszam = $_POST['sziszam'];
        $lakcim = $_POST['lakcim'];
        $jogossz = $_POST['jogossz'];

        // Hash the password 
        $db->register($email, $username, $password, $sziszam, $lakcim, $jogossz);
}
?>

<div id="login">
    <div id="bg"></div>

    <form method="POST">
        <div class="form-field">
            <input type="email" placeholder="Email cím" name="email" required/>
        </div>
        <div class="form-field">
            <input type="text" placeholder="Felhasználónév" name="username" required/>
        </div>
                <div class="form-field">
            <input type="text" placeholder="Személyigazolvány száma" name="sziszam" required/>
        </div>
                <div class="form-field">
            <input type="text" placeholder="Lakcím" name="lakcim" required/>
        </div>
                <div class="form-field">
            <input type="text" placeholder="Jogosítvány száma" name="jogossz" required/>
        </div>
                <div class="form-field">
            <input type="password" placeholder="Jelszó" name="password" required/>
        </div>
        <div class="form-field">
            <button class="btn" type="submit" name="register" value="1">Regisztráció</button>
        </div>
    </form>
</div>