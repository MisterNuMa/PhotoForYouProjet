        <?php
            include('include/entete.inc.php');

            if(isset($_SESSION['login'])) {
                echo '<script>location.href=".";</script>';
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Inscription Photographe</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Merci de remplir ce formulaire d'inscription</p>
                    <hr class="my-3">
                    <p class="lead fw-normal text-white-60 mb-0">Vous ferez bientôt parti de nos membres. Vous avez fait le bon choix ;-)</p>
                </div>
            </div>
        </header>

        <br>

        <div class="container">
            <!-- Formulaire d'inscription Photographe-->
            <form method="post" action="inscriptionPhotographe.php" id="form" enctype="multipart/form-data" autocomplete="on" novalidate>
                <fieldset>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="prenom"><span class="text-danger">*</span> Prénom</label>
                            <input type="text" class="form-control" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" minlength="3" maxlength="45" autocomplete="off"  spellcheck="false" name="prenom" id="prenom" placeholder="Votre prénom" required/>
                            <div class="valid-feedback">
                                Prénom Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ prénom est obligatoire et doit faire entre 3 et 45 caractères
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="nom"><span class="text-danger">*</span> Nom</label>
                            <input type="text" class="form-control" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" minlength="3" maxlength="45" autocomplete="off"  spellcheck="false" name="nom" id="nom" placeholder="Votre nom" required/>
                            <div class="valid-feedback">
                                Nom Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ nom est obligatoire et doit faire entre 3 et 45 caractères
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="nom">Photo</label>
                            <input class="form-control" type="file" onchange="actuPhoto(this)" id="photoUser" name="photoUser" accept="image/jpeg, image/png"/>
                        </div> 
                    </div>
                    <img src="" id="photo" style="width: 20%; border-radius: 50%;" class="img-responsive float-right"/>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="email"><span class="text-danger">*</span> Adresse électronique</label>
                            <input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" maxlength="45" placeholder="nom@exemple.com" required/>
                            <div class="invalid-feedback">
                                Vous devez fournir un email valide.
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="motDePasse"><span class="text-danger">*</span> Mot de Passe</label>
                            <input type="password" oninput='motdepasse1.setCustomValidity(motdepasse1.value != motdepasse1.value ?  "Mot de passe non identique" : "")' class="form-control" id="motdepasse1" name="motdepasse1" minlength="5" maxlength="45" required/>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" onclick="Afficher1()">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
                            </div>
                            <div class="valid-feedback">
                                Nom Ok !
                            </div>
                            <div class="invalid-feedback">
                                Le champ nom est obligatoire et doit faire entre 3 et 45 caractères
                            </div>
                            <div  class="invalid-feedback">
                                <p id="erreurMotDePasse"></p>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="motDePasse2"><span class="text-danger">*</span> Confirmation du mot de passe</label>
                            <input type="password" oninput='motdepasse2.setCustomValidity(motdepasse2.value != motdepasse1.value ?  "Mot de passe non identique" : "")' class="form-control" id="motdepasse2" name="motdepasse2" minlength="5" maxlength="30" required/>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" onclick="Afficher2()">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Afficher le mot de passe</label>
                            </div>
                            <div name="message" class="invalid-feedback">
                                Mot de passe non identique
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label for="siret"><span class="text-danger">*</span> Numéro de siret</label>
                            <input type="text" class="form-control col-md-3" name="siret" id="siret" placeholder="12345678900013" maxlength="14" size="14" pattern="[0-9]{14}" required/>
                            <div class="invalid-feedback">
                                Le numéro de SIRET est obligatoire et ce présente sous cette forme 12345678900013
                            </div>
                        </div>
                    </div>
                    <p class="user-select-none text-muted"><span class="text-danger">*</span> Obligatoire</p>
                    <p class="user-select-none text-muted">Il y aura un temps d'attente pour l'activation de votre compte qui sera vérifié par notre administrateur.<br>Merci de votre compréhension.</p>
                    <input type="submit" value="Confirmer"  class="btn btn-primary" name="submit" id="submit"/>
                </fieldset>
            </form>
        </div>

        <br>

        <script src="assets/js/formInscription.js"></script>

        <?php
            include('include/piedDePage.inc.php');
        ?>