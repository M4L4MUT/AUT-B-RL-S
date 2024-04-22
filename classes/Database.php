<?php

class Database {

    private $db = null;
    public $error = false;

    public function __construct($host, $username, $pass, $db) {
        try {
            $this->db = new mysqli($host, $username, $pass, $db);
            $this->db->set_charset("utf8");
        } catch (Exception $exc) {
            $this->error = true;
            echo '<p>Az adatbázis nem elérhető!</p>';
            exit();
        }
    }

    public function lefoglalvaTorles($jarmu_id) {
        $stmt1 = $this->db->prepare("UPDATE jarmuvek SET foglalas = 0 WHERE id = ?");
        $stmt1->bind_param("s", $jarmu_id);
        $stmt1->execute();
    }

    public function foglalasTorles($foglalas_id) {
        $stmt = $this->db->prepare("DELETE FROM foglalas WHERE foglalas_id = ?");
        $stmt->bind_param("i", $foglalas_id);
        $stmt->execute();
    }

    public function getUsername($user_id) {
        $stmt = $this->db->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();
        return $username;
    }

    public function getUserEmail($user_id) {
        $stmt = $this->db->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($useremail);
        $stmt->fetch();
        $stmt->close();
        return $useremail;
    }

    public function getJarmuMarka($jarmu_id) {
        $stmt = $this->db->prepare("SELECT marka FROM jarmuvek WHERE id = ?");
        $stmt->bind_param("i", $jarmu_id);
        $stmt->execute();
        $stmt->bind_result($jarmumarka);
        $stmt->fetch();
        $stmt->close();
        return $jarmumarka;
    }

    public function getJarmuModell($jarmu_id) {
        $stmt = $this->db->prepare("SELECT modell FROM jarmuvek WHERE id = ?");
        $stmt->bind_param("i", $jarmu_id);
        $stmt->execute();
        $stmt->bind_result($jarmumodell);
        $stmt->fetch();
        $stmt->close();
        return $jarmumodell;
    }

    public function osszesFoglalas() {
        $result = $this->db->query("SELECT * FROM `foglalas`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function osszesUser() {
        $result = $this->db->query("SELECT * FROM `users`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function osszesAdat() {
        $result = $this->db->query("SELECT DISTINCT marka, uzemanyag,szszam FROM `jarmuvek`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function osszesAuto() {
        $result = $this->db->query("SELECT * FROM `jarmuvek`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAuto($id) {
        $result = $this->db->query("SELECT * FROM `jarmuvek` WHERE id = " . $id);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUser($userName) {
        $sql = "SELECT * FROM `users` WHERE `username` LIKE '$userName'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKiemeltAjanlatok() {
        $result = $this->db->query("SELECT * FROM `jarmuvek`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMarka() {
        $result = $this->db->query("SELECT DISTINCT `marka` FROM `jarmuvek` WHERE 1 ORDER BY 1;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUzemanyag() {
        $result = $this->db->query("SELECT DISTINCT `uzemanyag` FROM `jarmuvek` WHERE 1 ORDER BY 1;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSzszam() {
        $result = $this->db->query("SELECT DISTINCT `szszam` FROM `jarmuvek` WHERE 1 ORDER BY 1;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function foglalas($id) {
        $stmt1 = $this->db->prepare("UPDATE jarmuvek SET foglalas = 1 WHERE id = ?");
        $stmt1->bind_param("s", $id);

        $stmt2 = $this->db->prepare("INSERT INTO foglalas (`user_id`, `jarmu_id`, `foglalasido`) VALUES (?, ?, CURRENT_TIME)");
        $stmt2->bind_param("ss", $_SESSION['user_id'], $id);

        $success = $stmt1->execute() && $stmt2->execute();

        if ($success) {
            header("Location: index.php?menu=fooldal");
            echo '<script type="text/javascript"> window.onload = function () { alert("Sikeres foglalás!"); }; </script>';
        } else {
            echo '<script type="text/javascript"> window.onload = function () { alert("Sikertelen foglalás!"); }; </script>';
        }
    }

    public function szures() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ellenőrizze, hogy az összes szükséges mezőt kitöltötték-e
            if (isset($_POST['marka']) && isset($_POST['uzemanyag']) && isset($_POST['szszam'])) {

                $marka = $this->db->real_escape_string(trim($_POST['marka']));
                $uzemanyag = $this->db->real_escape_string(trim($_POST['uzemanyag']));
                $szszam = $this->db->real_escape_string(trim($_POST['szszam']));

                $query = "SELECT * FROM `jarmuvek` WHERE 
                      `marka` LIKE '%$marka%' AND 
                      `uzemanyag` LIKE '%$uzemanyag%' AND 
                      `szszam` LIKE '%$szszam%'";

                $result = $this->db->query($query);

                if ($result !== false && $result->num_rows > 0) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    ?>
                    <script>
                        function mentes() {
                            var username = 'valami'; // Felhasználónév
                            var jogosultsag = 'regisztralt'; // Jogosultság érték

                            var data = {
                                username: username,
                                jogosultsag: jogosultsag
                            };

                            fetch('frissit.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            console.log('Sikeres frissítés');
                                            // Átirányítás a megfelelő oldalra, pl. index.php?menu=noresult
                                            window.location.href = './index.php?menu=noresult';
                                        } else {
                                            console.error('Hiba a frissítés során:', data.message);
                                            // Itt kezelheted a frissítési hibát
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Hálózati hiba:', error);
                                        // Itt kezelheted a hálózati hibát
                                    });
                        }
                    </script>
                    <?php

                    exit(); // Kilépés a PHP blokkból
                }
            }
        }

        return [];
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT `username`, `password`, `id` FROM `users` WHERE `username` LIKE ?;");
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['InputUsername'] = $row['username'];
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $row['id'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['InputUsername'] = '';
                $_SESSION['login'] = false;
                header("Location: index.php?menu=bejelentkezes");
                exit();
            }
            $result->free_result();
        }
        return false;
    }

    public function register($email, $username, $password, $sziszam, $lakcim, $jogossz) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, sziszam, lakcim, jogossz) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $email, $password, $sziszam, $lakcim, $jogossz);

        if ($stmt->execute()) {
            echo '<script type="text/javascript"> window.onload = function () { alert("Welcome at c-sharpcorner.com."); <script>';
            header("Location: index.php?menu=login");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
