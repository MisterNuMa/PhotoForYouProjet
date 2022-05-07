        <?php
            include('include/entete.inc.php');

            if($_SESSION['type']!="admin") { // Si l'utilisateur n'est pas admin
                echo '<script>location.href="connexion.php";</script>'; // On le redirige vers la page de connexion
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Gestion des Tags</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Désactiver ou Activer un tag</p>
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
                                <th scope="col">Nom du tag</th>
                                <th scope="col">Active</th>
                                <th scope="col">Créateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT idTags, libelleTags, tags.active, email FROM tags, users WHERE tags.idUser = users.idUser ORDER BY idTags DESC"; // On récupère tous les tags et l'email de l'utilisateur et on les trie par ordre décroissant
                                $ins = $db->prepare($sql);
                                $ins->execute();
                                $result = $ins->fetchAll();
                                if($result > 0) { // Si il y a des tags
                                    foreach ($result as $value) {
                                        echo "<tr>
                                        <th scope='row'>".$value['idTags']."</th>
                                        <td>".$value['libelleTags']."</td>
                                        <td>".$value['active']."</td>
                                        <td>".$value['email']."</td>
                                        <td>";
                                        if($value['active'] == 1) { // Si le tag est actif
                                            echo "<a href='desactiverTag.php?id=".$value['idTags']."' class='btn btn-danger'>Désactiver</a>"; // Bouton de désactivation
                                        } else { // Si le tag est désactivé
                                            echo "<a href='activerTag.php?id=".$value['idTags']."' class='btn btn-success'>Activer</a>"; // Bouton d'activation
                                        }
                                        echo "</td>
                                        </tr>";
                                    }
                                }
                                else { // Si il n'y a pas de tags
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