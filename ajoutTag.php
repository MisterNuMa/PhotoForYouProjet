        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] == "client" || empty($_SESSION['login'])) {
                echo '<script>location.href=".";</script>';
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Formulaire ajout d'un Tag</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Votre tag sera bientôt disponible</p>
                </div>
            </div>
        </header>

        <br>

        <div class="container">
            <div class="jumbotron">
                <form  method="post" action=""  id="form"  enctype="multipart/form-data" novalidate>
                    <fieldset>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="prenom">Libellé du Tags</label>
                            <input type="text" class="form-control" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" minlength="3" maxlength="45" name="tag" id="tag" required/>
                            <div class="valid-feedback">
                                Libellé Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ libellé est obligatoire et doit faire entre 3 et 45 caractères
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Confirmer" id="submit" name="submit"/>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <br>

        <script src="assets/js/ajoutTag.js"></script>

        <?php
            include('include/piedDePage.inc.php');

            if(isset($_POST['submit'])) {
                // Traitement de la donnée
                function valid_donnees($donnees) {
                    $donnees = trim($donnees);
                    $donnees = stripslashes($donnees);
                    $donnees = htmlspecialchars($donnees);
                    return $donnees;
                }
                // Traitement de la donnée et récuparation de la donnée du formulaire dans des variables grâce à la métode POST
                $tag = valid_donnees($_POST['tag']);
                // Vérification de la donnée
                $ok = true;
                if(empty($tag)
                    ||
                    strlen($tag) < 3
                    ||
                    strlen($tag) > 45) {
                $ok = false;
                }
                if($ok == true) {
                    $sql = $db->prepare('INSERT INTO photoforyou.tags(libelleTags, active, idUser) VALUES (InitCap(:tag), 0, '.intval($_SESSION['id']).')');
                    $sql->bindParam(':tag', $tag, PDO::PARAM_STR);
                    try {
                        $sql->execute();
                        echo '<script>location.href="ajoutTagReussi.php";</script>';
                    } catch(PDOException $e) {
                        echo"<br> Erreur:". $e->getMessage();
                    }
                } else {
                    echo '<script>alert("Veuillez remplir correctement le formulaire");</script>';
                }
            }
        ?>