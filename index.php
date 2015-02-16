<?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="wrap cf">

			<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<header class="article-header page-header">
					<h1 class="page-title">
						Blog
					</h1>
				</header>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part('content/post-excerpt'); ?>

				<?php endwhile; ?>

					<?php apper_page_navigation(); ?>

				<?php else : ?>

					<?php get_template_part('content/post-not-found'); ?>

				<?php endif; ?>


			</main>

			<?php get_sidebar('sidebar'); ?>

		</div>

	</div>

<?php get_footer(); ?>
