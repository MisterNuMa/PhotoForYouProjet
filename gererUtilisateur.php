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
                    <h1 class="display-4 fw-bolder">Gestion Utilisateurs</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Désactiver ou Activer un compte utilisateur</p>
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
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT idUser, email, type, active FROM users WHERE type != 'admin' ORDER BY idUser DESC"; // On récupère tous les utilisateurs sauf les admins et on les trie par ordre décroissant
                                $ins = $db->prepare($sql);
                                $ins->execute();
                                $result = $ins->fetchAll();
                                if($result > 0) { // Si il y a des utilisateurs
                                    foreach ($result as $value) {
                                        echo "<tr>
                                        <th scope='row'>".$value['idUser']."</th>
                                        <td>".$value['email']."</td>
                                        <td>".$value['type']."</td>
                                        <td>".$value['active']."</td>
                                        <td>";
                                        if($value['active'] == 1) { // Si l'utilisateur est actif
                                            echo "<a href='desactiverUtilisateur.php?id=".$value['idUser']."' class='btn btn-danger'>Désactiver</a>"; // Bouton de désactivation
                                        } else { // Si l'utilisateur est désactivé
                                            echo "<a href='activerUtilisateur.php?id=".$value['idUser']."' class='btn btn-success'>Activer</a>"; // Bouton d'activation
                                        }
                                        echo "</td>
                                        </tr>";
                                    }
                                }
                                else { // Si il n'y a pas d'utilisateur
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