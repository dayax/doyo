<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

    <!--[if lt IE 7]><div class="alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</div><![endif]-->

    <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
        get_template_part('templates/header-top-navbar');
    } else {
        get_template_part('templates/header');
    }
    ?>

    <div class="wrap container" role="document">        
        <div class="row">
            <div class="span12">
                <?php get_template_part('templates/page', 'header');?>
            </div>
        </div>
        <div class="content row">
            <div class="main <?php echo dyMainClass(); ?> clearfix" role="main">
                <?php include dyTemplatePath(); ?>
            </div><!-- /.main -->
            <?php if (dyDisplaySidebar()) : ?>
            <aside class="sidebar <?php echo dySidebarClass();?>" role="complementary">
                <?php include dySidebarPath();?>
            </aside><!-- /.sidebar -->
            <?php endif; ?>
        </div><!-- /.content -->
    </div><!-- /.wrap -->

    <?php get_template_part('templates/footer'); ?>

</body>
</html>