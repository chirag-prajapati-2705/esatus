<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Esatus</title>

    <!-- Bootstrap core CSS -->
    <?= $this->HTML->css('bootstrap.css'); ?>
    <link href="<?php echo URL ?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo URL ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <!-- Custom styles for this template -->
    <?= $this->HTML->css('modern-business'); ?>
    <?= $this->HTML->css('my_style'); ?>
    <?= $this->HTML->favicon(); ?>
    <?= $this->HTML->author(); ?>



    <?= $this->HTML->css('ss-symbolicons-line'); ?>
    <?= $this->HTML->css('owl.carousel'); ?>
    <?= $this->HTML->css('owl.theme'); ?>
    <?= $this->HTML->css('owl.transitions'); ?>
    <?= $this->HTML->css('style/masterslider'); ?>

    <?= $this->HTML->css('jquery-ui.min'); ?>
    <!-- Temporary navbar container fix -->
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
        /* Temporary fix for img-fluid sizing within the carousel */

        .carousel-item.active,
        .carousel-item-next,
        .carousel-item-prev {
            display: block;
        }
    </style>

</head>

<body>

<!-- Navigation -->
<nav class="navbar fixed-top navbar-toggleable-md">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
    </button>
    <div class="container">

        <a href="http://www.esatus.fr/index.php/" title="Esatus"><img src="http://www.esatus.fr/img/esatus/logo.png" alt="" />
        </a>

        <div class="collapse navbar-collapse" id="navbarExample">

            <ul class="navbar-nav ml-auto navone">

                <div class="card mb-2" style="border:none;">
                    <form class="" action="<?= Router::url('pages/search'); ?>" method="post">    <div class="input-group">

                            <input type="text" class="form-control" name="search" placeholder="Recherche..." style="border-radius:0px;border:none;">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit" title="Rechercher" style="border-radius:0px;">

                                        <i class="fa fa-search" aria-hidden="true"></i>

                                    </button>
                                </span>

                        </div></form>
                </div>

                <li class="nav-item nav_space">
                    <a class="nav-link dropdown-toggle gris" href="http://www.esatus.fr/index.php/creer-un-compte" title="Espace experts" id="">
                        Experts
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle gris" href="http://www.esatus.fr/index.php/#" title="Aide">
                        Aide
                    </a>

                </li>
                <li class="nav-item nav_space">
                    <a class="nav-link border" href="http://www.esatus.fr/index.php/creer-un-compte" title="S'inscrire">INSCRIPTION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border" href="http://www.esatus.fr/index.php/connexion">CONNEXION</a>
                </li>
            </ul>


            <div id ="tst" class="navbar navbar-toggleable-md navbar2">
                <ul class="navbar-nav m-auto nav2 container nav-2">
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/voyance" title="Astrologie">ASTRO</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/psychologie" title="Psycologie">PSYCHOLOGIE</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/juridique" title="Juridique">JURIDIQUE</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/stars" title="Stars">STARS</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/sante" title="Santé">SANTÉ</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/service" title="Service">SERVICE</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/enseignement" title="Enseignement">ENSEIGNEMENT</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/informatique" title="Informatique">INFORMATIQUE</a></li>
                    <li class="nav-item"><a  class="nav-link a2" href="http://www.esatus.fr/index.php/experts/business" title="Business">BUSINESS</a></li>
                </ul>
            </div>


        </div>

    </div>
</nav>
<?= $content_for_layout; ?>
<!-- Footer -->
<footer class="py-5 bg-inverse">
    <div class="container">
        <p class="align-center bold-txt footer-txt">Service client : 08 99 70 35 27</p>
        <p class="align-center footer-txt">
            Numéro surtaxé à 1,35€ TTC par appel +0,34€ la minute
        </p>
        <div class="row padtop3rem">

            <div class="col-md-3 col-sm-6 mb-4">
                <p class="white-txt blue-border">
                    Accueil
                </p>
                <ul>
                    <li>
                        <a href="http://www.esatus.fr/index.php/" title="Accueil">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="http://www.esatus.fr/index.php/rechercher" title="Rechercher des experts">
                            Recherche d'experts
                        </a>
                    </li>
                    <li>
                        <a href="http://www.esatus.fr/index.php/creer-un-compte" title="S'inscrire">
                            Inscription
                        </a>
                    </li>
                    <li>
                        <a href="http://www.esatus.fr/index.php/connexion" title="Se connecter">
                            Connexion
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <p class="white-txt blue-border">
                    Entreprise
                </p>
                <ul>
                    <li>
                        <a href="http://www.esatus.fr/index.php/conditions-g%C3%A9n%C3%A9rales-d-utilisation" title="A propos de nous">
                            A propos de nous
                        </a>
                    </li>
                    <li>
                        <a href="http://www.esatus.fr/index.php/mentions-legales" title="Mentions légales">
                            Mentions légales - CGU
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Conficiendalité">
                            Conficiendalité
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Politique de cookie">
                            Politique de cookie
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <p class="white-txt blue-border">
                    Aide
                </p>
                <ul>
                    <li>
                        <a href="#" title="FAQ">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Contactez-nous">
                            Contactez-nous
                        </a>
                    </li>
                    <li>
                        <a href="https://esatus.fr/blog" title="Blog">
                            Blog
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <p class="white-txt blue-border">
                    Suivez-nous
                </p>
                <ul>
                    <li>
                        <a href="https://fr-fr.facebook.com/EsatusOfficiel/" title="FACEBOOK">
                            FACEBOOK
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/esatus_services" title="TWITTER">
                            TWITTER
                        </a>
                    </li>
                    <li>
                        <a href="#" title="PINTEREST">
                            PINTEREST
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/106464933412410189100" title="GOOGLE PLUS">
                            GOOGLE PLUS
                        </a>
                    </li>
                </ul>
            </div>
            <p class="m-0 text-center text-white blue-border-top" style="width: 100%;
text-align: left !important;margin-left: 15px !important;margin-top:1rem!important;">&copy; Esatus</p>
        </div>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
