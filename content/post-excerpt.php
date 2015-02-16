

	<?php
		$class = '';
		if (has_post_thumbnail())
			$class = 'has-post-thumbnail';
	?>

	<article  <?php post_class( 'article-archive cf ' . $class ); ?> id="post-<?php the_ID(); ?>">

		<?php if (has_post_thumbnail()): ?>

			<div class='post-thumbnail'>
				<?php the_post_thumbnail('bones-thumb-150'); ?>
			</div>

		<?php endif; ?>

		<div class="post-entry">

            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>

            <p class="entry-meta">

				<time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l jS F Y') ?></time>
				Posted by <?php the_author_meta('display_name'); ?>.

			</p>

			<?php the_excerpt(); ?>

		</div>

	</article>

