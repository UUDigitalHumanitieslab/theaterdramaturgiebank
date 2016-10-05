<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="entry-content clearfix" itemprop="articleBody">
				<div class="row">
					<div class="col-sm-10">
						<p class="entry-author"><?php echo get_field('author'); ?></p>
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1>
						<em><?php echo get_field('date'); ?> &bull; <?php echo get_field('date'); ?></em>
						<p class="entry-content"><?php the_content(); ?></p>
					</div>
					<div class="col-sm-2 entry-details">
						<?php 
							foreach (get_field_objects() as $title => $field)
							{
								if ($field['value'])
								{
									echo '<a class="entry-details-header">' . $field['label'] . '</a>';
									echo '<p class="entry-details-content">' . $field['value'] . '</p>';
								}
							}
						?>
						<a class="entry-details-header">Keywords</a>
						<p class="entry-details-content"><?php the_tags('', ', '); ?></p>
					</div>
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
