<?php
/**
 * Shows a single record on the front page.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
	<header class="article-header">
		<h3 class="entry-header">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
	</header>

	<section class="entry-content clearfix">
		<?php
			if (has_post_thumbnail())
			{
				the_post_thumbnail('full');
			}
			else
			{
				the_excerpt();
			}

			echo '<a href="' . get_permalink($post->ID) . '" title="'. __('Read', 'uu2014') . get_the_title($post->ID).'" class="button icon" >'. __('Read more', 'uu2014') .'</a>';
		?>
	</section>

	<footer class="article-footer"></footer>
</article>
