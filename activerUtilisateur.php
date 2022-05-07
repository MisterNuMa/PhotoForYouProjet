        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "admin") { // Si l'utilisateur n'est pas admin
                echo '<script>location.href=".";</script>'; // On le redirige vers la page d'accueil
            }

            if($_GET['id'] != null) { // Si l'id n'est pas null
                $id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE idUser = $id"; // On récupère les données de l'utilisateur
                $req = $db->query($sql);
                $data = $result = $req->fetch();
            } else {
                echo "<script>location.href='gererUtilisateur.php';</script>"; // Sinon on redirige vers la page gérerUtilisateur.php
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Activer l'utilisateur</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Voulez vous activez cet utilisateur ?</p>
                </div>
            </div>
        </header>

        <br>
        
        <div class="container">
            <form action="" method="post">
                <input type="hidden" name="iduser" value="<?php echo $data['idUser'] ?>"/>
                <button type="submit" class="btn btn-success">Sauvegarder les changements</button> <!-- Bouton de validation-->
                <a href="gererUtilisateur.php" class="btn btn-danger">Retour</a> <!-- Bouton de retour-->
            </form>
        </div>

        <br>
        
        <?php
            include('include/piedDePage.inc.php');

            if($_POST) {
                $id = $_POST['iduser'];
                $sql = $db->prepare("UPDATE users SET active = 1 WHERE idUser = $id"); // On active l'utilisateur en changeant son statut active à 1
                try {
                    $sql->execute();
                    echo '<script>location.href="gererUtilisateur.php";</script>';
                } catch(PDOException $e) {
                    echo"<br> Erreur:". $e->getMessage(); // Affichage de l'erreur
                }
            }
        ?>