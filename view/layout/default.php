
<?= $this->HTML->docType(); ?>
<html lang="fr" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>

        <?= $this->HTML->charset('utf-8'); ?>

        <?= $this->HTML->title($title_for_layout); ?>
        <?=
        $this->HTML->metas(array(
            'description' => $description_for_layout,
            'classification' => '',
            'keywords' => '',
            'country' => 'FR',
            'viewport' => 'initial-scale=1.0'
        ));
        ?>
        
        <meta name="google-site-verification" content="M2zlrDkRnQ8LJHBT5nKa8n2P5AB8cPmMZclSUKS1_9Y">
        
        <?= $this->HTML->favicon(); ?>
        <?= $this->HTML->author(); ?>
        <?= $this->HTML->css('bootstrap'); ?>
        <?= $this->HTML->css('bootstrap3'); ?>
        <?= $this->HTML->css('jquery.smartmenus.bootstrap'); ?>
        <?= $this->HTML->css('flat-ui'); ?>
        <?= $this->HTML->css('style'); ?>
        <?= $this->HTML->css('slide'); ?>
        <?= $this->HTML->css('ss-symbolicons-line'); ?>
        <?= $this->HTML->css('owl.carousel'); ?>
        <?= $this->HTML->css('owl.theme'); ?>
        <?= $this->HTML->css('owl.transitions'); ?>
        <?= $this->HTML->css('style/masterslider'); ?>
        <?= $this->HTML->css('skins/default/style'); ?>
        <?= $this->HTML->css('jquery-ui.min'); ?>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <?= $this->HTML->js('jquery-ui.min'); ?>
        <?= $this->HTML->js('conference'); ?>
        <?= $this->HTML->js('tracking'); ?>
        <script type="text/javascript" src="ajax_status.js"></script>
        <script type="text/javascript" src="//try.abtasty.com/057533c5a4ef341b239034eeb6332071.js"></script> 
        <script>
            var userId = "";
            var userName = "";
            var remoteUserId = "";
        </script>
        <script language="javascript" type="text/javascript">
            function changeColor(col)
            {
                var couleur = col;
                if (couleur == "En ligne")
                    document.getElementById("epn").style.backgroundColor = "#88c51f";
                else if (couleur == "Indisponible")
                    document.getElementById("epn").style.backgroundColor = "#95a5a6";
                else
                    document.getElementById("epn").style.backgroundColor = "#e74c3c";
            }

        </script>

        <?php if (isset($scripts)): ?><?= $this->HTML->scripts_for_layout($scripts); ?><?php endif; ?>
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
            include('../controller/Status.php'); 
            include ('../ajax_status.js');
        ?>    
        <meta property="og:image" content="https://www.esatus.fr/bin/images/esatus-logo.png" />
        <meta property="og:site_name" content="esatus.fr" />
        <meta property="og:url" content="https://esatus.fr" />
        <meta http-equiv="content-language" content="fr-FR">
        <meta name="keywords" content="consultation, voyance,experts,juridique" />
        <meta property="og:title" content="Esatus.fr Conseil voyance, psycho et juridique" />
        <meta property="og:type" content="article" />
        <meta property="og:description" content="Vous cherchez une solution à vos problèmes ? Personnalités, avocats, psychologues, médiums... Avec Esatus, 300 experts vous répondent 24h/24, 7 jours/7." />
    </head>
    <body itemprop="mainContentOfPage" role="main" class="<?php if (isset($body_classes_for_layout)) echo $body_classes_for_layout; ?> new">	
        
				     <!-- pixel webmecanique -->
	 <img src="https://esatus.automation.webmecanik.com/mtracking.gif" />   
     <!-- pixel webmecanique --> 
         
        <?php include ('../bin/js/adwords.js.php'); ?>
        
        <div class="top-header">
            <div class="container">
                <div class="row">

                    <div class="col-lg-2 col-md-3 col-xs-12 logo">
                        <a href="<?= Router::url('pages/index'); ?>">
                            <img class="nav-logo" src="<?= IMAGE; ?>logo.png" alt="Esatus">
                        </a>
                    </div>
