        <?php
            include('include/entete.inc.php');
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Crédits</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Page d'achat de crédits</p>
                </div>
            </div>
        </header>

        <br>        

        <div class="container py-3">
            <main>
                <form action="" method="post">
                    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3">
                                    <h4 class="my-0 fw-normal">Offre n°1</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">5€</h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>500 crédits</li>
                                    </ul>
                                    <?php
                                        if(isset($_SESSION['login']) && $_SESSION['type'] == "client") {
                                            echo '<button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option1" id="option1">Acheter</button>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3">
                                    <h4 class="my-0 fw-normal">Offre n°2</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">10€</h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>1000 crédits</li>
                                    </ul>
                                    <?php
                                        if(isset($_SESSION['login']) && $_SESSION['type'] == "client") {
                                            echo '<button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option2" id="option2">Acheter</button>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3">
                                    <h4 class="my-0 fw-normal">Offre n°3</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">20€</h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>2000 crédits</li>
                                    </ul>
                                    <?php
                                        if(isset($_SESSION['login']) && $_SESSION['type'] == "client") {
                                            echo '<button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option3" id="option3">Acheter</button>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </main>

            <?php
                if(!isset($_SESSION['login'])) {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">         
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    </svg>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            Vous devez être <a href="connexion.php" class="alert-link">connecté</a> à un compte client pour pouvoir acheter des crédits.
                        </div>
                    </div>';
                } else if($_SESSION['type'] == "admin" || $_SESSION['type'] == "photographe") {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">         
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    </svg>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            Seul un client peut acheter des crédits.
                        </div>
                    </div>';
                }
            ?>
            
        </div>

        <br>

        <?php

            //Requête pour ajouter 500 crédits au compte d'un utilisateur(option 1)
            if(isset($_POST['option1'])) {
                $newcredit = $_SESSION['credit'] + 500;
                $insertcredit = $db->prepare("UPDATE photoforyou.users SET credit = ? WHERE idUser = ?");
                $insertcredit->execute(array($newcredit, $_SESSION['id']));
                $_SESSION['credit'] = $newcredit;
                echo '<script>location.href="credit.php";</script>';
            }

            //Requête pour ajouter 1000 crédits au compte d'un utilisateur(option 2)
            if(isset($_POST['option2'])) {
                $newcredit = $_SESSION['credit'] + 1000;
                $insertcredit = $db->prepare("UPDATE photoforyou.users SET credit = ? WHERE idUser = ?");
                $insertcredit->execute(array($newcredit, $_SESSION['id']));
                $_SESSION['credit'] = $newcredit;
                echo '<script>location.href="credit.php";</script>';
            }

            //Requête pour ajouter 2000 crédits au compte d'un utilisateur(option 3)
            if(isset($_POST['option3'])) {
                $newcredit = $_SESSION['credit'] + 2000;
                $insertcredit = $db->prepare("UPDATE photoforyou.users SET credit = ? WHERE idUser = ?");
                $insertcredit->execute(array($newcredit, $_SESSION['id']));
                $_SESSION['credit'] = $newcredit;
                echo '<script>location.href="credit.php";</script>';
            }

            include('include/piedDePage.inc.php');
        ?>