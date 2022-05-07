        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "photographe") {
                echo '<script>location.href=".";</script>';
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Échange crédits</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Échanger vos crédits contre de l'argent</p>
                </div>
            </div>
        </header>

        <br>
        
        <div class="container">
            <div class="jumbotron">
                <form  method="post"  id="form"  enctype="multipart/form-data" novalidate>
                    <fieldset>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label class='labels'>Nombre de crédit</label>
                            <span class='form-control font-weight-bold'><?php echo $_SESSION['credit']." <i class='bi bi-coin'></i></span>"; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label class='labels'>Convertion</label>
                            <span class='form-control font-weight-bold'><?php echo round($_SESSION['credit'] / 500 * 5 * 0.65, 2)." €"; ?></span>
                            <p class="user-select-none text-muted">Nous prenons 35% de commission. Les détails du calcul sont les suivants :<br>((Nombre de crédits / 500) * 5) * 0.65</p>
                        </div>
                    </div>
                    
                    <?php
                        if($_SESSION['credit'] > 0) {
                            echo '<p class="user-select-none text-muted">Cliquer sur convertir pour recevoir sur votre compte la somme indiquer au-dessus</p>
                            <input type="submit" class="btn btn-primary" value="Convertir" id="submit" name="submit"/>';
                        } else {
                            echo '<p class="user-select-none text-muted">Vous n\'avez pas de crédit à convertir</p>';
                        }
                    ?>

                    </fieldset>
                </form>
            </div>
        </div>

        <br>

        <?php
            include('include/piedDePage.inc.php');
            
            if(isset($_POST['submit'])) {
                $argent = round($_SESSION['credit'] / 500 * 5 * 0.65, 2);

                $sql = $db->prepare('UPDATE users SET credit = 0 WHERE idUser = :id');
                $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
                $sql1 = $db->prepare('UPDATE users SET argent = argent + :argent WHERE idUser = :id');
                $sql1->bindParam(':argent', $argent, PDO::PARAM_STR);
                $sql1->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
                try {
                    $sql->execute();
                    $sql1->execute();
                    $_SESSION['credit'] = 0;
                    echo '<script>location.href="echangeCreditReussi.php";</script>';
                } catch(Exception $e) {
                    echo '<br>Erreur : '.$e->getMessage();
                }
            }
        ?>