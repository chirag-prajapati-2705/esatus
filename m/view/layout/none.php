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
        <meta name="google-site-verification" content="M2zlrDkRnQ8LJHBT5nKa8n2P5AB8cPmMZclSUKS1_9Y">
        <?= $this->HTML->css('bootstrap'); ?>
        <?= $this->HTML->css('flat-ui'); ?>
        <?= $this->HTML->css('slide'); ?>
        <?= $this->HTML->css('ss-symbolicons-line'); ?>
        <?= $this->HTML->favicon(); ?>
        <?= $this->HTML->author(); ?>

        <?= $this->HTML->js('jquery'); ?>
        <?= $this->HTML->js('bootstrap.min'); ?>

        <?= $this->HTML->js('bootstrap-switch'); ?>
        <?= $this->HTML->js('application'); ?>
        <?= $this->HTML->js('slide'); ?>
        <?= $this->HTML->js('jquery.cycle2.min'); ?>
        <?= $this->HTML->js('jquery.cycle2.shuffle'); ?>
<?= $this->HTML->js('jquery.scrollbox'); ?>
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

    </head>

<?= $content_for_layout; ?>
</body>
</html>