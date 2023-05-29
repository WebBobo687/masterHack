<?php include_once "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Master Hack</title>
</head>
<body>
    <div class="home">
        <video muted loop autoplay>
            <source src="matrix.mov" type="video/mp4">
        </video>

        <div class="tours">
            <br>
           <h3> Essais restant: <?= $_SESSION["restTry"];?> </h3>
        </div>
        <h1>Master Hack</h1>
        
        <form action="index.php" method="POST">
            <input type="submit" name="start" value="Start" id="start">
        </form>

        <div class="home-content">
        <?php if (!$_SESSION['loose'] || !$_SESSION['win'] && $_SESSION['start']) : ?>
            <?php if ($_SESSION['try'] < 10) :?>
                <form action="index.php" method="GET">
                    <p>Entrez un code à 4 chiffres</p>
                    <input type="text" name="codeUser" placeholder="Exemple: 1234">
                </form>
            <?php endif ?>
        </div>
        <div class="container">
            <div class="historique">
                <h3>Historique des entrées</h3>
                <ul>
                    <?php for ($i = 0; $i < count($_SESSION["historic"]); $i++) : ?>
                        <li> <?= $_SESSION["historic"][$i]; ?> </li>
                    <?php endfor ?>
                </ul>
            </div>

            <div class="track">
                <h3>Vérification des entrées</h3>
                <ul>
                    <?php for ($i = 0; $i < count($_SESSION["tracking"]); $i++) : ?>
                        <li> <?= $_SESSION["tracking"][$i]; ?> </li>
                    <?php endfor ?>
                </ul>
                <h3>o: good | x: not good | _: unexist</h3>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['win'] == True) : ?>
            <div id="container">
                <h1>Félicitation vous avez gagné</h1>
                <p>Le code est <?=$_SESSION['code']; ?></p>
            </div>
        <?php endif ?>
        <?php if ($_SESSION['loose'] == True) : ?>
            <div id="container">
                <h1>Dommage vous avez perdu</h1>
                <p>Le code était <?=$_SESSION['code']; ?></p>
            </div>
        <?php endif ?>
    </div>
</body>
</html>
