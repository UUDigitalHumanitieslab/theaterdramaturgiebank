<?php 
/**
 * The template for displaying a single post with the 'record' category.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Shows the record and contains a sidebar with all custom fields and a link back to the faceted search.
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
			<section class="clearfix" itemprop="articleBody">
				<div class="row">
					<div class="col-sm-9 record-main">
						<div class="record-image pull-left">
							<?php the_post_thumbnail('full', array('class' => 'img-responsive img-thumbnail')); ?>
						</div>

						<!-- Article title -->
						<h1>
							<?php the_title(); ?>
						</h1>

						<!-- Article content (excerpt + content) -->
						<?php the_excerpt(); ?>

						<?php if (get_field('full-text')) { ?>
							<button id="record-more-button" class="button icon">Read more</button>
							<div id="record-more-content">
								<?php the_content(); ?>
							</div>
						<?php } ?>

						<!-- Bibliography (if available) -->
						<?php if (get_field('bibliography')) { ?>
							<h1>
								Bibliography
							</h1>
							<p>
								<?php the_field('bibliography'); ?>
							</p>
						<?php } ?>
					</div>
					<div class="col-sm-3 record-sidebar">
						<?php
							// Display the custom fields, with a link back to the faceted search
							$not_shown = array('key', 'bibliography', 'full-text');  // List of fields not displayed
							$fields = get_field_objects();
							ksort($fields);
							foreach ($fields as $title => $field)
							{
								if ($field['value'] && !in_array($title, $not_shown))
								{
									echo '<a class="record-header">' . $field['label'] . '</a>';
									echo '<p class="record-content">';

									// Special case for the year facet: select only the selected year as a range value
									if ($title === 'year')
									{
										$link = SEARCH_PAGE;
										$link .= '&fwp_' . 'year' . '=' . $field['value'] . '%2C ' . $field['value'];
										echo '<a href="' . $link . '">' . $field['value'] . '</a>';
									}
									// Links back for the 'normal' facet fields
									else if (in_array($title, array('collection', 'journal')))
									{
										echo create_anchor($title, $field['value']);
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
											$key = $subs[$title];
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

							// Display the keywords with a link back to the search page
							$keywords = get_the_terms($post->ID , 'keyword');
							if ($keywords)
							{
								echo '<a class="record-header">Keywords</a>';
								echo '<p class="record-content">';

								$anchors = array();
								foreach ($keywords as $keyword)
								{
									array_push($anchors, create_anchor('keywords', $keyword->name));
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
		</article><?php // end article ?>

		<script>
			// Hide the additional content until the "more"-button is clicked.
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
		<?php get_template_part('includes/template', 'error'); // WordPress template error message ?>
	<?php endif; ?>

<?php get_template_part('parts/page-footer-1col'); ?> 

<?php get_footer(); ?>
