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
						<h2>
							<?php the_title(); ?>
						</h2>

						<!-- Article content (excerpt + content) -->
						<div id="record-excerpt">
							<?php the_excerpt(); ?>
						</div>

						<?php if (get_field('full-text')) { ?>
							<button id="record-more-button" class="button icon">Read more</button>
							<button id="record-less-button" class="button icon">Hide text</button>
							<div id="record-more-content">
								<?php the_content(); ?>
							</div>
						<?php } ?>

						<!-- Download (if available) -->
						<?php if (get_field('file')) { ?>
							<h2>
								Original document
							</h2>
							<p>
								<a href="<?php echo get_field('file')['url']; ?>" target="_blank">
									<?php echo get_field('file')['filename']; ?>
								</a>
							</p>
						<?php } ?>

						<!-- Bibliography (if available) -->
						<?php if (get_field('bibliography')) { ?>
							<h3>
								Bibliography
							</h3>
							<p>
								<?php the_field('bibliography'); ?>
							</p>
						<?php } ?>
					</div>
					<div class="col-sm-3 record-sidebar">
						<?php
							// Display the custom fields, with a link back to the faceted search
							$fields = get_field_objects();
							ksort($fields);
							foreach ($fields as $title => $field)
							{
								$value = $field['value'];

								// Don't display fields without a value, or fields that are displayed/used elsewhere
								if (!$value || in_array($title, array('key', 'bibliography', 'full-text', 'file')))
								{
									continue;
								}

								// Retrieve the link back to the search page (or post in case of collections)
								$anchor = '';
								// Special case for collections (linked posts): show the link to the post
								if ($title === 'collection')
								{
									$anchor = create_collection_anchor($title, $value);
								}
								// Special case for the year facet: select only the selected year as a range value
								else if ($title === 'year')
								{
									$anchor = create_year_anchor($title, $value);
								}
								// Special case for repeater facet fields
								else if (is_array($value))
								{
									$anchor = create_repeater_anchor($title, $value);
								}
								// Links back for the 'normal' facet fields
								else
								{
									$anchor = create_anchor($title, $value);
								}

								// Display the link
								if ($anchor)
								{
									echo '<a class="record-header">' . $field['label'] . '</a>';
									echo '<p class="record-content">';
									echo $anchor;
									echo '</p>';
								}
							}

							// Display the keywords with a link back to the search page
							$tags = get_the_terms($post->ID , 'post_tag');
							if ($tags)
							{
								echo '<a class="record-header">Keywords</a>';
								echo '<p class="record-content">';

								$anchors = array();
								foreach ($tags as $tag)
								{
									array_push($anchors, create_anchor('keywords', $tag->name));
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
			// Note that this uses window.load instead of document.ready, 
			// otherwise embedded videos won't be loaded before the div is hidden.
			// See: https://stackoverflow.com/a/545005/3710392
			jQuery(window).on("load", function() {
				jQuery("#record-more-content").hide();
				jQuery("#record-more-button").click(function() {
					jQuery("#record-more-content").show();
					jQuery("#record-less-button").show();
					jQuery(this).hide();
				});
				jQuery("#record-less-button").click(function() {
					jQuery("#record-more-content").hide();
					jQuery("#record-more-button").show();
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