<?php if ($this->Session->isLogged()): ?>
                        <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
                                        if ($s):
                                            ?>
                    <div class="col-lg-2 col-md-4 col-xs-12 search">
                        
                                    <?php
                                    $ns = new Status();
                                    $ns_status = $ns->MonStatusAvance();
                                    //echo 'statut : '.$ns_status;
                                    if ($ns_status == "1")
                                        $couleur = "#88c51f";
                                    if ($ns_status == "0")
                                        $couleur = "#95a5a6";
                                    if ($ns_status == "2")
                                        $couleur = "#e74c3c";
                                    ?>

                                    <?php
                                    if ($ns_status != "") {
                                        ?>
                                    

                                                    <?php $id_expert = $this->Session->profile('id'); ?> 
                                            <select name="state" onchange='makeRequest("https://www.esatus.fr/change_status.php?id_session=<?php echo $id_expert; ?>", "epn");
                                                    changeColor(this.value);' id="epn" <?php
                                                    if ($ns_status == "1") {
                                                        echo 'style="background-color: #88c51f;width:120px;"';
                                                    }
                                                    if ($ns_status == "0") {
                                                        echo 'style="background-color: #95a5a6;width:120px;"';
                                                    }
                                                    if ($ns_status == "2") {
                                                        echo 'style="background-color: #e74c3c;width:120px;"';
                                                    }
                                                    ?>  >
                                                        <?php
                                                        if ($ns_status == "1") {

                                                            echo ' <option selected="selected" style="background-color: #88c51f">En ligne</option>
                    <option style="background-color: #95a5a6"  >Indisponible</option>
                    <option style="background-color: #e74c3c" >Occupe</option>';
                                                        }
                                                        if ($ns_status == "0") {
                                                            echo ' <option style="background-color: #88c51f">En ligne</option>
                    <option selected="selected" style="background-color: #95a5a6">Indisponible</option>
                    <option style="background-color: #e74c3c">Occupe</option>';
                                                        }
                                                        if ($ns_status == "2") {

                                                            echo ' <option style="background-color: #88c51f" >En ligne</option>
                    <option style="background-color: #95a5a6" >Indisponible</option>
                    <option selected="selected" sstyle="background-color: #e74c3c">Occupe</option>';
                                                        }
                                                        //added by andru
                                                        if ($ns_status == "3") {

                                                            echo ' <option value="" disabled selected>Votre statut temporaire</option>
                    <option style="background-color: #88c51f" >En ligne</option>
                    <option style="background-color: #95a5a6" >Indisponible</option>
                    <option style="background-color: #e74c3c" >Occupe</option>';
                                                        }
                                                        //echo 'status', $ns -> MonStatus();
                                                        ?>


                                            </select>
                                            <div id="id_ecrire"> </div>

                      
                                        <?php
                                    }
                                    ?>


     
                    </div>
              <?php endif; ?>
                     <?php endif; ?>   
                    <div class="col-lg-8 col-md-5 col-xs-12 connexion">
                         
                        <div class="navbar-collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 0px;">
                            <form class="navbar-form pull-right" action="<?= Router::url('pages/search'); ?>" method="post">
                            <div class="control-group">
                                <input type="text" class="form-control top-input" value="" id="search" name="search" placeholder="Recherche...">
                                <input type="submit" class="form-control submit" value="" id="search-btn" >
                            </div>
                        </form>
                            <ul class="connexion nav navbar-nav navbar-right">
                                <?php if ($this->Session->isLogged()): ?>
                                    <li>
                                        <a href="<?= Router::url('users/index'); ?>">Espace client</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= Router::url('users/index'); ?>">Tableau ce bord</a></li>
                                            <li><a href="<?= Router::url('users/datas'); ?>">Vos informations</a></li>
                                            <li><a href="<?= Router::url('users/questions'); ?>">Vos questions</a></li>
                                            <li><a href="<?= Router::url('users/calls'); ?>">Vos appels</a></li>
                                            <li><a href="<?= Router::url('users/card'); ?>">Votre carte bancaire</a></li>
                                            <li><a href="<?= Router::url('services/index'); ?>">Espace expert</a></li>

                                            <li><a href="http://www.esatus.fr/index.php/deconnexion">Me déconnecter</a></li>
                                        </ul>
                                    </li>   
                                <?php else: ?>
                                <li><a href="<?= Router::url('profiles/login'); ?>">Connexion</a></li>
                                <li class="active"><a href="<?= Router::url('creer-un-compte'); ?>">Inscription</a></li>
                                <?php endif; ?>
                                <li>
                                    <a href="">Espace expert</a>
                                    <ul class="dropdown-menu">
                                        <?php if ($this->Session->isLogged()): ?> 
          
                                        <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
                                        if ($s):
                                            ?>
                                            
                                            
                                                <li><a href="<?= Router::url('services/index'); ?>">Vos services :</a></li>
                                                <?php foreach ($s as $k => $v): ?><?php $v = current($v);
                                        $i = $k + 1;
                                        ?>
                                                    <li>
                                                        <a href="<?= Router::url('services/service/id:' . $v->id); ?>"><?= $i . ' - ' . $v->title; ?> <i class="icon-angle-right"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="<?= Router::url('services/edit/id:' . $v->id); ?>">Fiche de service</i></a></li>
                                                            <li><a href="<?= Router::url('services/availabilities/id:' . $v->id); ?>">Vos disponibilités</a></li>
                                                            <li><a href="<?= Router::url('services/calls/id:' . $v->id); ?>">Vos appels reçus</a></li>
                                                            <li><a href="<?= Router::url('services/repayments/id:' . $v->id); ?>">Vos gains</a></li>
                                                            <li><a href="<?= Router::url('services/bdi/id:' . $v->id); ?>">Votre IBAN</a></li>
                                                            <li><a href="<?= Router::url('services/clients/id/' . $v->id); ?>">Vos clients</a></li>
                                                        </ul>
                                                    </li>

                                                <?php endforeach ?>
                                                <?php if ($i < 3) : ?>
                                                    <li><a href="<?= Router::url('services/create'); ?>"><i class="icon-plus"></i> Créer un nouveau service</a></li>
                                            <?php endif; ?>
                         
                                        <?php else: ?>
                                            <a href="<?= Router::url('services/create'); ?>">Devenir expert ?</a>
                                    <?php endif; ?>
                                 
                                    <?php else: ?>
                                        <li><a href="<?= Router::url('creer-un-compte-expert'); ?>">Créer un compte</a></li>
                                        <li><a href="<?= Router::url('profiles/login'); ?>">Vous connecter</a></li>
                                    <?php endif; ?>
                                    </ul>
                                </li>
                                <li><a href="https://esatus.fr/blog">Blog</a></li>
                                <li>
                                    <a href="#">Aide</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= Router::url('pages/customersfaq'); ?>">FAQ clients</a></li>
                                        <li><a href="<?= Router::url('pages/expertsfaq'); ?>">FAQ experts</a></li>
                                        <li><a href="<?= Router::url('pages/contact'); ?>">Contact</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- header -->
        <header class="header">
            <div class="nav-container">
                <div class="container">
                    <div class="navbar navbar-default" role="navigation">
                        <!-- Menu -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse" id="main-nav">
                            <ul class="nav navbar-nav">

                                <li>
                                    <a href="<?= Router::url('pages/index'); ?>">Accueil</a>
                                </li>
                               
                                <?php foreach ($this->requestAction(array('controller' => 'categories', 'action' => 'getCategories')) as $k => $v): ?><?php $v = current($v); ?>
                                <li>
                                        <a href="<?= Router::url('categories/category/slug:' . $v->slug); ?>"><?= $v->title; ?></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($v->subcategories as $sk => $sv): ?><?php $sv = current($sv); ?>
                                                <?php
                                                $services = $this->Service->findBy(array('conditions' => array('category_id' => $v->id, 'subcategory_id' => $sv->id, 'validated' => 1)));
                                                if (count($services) > 0):
                                                ?>
                                                <li><a href="<?= Router::url('categories/subcategory/cat:' . $v->slug . '/subcat:' . $sv->slug); ?>"><?= $sv->title; ?> </a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>

                                


