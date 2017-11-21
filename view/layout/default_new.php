<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Esatus</title>

    <!-- Bootstrap core CSS -->
    <link href="http://esatus.fr/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="http://esatus.fr/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link href="<?= $this->HTML->css('modern-business'); ?>" rel="stylesheet">
    <link href="<?= $this->HTML->css('my_style'); ?>" rel="stylesheet">
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

            <a href="http://www.esatus.fr/index.php/" title="Esatus"><img src="img/esatus/logo.png" alt="" />
            </a>

            <div class="collapse navbar-collapse" id="navbarExample">
                
                <ul class="navbar-nav ml-auto navone">

                    <div class="card mb-2" style="border:none;">
                         <form class="" action="http://www.esatus/index.php/rechercher" method="post">    <div class="input-group">
                                
                                    <input type="text" class="form-control" placeholder="Recherche..." style="border-radius:0px;border:none;">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit" title="Rechercher" style="border-radius:0px;">
                                        
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        
                                    </button>
                                </span>
                            
                            </div></form>
                    </div>
                    
                    <li class="nav-item nav_space">
                        <a class="nav-link dropdown-toggle gris" href="http://www.esatus.fr/index.php/espace-expert" title="Espace experts" id="">
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
        <div class="container cnx">
        <div class="row bloc-rs" style="background-image:url('http://esatus.fr/img/esatus/world_map.png');background-repeat: no-repeat;background-size: 100%;">
                <div class="chap">
                    <h1 class="quicksand-bold">Provoquez votre réussite. Communiquez. Monétisez votre Talent</h1>
                    <h2 class="quicksand">Réussissez 3 fois plus vite avec nos experts. Bénéficiez d’un programme sur mesure</h2>
                </div>
                <div class="col-lg-4 mb-4">
                </div>
                <div class="col-lg-4 mb-4">
                </div>
                <div class="col-lg-4 mb-4">
                    
                    <form name="sentMessage" id="connexForm" novalidate>
                            <div>
                                <a href="#" title="Connectez-vous avec Facebook" class="btn btn-primary fbform">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                        <p>Connectez-vous avec Facebook</p>
                                </a>
                            </div>
                            <div>
                                <a href="#" title="Connectez-vous avec Twitter" class="btn btn-primary ttform">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                        <p>Connectez-vous avec Twitter</P>
                                </a>
                            </div>
                            <div class="control-group form-group nameform">
                                <div class="controls">
                                    
                                    <input type="text" class="form-control" id="name" placeholder="Nom" required data-validation-required-message="Please enter your first name.">
                                    <!-- <p class="help-block"></p> -->
                                </div>
                            </div>
                            <div class="control-group form-group name2form">
                                <div class="controls">
                                    
                                    <input type="text" class="form-control" id="name2" placeholder="Prénom" required data-validation-required-message="Please enter your last name.">
                                </div>
                            </div>
                            <div class="control-group form-group emailform">
                                <div class="controls">
                                    
                                    <input type="email" class="form-control" id="email" 
                                    placeholder="Adresse e-mail" required data-validation-required-message="Please enter your email address.">
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    
                                    <input type="password" class="form-control" id="password" 
                                    placeholder="Mot de passe (6 caractères minimum)" required data-validation-required-message="Please enter your email address.">
                                </div>
                            </div>
                           <div class="cdu">
                            <p>En cliquant sur S’inscrire, vous acceptez les <a href="http://www.esatus.fr/index.php/conditions-g%C3%A9n%C3%A9rales-d-utilisation" title="voir les conditions d'utilisation">Conditions d’utilisation</a>, la <a href="http://www.esatus.fr/index.php/conditions-g%C3%A9n%C3%A9rales-d-utilisation" title="Voir notre politique de confidentialité">Politique de confidentialité</a>, et la <a href="http://www.esatus.fr/index.php/mentions-legales" title="Voir les mentions légales">Politique relatives aux cookies</a> de Ésatus</p>
                           </div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                            <button id="inscrip-cta" type="submit" class="btn btn-primary2 btform" title="S'inscrire">S'inscrire</button>
                    </form>
                </div>
            
        
    </div>
        </div>

    
    <h1 class="my-4 quicksand">Nos experts les plus populaires</h1>   
    <!-- Page Content -->
    <div class="container">


        <!-- Portfolio Section -->
        <div class="row" id="exp-selec">
            <div class="col-lg-4 col-sm-6 portfolio-item">
              <!--  <div class="card h-100"> -->
                    <div class="card">
                <!--     <a href="#" style="float:left;width:45%;margin-right: 0.5rem;"> -->
                        <img class="card-img-top img-fluid" src="img/esatus/expert01-home.png" alt="" style="float:left;width:41%;margin-right: 0.5rem;">
                <!--     </a> -->
                    <div class="card-block">
                        <h4 class="card-title" style="float:left;width:53%">David Val</h4>
                        <h5 class="card-subtitle">Médium - Voyant</h5>
                        <p class="card-text">-30% sur votre 1ère consultation</p>
                    </div>
                </div>
                <div class="card-footer">
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/david-val--1" title="Consulter cet expert" class="btn2e btn-primary2">Appeller 3.50€/min</a>
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/david-val--1" title="Voir sa fiche" class="btn2e btn-primary">Voir sa fiche</a>
                    </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card">
                    <a href="#" style="float:left;width:41%;margin-right: 0.5rem;"><img class="card-img-top img-fluid" src="img/esatus/expert02-home.png" alt=""></a>
                    <div class="card-block">
                        <h4 class="card-title" style="float:left;width:53%">Adelaid</h4>
                        <h5 class="card-subtitle">Médium de naissance</h5>
                        <p class="card-text">-30% sur votre 1ère consultation</p>
                    </div>
                </div>
                <div class="card-footer">
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/adelaid-435" title="Consulter cet expert" class="btn2e btn-primary2">Appeller 2.75€/min</a>
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/adelaid-435" title="Voir sa fiche" class="btn2e btn-primary">Voir sa fiche</a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card">
                    <a href="#" style="float:left;width:41%;margin-right: 0.5rem;"><img class="card-img-top img-fluid" src="img/esatus/expert03-home.png" alt=""></a>
                    <div class="card-block">
                        <h4 class="card-title" style="float:left;width:53%">Olivia</h4>
                        <h5 class="card-subtitle">Médium</h5>
                        <p class="card-text">-30% sur votre 1ère consultation</p>
                    </div>
                </div>
                <div class="card-footer">
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/olivia-meduim-426" title="Consulter cet expert" class="btn2e btn-primary2">Appeller 2.60€/min</a>
                        <a href="http://www.esatus.fr/index.php/experts/voyance/medium-voyant/olivia-meduim-426" title="Voir sa fiche" class="btn2e btn-primary">Voir sa fiche</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>    


        <!-- Marketing Icons Section -->
    <div class="greybkg">
        <div class="container">
        <h1 class="blue-title quicksand-bold">COMMENT ÇA MARCHE ?</h1>  
        <div class="row">

            <div class="col-lg-4 mb-4">
                <div class="h-100">
                   
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/etape1.png" alt="">
                        <p class="card-text txt-1r quicksand">Je choisis un expert</p>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                   
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/etape2.png" alt="">
                        <p class="card-text txt-1r quicksand">Je clique sur appeler... mon téléphone sonne</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                    
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/etape3.png" alt="">
                        <p class="card-text txt-1r quicksand">Je note les conseils de l’expert</p>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
   </div> 
    <div class="container"> 

    <h1 class="blue-title quicksand-bold">3 moyens pour consulter l'expert de votre choix</h1>  
        <div class="row">

            <div class="col-lg-4 mb-4">
                <div class="h-100">
                   
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/tel-icon.png" alt="">
                        <p class="card-text txt-1r quicksand">Téléphone</p>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                   
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/webcam-icon.png" alt="">
                        <p class="card-text txt-1r quicksand">Web cam</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                    
                    <div class="card-block align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/chat-icon.png" alt="">
                        <p class="card-text txt-1r quicksand">Chat</p>
                    </div>
                
                </div>
            </div> 
        </div>
     </div>         
        <!-- Features Section -->
        <div class="row feat">
            <div class="col-lg-6">
                <img class="img-fluid" src="img/esatus/img-fonctionnement.png" alt="">
            </div>
            <div class="col-lg-6 feat-txt" style="padding-right:7rem;">
                <div class="hgt"></div>
                <h2 class="align-center grey-txt quicksand fonctio">Fonctionnement</h2>
                <p class="blue-txt bold-txt txt-13r quicksand-bold 90pc">Choisissez la catégorie métier qui vous intéresse</p>
                <ul class="grey-txt quicksand" style="padding-right:5rem;">
                    <li>Sélectionnez l’expert que vous souhaitez consulter après consultation des tarifs, notes et avis de nos membres
                    </li>
                    <li>Utilisez le support de communication adapté à votre expert</li>
                    <li>Cliquez sur le bouton “j’appelle” et mettez vous en relation avec l’expert</li>
                    <li>Votre numéro de téléphone est protégé</li>
                    <li>Notez, échangez, les conseils avec la communauté Esatus</li>
                </ul>
                
            </div>
            
        </div>
        <!-- /.row -->

        <div class="orangebkg height">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                   
                    <div class="card-block align-right offre">
                        
                        <p class="card-text txt-19r white-txt quicksand"><span class="bold-txt">Offre</span> de bienvenue</p>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-4 mb-4" id="img-offre">
                <div class="h-100">
                   
                    <div class="align-center">
                        <img class="card-img-top img-fluid" src="img/esatus/offre25e.png" alt="" style="">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="h-100">
                    
                    <div class="card-block align-left offre" style="padding-left:0;">
                        
                        <p class="card-text txt-19r white-txt bold-txt quicksand">Sur la 1ere consultation</p>
                    </div>
                
                </div>
            </div> 
        </div>
        </div>
        </div>





    <div class="greybkg bloc-partenaires bloc-content" style="padding-top: 4rem;">
        <div class="container">
            <h2 class="align-center grey-txt cnt quicksand">Ils nous font confiance</h2>
            <div class="row align-center cnt">
              <div class="col-md-2"><img src="img/esatus/orange.jpg" alt="logo orange" class="center-block img-responsive"></div>
              <div class="col-md-2"><img src="img/esatus/paybox.jpg" alt="logo paybox" class="center-block img-responsive"></div>
              <div class="col-md-2"><img src="img/esatus/conversant.jpg" alt="conversant" class="center-block img-responsive"></div>
              <div class="col-md-2"><img src="img/esatus/credit_agricole.jpg" alt="credit agricole" class="center-block img-responsive"></div>
              <div class="col-md-2"><img src="img/esatus/4u-consulting.png" alt="4u consulting" class="center-block img-responsive"></div>
            </div>
        </div>   
    </div>              


     <div class="bloc-partenaires bloc-content">
        <div class="container">
            <p class="grey-txt cnt quicksand">Annuaire expert</p>
        <div class="row align-center cnt annuaire">
          <a href="rechercher A" title="Consulter l'annuaire"><img src="img/esatus/a.png" alt="" style="width:55px;"><a/>
          <a href="rechercher B" title="Consulter l'annuaire"><img src="img/esatus/b.png" alt="" style="width:55px;"><a/>
          <a href="rechercher C" title="Consulter l'annuaire"><img src="img/esatus/c.png" alt="" style="width:55px;"><a/>
          <a href="rechercher D" title="Consulter l'annuaire"><img src="img/esatus/d.png" alt="" style="width:55px;"><a/>
          <a href="rechercher E" title="Consulter l'annuaire"><img src="img/esatus/e.png" alt="" style="width:55px;"><a/>
          <a href="rechercher F" title="Consulter l'annuaire"><img src="img/esatus/f.png" alt="" style="width:55px;"><a/>
          <a href="rechercher G" title="Consulter l'annuaire"><img src="img/esatus/g.png" alt="" style="width:55px;"><a/>
          <a href="rechercher H" title="Consulter l'annuaire"><img src="img/esatus/h.png" alt="" style="width:55px;"><a/>
          <a href="rechercher I" title="Consulter l'annuaire"><img src="img/esatus/i.png" alt="" style="width:55px;"><a/>
          <a href="rechercher J" title="Consulter l'annuaire"><img src="img/esatus/j.png" alt="" style="width:55px;"><a/>
          <a href="rechercher K" title="Consulter l'annuaire"><img src="img/esatus/k.png" alt="" style="width:55px;"><a/>
          <a href="rechercher L" title="Consulter l'annuaire"><img src="img/esatus/l.png" alt="" style="width:55px;"><a/>
          <a href="rechercher M" title="Consulter l'annuaire"><img src="img/esatus/m.png" alt="" style="width:55px;"><a/>
          <a href="rechercher N" title="Consulter l'annuaire"><img src="img/esatus/n.png" alt="" style="width:55px;"><a/>
          <a href="rechercher O" title="Consulter l'annuaire"><img src="img/esatus/o.png" alt="" style="width:55px;"><a/>
          <a href="rechercher P" title="Consulter l'annuaire"><img src="img/esatus/p.png" alt="" style="width:55px;"><a/>
          <a href="rechercher Q" title="Consulter l'annuaire"><img src="img/esatus/q.png" alt="" style="width:55px;"><a/>
          <a href="rechercher R" title="Consulter l'annuaire"><img src="img/esatus/r.png" alt="" style="width:55px;"><a/>
          <a href="rechercher S" title="Consulter l'annuaire"><img src="img/esatus/s.png" alt="" style="width:55px;"><a/>
          <a href="rechercher T" title="Consulter l'annuaire"><img src="img/esatus/t.png" alt="" style="width:55px;"><a/>
          <a href="rechercher U" title="Consulter l'annuaire"><img src="img/esatus/u.png" alt="" style="width:55px;"><a/>
          <a href="rechercher V" title="Consulter l'annuaire"><img src="img/esatus/v.png" alt="" style="width:55px;"><a/>
          <a href="rechercher W" title="Consulter l'annuaire"><img src="img/esatus/w.png" alt="" style="width:55px;"><a/>
          <a href="rechercher X" title="Consulter l'annuaire"><img src="img/esatus/x.png" alt="" style="width:55px;"><a/>
          <a href="rechercher Y" title="Consulter l'annuaire"><img src="img/esatus/y.png" alt="" style="width:55px;"><a/>
          <a href="rechercher Z" title="Consulter l'annuaire"><img src="img/esatus/z.png" alt="" style="width:55px;"><a/>
        </div>
        </div>   
    </div> 

       


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
