
    <nav role="navigation">
        <?php wp_nav_menu(array(
            'container' => 'div',
            'container_class' => 'footer-links cf',
            'menu' => __( 'Footer Menu', 'apper' ),
            'menu_class' => 'nav footer-nav cf',
            'theme_location' => 'footer-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 0,
            'fallback_cb' => 'bones_footer_links_fallback'
        )); ?>
    </nav>

    <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
