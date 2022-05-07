        <?php
            include('include/entete.inc.php');

            if($_SESSION['type'] != "admin" && $_SESSION['type'] != "photographe") {
                echo '<script>location.href=".";</script>';
            }
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Ajout de votre tag réussi</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Vous n'avez plus qu'a attendre l'activation de celui-ci par l'administrateur du site</p>
                </div>
            </div>
        </header>
        
        <br>

        <?php
            include('include/piedDePage.inc.php');
        ?>