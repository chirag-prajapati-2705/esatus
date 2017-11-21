<?= $this->HTML->docType(); ?>
<html lang="fr" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <?= $this->HTML->charset('utf-8'); ?>
        <?= $this->HTML->title($title_for_layout); ?>
        <?=
        $this->HTML->metas(array(
            'description' => $description_for_layout,
            'viewport' => 'initial-scale=1.0'
        ));
        ?>
        <?= $this->HTML->css_admin('bootstrap'); ?>
        <?= $this->HTML->css_admin('flat-ui'); ?>
        <?= $this->HTML->favicon(); ?>
        <?= $this->HTML->author(); ?>

<?= $this->HTML->js('jquery'); ?>
<?= $this->HTML->js('sellectAll'); ?>
    <!--[if lt IE 9]><?= $this->HTML->js('html5'); ?><![endif]-->
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea",
                theme: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern imagetools"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor emoticons",
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ]
            });
        </script>
    </head>
    <body itemprop="mainContentOfPage" role="main" class="superadmin">
        <header>
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li>
                                    <a href="<?= Router::url('partner/index'); ?>">
                                        <img class="nav-logo" src="<?= IMAGE; ?>esatus-logo-mini.png" alt="Esatus">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Router::url('partner/index'); ?>">Menu partenaire <i class="icon-angle-down"></i></a>
                                    <ul>
                                        <li>
                                            <a href="<?= Router::url('partner/index'); ?>">Tableau de bord</a>
                                        </li>
                                        <li>
                                            <a href="<?= Router::url('partner/users'); ?>">Clients</a>
                                        </li>
                                        <li>
                                            <a href="<?= Router::url('partner/services'); ?>">Experts</a>
                                        </li>
                                        <li>
                                            <a href="<?= Router::url('partner/calls'); ?>">Appels</a>
                                        </li>
                                        <li>
                                            <a href="<?= Router::url('partner/promo'); ?>">Promotions</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav pull-right" style="margin-left: 40px;">
                                <li>
                                    <a href="<?= Router::url('partner/logout'); ?>">Retour sur Esatus.fr</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section>
<?php 
if (isset($breadcrumb_for_layout)) 
    echo breadcrumb($breadcrumb_for_layout); 
?>
<?= $content_for_layout; ?>
        </section>
        <footer>
            <div class="container">
                <div class="row">

                </div>
            </div>
        </footer>
<?= $this->HTML->js('jquery'); ?>
<?php if (isset($scripts)): ?><?= $this->HTML->scripts_for_layout($scripts); ?><?php endif; ?>
    </body>
</html>