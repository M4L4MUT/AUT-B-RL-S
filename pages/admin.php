<?php

if (isset($_POST['delete_foglalas'])) {
    $foglalas_id = $_POST['foglalas_id'];
    $db->foglalasTorles($foglalas_id);

    $jarmu_id = $_POST['jarmu_id'];
    $db->lefoglalvaTorles($jarmu_id);
}
?>

<style>
    /* CSS stílusok */
    .scroll-container {
        width: 70%; 
        height: 20vw;
        overflow-y: auto;
        border: 1px solid #000; 
        padding: 15px;
        margin-left: 4vw;
    }
    #text {
        font-size: 1.5vw;
        padding-top: 3vh;
        margin-left: 10vw;
    }
    h2 {
        margin-bottom: 50px;
    }
    .container {
        text-align: center;
        overflow: hidden;
        width: 800px;
        margin: 0 auto;
    }
    .container table {
        width: 100%;
    }
    .container td, .container th {
        padding: 10px;
        
    }
    .container td:first-child, .container th:first-child {
        padding-left: 20px;
    }
    .container td:last-child, .container th:last-child {
        padding-right: 20px;
    }
    .container th {
        border-bottom: 1px solid #ddd;
        position: relative;
    }
    #adminfelosztas{
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 35% 75%;
        height: 50vh;
        width: 100vw;
        padding-left: 2vw;
        padding-right: 2vw;
    }
    #felhasznalok{
        grid-column-start: 1;
        grid-column-end: 1;
        grid-row-start: 1;
        grid-row-end: 1;
    }
    #foglalasok{
        grid-column-start: 2;
        grid-column-end: 2;
        grid-row-start: 1;
        grid-row-end: 1;
    }
    th, td{
        padding-left:2vw;
    }
</style>
<input type="search" class="light-table-filter" data-table="order-table" placeholder="Keresés"  style="text-align: center; margin-left: 40vw; margin-top: 2vh; "/>
<div id="adminfelosztas" style="width:98vw;">
    
<div id="felhasznalok">
    <h2 style="padding-left: 23%">Regisztrált felhasználók</h2>
    <div class="scroll-container">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Felhasználó</th>
                    <th>E-Mail cím</th>
                    <th>Jogosultság</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($db->osszesUser() as $row) { ?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <select id="select-<?= $row['username'] ?>" onchange="jogosultsagUpdate(this.value, '<?= $row['username'] ?>')">
                                <option value="regisztrált" <?= ($row['jogosultsag'] == 'regisztrált') ? 'selected' : '' ?>>Regisztrált</option>
                                <option value="admin" <?= ($row['jogosultsag'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <button onclick="mentes()">Mentés</button>
</div>

<script>
    function jogosultsagUpdate(newValue, username) {
        // Frissítsük a tárolt jogosultságot az adott felhasználóhoz
        document.getElementById('select-' + username).setAttribute('data-new-value', newValue);
    }

    function mentes() {
        // Gyűjtsük össze az összes módosított jogosultsági értéket és küldjük el a szerverre
        var selects = document.querySelectorAll('select');
        var changes = [];

        selects.forEach(function(select) {
            var username = select.id.split('-')[1];
            var newValue = select.getAttribute('data-new-value');
            if (newValue) {
                changes.push({ username: username, newValue: newValue });
            }
        });

        // Küldjük el az adatokat AJAX kéréssel a szerverre (például PHP fájlra)
        // Ehelyett implementáld a szükséges adatbázis frissítést vagy műveleteket
        console.log('Mentésre váró változtatások:', changes);
        
        // Töröljük az összes adott `data-new-value` attribútumot a frissítés után
        selects.forEach(function(select) {
            select.removeAttribute('data-new-value');
        });
    }
</script>
<script>
function mentes() {
    var selects = document.querySelectorAll('select');
    var changes = [];

    selects.forEach(function(select) {
        var username = select.id.split('-')[1];
        var newValue = select.getAttribute('data-new-value');
        if (newValue) {
            changes.push({ username: username, newValue: newValue });
        }
    });

    // Küldjük el az adatokat AJAX kéréssel a szerverre
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'frissit.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log('Sikeres mentés');
            // Töröljük az összes adott `data-new-value` attribútumot a frissítés után
            selects.forEach(function(select) {
                select.removeAttribute('data-new-value');
            });
        } else {
            console.error('Hiba történt a mentés során');
        }
    };

    xhr.onerror = function() {
        console.error('Hiba történt a mentés során');
    };

    xhr.send(JSON.stringify(changes));
}
</script>
<?php
// frissit.php

// Ellenőrizzük, hogy a POST adatokat megkaptuk-e
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ($request) {
    // Kapott adatok feldolgozása és adatbázis frissítése
    foreach ($request as $change) {
        $username = $change->username;
        $newValue = $change->newValue;

        // Frissítsd az adatbázist a $username felhasználó jogosultságával ($newValue)
        // Például:
        // $db->updateJogosultsag($username, $newValue);
    }

    // Válasz küldése a kliensnek
    http_response_code(200); // Sikeres kód (HTTP 200)
    echo json_encode(['message' => 'Sikeres mentés']);
} else {
    http_response_code(400); // Hibás kérés (HTTP 400)
    echo json_encode(['message' => 'Hibás kérés']);
}
?>

    <div id="foglalasok" style="margin-top: 0px;">
        <!-- Módosított foglalások rész, ahol az űrlapokat használjuk a törléshez -->
        <h2 style="padding-left: 15vw;">Foglalások kezelése</h2>
        <section class="scroll-container" style="width: 46vw; padding-left: 1vw; margin-left: 1vw;">
            
            <table class="order-table">
                <thead>
                    <tr>
                        <th style="padding-left: 1vw;">Foglalás</th>
                        <th>Felhasználónév</th>
                        <th>Felhasználó Email</th>
                        <th>Jármű</th>
                        <th>Kezdete</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="margin-bottom: 10vh;">
                    <?php
                    foreach ($db->osszesFoglalas() as $row) {
                        $user_id = $row['user_id'];
                        $username = $db->getUsername($user_id);
                        $useremail = $db->getUserEmail($user_id);
                        
                        $jarmu_id = $row['jarmu_id'];
                        $jarmumarka = $db ->getJarmuMarka($jarmu_id);
                        $jarmumodell = $db ->getJarmuModell($jarmu_id);
                        ?>
                        <tr>
                            <td><?= $row['foglalas_id'] ?></td>
                            <td><?= $username ?></td>
                            <td><?= $useremail ?></td>
                            <td><?= $jarmumarka?> - <?= $jarmumodell ?></td>
                            <td><?= $row['foglalasido'] ?></td>
                            <td>
                              
                                <form method="post">
                                    <input type="hidden" name="foglalas_id" value="<?= $row['foglalas_id'] ?>">
                                    <input type="hidden" name="jarmu_id" value="<?= $row['jarmu_id'] ?>">
                                    <button type="submit" name="delete_foglalas" style="padding: 3px; margin-bottom: 4vh;">Törlés</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

<script>
    (function (document) {
        'use strict';

        var LightTableFilter = (function (Arr) {

            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function (table) {
                    Arr.forEach.call(table.tBodies, function (tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function () {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function (input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function () {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

    })(document);
</script>
