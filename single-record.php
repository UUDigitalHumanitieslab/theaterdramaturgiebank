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
						<!-- Article title -->
						<h1 class="record-title">
							<?php the_title(); ?>
						</h1>

						<!-- Article content (excerpt + content) -->
						<?php the_excerpt(); ?>
						<button id="record-more-button" class="button icon">Read more</button>
						<div id="record-more-content">
							<?php the_content(); ?>
						</div>

						<!-- Bibliography (if available) -->
						<?php if (get_field('bibliography')) { ?>
							<h2>
								Bibliography
							</h2>
							<p>
								<?php the_field('bibliography'); ?>
							</p>
						<?php } ?>
					</div>
					<div class="col-sm-3 record-sidebar">
						<?php
							// Display the ACF-fields with a link back to the search page
							function create_anchor($label, $value)
							{
								$anchor = '/category/record/?fwp_' . strtolower($label);
								$anchor .= '=' . sanitize_title_with_dashes($value);  // TODO: does not work for items with a '.'
								return '<a href="' . $anchor . '">' . $value . '</a>';
							}


							$fields = get_field_objects();
							ksort($fields);
							foreach ($fields as $title => $field)
							{
								if ($field['value'])
								{
									echo '<a class="record-header">' . $field['label'] . '</a>';
									echo '<p class="record-content">';

									// Special case for the year facet: select only the selected year as a range value
									if ($field['label'] === 'Year')
									{
										$link = '/category/record/?fwp_' . 'year' . '=' . $field['value'] . '%2C ' . $field['value'];
										echo '<a href="' . $link . '">' . $field['value'] . '</a>';
									}
									// Links back for the 'normal' facet fields
									else if (in_array($field['label'], array('Collection', 'City', 'Journal')))
									{
										echo create_anchor($field['label'], $field['value']);
									}
									// Links back for repeater facet fields
									else if (is_array($field['value']))
									{
										$subs = array(
											'authors'		=> 'author',
											'languages'		=> 'language',
											'people'		=> 'person',
											'performances'	=> 'performance',
										);
										$anchors = array();
										foreach($field['value'] as $sub)
										{
											$key = $subs[strtolower($field['label'])];
											$value = $sub[$key];
											array_push($anchors, create_anchor($key, $value));
										}
										echo implode(', ', $anchors);
									}
									else
									{
										echo $field['value'];
									}
									
									echo '</p>';
								}
							}

							// Display the tags with a link back to the search page
							if (get_the_tags())
							{
								echo '<a class="record-header">Keywords</a>';
								echo '<p class="record-content">';

								$anchors = array();
								foreach (get_the_tags() as $tag)
								{
									array_push($anchors, create_anchor('tags', $tag->name));
								}
								echo implode(', ', $anchors);

								echo '</p>';
							}
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

		<script>
		jQuery(function() {
			jQuery("#record-more-content").hide();
			jQuery("#record-more-button").click(function() {
				jQuery("#record-more-content").show();
				jQuery(this).hide();
			});
		});
		</script>
	
	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); // WordPress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer(); ?>
