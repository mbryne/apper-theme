<?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="wrap cf">

			<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part('content/page-content'); ?>

				<?php endwhile; else : ?>

					<?php get_template_part('content/page-not-found'); ?>

				<?php endif; ?>

			</main>

			<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
