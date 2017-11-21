<?= $this->HTML->docType(); ?>
<html lang="fr" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>

        <?= $this->HTML->charset('utf-8'); ?>

        <?= $this->HTML->title($title_for_layout); ?>
        <?=
        $this->HTML->metas(array(
            'description' => $description_for_layout,
            'classification' => $classification_for_layout,
            'keywords' => $keywords_for_layout,
            'country' => $country_for_layout,
            'viewport' => 'initial-scale=1.0'
        ));
        ?>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="google-site-verification" content="M2zlrDkRnQ8LJHBT5nKa8n2P5AB8cPmMZclSUKS1_9Y">

        <?= $this->HTML->favicon(); ?>
        <?= $this->HTML->author(); ?>

            <!-- Google Webfont -->
            <link href='http://fonts.googleapis.com/css?family=Vampiro+One' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,800' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,600,700' rel='stylesheet' type='text/css'>

            <!-- CSS -->
            <?= $this->HTML->css('landing/font-awesome/css/font-awesome'); ?>
            <?= $this->HTML->css('landing/bootstrap'); ?>
            <?= $this->HTML->css('landing/slick/slick'); ?>
            <?= $this->HTML->css('landing/slick/slick-theme'); ?>
            <?= $this->HTML->css('landing/flex-slider/flexslider'); ?>
            <?= $this->HTML->css('landing/owl-carousel/owl.carousel'); ?>
            <?= $this->HTML->css('landing/owl-carousel/owl.theme'); ?>
            <?= $this->HTML->css('landing/owl-carousel/owl.transitions'); ?>
            <?= $this->HTML->css('landing/prettyphoto'); ?>
            <?= $this->HTML->css('landing/style'); ?>

            <!-- SKIN -->
            <?= $this->HTML->css('landing/colors/skin-blue'); ?>

            <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

            <!-- MODERNIZR -->
            <?= $this->HTML->js('landing/modernizr.custom'); ?>

            <!-- Javascript -->
            <?= $this->HTML->js('landing/bootstrap.min'); ?>
            <?= $this->HTML->js('landing/jquery.easing.min'); ?>
            <?= $this->HTML->js('landing/flex-slider/jquery.flexslider'); ?>
            <?= $this->HTML->js('landing/owl-carousel/owl.carousel'); ?>
            <?= $this->HTML->js('landing/slick/slick'); ?>
            <?= $this->HTML->js('landing/jquery.prettyphoto'); ?>
            <?= $this->HTML->js('landing/jquery.countdown.min'); ?>
            <?= $this->HTML->js('landing/jquery.flip.min'); ?>
            <?= $this->HTML->js('landing/main'); ?>


            <!--[if lt IE 9]><?= $this->HTML->js('html5'); ?><![endif]-->
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-44456186-1', 'esatus.fr');
            ga('send', 'pageview');

        </script>
        <meta name="google-site-verification" content="w6c2-E1VOaLAMOAmE8GOZE-Yb9S5rk1ipiBXazlH49w" />
        <meta name="verification" content="4c966270e08d01c26ff0d4ca36fe0e29" />
        <?php
        if (!isset($_SESSION['source'])) {
            $_SESSION['source'] = $_SERVER['HTTP_REFERER'];
        }
        echo $_SESSION['source'];
        ?>
        <?php
        include('../controller/Status.php');
        include ('../ajax_status.js');
        ?>    
    </head>
    <body id="page-top">
    <div id="body">
        <!-- HEADER -->
    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-top">
            <div class="container">
                <div class="col-md-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= Router::url('categories/index'); ?>"><img src="<?= IMAGE; ?>landing/logo.png"></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/experts">Accueil</a></li>
                            <li><a href="#">Abonnement</a></li>
                            <li><a href="#">Connexion</a></li>
                            <li><a class="page-scroll" href="#">Contactez-nous</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </nav>
    </header>
        <?= $content_for_layout; ?>
    </div>

    </body>
</html>

