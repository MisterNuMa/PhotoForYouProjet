        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "admin") { // Si l'utilisateur n'est pas admin
                echo '<script>location.href="connexion.php";</script>'; // On le redirige vers la page de connexion
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Gestion des Photos</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Désactiver ou Activer une photo</p>
                </div>
            </div>
        </header>

        <br>

        <div class="container">
            <div class="jumbotron">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <table class="table">
                        <thead class="thead-dark" style="width:100%">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nom de la photo</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Photographe</th>
                                <th scope="col">Nom du tag</th>
                                <th scope="col">Date de publication</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT idPhoto, nomImage, libellePhoto, prix, email, libelleTags, datePub, photo.active FROM photo, users, tags WHERE users.idUser = photo.idUser AND photo.idTags = tags.idTags AND idPhoto NOT IN (SELECT idPhoto from acheter) ORDER BY idPhoto DESC"; // On récupère toutes les photos et on les trie par ordre décroissant
                                $ins = $db->prepare($sql);
                                $ins->execute();
                                $result = $ins->fetchAll();
                                if($result > 0) { // Si il y a des photos
                                    foreach ($result as $value) {
                                        echo "<tr>
                                        <th scope='row'>".$value['idPhoto']."</th>
                                        <td>".$value['libellePhoto']."</td>
                                        <td><img src='images/photos/".$value['nomImage']."' alt='...' width='125'/></td>
                                        <td>".$value['prix']." <i class='bi bi-coin'></i></td>
                                        <td>".$value['email']."</td>
                                        <td>".$value['libelleTags']."</td>
                                        <td>".$value['datePub']."</td>
                                        <td>".$value['active']."</td>
                                        <td>";
                                        if($value['active'] == 1) { // Si photo est actif
                                            echo "<a href='desactiverPhoto.php?id=".$value['idPhoto']."' class='btn btn-danger'>Désactiver</a>"; // Bouton de désactivation
                                        } else { // Si photo est désactivé
                                            echo "<a href='activerPhoto.php?id=".$value['idPhoto']."' class='btn btn-success'>Activer</a>"; // Bouton d'activation
                                        }
                                        echo "</td>
                                        </tr>";
                                    }
                                }
                                else { // Si il n'y a pas de photos
                                    echo "<tr><td colspan='7'><center>Pas de Donnée</center></td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
            include('include/piedDePage.inc.php')
        ?>