        <?php
            include('include/entete.inc.php');

            if(!isset($_SESSION['login'])) {
                echo '<script>location.href=".";</script>';
            }

            if(isset($_POST['submit'])) {
                if(isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $_SESSION['prenom']) {
                    $newprenom = htmlspecialchars($_POST['newprenom']);
                    $insertprenom = $db->prepare("UPDATE photoforyou.users SET prenom = InitCap(:prenom) WHERE idUser = :idUser");
                    $insertprenom->bindParam(':prenom', $newprenom, PDO::PARAM_STR);
                    $insertprenom->bindParam(':idUser', $_SESSION['id'], PDO::PARAM_INT);
                    $insertprenom->execute();
                    $_SESSION['prenom'] = $newprenom;
                    echo '<script>location.href="voirProfil.php";</script>';
                }

                if(isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $_SESSION['nom']) {
                    $newnom = htmlspecialchars($_POST['newnom']);
                    $insertnom = $db->prepare("UPDATE photoforyou.users SET nom = InitCap(:nom) WHERE idUser = :idUser");
                    $insertnom->bindParam(':nom', $newnom, PDO::PARAM_STR);
                    $insertnom->bindParam(':idUser', $_SESSION['id'], PDO::PARAM_INT);
                    $_SESSION['nom'] = $newnom;
                    echo '<script>location.href="voirProfil.php";</script>';
                }

                if(isset($_POST['newdate']) AND !empty($_POST['newdate']) AND $_POST['newdate'] != $_SESSION['dateNaiss']) {
                    $newdate = htmlspecialchars($_POST['newdate']);
                    $insertdate = $db->prepare("UPDATE photoforyou.users SET dateNaiss = :date WHERE idUser = :idUser");
                    $insertdate->bindParam(':date', $newdate, PDO::PARAM_STR);
                    $insertdate->bindParam(':idUser', $_SESSION['id'], PDO::PARAM_INT);
                    $insertdate->execute();
                    $_SESSION['dateNaiss'] = $newdate;
                    echo '<script>location.href="voirProfil.php";</script>';
                }

                if(isset($_POST['newsite']) AND !empty($_POST['newsite']) AND $_POST['newsite'] != $_SESSION['siteUser']) {
                    $newsite = htmlspecialchars($_POST['newsite']);
                    $insertsite = $db->prepare("UPDATE photoforyou.users SET siteUser = :site WHERE idUser = :idUser");
                    $insertsite->bindParam(':site', $newsite, PDO::PARAM_STR);
                    $insertsite->bindParam(':idUser', $_SESSION['id'], PDO::PARAM_INT);
                    $insertsite->execute();
                    $_SESSION['siteUser'] = $newsite;
                    echo '<script>location.href="voirProfil.php";</script>';
                }
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Édition de votre Profil</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Vous voulez modifier une information pas de soucis corrigés là ici</p>
                </div>
            </div>
        </header>

        <br>

        <form action="" method="post">
            <fieldset>
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                
                                <?php echo "<img class='rounded-circle mt-5' width='150px' src='images/profil/".($_SESSION["photoUser"])."'>
                                    <label class='form-label'>Photo</label>
                                    <input class='form-control' type='file' id='disabledInput' name='newphoto' accept='image/jpeg, image/png, image/gif' disabled>
                                    <span class='font-weight-bold'>".($_SESSION['prenom'])."\t".($_SESSION['nom'])."</span>
                                    <span class='text-black-50'>".($_SESSION['email'])."</span>
                                    <span> </span>";
                                ?>

                            </div><!-- fin div d-flex -->
                        </div><!-- fin div col-md-3 -->
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Éditer le profile</h4>
                                </div><!-- fin div d-flex -->
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Prenom</label><?php echo"<input type='text' class='form-control' placeholder='Prenom' name='newprenom' value='".$_SESSION["prenom"]."'>";?></div>
                                    <div class="col-md-6"><label class="labels">Nom</label><?php echo"<input type='text' class='form-control' placeholder='Nom' name='newnom' value='".$_SESSION["nom"]."'>";?></div>
                                </div><!-- fin div row -->
                                <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Statut</label><?php echo"<input type='text' class='form-control' id='disabledInput' value='".$_SESSION['type']."' disabled>";?></div>
                                
                                <?php
                                    if($_SESSION['type']=="client") {
                                        echo "<div class='col-md-12'><label class='labels'>Date de Naissance</label><input type='date' class='form-control' placeholder='Date de Naissance' name='newdate' value='".$_SESSION["dateNaiss"]."'></div>";                           
                                    } 
                                    
                                    if($_SESSION['type']=="photographe") {
                                        echo "<div class='col-md-12'><label class='labels'>Site</label> <input type='text' class='form-control' placeholder='Site' name='newsite' value='".$_SESSION["siteUser"]."'></div>";
                                    }
                                ?>

                                </div><!-- fin div row -->
                                <div class="mt-5 text-center"><input type="submit" value="Confirmer"  class="btn btn-primary" name="submit"/></div>
                            </div><!-- fin div p-3 -->
                        </div><!-- fin div col-md-5 -->
                    </div><!-- fin div row -->
                </div><!-- fin div container -->
            </fieldset>
        </form>

        <br>

        <?php
            include('include/piedDePage.inc.php');
        ?>