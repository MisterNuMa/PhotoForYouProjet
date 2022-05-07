<?php
    session_start();
    
    if(!isset($_SESSION['type'])) {    
        $_SESSION['type'] = 'visiteur';
    }

    require_once('dbconnect.php');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PhotoForYou</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap link-->
        <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    </head>
    <body>

        <?php
            // On regarde le niveau d'habilitation
            switch ($_SESSION['type']) {
                case "client":      $niveauHab = "%C%"; break;
                case "photographe": $niveauHab = "%P%"; break;
                case "visiteur":    $niveauHab = "%V%"; break;
                case "admin":       $niveauHab = "%A%"; break;
            }

            // On récupère l'ensemble des itérations dans Menu
            $requete = "SELECT idMenu, nomMenu, URL FROM menu WHERE Habilitation LIKE '".$niveauHab."'";
            $instruction = $db->prepare($requete);
            $instruction->execute();
            $num = $instruction->fetchAll(); // Tout se trouve maintenant dans le tableau $num
        ?>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href=".">PhotoForYou</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        
                        <?php
                            // On va récupérer les menus de niveau 1 dont l'id est compris entre 1 et 9
                            foreach($num as $value) {
                                // Menu de niveau 1
                                if (strlen($value['idMenu']) == 1) {
                                    $niv = substr($value['idMenu'], 0, 1); // On mémorise le niveau
                                    echo '<li class="nav-item dropdown">'.PHP_EOL;
                                    echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="'.$value['URL'].'" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.$value['nomMenu'].'</a>'.PHP_EOL;
                                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">'.PHP_EOL;
                                    foreach($num as $value) {
                                        // Sous menu
                                        if (strlen($value['idMenu']) == 2 AND substr($value['idMenu'], 0, 1) == $niv ) {
                                            echo '<li><a class="dropdown-item" href="'.$value['URL'].'">'.$value['nomMenu'].'</a></li>'.PHP_EOL;
                                        }
                                    }
                                    echo "</ul>";
                                    echo "</li>";
                                }
                            }
                        ?>

                    </ul>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <!--
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" name="recherche" id="rechercher" placeholder="Recherche" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Valider</button>
                        </form>
                    -->

                        <?php
                            if(!isset($_SESSION['login'])) {
                                echo '
                                <!-- Button trigger modal -->
                                <form class="d-flex">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalConnexionInscription">
                                    S\'inscrire | Se connecter
                                    </button>
                                </form>
                                <!-- Modal-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="modalConnexionInscription">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content rounded-5 shadow">
                                            <div class="modal-header p-5 pb-4 border-bottom-0">
                                                <h2 class="fw-bold mb-0">Connectez-vous</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-5 pt-0">
                                                <!-- Bouton Connexion-->
                                                <a class="w-100 py-2 mb-2 btn btn-outline-primary rounded-4" href="connexion.php" role="button">Connexion</a>
                                                <hr class="my-4">
                                                <h2 class="fs-5 fw-bold mb-3">Ou Inscrivez-vous</h2>
                                                <!-- Bouton Inscription pour les Clients-->
                                                <a class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" href="formInscriptionClient.php" role="button">Inscription Client</a>
                                                <!-- Bouton Inscription pour les Photographes-->
                                                <a class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" href="formInscriptionPhotographe.php" role="button">Inscription Photographe</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            } else {
                                echo '
                                <form class="d-flex">
                                    <a class="btn btn-outline-primary" href="deconnexion.php" role="button">Deconnexion</a>
                                </form>';
                            }
                        ?>

                        <form class="d-flex">
                            <a class="btn btn-outline-warning" href="credit.php" role="button">
                                <i class='bi bi-coin'></i>
                                Crédit(s)
                                <span class="badge bg-warning text-white ms-1 rounded-pill"><?php if(!isset($_SESSION['login'])) {echo 0;} else {echo $_SESSION['credit'];} ?></span>
                            </a>
                        </form>
                        
                        <!--
                            <form class="d-flex">
                                <a class="btn btn-outline-dark" href="#" role="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    Panier
                                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                                </a>
                            </form>
                        -->
                    </div>
                </div>
            </div>
        </nav>