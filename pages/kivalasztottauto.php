<div id="kivalasztottauto">
<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$autoAdatok = $db->getAuto($id);
if ($autoAdatok) {
    $imagePath = "./autokepek/" . $autoAdatok[0]['modell']."/kep1";
    $imageExtensions = ['jpg', 'png', 'jpeg', 'jfif'];
    foreach ($imageExtensions as $extension) {
        if (file_exists("$imagePath.$extension")) {
            $image = "$imagePath.$extension";
            break;
        }
    }

    if (!isset($image)) {
        $image = "./images/noimage.jpg";
    }
}

$modellneve = $autoAdatok[0]['modell'];

function reklamsav() {


    $html = '<div id="reklamsav">'
            . '<img id="image1" src="./Design/reklam1.jpg" style="width: 100%; height: 100%; alt="Első kép" ">'
            . '<img id="image2" src="./Design/reklam2.jpg" style="width: 100%; height: 100%; alt="Második kép" ">'
            . '</div>';
    return $html;
}

function jarmuleiras() {
    global $autoAdatok;
    if ($autoAdatok[0]['foglalas'] == 0) {
        $html = '<form method="POST" action="index.php?menu=lefoglalas&id='.$autoAdatok[0]['id'].'"><div id="jarmuLeiras">'
            . "<div style='font-size: 3vw; font-style: inherit; color: black; text-align: center; padding-top: 10px; font-family: cursive; font-weight: bold;'><p>" . $autoAdatok[0]['marka'] . " " . $autoAdatok[0]['modell'] . " " . $autoAdatok[0]['motor'] . " bérelhető!</p></div>"
            . "<table>"
            . "<tr><td class='o1'>Üzemanyag:</td> <td class='o2'>" . $autoAdatok[0]['uzemanyag'] . "</td></tr>"
            . "<tr><td class='o1'>Kilométeróra állás: </td> <td class='o2'>" . $autoAdatok[0]['km'] . " Km</td></tr>"
            . "<tr><td class='o1'>Kaukció: </td> <td class='o2'>" . $autoAdatok[0]['kaukcio'] . " Ft</td></tr>"
            . "<tr><td class='o1'>Bérleti díj: </td> <td class='o2'>" . $autoAdatok[0]['berletidij'] . " Ft</td></tr>"
            . "<tr><td class='o1'>Szállítható Személyek: </td> <td class='o2'>" . $autoAdatok[0]['szszam'] . " Fő</td></tr>"
            . "<tr><td class='o1'>Fogyasztás </td> <td class='o2'>" . $autoAdatok[0]['fogyasztas'] . " L /100Km</td></tr>"
            . "</table>";
        
            if (isset($_SESSION['login']) && $_SESSION['login']) {
        $html .= "<button class='btn' type='submit' style='margin: auto; display: flex;' onclick='foglalas()' id='kiberlesgomb' name='berlesGomb' value='1'>Kibérlés</button>";
    } else {
        $html .= "<button class='btn' id='customAlert' type='button' style='margin: auto; display: flex;' onclick='bejelentkezesSzukseg();'>Kibérlés</button>";
    }
        
        
    }
    
    
    
    
    
    
    
    else {
        $html = '<form method="POST" action="index.php?menu=lefoglalas&id='.$autoAdatok[0]['id'].'"><div id="jarmuLeiras">'
            . "<div style='font-size: 3vw; font-style: inherit; color: black; text-align: center; padding-top: 10px; font-family: cursive; font-weight: bold;'><p>" . $autoAdatok[0]['marka'] . " " . $autoAdatok[0]['modell'] . " " . $autoAdatok[0]['motor'] . " lefoglalva!</p></div>"
            . "<table>"
            . "<tr><td class='o1'>Üzemanyag:</td> <td class='o2'>" . $autoAdatok[0]['uzemanyag'] . "</td></tr>"
            . "<tr><td class='o1'>Kilométeróra állás: </td> <td class='o2'>" . $autoAdatok[0]['km'] . " Km</td></tr>"
            . "<tr><td class='o1'>Kaukció: </td> <td class='o2'>" . $autoAdatok[0]['kaukcio'] . " Ft</td></tr>"
            . "<tr><td class='o1'>Bérleti díj: </td> <td class='o2'>" . $autoAdatok[0]['berletidij'] . " Ft</td></tr>"
            . "<tr><td class='o1'>Szállítható Személyek: </td> <td class='o2'>" . $autoAdatok[0]['szszam'] . " Fő</td></tr>"
            . "<tr><td class='o1'>Fogyasztás </td> <td class='o2'>" . $autoAdatok[0]['fogyasztas'] . " L /100Km</td></tr>"
            . "</table>";
        
    }

    $html .= '</div></form>';
    $html .= '<script>
        function foglalas(){
            alert("Foglalás sikeres! Kérjük vegye fel velünk a kapcsolatot a bérlés megkezdéséhez! ");
        }

        function bejelentkezesSzukseg() {
            alert("Be kell jelentkezni a foglaláshoz!");
        }
    </script>';

    return $html;
}

