        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "admin") { // Si l'utilisateur n'est pas admin
                echo '<script>location.href=".";</script>'; // On le redirige vers la page d'accueil
            }

            if(!empty($_GET['id'])) { // Si l'id n'est pas null
                $id = $_GET['id'];
                $sql = 'SELECT * FROM photo WHERE idPhoto = '.$id.' AND idPhoto NOT IN (SELECT idPhoto from acheter)'; // On récupère les données de la photo
                $req = $db->query($sql);
                $data = $result = $req->fetch();
            } else {
                echo "<script>location.href='gererPhoto.php';</script>"; // Sinon on redirige vers la page gererPhoto.php
            }
            if($data == false) {
                echo "<script>location.href='gererPhoto.php';</script>";
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Activer la photo</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Voulez vous activez cette photo ?</p>
                </div>
            </div>
        </header>

        <br>
        
        <div class="container">
            <form action="" method="post">
                <input type="hidden" name="idphoto" value="<?php echo $data['idPhoto'] ?>"/>
                <button type="submit" class="btn btn-success">Sauvegarder les changements</button> <!-- Bouton de validation-->
                <a href="gererPhoto.php" class="btn btn-danger">Retour</a> <!-- Bouton de retour-->
            </form>
        </div>

        <br>
        
        <?php
            include('include/piedDePage.inc.php');

            if($_POST) {
                $id = $_POST['idphoto'];
                $sql = $db->prepare("UPDATE photo SET active = 1 WHERE idPhoto = $id"); // On active la photo en changeant son statut active à 1
                try {
                    $sql->execute();
                    echo '<script>location.href="gererPhoto.php";</script>';
                } catch(PDOException $e) {
                    echo"<br> Erreur:". $e->getMessage(); // Affichage de l'erreur
                }
            }
        ?>