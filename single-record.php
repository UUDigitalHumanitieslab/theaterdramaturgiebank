<?php 
/**
 * The template for displaying a single post with the 'record' category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="record-content clearfix" itemprop="articleBody">
				<div class="row">
					<div class="col-sm-9 record-main">
						<h1 class="record-title">
							<?php the_title(); ?>
						</h1>
						<em>
							<?php echo get_field('date'); ?> &bull; <?php echo get_field('city'); ?>
						</em>
						<p class="record-content">
							<?php the_content(); ?>
						</p>
					</div>
					<div class="col-sm-3 record-sidebar">
						<?php
							// Display the ACF-fields with a link back to the search page
							$fields = get_field_objects();
							ksort($fields);
							foreach ($fields as $title => $field)
							{
								if ($field['value'])
								{
									echo '<a class="record-header">' . $field['label'] . '</a>';
									echo '<p class="record-content">';

									// TODO: make this more generic
									if ($field['label'] === 'Year')
									{
										$link = '/category/record/?fwp_' . 'year' . '=' . $field['value'] . '%2C ' . $field['value'];
										echo '<a href="' . $link . '">' . $field['value'] . '</a>';
									}
									else if ($field['label'] === 'City')
									{
										$link = '/category/record/?fwp_' . 'cities' . '=' . sanitize_title_with_dashes($field['value']);
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
							echo '<a class="record-header">Keywords</a>';
							echo '<p class="record-content">';
							foreach (get_the_tags() as $tag)
							{
								$link = '/category/record/?fwp_tags=' . $tag->slug;
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
