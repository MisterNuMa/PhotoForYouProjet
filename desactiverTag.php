        <?php
            include('include/entete.inc.php');

            if($_SESSION['type']!="admin") { // Si l'utilisateur n'est pas admin
                echo '<script>location.href=".";</script>'; // On le redirige vers la page d'accueil
            }
            
            if($_GET['id'] != null ) { // Si l'id n'est pas null
                $id = $_GET['id'];
                $sql = "SELECT * from tags where idTags = $id"; // On récupère les données du tag
                $req = $db->query($sql);
                $data = $result = $req->fetch();
            } else {
                echo "<script>location.href='gererTag.php';</script>"; // Sinon on redirige vers la page gérerUtilisateur.php
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Désactivation du tag</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Voulez vous désactivez ce tag ?</p>
                </div>
            </div>
        </header>

        <br>
        
        <div class="container">
            <form action="" method="post">
                <input type="hidden" name="idtag" value="<?php echo $data['idTags'] ?>"/>
                <button type="submit" class="btn btn-success">Sauvegarder les changements</button> <!-- Bouton de validation-->
                <a href="gererTag.php" class="btn btn-danger">Retour</a> <!-- Bouton de retour-->
            </form>
        </div>

        <br>
        
        <?php
            include('include/piedDePage.inc.php');

            if($_POST) {
                $id = $_POST['idtag'];
                $sql = $db->prepare("UPDATE tags SET active = 0 WHERE idTags = $id"); // On désactive le tag en changeant son statut active à 0
                try {
                    $sql->execute();
                    echo '<script>location.href="gererTag.php";</script>';
                } catch(PDOException $e) {
                    echo"<br> Erreur:". $e->getMessage(); // Affichage de l'erreur
                }
            }
        ?>