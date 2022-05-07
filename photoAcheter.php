        <?php
            include('include/entete.inc.php');

            $req = 'SELECT * FROM photo, users, acheter WHERE users.idUser = photo.idUser AND photo.idPhoto = acheter.idPhoto AND acheter.idUser = '.$_SESSION['id'].' AND acheter.idPhoto = '.$_GET["idphoto"].';';
            $ins = $db->prepare($req);
            $ins->execute();
            $num = $ins->fetchAll();
            if(empty($num)){
                echo '<script>location.href="voirProfil.php";</script>';
            }
        ?>

        <?php
            foreach ($num as $value) {
                echo '
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="images/photos/'.htmlentities($value['nomImage']).'" alt="..." /></div> <!-- https://dummyimage.com/600x700/dee2e6/6c757d.jpg-->
                            <div class="col-md-6">
                            <div class="small mb-1">Date de publication : '.$value["datePub"].'</div>
                                <h1 class="display-5 fw-bolder">'.$value["libellePhoto"].'</h1>
                                <p class="lead">Photographe: '.$value['prenom']."\t". $value['nom'].'</p>
                                <p class="lead">Appartient à '.$_SESSION["prenom"]."\t". $_SESSION["nom"].'</p>
                                <div class="d-flex">
                                    <a class="btn btn-outline-success flex-shrink-0" href="images/photos/'.htmlentities($value['nomImage']).'" download="'.str_replace(" ", "_", $value['libellePhoto']).'"><i class="bi bi-download"></i> Télécharger l\'image</a>
                                </div>';
                            echo '
                            </div>
                        </div>
                    </div>
                </section>';
            }
        ?>

        <?php
            include('include/piedDePage.inc.php');
        ?>