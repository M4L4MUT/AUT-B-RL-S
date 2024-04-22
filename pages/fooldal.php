<div id="szuro">
    <form id="szuresForm" action="index.php?menu=szurtautok" method="post">



        <label for="marka">Márka:</label>
        <select name="marka" id="marka" style="padding-right: 0.5vw;">
            <option value="">Mindegy</option>
            <?php foreach ($db->getMarka() as $row) { ?>
                <option value="<?= $row['marka'] ?>"><?= $row['marka'] ?></option>
            <?php } ?>
        </select>

        <label for="uzemanyag">Üzemanyag típus:</label>
        <select name="uzemanyag" id="uzemanyag" style="padding-right: 0.5vw;">
            <option value="">Mindegy</option>
            <?php foreach ($db->getUzemanyag() as $row) { ?>
                <option value="<?= $row['uzemanyag'] ?>"><?= $row['uzemanyag'] ?></option>
            <?php } ?>
        </select>

        <label for="szszam">Ülések száma:</label>
        <select name="szszam" id="szszam" style="padding-right: 0.5vw;">
            <option value="">Mindegy</option>
            <?php foreach ($db->getSzszam() as $row) { ?>
                <option value="<?= $row['szszam'] ?>"><?= $row['szszam'] ?></option>
            <?php } ?>
        </select>
        <br><br>
                <a href="index.php?menu=szurtautok">
                    <button type="submit" class="Btn">
                        <div class="sign"><svg viewBox="0 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796   s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z    M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5,169.5S41.1,304.396,41.1,210.796z"/></svg></div>
                        <div class="text">Keresés</div>
                    </button></a>
                </form>
                </div>


                <script>
                    function szures() {
                        var formData = new FormData(document.getElementById('szuresForm'));

                        // AJAX kérés elküldése
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    // Válasz feldolgozása itt
                                    var response = xhr.responseText;

                                    // Példa: az eredményt egy elembe beillesztjük a HTML-be
                                    document.getElementById('keresesEredmenyek').innerHTML = response;
                                } else {
                                    // Hiba esetén kezelés
                                    console.error('AJAX hiba: ' + xhr.status);
                                }
                            }
                        };

                        xhr.open('POST', 'Vizsgaremek2/index.php', true);
                        xhr.send(formData);
                    }


                </script>




                <div id="fixed-container" class="fixed-container mt-15 mb-5">
                    <div class="row">
                        <?php
                        foreach ($db->osszesAuto() as $row) {
                            $image = null;
                            if (file_exists("./autokepek/" . $row['modell'] . "/kep1.jpg")) {
                                $image = "./autokepek/" . $row['modell'] . "/kep1.jpg";
                            } else {
                                $image = "./images/noimage.jpg";
                            }

                           
                            if ($row['foglalas'] == 1) {
                                ?>


                                <div class="col-md-3 mb-4" style="overflow: hidden;">
                                    <a href="index.php?menu=kivalasztottauto&id=<?php echo $row["id"]; ?>"><div class="card">
                                            <div style="position: relative;">
                                                <img src="<?= $image ?>" class="card-img-top" alt="...">
                                                    <div class="kis-kep-container" style="overflow: hidden; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                        <img src="./images/lefoglalva.png" style="width: 30vw; height: auto;">
                                                    </div>
                                            </div></a>
                                    <div class="card-body" style="background-color: rgb(38, 38, 36); color:white;">
                                        <h5 class="card-title"><?= $row['modell'] ?></h5>
                                        <p class="card-text">Márka: <?= $row['marka'] ?></p>
                                        <p class="card-text">Bérletidíj: <?= $row['berletidij'] ?> Ft</p>
                                        <p class="hidden"></p>
                                    </div>
                                </div>
                            </div>

                            <?php
                        } else {
                         
                            ?>
                            <div class="col-md-3 mb-4">
                                <div class="card"> 
                                    <a href="index.php?menu=kivalasztottauto&id=<?php echo $row["id"]; ?>"><img src="<?= $image ?>" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['modell'] ?></h5>
                                        <p class="card-text">Márka: <?= $row['marka'] ?></p>
                                        <p class="card-text">Bérletidíj: <?= $row['berletidij'] ?> Ft</p>
                                        <p class="hidden"></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
                </div>
                <div style="text-align: center;">
                    <h3 style="font-size: 2vw; padding-bottom: 3vh; color: #333; font-family: Arial, sans-serif; text-transform: uppercase;">
                        A cégünk támogatói
                    </h3>
                    <div style="display: inline-block;">
                        <hr style="width: 40vw; border-bottom: 2px solid; margin: 0 auto; text-align: center;">
                    </div>
                </div>

                <table style="margin:auto; text-align:center; margin-bottom: 5vw;">
                    <tr id="elrendezes">
                        <th style="padding-right: 5vw;"><a href="https://wwww.audi.hu/?wt_ga=132263182254_592678630713&wt_kw=e_132263182254_audihttps://wwww.audi.hu/?wt_ga=132263182254_592678630713&wt_kw=e_132263182254_audi&gad_source=1&gclid=EAIaIQobChMIgZ-ynrjkhAMVWJCDBx1RuwhwEAAYASAAEgJMYPD_BwE" target="_blank"><img style="padding:0; width:5vw;" src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExZXY0ZjVnN3FmbXc0MHpmbjJ1aDR5Zm04cXhwbjRsajYycGFiaHd2byZlcD12MV9naWZzX3NlYXJjaCZjdD1z/3dpMfROzEW0OZrqc3M/giphy.gif"></a></th>
                        <th style="padding-right: 5vw;"><a href="https://www.bmwgroup.jobs/hu/hu.html?tl=sea-goog-bda1-tac-miy-.-text-.-20230406-.B0F3564C&gad_source=1&gclid=EAIaIQobChMI1LLEwbjkhAMVXJWDBx1BHAEfEAAYASAAEgKbLfD_BwE" target="_blank"><img style="width:3vw;" src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExNjg0YzU1M2RxeXEzMXVsZTVocjhiNm92M2xuMTV4dWxpeWl2Y2RvNSZlcD12MV9naWZzX3NlYXJjaCZjdD1z/xUA7aKMml6zIS2Qle8/giphy.gif"></a></th>
                        <th style="padding-right: 5vw;"><a href="https://www.dubai.mercedesbenzplaces.com/?gad_source=1&gclid=EAIaIQobChMIiNuXurnkhAMVzqeDBx166wKKEAAYASAAEgKY0vD_BwE" target="_blank"><img style="width:3vw;" src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbnd2cG1zcXY5ajVrM2VmdmdvamdldGdhcnJwbWhsNmYyOTQxeDNtMSZlcD12MV9naWZzX3NlYXJjaCZjdD1z/MoIYVtBcvGlYye8O9D/giphy.gif"></a></th>
                        <th style="padding-right: 5vw;"><a href="https://fordsolymar.hu/haszongepjarmu-ajanlat-a-ford-solymartol?gad_source=1&gclid=EAIaIQobChMI7uL-z7nkhAMVMZ6DBx1ZrAlZEAAYAiAAEgI5k_D_BwE" target="_blank"><img style="width:5vw;" src="https://media.giphy.com/media/vMsbkeKeIMQK2OaW1U/giphy.gif?cid=ecf05e47g8q5de2480nmi7tx9xfkxuhehlazuqft4qvrbe21&ep=v1_gifs_search&rid=giphy.gif&ct=s"></a></th>
                        <th><a href="https://www.carvertical.com/hu/landing/features?a=gpa&b=ca5f8bea&gad_source=1&gclid=EAIaIQobChMIoMDS5bnkhAMVaqiDBx1y5wXEEAAYASAAEgI8ZfD_BwE" target="_blank"><img style="width:5vw;" src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExNndqdnoxeXpybmprMGxvM3IyNzJxNjBweXlqcnF2N2E4bzVwcXhheiZlcD12MV9naWZzX3NlYXJjaCZjdD1z/4pBm4RKgYGFsHvY2T9/giphy.gif"></a></th>
                    </tr>
                </table>


<script>
    function scrollImages() {
        var container = document.getElementById('fixed-container');
        var scrollAmount = 2;
        var scrollSpeed = 50;
        var scrollingDown = true; 

        function startScrolling() {
            if (scrollingDown) {
                container.scrollTop += scrollAmount;
                if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
                   
                    scrollingDown = false;
                }
            } else {
                container.scrollTop -= scrollAmount;
                if (container.scrollTop <= 0) {
                   
                    scrollingDown = true;
                }
            }
            setTimeout(startScrolling, scrollSpeed);
        }

        startScrolling();
    }

    window.onload = function() {
        scrollImages();
    };
</script>

