        <?php
            include('include/entete.inc.php');
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">PhotoForYou</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Des pros au service des professionnels de la communication</p>
                </div>
            </div>
        </header>
        
        <br>

        <div class="container text-center">
            <main>
                <!-- Carrousel-->
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                <div class="carousel-item active" data-interval="4000">
                    <img class="d-block w-100" src="images/carousel/hiver.jpg" alt="...">
                <div class="container">
                </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                    <img class="d-block w-100" src="images/carousel/printemps.jpg" alt="...">
                <div class="container">
                </div>
                </div>
                <div class="carousel-item" data-interval="1000">
                    <img class="d-block w-100" src="images/carousel/automne.jpg" alt="...">
                <div class="container">
                </div>
                </div>
                </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </main>

            <div class="h-100 p-3 text-white bg-dark rounded-3">
                <img class="rounded mx-auto d-block" src="assets/logo.png" alt="..." width="250">
                <h3>Moins de temps à chercher. Plus de résultats.</h3>
                <h6>Découvrez les images qui vous aideront à vous démarquer.</h6>
            </div>
        </div>
        
        <br>

        <?php
            include('include/piedDePage.inc.php');
        ?>