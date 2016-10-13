<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="entry-content clearfix" itemprop="articleBody">
				<div class="row">
					<div class="col-sm-9">
						<p class="entry-author"><?php echo get_field('author'); ?></p>
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1>
						<em><?php echo get_field('date'); ?> &bull; <?php echo get_field('date'); ?></em>
						<p class="entry-content"><?php the_content(); ?></p>
					</div>
					<div class="col-sm-3 entry">
						<?php
							// Display the ACF-fields with a link back to the search page
							foreach (get_field_objects() as $title => $field)
							{
								if ($field['value'])
								{
									echo '<a class="entry-header">' . $field['label'] . '</a>';
									echo '<p class="entry-content">';

									// TODO: make this more generic
									if ($field['label'] === 'Year')
									{
										$link = '/category/entry/?fwp_' . 'year' . '=' . $field['value'] . '%2C ' . $field['value'];
										echo '<a href="' . $link . '">' . $field['value'] . '</a>';
									}
									else
									{
										echo $field['value'];
									}
									
									echo '</p>';
								}
							}

							// Display the tags with a link back to the search page
							echo '<a class="entry-header">Keywords</a>';
							echo '<p class="entry-content">';
							foreach (get_the_tags() as $tag)
							{
								$link = '/category/entry/?fwp_tags=' . $tag->slug;
								echo '<a href="' . $link . '">' . $tag->name . '</a></br>';
							}
							echo '</p>';
						?>
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
