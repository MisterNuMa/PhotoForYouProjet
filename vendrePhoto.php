        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "photographe") { // Si l'utilisateur n'est pas photographe
                echo '<script>location.href="connexion.php";</script>'; // redirection vers la page de connexion
            }

            $tags = $db->query('SELECT * FROM tags');
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Formulaire vente photo</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Votre photo sera bientôt en vente sur nôtre site</p>
                </div>
            </div>
        </header>

        <br>

        <div class="container">
            <form class="need-validate" method="post" action="" id="form" enctype="multipart/form-data" novalidate >
                <fieldset>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="titre" class="form-label"><span class="text-danger">*</span> Titre</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Titre de votre photographie" required/>
                            <div class="valid-feedback">
                                Titre Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ titre est obligatoire et doit faire entre 3 et 45 caractères
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="prix" class="form-label"><span class="text-danger">*</span> Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" placeholder="500" min="500" max="10000" step="500" required/>
                            <div class="valid-feedback">
                                Prix Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ prix est obligatoire et doit être un nombre entier de type int(eger), et doit être compris entre 500 et 10000 avec un pas de 500
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="photo"><span class="text-danger">*</span> Photographie</label>
                            <input class="form-control" type="file" onchange="actuPhoto(this)" id="nomImage" name="nomImage" accept="image/jpeg, image/png" required/>
                        </div>
                    </div>
                    <img src="" id="photo" style='width: 50%; height: auto;'; class="img-responsive float-right">
                    <div class="col-auto my-1">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Choisir Tags de la Photo</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="tags">
                            <option selected></option>
                        
                            <?php
                                foreach ($tags as $value) {
                                    echo "<option value=".$value["idTags"].">".$value["libelleTags"]."</option>";
                                };
                            ?>

                        </select>
                    </div>

                    <br>

                    <p class="user-select-none text-muted"><span class="text-danger">*</span> Obligatoire</p>
                    <button type="submit" class="btn btn-primary" name="submit">Confirmer</button>
                </fieldset>
            </form>
        </div>

        <br>

        <script src="assets/js/vendrePhoto.js"></script>

        <?php
            include('include/piedDePage.inc.php');
            
            if(isset($_POST['submit'])) {
                // Traitement de la photo
                if($_FILES) {
                    switch($_FILES['nomImage']['type']) {
                        case 'image/jpeg': $extension = 'jpg'; break;
                        case 'image/png':  $extension = 'png'; break;
                        default:           $extension = ''; break;
                    }
                    if($extension && $_FILES['nomImage']['size'] < 30*1024*1024) {
                        // Changer le nom de l'image
                        $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                        $nom_alea = '';
                        for($i = 0; $i < 20; $i++) {
                            $nom_alea .= substr($alpha, rand() % (strlen($alpha)), 1);
                        }
                        date_default_timezone_set('Europe/Paris');
                        $nom_fichier = $nom_alea.date('_Y_m_d_H_i_s.').$extension;
                        $fileName = $_FILES['nomImage']['name'];
                        $tempName = $_FILES['nomImage']['tmp_name'];
                        if(!isset($fileName)) {
                            if(!$extension) echo $_FILES['photoUser']['name']."n'est pas accepté comme fichier image";
                            else echo "L'image dépasse les 30 Mo";
                        }
                    }
                    if(strlen($nom_fichier) == 0) {
                        $nom_fichier = '';
                    }
                    // Traitement des données
                    function valid_donnees($donnees) {
                        $donnees = stripslashes($donnees);
                        $donnees = htmlspecialchars($donnees);
                        return $donnees;
                    }
                    // Récupération des données
                    $libelle = valid_donnees($_POST['libelle']);
                    $prix = intval($_POST['prix']);
                    $tag = intval($_POST['tags']);
                    list($largeur, $longueur) = getimagesize($_FILES['nomImage']['tmp_name']);
                    $largeur = intval($largeur);
                    $longueur = intval($longueur);
                    $poids = $_FILES['nomImage']['size'];
                    $ok = true;

                    // Test pour savoir si les valeurs ont bien été rentrées
                    // Titre Libelle
                    if(empty($libelle)
                        ||
                        strlen($libelle) < 3
                        ||
                        strlen($libelle) > 45) {
                    $ok = false;
                    }
                    // Prix
                    $range = range(500, 10000, 500); // Tableau de 500 à 10000, de 500 en 500
                    if(empty($prix)
                        ||
                        !is_int($prix)
                        ||
                        $prix < 0
                        ||
                        !in_array($prix, $range)) {
                    $ok = false;
                    }
                    // Image
                    if(empty($nom_fichier)) {
                        $ok = false;
                    }
                    // Tags
                    if(empty($tag)) {
                        $ok = false;
                    }

                    // Si tout est ok, on envoie les données à la base de données
                    if($ok == true) {
                        $sql = $db->prepare('INSERT INTO photoforyou.photo(libellePhoto, photoLargeur, photoLongueur, nomImage, prix, datePub, poids, idUser, idTags) VALUES(InitCap(:libellePhoto), :photoLargeur, :photoLongueur, :nomImage, :prix, NOW(), :poids, '.intval($_SESSION['id']).', :idTags)');
                        $sql->bindParam(':libellePhoto', $libelle, PDO::PARAM_STR);
                        $sql->bindParam(':photoLargeur', $largeur, PDO::PARAM_INT);
                        $sql->bindParam(':photoLongueur', $longueur, PDO::PARAM_INT);
                        $sql->bindParam(':nomImage', $nom_fichier, PDO::PARAM_STR);
                        $sql->bindParam(':prix', $prix, PDO::PARAM_INT);
                        $sql->bindParam(':poids', $poids, PDO::PARAM_INT);
                        $sql->bindParam(':idTags', $tag, PDO::PARAM_INT);
                        // On essaye d'envoyer les données à la base de données
                        try {
                            $sql->execute();
                            if(!empty($fileName)) {
                                $location = 'images/photos/';
                                if(move_uploaded_file($tempName, $location.$nom_fichier)) {
                                    echo 'Image Envoyé';
                                }
                            }
                            echo '<script>location.href="vendrePhotoReussie.php";</script>';
                        // Si une erreur est survenue, on affiche un message d'erreur
                        } catch(PDOException $e) {
                            echo"<br> Erreur:". $e->getMessage();
                        }
                    // Si les valeurs n'ont pas été rentrées, on affiche un message d'erreur
                    } else {
                        echo '<script>alert("Veuillez remplir tous les champs");</script>';
                    }
                // Si aucun fichier n'a été envoyé, on affiche un message d'erreur
                } else {
                    echo '<script>alert("Veuillez choisir une image");</script>';
                }
            }
        ?>