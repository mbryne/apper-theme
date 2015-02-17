

    <h1 id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>

    <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

        <?php wp_nav_menu(array(
            'container' => false,
            'container_class' => 'menu cf',
            'menu' => __( 'Main Menu', 'apper' ),
            'menu_class' => 'nav top-nav cf',
            'theme_location' => 'main-nav',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 0,
            'fallback_cb' => ''
        )); ?>

    </nav>
