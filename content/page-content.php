
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

        <?php do_action('apper_before_title'); ?>

        <header class="article-header page-header">
            <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
        </header>

        <?php do_action('apper_before_content'); ?>

        <section class="entry-content cf" itemprop="articleBody">

            <?php the_content(); ?>

        </section>

        <?php do_action('apper_after_content'); ?>

    </article>
