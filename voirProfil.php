        <?php
            include('include/entete.inc.php');

            if(!isset($_SESSION['login'])) {
                echo '<script>location.href=".";</script>';
            }
            
            switch($_SESSION['type']) {
                case "client":       $categorie = "Client"; break;
                case "photographe":  $categorie = "Photographe"; break;
                case "admin":        $categorie = "Administrateur"; break;
            }
            $photo = $db->query('SELECT * FROM photo, users, tags WHERE users.idUser = photo.idUser AND tags.idTags = photo.idTags AND tags.active = 1 AND idPhoto NOT IN (SELECT idPhoto FROM acheter) AND photo.idUser="'.$_SESSION['id'].'" ORDER BY idPhoto DESC');
            $photoacheter = $db->query('SELECT * FROM acheter, tags, users, photo WHERE acheter.idUser = users.idUser AND acheter.idPhoto = photo.idPhoto AND tags.idtags = photo.idTags AND acheter.idUser = '.$_SESSION['id'].' ORDER BY photo.idPhoto DESC');
            $nombrephoto = $db->query('SELECT nombre_photo('.$_SESSION['id'].')');
            $nbr = $nombrephoto->fetch();
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Votre Profil</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Bienvenue sur votre profil</p>
                </div>
            </div>
        </header>

        <br>
            
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php echo "<img class='rounded-circle mt-5' width='150px' src='images/profil/".$_SESSION["photoUser"]."'>
                            <span class='font-weight-bold'>".htmlentities($_SESSION['prenom'])."\t".$_SESSION['nom']."</span>
                            <span class='text-black-50'>".htmlentities($_SESSION['email'])."</span>";
                        ?>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <?php echo "<h4 class='text-right'>Profil de"."\t".$_SESSION['prenom']."\t".$_SESSION['nom']."</h4>"?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Prenom</label><?php echo"<span class='form-control font-weight-bold'>"."\t".$_SESSION['prenom']."</span>";?></div>
                            <div class="col-md-6"><label class="labels">Nom</label><?php echo"<span class='form-control font-weight-bold'>"."\t".$_SESSION['nom']."</span>";?></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Statut</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($categorie)."</span>";?></div>
                            <?php
                                if($_SESSION['type']=="client") {
                                    echo "<div class='col-md-6'><label class='labels'>Date de Naissance</label><span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['dateNaiss'])."</span></div>";
                                } else if($_SESSION['type']=="photographe") {
                                    echo "<div class='col-md-6'><label class='labels'>SIRET</label><span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['siret'])."</span></div>";
                                    if($_SESSION['siteUser']!='') {
                                        echo "<div class='row mt-3'><div class='col-md-12'><label class='labels'>Site</label><span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['siteUser'])."</span></div></div>";
                                    }
                                }
                            ?>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center experience"><a class="btn btn-primary" href="editerProfil.php" role="button">Editer le profil</a></div><br>
                                <?php
                                    if($_SESSION['type']!="admin") {
                                        echo '<div class="col-md-8"><label class="labels">Credit</label><span class="form-control font-weight-bold">'.htmlentities($_SESSION['credit']).' <i class="bi bi-coin"></i></span></div>';
                                    }
                                    if($_SESSION['type']=="photographe") {
                                        echo "<div class='row mt-3'><div class='col-md-8'><label class='label'>Nombre de Photos Posté</label><span class='form-control font-weight-bold'>".$nbr[0]."</span></div> </div></div>";
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if($_SESSION['type']=="photographe") {
        ?>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Photo publiés par <?php echo $_SESSION['prenom']."\t".$_SESSION['nom']?></h1>
                </div>
            </div>
        </section>
        <div class='container px-4 px-lg-5 mt-5'>
            <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>

            <?php
                foreach ($photo as $value) {
                    echo"
                    <div class='col mb-5'>
                        <div class='card h-100'>
                        <!-- Product image-->
                        <img class='card-img-top' src='images/photos/".htmlentities($value['nomImage'])."' alt='...'/>
                            <!-- Product details-->
                            <div class='card-body p-4'>
                                <div class='text-center'>
                                    <!-- Product name-->
                                    <h5 class='fw-bolder'>".$value["libellePhoto"]."</h5>
                                    <!-- Product price-->
                                    ".$value["prix"]." <i class='bi bi-coin'></i> 
                                    <br>
                                    <small>".$value["libelleTags"]."</small>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>";
                };
            ?>

            </div>
        </div>

        <?php
            };

            if($_SESSION['type']=="client") {
        ?>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Photo acheter par <?php echo $_SESSION['prenom']."\t".$_SESSION['nom']?></h1>
                </div>
            </div>
        </section>
        <div class='container px-4 px-lg-5 mt-5'>
            <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>
      
            <?php
                foreach ($photoacheter as $value) {
                    echo"
                    <div class='col mb-5'>
                        <div class='card h-100'>
                            <!-- Product image-->
                            <img class='card-img-top' src='images/photos/".htmlentities($value['nomImage'])."' alt='...'/>
                            <!-- Product details-->
                            <div class='card-body p-4'>
                                <div class='text-center'>
                                    <!-- Product name-->
                                    <h5 class='fw-bolder'>".$value["libellePhoto"]."</h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='photoAcheter.php?idphoto=".$value['idPhoto']."'>Voir plus</a></div>
                            </div>
                        </div>
                    </div>";
                };
            ?>

            </div>
        </div>

        <?php
            };
        ?>

        <br>

        <?php
            include('include/piedDePage.inc.php');
        ?>