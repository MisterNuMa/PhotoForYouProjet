        <?php
            include('include/entete.inc.php');

            $req = 'SELECT * FROM photo, users WHERE users.idUser = photo.idUser AND idPhoto = '.$_GET["idphoto"].' AND photo.active = 1 AND idPhoto NOT IN (SELECT idPhoto FROM acheter);';
            $ins = $db->prepare($req);
            $ins->execute();
            $num = $ins->fetchAll();
            if(!empty($num[0])){
                $photo = $db->query('SELECT * FROM photo, users, tags WHERE users.idUser = photo.idUser AND tags.idTags = photo.idTags AND tags.active = 1 AND photo.active = 1 AND idPhoto != '.$_GET["idphoto"].' AND photo.idUser = '.$num[0]['idUser'].' AND idPhoto NOT IN (SELECT idPhoto FROM acheter) ORDER BY idPhoto DESC LIMIT 8;');
            } else {
                echo '<script>location.href="voirPhoto.php";</script>';
            }
        ?>

        <br>

        <?php
            if(!empty($num)){
                foreach ($num as $value) {
                    echo '
                    <section class="py-5">
                        <div class="container px-4 px-lg-5 my-5">
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="images/photos/'.htmlentities($value['nomImage']).'" alt="..." /></div> <!-- https://dummyimage.com/600x700/dee2e6/6c757d.jpg-->
                                <div class="col-md-6">
                                <div class="small mb-1">Date de publication : '.$value["datePub"].'</div>
                                    <h1 class="display-5 fw-bolder">'.$value["libellePhoto"].'</h1>
                                    <div class="fs-5 mb-5">
                                        <span>'.$value["prix"].' <i class="bi bi-coin"></i></span>
                                    </div>
                                    <p class="lead">Photographe : '.$value["prenom"]."\t". $value["nom"].'</p>';
                                    if($_SESSION['type'] == "client") {
                                        echo '
                                        <div class="d-flex">
                                            <form method="post">
                                                <button class="btn btn-outline-warning flex-shrink-0" type="submit" id="acheter" name="acheter" value="acheter">
                                                    <i class="bi bi-coin"></i>
                                                    Acheter
                                                </button>
                                            </form>
                                        </div>';
                                    } else if($_SESSION['type'] == "photographe" || $_SESSION['type'] == "admin") {
                                        echo '
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">         
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </symbol>
                                        </svg>
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Seul un client peut acheter des photos.
                                            </div>
                                        </div>';
                                    } else {
                                        echo '
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">         
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </symbol>
                                        </svg>
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Vous devez être <a href="connexion.php" class="alert-link">connecté</a> à un compte client pour pouvoir acheter des photos.
                                            </div>
                                        </div>';
                                    }

                                    if(isset($_POST['acheter'])) {
                                        if($_SESSION['credit'] < $value["prix"]) {
                                            echo '
                                            <br>
                                            <div class="alert alert-danger" id="bloc" style="display:none role="alert">
                                                Vous n\'avez pas assez de crédits pour acheter cette photo.
                                            </div>
                                            <script>
                                                document.getElementById("bloc").style.display="block";
                                                setTimeout(function(){document.getElementById("bloc").style.display="none";},5000);
                                            </script>';
                                        } else {
                                            // Récupération des éléments du formulaire dans des variables
                                            $idUser = $_SESSION['id'];
                                            $idPhoto = $_GET['idphoto'];
                                            $prix = $value["prix"];
                                            $idPhotographe = $value["idUser"];
                                            // Requête pour insérer les données dans la table acheter
                                            $sql = $db->prepare('INSERT INTO photoforyou.acheter(idUser,idPhoto) VALUES(:idUser, :idPhoto)');
                                            $sql->bindParam(':idUser', $idUser, PDO::PARAM_STR);
                                            $sql->bindParam(':idPhoto', $idPhoto, PDO::PARAM_STR);
                                            // Requête pour mettre à jour les crédits de l'utilisateur
                                            $sql1 = $db->prepare('UPDATE photoforyou.users SET credit = credit - :prix WHERE idUser = :idUser');
                                            $sql1->bindParam(':prix', $prix, PDO::PARAM_STR);
                                            $sql1->bindParam(':idUser', $idUser, PDO::PARAM_STR);
                                            $_SESSION['credit'] -= $prix; // Mise à jour des crédits de l'utilisateur
                                            // Requête pour mettre à jour les crédits du photographe
                                            $sql2 = $db->prepare('UPDATE photoforyou.users SET credit = credit + :prix WHERE idUser = :idPhotographe');
                                            $sql2->bindParam(':prix', $prix, PDO::PARAM_STR);
                                            $sql2->bindParam('idPhotographe', $idPhotographe, PDO::PARAM_STR);
                                            // Reqêtes pour désactivés la photo
                                            $sql3 = $db->prepare('UPDATE photoforyou.photo SET active = 0 WHERE idPhoto = :idPhoto');
                                            $sql3->bindParam(':idPhoto', $idPhoto, PDO::PARAM_STR);
                                            // Exécution des requêtes
                                            try {
                                                $sql->execute();
                                                $sql1->execute();
                                                $sql2->execute();
                                                $sql3->execute();
                                                echo '<script>location.href="voirProfil.php";</script>';
                                            } catch(PDOException $e) {
                                              echo"<br> Erreur:". $e->getMessage();
                                            }
                                        }
                                    }

                                echo '
                                </div>
                            </div>
                        </div>
                    </section>';
                }
                echo '
                <section class="py-5 bg-light">
                    <div class="container px-4 px-lg-5 mt-5">
                        <h2 class="fw-bolder mb-4">Autres photos de '.$value["prenom"]."\t". $value["nom"].'</h2>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';

                        foreach ($photo as $result) {
                            echo '
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="images/photos/'.htmlentities($result['nomImage']).'" alt="..." /> <!-- https://dummyimage.com/450x300/dee2e6/6c757d.jpg-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">'.$result['libellePhoto'].'</h5>
                                            '.$result['prix'].' <i class="bi bi-coin"></i>
                                            <br>
                                            <small class="text-muted">'.$result['libelleTags'].'</small>
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="acheterPhoto.php?idphoto='.$result['idPhoto'].'">Voir Plus</a></div>
                                    </div>
                                </div>
                            </div>';
                        }

                        echo '
                        </div>
                    </div>
                </section>';
            } // Fin de la boucle foreach
        ?>
        
        <br>

        <script src="assets/js/protectionImage.js"></script>

        <?php
            include('include/piedDePage.inc.php');
        ?>