<?php if (!$this->Session->isLogged()): ?>
                                    <!-- <li>
                                        <a href="<?= Router::url('pages/customersfaq'); ?>">Espace client <i class="icon-angle-down"></i></a>
                                        <ul>
                                            <li><a href="<?= Router::url('profiles/signin'); ?>">Créer un compte</a></li>
                                            <li><a href="<?= Router::url('profiles/login'); ?>">Vous connecter</a></li>
                                        </ul>
                                    </li> -->
<?php endif; ?>

                                <!-- <li>
                                    <a href="<?= Router::url('pages/customersfaq'); ?>">Aide <i class="icon-angle-down"></i></a>
                                    <ul>
                                        <li><a href="<?= Router::url('pages/customersfaq'); ?>">FAQ clients</a></li>
                                        <li><a href="<?= Router::url('pages/expertsfaq'); ?>">FAQ experts</a></li>
                                    </ul>
                                </li>
                                -->
                                

                                
                            </ul>
                        </div>
                        <div id="id_ecrire"></div>

                    </div>
                </div>
            </div>
        </header>

        <!--added by andru for chat-->
<?php if ($this->Session->isLogged()): ?>

            <script type="text/javascript">window.sockets = new Array();</script>
            <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/plugins/jspkg-archive/stylesheets/jquery.cssemoticons.css">
            <audio id="received_msg">
                <source src="/bin/audio/skype_message_receiv.mp3" type="audio/mpeg">
            </audio>

            <div id="chat_container">
                <div id="absolute_container">
                </div>
            </div>

            <style type="text/css">
                #chat_container
                {
                    position: fixed;
                    right: 0;
                    bottom: 0;

                    z-index: 99999;
                    width: 100%;
                    background: #999;
                }
                #absolute_container
                {
                    position: absolute;
                    right: 0;
                    bottom: 0;
                }
                .chat_element
                {
                    width: 20em;
                    right: 0;
                    bottom: 0;
                    float: right;
                    border: solid 1px #ddd;
                    margin-left: 0.3em;
                }
                .chat_title
                {
                    background: #5DADE2;
                    cursor: pointer;
                    padding: 0.5em;
                    font-weight: bold;
                    border-radius: 3px 3px 0 0;
                }
                .chat_client_dispo
                {
                    margin: 1em;
                }
                .chat_close
                {
                    float: right;
                }
                .chat_content
                {
                    background: #eee;
                    height: 16em;
                    overflow-y: auto;
                }
                .chat
                {
                    text-align: right;
                    /*padding-left: 5em;*/
                    padding: 0.5em 0.5em 0.5em 5em;
                }
                .chat_response
                {
                    padding: 0.5em 5em 0.5em 0.5em;
                }
                .chat_message
                {
                    padding: 0.5em 2.5em 0.5em 2.5em;
                }
                .typer
                {
                    margin: 0 !important;
                    width: 100%;
                    height: auto !important;
                    border-radius: 0px !important;
                    border: solid 1px #ddd !important;

                    -webkit-box-sizing: border-box;‌​
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                }
            </style>

            <script type="text/javascript">

                function bindchatwindows()
                {
                    $(".chat_title").unbind();
                    $(".chat_title").click(function() {
                        if ($(this).attr("collapse") == "no") {
                            $(this).parent().children(".chat_content").hide();
                            $(this).parent().children(".chat_typer").hide();
                            $(this).attr("collapse", "yes");
                        }
                        else
                        {
                            $(this).parent().children(".chat_content").show();
                            $(this).parent().children(".chat_typer").show();
                            $(this).attr("collapse", "no");
                        }
                    });

                    $(".typer").unbind();
                    $(".typer").keypress(function(e) {
                        if (e.which == 13)
                        {
                            var chat_text = $(this).val();
                            var chat_id = $(this).parent().parent().attr('id');
                            var chat = '<div class="chat"><b>Moi : </b><span>' + chat_text + '</span></div>';
                            $(this).val("");
                            var content = $(this).parent().parent().children('.chat_content');
                            content.append(chat);
                            $(".chat_content div:last span").emoticonize();

                            var content_js = document.getElementById('chat_content');
                            content_js.scrollTop = content_js.scrollHeight;

                            window.sockets[chat_id].emit('chat_message', chat_text);

    <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
    if ($s): ?>
    <?php else: ?>
                                updatechatdb(chat_text, 'client', <?= $this->Session->user('id') ?>);
    <?php endif; ?>
                        }

                    });

                }

                function updatechat(chat_text, chat_id, client_id)
                {
                    var chat = '<div class="chat_response"><b>' + client_id + ' : </b><span>' + chat_text + '</span></div>';
                    $("#" + chat_id + " .chat_content").append(chat);
                    $("#" + chat_id + " .chat_content div:last span").emoticonize();

                    var content_js = document.getElementById('chat_content');
                    content_js.scrollTop = content_js.scrollHeight;

                    var new_msg_ring = document.getElementById('received_msg');
                    new_msg_ring.play();
                }

            </script>

    <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
    if ($s): ?>
                <!--Expert chat-->

                <script type="text/javascript">
                    function initchat()
                    {
                        //loading chat files
                        $.ajax({
                            url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/socket.io/socket.io.js',
                            dataType: 'script',
                            success: function() {
                                $.ajax({
                                    url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/js/adapter.js',
                                    dataType: 'script',
                                    success: function() {
                                        window.signal_host = '<?php echo $_SERVER["HTTP_HOST"] ?>';
                                        window.signal_port = '1001';
                                        window.room = 'chat_<?php echo $this->Session->profile("id") ?>';

                                        $.ajax({
                                            url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/js/chat_expert.js',
                                            dataType: 'script'
                                        });
                                        $.ajax({
                                            url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/plugins/jspkg-archive/javascripts/jquery.cssemoticons.min.js',
                                            dataType: 'script'
                                        });
                                    }
                                });
                            }
                        });
                    }
                    initchat();

                    function chatter(chat_room, client_name)
                    {
                        if ($("#chat_container #absolute_container #" + chat_room).children().length > 0)
                        {
                            //alert("Un client cherche à vous joindre mais vous êtes en communication");
                        }
                        else
                        {
                            //$("#chat_container #absolute_container").html("");

                            var chat_window = '<div id="' + chat_room + '" class="chat_element"><div class="chat_title" collapse="no"><span class="chat_client_dispo"></span><span class="chat_client_id">' + client_name + '</span><span id="chat_close" class="chat_close">X</span></div><div id="chat_content" class="chat_content"></div><div class="chat_typer"><input type="text" class="typer"></div></div>';

                            $("#chat_container #absolute_container").html(chat_window);

                            bindchatwindows();

                            window.sockets[chat_room].emit('chat_message', '<?php echo current($s)->Service->title ?>');
                        }
                    }

                    function close_chat()
                    {
                        $("#chat_container #absolute_container").html("");
                    }

                </script>

    <?php else: ?>
                <!--Client chat-->

                <script type="text/javascript">

                    function updatechatdb(chat_text, sender, client_id)
                    {
                        $.ajax({
                            type: 'POST',
                            url: '/calls/updatechat',
                            data: {oldsession: "<?= $this->Session->id ?>", message: chat_text, sender: sender, client: client_id},
                            success: function(success_response) {
                                //alert(success_response);
                            }
                        });
                    }

                    function chathandlepayment()
                    {
                        $.ajax({
                            type: "POST",
                            url: "/calls/chatpayment",
                            data: {meid: "<?= $this->Session->user('id') ?>", oldsession: "<?= $this->Session->profile('id') ?>"},
                            success: function(response) {
                                //
                                //alert(response);
                                console.log(response);
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                    }

                    function client_chatter()
                    {
                        $("#" + the_room + " .chat_typer .typer").removeAttr("disabled");

                        bindchatwindows();

                        $("#chat_close").unbind();

                        $("#chat_close").click(function() {
                            //end and payment

                            var chat_id = ($(this).parent().parent().attr('id'));
                            chathandlepayment();
                            window.sockets[chat_id].emit('quit', chat_id);
                            window.sockets[chat_id].close();

                            $("#chat_container #absolute_container").html("");
                        });
                    }

                    function loadchat()
                    {
                        $.ajax({
                            type: 'POST',
                            url: '/calls/loadchat',
                            data: {oldsession: "<?= $this->Session->id ?>"},
                            success: function(success_response) {
                                response = $.trim(success_response);
                                if (response != 'none')
                                {
                                    the_chat = $.parseJSON(response);
                                    chatter(the_chat.service_id, the_chat.service_name);

                                    //conversation load
                                    conversation = the_chat.conversation.split("_" + the_chat.session_id + "_");

                                    $.each(conversation, function(index, value) {
                                        if (value.indexOf("expert_") == 0) {
                                            value = value.replace("expert_", "");
                                            var chat_html = '<div class="chat_response"><b>' + the_chat.service_name + ' : </b><span>' + value + '</span></div>';
                                        }
                                        else {
                                            value = value.replace("client_", "");
                                            var chat_html = '<div class="chat"><b>Moi : </b><span>' + value + '</span></div>';
                                        }
                                        $(".chat_content").append(chat_html);
                                    });

                                    var content_js = document.getElementById('chat_content');
                                    content_js.scrollTop = content_js.scrollHeight;

                                }
                                else
                                {
                                    //console.log("no old conversation");
                                }
                            }
                        });
                    }
                    loadchat();

                    // from category.php
                    function chatter(chat_room, expert_name)
                    {
                        if ($("#chat_container #absolute_container").children().length > 0)
                        {
                            alert("Vous ête déjà en communication avec un autre expert!\n Terminez la conversation avant de commencer une autre");
                        }
                        else
                        {
                            //chat window
                            var chat_window = '<div id="chat_' + chat_room + '" class="chat_element"><div class="chat_title" collapse="no"><span class="chat_client_dispo"></span><span class="chat_client_id">' + expert_name + '</span><span id="chat_close" class="chat_close">X</span></div><div id="chat_content" class="chat_content"></div><div class="chat_typer"><input type="text" class="typer" disabled="disabled"></div></div>';
                            $("#chat_container #absolute_container").append(chat_window);

                            //loading chat files
                            $.ajax({
                                url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/socket.io/socket.io.js',
                                dataType: 'script',
                                success: function() {
                                    $.ajax({
                                        url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/js/adapter.js',
                                        dataType: 'script',
                                        success: function() {
                                            window.signal_host = '<?php echo $_SERVER["HTTP_HOST"] ?>';
                                            window.signal_port = '1001';
                                            window.room = chat_room;
                                            window.expert_name = expert_name;
                                            window.client_name = '<?php echo $this->Session->user("pseudo"); ?>';
                                            window.client_id = '<?php echo $this->Session->user("id"); ?>';

                                            $.ajax({
                                                url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/js/chat_client.js',
                                                dataType: 'script'
                                            });
                                            $.ajax({
                                                url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/plugins/jspkg-archive/javascripts/jquery.cssemoticons.min.js',
                                                dataType: 'script'
                                            });
                                            $.ajax({
                                                url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>:1001/plugins/jspkg-archive/stylesheets/jquery.cssemoticons.css',
                                                dataType: 'css'
                                            });
                                        }
                                    });

                                }
                            });

                        }
                    }

                    function emptyroom(the_room)
                    {
                        var empty_message = '<div class="chat_message">L\'expert n\'est pas connecté</div>';
                        $("#" + the_room + " .chat_content").append(empty_message);
                        //$("#"+the_room+" .chat_typer .typer").attr("disabled","disabled");
                        //alert("L'expert n'est pas connecté!");

                        var content_js = document.getElementById('chat_content');
                        content_js.scrollTop = content_js.scrollHeight;
                    }
                    function fullroom(the_room)
                    {
                        var empty_message = '<div class="chat_message">L\expert est occupé en ce moment! attendez quelques instants</div>';
                        $("#" + the_room + " .chat_content").append(empty_message);
                        //$("#"+the_room+" .chat_typer .typer").attr("disabled","disabled");
                        //alert("L'expert est en communication avec quelqu'un d'autre!\nVeuillez reéssayez plus tard");

                        var content_js = document.getElementById('chat_content');
                        content_js.scrollTop = content_js.scrollHeight;
                    }
                    function joinedroom(room, expert_name)
                    {
                        //saving chat session
                        $.ajax({
                            type: 'POST',
                            url: '/calls/chat',
                            data: {serviceid: room, meid: "<?php echo $this->Session->user('id'); ?>"},
                            success: function(success_response) {
                                var response = $.trim(success_response);
                                if (response == 'ok')
                                {
                                    //alert("ok");
                                    client_chatter();
                                }
                                else
                                {
                                    alert("Erreur de connexion!");
                                }
                            }
                        });
                    }

                </script>

    <?php endif; ?>
        <?php endif; ?>


        <!--added by andru for video call-->

<?php if (!($this->Session->controller->request->action == 'videocall')): ?>
    <?php if ($this->Session->isLogged()): ?>
        <?php $s = $this->requestAction(array('controller' => 'services', 'action' => 'test'));
        if ($s): ?>

                    <!--added by andru-->
                                      <!--<iframe id="videos_iframe" src="http://37.187.149.143:1001/chat_expert.html" frameborder="0" scrolling="no"></iframe>-->

                    <script type="text/javascript">
                        $(document).ready(function() {
                            var id = '#dialog';
                            //Get the screen height and width
                            var maskHeight = $(document).height();
                            var maskWidth = $(window).width();
                            //Set heigth and width to mask to fill up the whole screen
                            $('#mask').css({'width': maskWidth, 'height': maskHeight});
                            //transition effect   
                            /*$('#mask').fadeIn(1000);  
                             $('#mask').fadeTo("slow",0.8);  */
                            //Get the window height and width
                            var winH = $(window).height();
                            var winW = $(window).width();

                            //Set the popup window to center
                            $(id).css('top', winH / 2 - $(id).height() / 2);
                            $(id).css('left', winW / 2 - $(id).width() / 2);

                            //transition effect
                            /* $(id).fadeIn(2000);    */

                            //if mask is clicked
                            $('#expert_hangupButton').click(function() {
                                hangup();
                                $("#mask").hide();
                                $('.window').hide();
                            });

                        });

                        function accepted() {
                            var incall = document.getElementById("incall");
                            incall.pause();
                        }

                        function ring() {
                            var incall = document.getElementById("incall");
                            incall.play();
                        }

                    </script>
                    <style type="text/css">
                        body {
                            font-family:verdana;
                            font-size:15px;

                        }
                        a {color:#333; text-decoration:none}
                        a:hover {color:#ccc; text-decoration:none}

                        #mask {
                            position:absolute;
                            left:0;
                            top:0;
                            z-index:9000;
                            background-color:#000;
                            display:none;
                        }  
                        #boxes .window {
                            position:absolute;
                            left:0;
                            top:0;
                            display:none;
                            z-index:9999;
                            padding:20px;
                        }
                    </style>

                    <div id="boxes">
                        <div style="display: none;" id="dialog" class="window">
                            <div id='expert_videos'>
                                <video id='expert_localVideo' autoplay></video>
                                <video id='expert_remoteVideo' autoplay></video>
                            </div>
                            <audio id="incall" loop>
                                <source src="/bin/audio/skype_call.mp3" type="audio/mpeg">
                            </audio>
                            <div style="align:right">
                                <span id="mutevideo" muted=false><img src="<?= IMAGE; ?>camera.png" style="width: 3em"></span>
                                <span id="muteaudio" muted=false><img src="<?= IMAGE; ?>micro.png" style="width: 3em"></span>
                                <script type="text/javascript">
                                    $("#mutevideo").click(function() {
                                        $(this).children("img").attr("src", "<?= IMAGE; ?>" + ($(this).attr('muted') == "false" ? "camera_mute.png" : "camera.png"));
                                        $(this).attr('muted', $(this).attr('muted') == "false");
                                        mutevideo();
                                    });
                                    $("#muteaudio").click(function() {
                                        $(this).children("img").attr("src", "<?= IMAGE; ?>" + ($(this).attr('muted') == "false" ? "micro_mute.png" : "micro.png"));
                                        $(this).attr('muted', $(this).attr('muted') == 'false');
                                        muteaudio();
                                    });
                                </script>
                                <a id="expert_hangupButton" class="btn btn-danger tiny" style="float:right" href="#">Couper l'appel vid&eacute;o</a>
                            </div>
                        </div>
                    </div>

                    <div style="width: 1478px; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                    <script src='http://<?php echo $_SERVER['HTTP_HOST'] ?>:1001/socket.io/socket.io.js'></script>
                    <script src='http://<?php echo $_SERVER['SERVER_NAME'] ?>:1001/js/adapter.js'></script>
                    <script type="text/javascript">
                                    var signal_host = '<?php echo $_SERVER["HTTP_HOST"] ?>';
                                    var signal_port = '1001';
                                    var room = '<?php echo $this->Session->profile("id") ?>';
                    </script>
                    <script src='http://<?php echo $_SERVER['HTTP_HOST'] ?>:1001/js/main_expert.js'></script>

                    <style>

                        #expert_videos
                        {
                            background: black;
                            position: relative;
                        }

                        #expert_localVideo
                        {
                            position: absolute;
                            bottom: 0.5em;
                            right: 0.5em;

                            width: 12em;
                        }

                        #expert_remoteVideo
                        {
                            min-height: 30em;
                        }

                    </style>

                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>


        <section>
            <?php if (isset($breadcrumb_for_layout)) echo breadcrumb($breadcrumb_for_layout); ?>
            <?= $content_for_layout; ?>
        </section>
            <?php if (!($this->request->controller == "pages" && $this->request->action == "index")) { ?>
            <footer class="footer">
                <?php
                $this->loadModel('Rating');
                $reviews = $this->Rating->findBy(array('order' => 'id DESC', 'limit' => 20));
                foreach ($reviews as $k => $v) {
                    $this->loadModel('User');
                    $this->loadModel('Service');
                    $this->loadModel('Category');
                    $this->loadModel('Subcategory');
                    $v->Rating->user = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Rating->profile_id))));
                    $v->Rating->service = current($this->Service->findOneBy(array('conditions' => array('id' => $v->Rating->service_id))));
                    $v->Rating->expert = current($this->User->findOneBy(array('conditions' => array('profile_id' => $v->Rating->service->profile_id))));
                    $v->Rating->username = ($v->Rating->service->username == '') ? $v->Rating->expert->last_name . '-' . $v->Rating->expert->first_name : $v->Rating->service->username;
                    $v->Rating->category = current($this->Category->findOneBy(array('conditions' => array('id' => $v->Rating->service->category_id))));
                    $v->Rating->subcategory = current($this->Subcategory->findOneBy(array('conditions' => array('id' => $v->Rating->service->subcategory_id))));
                }
                ?>

    <?php if (isset($reviews) && $reviews): ?>
                    <div class="section-title orange-color">
                        <h2>Dernier commentaire client en temps réel...</h2>
                    </div>

                    <div class="bloc-commentaires bloc-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="quote-slider" class="owl-carousel owl-theme">

        <?php foreach ($reviews as $k => $v): ?><?php $v = current($v); ?>
                                            <div class="item">
                                                <div class="quote-info">
                                                    <div class="header">
                                                        Par <?= $v->user->first_name; ?> au sujet de <a href="<?= Router::url('services/view/cat:' . $v->category->slug . '/subcat:' . $v->subcategory->slug . '/slug:' . clean($v->username) . '/id:' . $v->service->id); ?>"><?= $v->username; ?>, <?= $v->service->title; ?></a> 
                                                        | note : <span class="label label_default review_rating"><?= $v->rate; ?>/10</span>
                                                    </div>
                                                    <p><?= $v->comment; ?></p>
                                                    <!-- <cite>- Rebecca<span>XYZ Company</span></cite> -->
                                                </div>
                                            </div>
        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- fin commentaires -->
    <?php endif; ?>
                <div class="footer-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h3 class="footer-title">Esatus " Pour en savoir plus "</h3>
                                <p>Le temps vous manque, Esatus facilitera votre quotidien, en faisant appel à des professionnels plébiscités par nos clients et sélectionnés par notre service Qualité. Diététicienne, Avocat, Coach, Fiscaliste, Astrologue et bien d’autres activités répondent à vos questions au meilleur prix en toute discrétion 24H/24 7 jours sur 7 !</p>
                                <p>Consultez nos professionnels, de chez vous ou en mode Nomade, Esatus est LA solution qui vous permet de gagner du temps et révolutionne votre quotidien.</p>
                                <p>Esatus c’est un gain de temps pour les uns... un gain de revenus complémentaires pour les autres, <a href="<?= Router::url('profiles/signin'); ?>">rejoignez-nous !</a></p>
                            </div>
                            <div class="col-md-5">
                                <div class="footer-banner">
                                    <h3 class="footer-title">A propos</h3>
                                    <ul>
                                        <li>Site édité par la SARL 4U Consulting</li>
                                        <li>29, Grand Rue 59100 ROUBAIX</li>
                                        <li>SIREN : 523 411 866</li>
                                        <li>TVA intracommunautaire : <br/>FR75 523 411 866</li>
                                        <li>service client : 08 99 70 35 27</li>
                                        <li>Numéro surtaxé à 1,35 € TTC par appel + 0,34 € la minute</li>
                                    </ul>
                                    <a href="<?= Router::url('pages/imprint'); ?>">Mentions légales</a> - 
                                    <a href="<?= Router::url('pages/termsofuse'); ?>">CGU</a>
                                    <br/>
                                    <br/>
                                    <a href="http://www.orange.fr"  target="_blank"><img src="<?= IMAGE; ?>label-orange-qualite.png" alt="Qualité certifiée par Orange" /></a>
                                    <a href="http://www.paybox.com" target="_blank"><img src="<?= IMAGE; ?>label-paybox-securise.png" alt="Paiments sécurisés par Paybox" /></a>
                                    
                                    <br><br>
                                    
                                        <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=esatus.fr','SiteLock','width=600,height=600,left=160,top=170');" >
                                            <img alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/esatus.fr"/>
                                        </a>
                                    <a href="http://premierpixel.net/" target="_blank"><img src="<?= IMAGE; ?>logo-premier-pixel.png" alt="Creation des sites web" /></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <?php } ?>
        <div id="back-to-top" class="alert alert-info">
            <i class="icon-arrow-up"></i>
        </div>

        <?= $this->HTML->js('bootstrap.min'); ?>
        <?= $this->HTML->js('bootstrap-switch'); ?>
        <?= $this->HTML->js('jquery.smartmenus.min'); ?>
        <?= $this->HTML->js('jquery.smartmenus.bootstrap.min'); ?>
        <?= $this->HTML->js('application'); ?>
        <?= $this->HTML->js('slide'); ?>
        <?= $this->HTML->js('jquery.cycle2.min'); ?>
        <?= $this->HTML->js('jquery.cycle2.shuffle'); ?>
        <?= $this->HTML->js('jquery.scrollbox'); ?>
        <?= $this->HTML->js('/owl-carousel/owl.carousel'); ?>
<?= $this->HTML->js('jquery.easing.min'); ?>
<?= $this->HTML->js('masterslider/masterslider.min'); ?>
<script type="text/javascript">
var __lc = {};
__lc.license = 6363171;

(function() {
 var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
 lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<?php if (!($this->request->controller == "pages" && $this->request->action == "index")) { ?>
            <script type="text/javascript">

                            var tot = 0;
                            jQuery(document).ready(
                                    $('ul li a').click(function() {
                                var id = $(this).attr('id');
                                tot += 1;
                                console.log(id);
                                console.log(tot);
                                if (tot <= 5) {
                                    $('.row .col-md-12').append('<span>le choix  ' + id + '</span><br>');
                                    if (tot == 5) {
                                        // window.location = "http://boostmarketing.fr/clients/esatus/bin/users/cartes";
                                        console.log('ouii dakhl');
                                        window.location.href = "http://boostmarketing.fr/clients/esatus/bin/users/consiel";
                                    }
                                } else {
                                    console.log('vous avez pas le droit ');

                                }

                            }
                            ));
            </script>
<?php } ?>
            
    </body>
</html>

