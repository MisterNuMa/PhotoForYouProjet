        <?php
            include('include/entete.inc.php');

            if(isset($_GET['idtags'])) {
                $photo = $db->query('SELECT * FROM photo, users, tags WHERE photo.idUser = users.idUser AND tags.idTags = photo.idTags AND tags.idTags = '.$_GET['idtags'].' AND tags.active = 1 AND photo.active = 1 AND idPhoto NOT IN (SELECT idPhoto FROM acheter) ORDER BY idPhoto DESC;');
            } else {
                $photo = $db->query('SELECT * FROM photo, users, tags WHERE photo.idUser = users.idUser AND tags.idTags = photo.idTags AND tags.active = 1 AND photo.active = 1 AND idPhoto NOT IN (SELECT idPhoto FROM acheter) ORDER BY idPhoto DESC;');
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Album photo</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Acheter des photos prises et vendu par des professionnels</p>
                </div>
            </div>
        </header>

        <br>

        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                    foreach($photo as $value) {
                        echo '<div class="col mb-5">
                            <div class="card h-100">
                                <img class="card-img-top" src="images/photos/'.htmlentities($value['nomImage']).'" alt="..." />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">'.$value['libellePhoto'].'</h5>
                                        '.$value['prix'].' <i class="bi bi-coin"></i>
                                        <br>
                                        <small class="text-muted">'.$value['libelleTags'].'</small>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="acheterPhoto.php?idphoto='.$value['idPhoto'].'">Voir Plus</a></div>
                                </div>
                            </div>
                        </div>';
                    }
                ?>

                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <h2 class="fw-bolder mb-4 text-center">Catégories</h2>
                <!-- On affiche les catégories, il y a une en brut (Toutes les photos) et les autres seront affichés grâce au PHP et une requête SQL -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                    <?php
                        if(isset($_GET['idtags'])) {
                            $id = $_GET['idtags'];
                            $tags = $db->query('SELECT * FROM tags WHERE tags.active = 1 AND idTags NOT IN ('.$id.') ORDER BY idTags DESC');
                        } else {
                            $tags = $db->query('SELECT * FROM tags WHERE tags.active = 1 ORDER BY idTags DESC');
                        }
                        foreach($tags as $value) {
                            echo"
                            <a style='color: #000000; text-decoration: none; text-align: center;' href='voirPhoto.php?idtags=".$value['idTags']."'>
                            <div class='col'>
                                <div class='card shadow-sm'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>".$value["libelleTags"]."</h5>
                                    </div>
                                </div>
                            </div>
                            </a>";
                        }
                    ?>

                </div>
            </div>
        </div>
        
        <br>

        <script src="assets/js/protectionImage.js"></script>

        <?php
            include('include/piedDePage.inc.php');
        ?>