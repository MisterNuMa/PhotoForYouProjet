<?php
    require_once('include/dbconnect.php');

    if(isset($_POST['submit'])) {
        // Traitement de la photo
        if($_FILES) {
            switch($_FILES['photoUser']['type']) {
                case 'image/jpeg': $extension = 'jpg'; break;
                case 'image/png':  $extension = 'png'; break;
                default:           $extension = ''; break;
            }
            if($extension && $_FILES['photoUser']['size'] < 30*1024*1024) {
                // Changer le nom de l'image
                $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $nom_alea = '';
                for($i = 0; $i < 20; $i++) {
                    $nom_alea .= substr($alpha, rand() % (strlen($alpha)), 1);
                }
                date_default_timezone_set('Europe/Paris');
                $nom_fichier = $nom_alea.date('_Y_m_d_H_i_s.').$extension;
                $fileName = $_FILES['photoUser']['name'];
                $tempName = $_FILES['photoUser']['tmp_name'];
                if(!isset($fileName)) {
                    if(!$extension) echo $_FILES['photoUser']['name']."n'est pas accepté comme fichier image";
                    else echo "L'image dépasse les 30 Mo";
                }
            }
            if(strlen($nom_fichier) == 0) {
                $nom_fichier = "user.jpg";
            }
            // Traitement des données
            function valid_donnees($donnees) {
                $donnees = trim($donnees);
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);
                return $donnees;
            }
            // Traitement des données et récuparation des données du formulaire dans des variables grâce à la métode POST
            $nom = valid_donnees($_POST['nom']);
            $prenom = valid_donnees($_POST['prenom']);
            $email = valid_donnees($_POST['email']);
            $mdp = hash('sha512', $_POST['motdepasse1']);
            $mdp2 = hash('sha512', $_POST['motdepasse2']);
            $date = $_POST['dateNaissance'];
            $ok = true;
            // Test pour savoir si les valeurs ont bien été rentrées
            // Condition sur le nom
            if(empty($nom)
                ||
                strlen($nom) < 3
                ||
                strlen($nom) > 45) {
            $ok = false;
            }
            // Condition sur le prénom
            if(empty($prenom)
                ||
                strlen($prenom) < 3
                ||
                strlen($prenom) > 45) {
            $ok = false;
            }
            // Condition sur le mail
            $sqlmail = 'SELECT count(email) FROM users WHERE email="'.$email.'" AND type="client"';
            $reqmail = $db->query($sqlmail);
            $resultemail = $reqmail->fetch();
            foreach($resultmail as $rmail) {
                if($rmail == 1) {
                    $ok = false;
                }
            }
            if(empty($email)
                ||
                !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $ok = false;
            }
            // Condition sur le mot de passe
            if(empty($mdp)
                ||
                empty($mdp2)
                ||
                $mdp != $mdp2) {
            $ok = false;
            }
            // Condition sur la date de naissance
            if($date > date('Y-m-d', strtotime('-13 year'))
                ||
                $date < date('Y-01-01', strtotime('-117 year'))) {
            $ok = false;
            }
            // Si tout est bon on insère les données dans la base de données
            if($ok == true) {
                $sql = $db->prepare('INSERT INTO users(nom, prenom, email, mdp, dateNaiss, active, type, photoUser) VALUES(InitCap(:nom), InitCap(:prenom), lower(:email), :mdp, :dateNaiss, 1, "client", :photo)');
                $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
                $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $sql->bindParam(':email', $email, PDO::PARAM_STR);
                $sql->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $sql->bindParam(':dateNaiss', $date, PDO::PARAM_STR);
                $sql->bindParam(':photo', $nom_fichier, PDO::PARAM_STR);
                try {
                    $sql->execute();
                    if(!empty($fileName)) {
                        $location = 'images/profil/';
                        if(move_uploaded_file($tempName, $location.$nom_fichier)) {
                            echo 'Image Envoyé';
                        }
                    }
                    echo '<script>location.href="inscriptionReussie.php";</script>';
                } catch(Exception $e) {
                    echo '<br>Erreur : '.$e->getMessage();
                }
            } else {
                echo '<script>location.href="formInscriptionClient.php";</script>';
            }
        } else {
            echo '<script>location.href="formInscriptionClient.php";</script>';
        }
    }

    if($_SESSION['type'] != "visiteur") {
        echo '<script>location.href=".";</script>';
    }
?>