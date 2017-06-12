<article id="post-<?php the_ID(); ?>" class="row" <?php post_class('clearfix'); ?> role="article">
	<div class="col-sm-12">

		<header class="article-header">
			<h2 class="entry-header">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
		</header>

		<section class="entry-content clearfix">
			<?php
				echo '<em>' . collection_linked_records($post->ID)->post_count . ' linked record(s)</em><br>';

				echo get_the_excerpt($post->ID);

				echo '<a href="' . get_permalink($post->ID) . '" title="'. __('Read', 'uu2014') . get_the_title($post->ID).'" class="button icon" >'. __('Read more', 'uu2014') .'</a>';
			?>
		</section>

	</div>
</article>
