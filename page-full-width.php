<?php
/*
 Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<?php get_template_part('content/snippets/slider'); ?>

	<div id="content">

		<div id="inner-content" class="wrap cf">

			<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part('content/page-content'); ?>

				<?php endwhile; else : ?>

					<?php get_template_part('content/page-not-found'); ?>

				<?php endif; ?>

			</main>

		</div>

	</div>

<?php get_footer(); ?>
