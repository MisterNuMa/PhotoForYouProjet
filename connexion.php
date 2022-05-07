        <?php
            include('include/entete.inc.php');

            // Si $_SESSION['login'] == true alors on renvoie vers la page index.php.
            if(isset($_SESSION['login'])) {
                echo '<script>location.href=".";</script>';
            }

            if(isset($_POST['submit'])) {
                $email = $_POST['email'];
                $mdp = hash('sha512', $_POST['mdp']); # On hash le mot de passe en sha512.
                $sql = 'SELECT idUser FROM users WHERE email=:email AND mdp=:mdp AND active = 1';
                $sql = $db->prepare($sql);
                $sql->bindParam(':email', $email, PDO::PARAM_STR);
                $sql->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $sql->execute();
                $num = $sql->fetchAll();
                if(count($num) > 0) {
                    // On récupère le prénom pour le message d'accueil
                    $_SESSION['login'] = true;
                    $sql1 = 'SELECT * FROM users WHERE email="'.$email.'"';
                    $req = $db->query($sql1);
                    $result = $req->fetch();
                    $_SESSION['id'] = htmlentities($result['idUser']);
                    $_SESSION['prenom'] = htmlentities($result['prenom']);
                    $_SESSION['nom'] = htmlentities($result['nom']);
                    $_SESSION['email'] = htmlentities($result['email']);
                    $_SESSION['type'] = htmlentities($result['type']);
                    $_SESSION['photoUser'] = htmlentities($result['photoUser']);
                    $_SESSION['dateNaiss'] = htmlentities($result['dateNaiss']);
                    $_SESSION['credit'] = htmlentities($result['credit']);
                    $_SESSION['siteUser'] = htmlentities($result['siteUser']);
                    $_SESSION['siret'] = htmlentities($result['siret']);
                    unset($result);
                    echo '<script>location.href="connexionReussie.php";</script>';
                } else {
                    $user_unknown = false;
                }
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Connexion</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Merci de vous identifier</p>
                </div>
            </div>
        </header>
        
        <br>

        <div class="container">
            <!-- Formulaire de connexion-->
            <form method="post" id="formId" novalidate>
                <fieldset>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="email">Adresse électronique :</label>
                            <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="email" id="email" required/>
                            <div class="invalid-feedback">
                                Vous devez fournir une adresse électronique.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="mdp">Mot de Passe :</label>
                            <input type="password" class="form-control" minlength="5" maxlength="45" name="mdp" id="mdp" required/>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" onclick="Afficher()">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
                            </div>
                            <div class="invalid-feedback">
                                Vous devez fournir un mot de passe.
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Confirmer" class="btn btn-primary" name="submit" id="submit"/>
                </fieldset>
            </form>

            <?php              
                if(isset($user_unknown)) {
                    echo '
                    <br>
                    <div class="alert alert-danger" id="bloc" style="display:none role="alert">
                        Email ou mot de passe incorrect.
                    </div>
                    <script>
                        document.getElementById("bloc").style.display="block";
                        setTimeout(function(){document.getElementById("bloc").style.display="none";},5000);
                    </script>';
                }
            ?>

            <br>

        </div>

        <script src="assets/js/connexion.js"></script>

        <?php
            include('include/piedDePage.inc.php')
        ?>