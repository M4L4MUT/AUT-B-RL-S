



<style>* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f3f4f6;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 50px;
        margin-left: 10%;
        margin-right: 10%;
        margin-top:5vh;
    }

    .card {
        width: 300px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: auto;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-details {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .card-text {
        margin-bottom: 15px;
    }

    .card-icons {
        display: flex;
        justify-content: space-between;
    }



    .icon i {
        margin-right: 5px;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-left:80px;
        margin-top:15px;
    }

    .card-icons {
        display: flex;
        justify-content: center; 
        align-items: center; 
        flex-wrap: wrap;
    }

    .icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 20px;

    }

    .icon p {
        margin-top: 5px;
    }

    .button:hover {
        background-color: #0f1621;
    }
</style>

<div class="card-container">
    <?php foreach ($db->szures() as $row): ?>
        <div class="card">
            <?php
            $image = file_exists("./autokepek/" . $row['modell'] . "/kep1.jpg") ?
                    "./autokepek/" . $row['modell'] . "/kep1.jpg" :
                    "./images/noimage.jpg";
            ?><?php if ($row['foglalas'] == 1) {
                ?>
                <div style="position: relative;">
                    <img src="<?= $image ?>" class="card-img-top" alt="...">
                    <div class="kis-kep-container" style="overflow: hidden; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <img src="./images/lefoglalva.png" style="width: 30vw; height: auto;">
                    </div>
                </div>

                <div class="card-details"  style="background-color: rgb(38, 38, 36); color:white;">
                    <h2 style="text-align: center; font-weight: bold;" class="card-title"><?= $row['marka'] ?> <?= $row['modell'] ?></h2>
                    <p style="text-align: center; "class="card-text">Bérleti Díj: <?= $row['berletidij'] ?> Ft</p>
                    <div class="card-icons">
                        <div class="icon">
                            <i class="fa-solid fa-cart-shopping" title="Kaució"></i>
                            <p><?= $row['kaukcio'] ?></p>
                        </div>
                        <div class="icon">
                            <i style="height:30px;" class="fa-solid fa-person" title="Szállítható személyek"></i>
                            <p><?= $row['szszam'] ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-gas-pump" title="Fogyasztás L/100Km"></i>
                            <p><?= $row['fogyasztas'] ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-clock" title="Km óra állása"></i>
                            <p><?= $row['km'] ?></p>
                        </div>
                    </div>
                    <a href="index.php?menu=kivalasztottauto&id=<?= $row['id'] ?>" class="button">Érdekel</a>
                </div>

            <?php } else { ?>
                <div class="card-image">
                    <img src="<?= $image ?>" alt="<?= $row['marka'] . ' ' . $row['modell'] ?>">
                </div>
                <div class="card-details">
                    <h2 style="text-align: center; font-weight: bold;" class="card-title"><?= $row['marka'] ?> <?= $row['modell'] ?></h2>
                    <p style="text-align: center; "class="card-text">Bérleti Díj: <?= $row['berletidij'] ?> Ft</p>
                    <div class="card-icons">
                        <div class="icon">
                            <i class="fa-solid fa-cart-shopping" title="Kaució"></i>
                            <p><?= $row['kaukcio'] ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-person" title="Szállítható személyek"></i>
                            <p><?= $row['szszam'] ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-gas-pump" title="Fogyasztás L/100Km"></i>
                            <p><?= $row['fogyasztas'] ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-clock" title="Km óra állása"></i>
                            <p><?= $row['km'] ?></p>
                        </div>
                    </div>
                    <a href="index.php?menu=kivalasztottauto&id=<?= $row['id'] ?>" class="button">Érdekel</a>
                </div><?php } ?>
        </div>
    <?php endforeach; ?>
</div>