function jarmuKep() {
    global $autoAdatok;
    global $image;
    if ($autoAdatok[0]['foglalas'] == 1) {
        $html = '<div id="jarmuKep" style="position: relative">'
            . '<img style="width: 80%; height: auto;" src="' . $image . '" alt="' . $autoAdatok[0]['modell'] . ' kép" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">'
            . '<div class="kis-kep-container" style="position: absolute; top: 30%; left: 40%; width: 30vw; height: auto; transform: translate(-50%, -50%);"><img src="./images/lefoglalva.png" style="width: 30vw; height: auto;" onclick="openModal();currentSlide(1)"></div>'
            . '</div>';
    return $html;
    }
    
    else {
    $html = '<div id="jarmuKep">'
            . '<img style="width: 80%; height: auto;" src="' . $image . '" alt="' . $autoAdatok[0]['modell'] . ' kép" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">'
            . '</div>';
    return $html;
}}

function tajekoztato() {
    $html = '<div id="tajekoztato">
      <p>Kérjük ne feledje, nem csak a képeket érdemes megnézni, a szöveges leírások, bérleti feltételek elolvasása is hasznos.</p>
      <p> Az áraknál induló napi árak vannak feltüntetve.</p>
      <p> Az árak mindig egyediek, mely függ a bérelt napok számától, a megtett km-től, és a célországtól.</p>
      <p>Ezek vonatkoznak belföldre, külföldre. Napi km korlát nincs meghatározva.</p>
    </div>';
    return $html;
}

?>

<div id="felosztas">
    <?php
    echo reklamsav();
    echo jarmuleiras();

    echo jarmuKep();
    echo tajekoztato();
    ?>
<div id="kiemeltAjanlatok">
    <h2 style="font-style: inherit; font-size: 2vw;">Kiemelt ajánlatunk</h2>
    <hr style="width: 40vw; border-bottom: 2px solid #333;  ">
    <div style="text-align: center; padding-right: 100px;">
        <?php
        $a = 0;
        foreach ($db->osszesAuto() as $row) {
            $image = file_exists("./autokepek/" . $row['modell'] . "/kep1.jpg") ? "./autokepek/" . $row['modell'] . "/kep1.jpg" : "./images/noimage.jpg";
            if ($a < 4) {
        ?>
            <a href="index.php?menu=kivalasztottauto&id=<?php echo $row["id"]; ?>" style="text-decoration: none; display: inline-block; margin: 25px;">
                <div class="card" style="width: 15vw; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <img src="<?= $image ?>" class="card-img-top" alt="Car Image" style="width: 100%; height: auto;">
                    <div class="info">
                        <h3 style="margin:  0; font-size: 1.5vw;"><?= $row['marka'] ?> <?= $row['modell'] ?></h3>
                        <p style="margin: 0; font-size: 1.5vw; color: red;"><?= $row['berletidij'] ?>Ft / nap</p>
                    </div>
                </div>
            </a>
        <?php
                $a++;
                if ($a % 4 == 0) { // Ha minden negyedik képnél vagyunk, tegyünk sorváltást
                    echo '<br>';
                }
            }
        }
        ?>
    </div>
</div></div>

<script>
    let currentImage = 1;
    document.getElementById('image1').style.display = 'block';
    document.getElementById('image2').style.display = 'none';
    function changeImage() {

        if (currentImage === 1) {
            document.getElementById('image1').style.display = 'block';
            document.getElementById('image2').style.display = 'none';
            currentImage = 2;
        } else {
            document.getElementById('image1').style.display = 'none';
            document.getElementById('image2').style.display = 'block';
            currentImage = 1;
        }
    }

    setInterval(changeImage, 5000);
</script>

<div id="myModal" class="modal">
    <span class="close cursor" style="margin-right: 15%; padding-top: 5vh;" onclick="closeModal()">&times;</span>
    <div class="modal-content">

       
        <a id="prev" style="position: absolute; top: 50%; left: 0; transform: translateY(-50%);" onclick="plusSlides(-1)">&#10094;</a>
        <a id="next" style="position: absolute; top: 50%; right: 0; transform: translateY(-50%);" onclick="plusSlides(1)">&#10095;</a>

        
        <div class="mySlides">
            <img src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep1.jpg" style="width:75vh; height: auto;">
        </div>

        <div class="mySlides">
            <img src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep2.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <img src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep3.jpg" style="width:100%">
        </div>

       
        <div class="row" style="display: flex; flex-direction: row; justify-content: center; margin-top: 1vh;margin-bottom: 1vh">
            <img class="demo cursor" src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep1.jpg" style="width:10vw; height: auto;" onclick="currentSlide(1)">
            <img class="demo cursor" src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep2.jpg" style="width:10vw; height: auto;" onclick="currentSlide(2)">
            <img class="demo cursor" src="./autokepek/<?= $autoAdatok[0]['modell'] ?>/kep3.jpg" style="width:10vw; height: auto;" onclick="currentSlide(3)">
        </div>
    </div>
</div>

