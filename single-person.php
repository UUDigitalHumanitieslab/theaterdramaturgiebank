<?php 
/**
 * The template for displaying a single post with the 'person' category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="clearfix" itemprop="articleBody">
				<div class="person-main">
					<div class="person-image pull-left">
						<?php the_post_thumbnail('full', array('class' => 'img-responsive img-thumbnail')); ?>
					</div>
					<!-- Article title -->
					<h1>
						<?php the_title(); ?>
					</h1>

					<!-- Article content (content) -->
					<?php the_content(); ?>

					<!-- TODO: show records linked to author -->
				</div>
				
			</section><?php // end article section ?>

			<footer class="article-footer">

			</footer><?php // end article footer ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</article><?php // end article ?>
	
	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer(); ?>