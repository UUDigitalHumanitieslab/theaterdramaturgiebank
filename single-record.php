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
							<?php echo markdown_title(); ?>
						</h2>

						<!-- Article content (excerpt + content) -->
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>

						<!-- Images (if available) -->
						<?php if (have_rows('images')) { ?>
							<div class="images">
								<?php while (have_rows('images')) : the_row(); ?>
									<img
										src="<?php echo get_sub_field('image')['url']; ?>"
										alt="<?php echo get_sub_field('image')['alt']; ?>"
									/>
								<?php endwhile; ?>
							</div>
						<?php } ?>

						<!-- Videos (if available) -->
						<?php if (have_rows('videos')) { ?>
							<div class="videos">
								<?php while (have_rows('videos')) : the_row(); ?>
								<?php the_sub_field('video'); ?>
								<?php endwhile; ?>
							</div>
						<?php } ?>

						<div class="buttons">
							<!-- More/less button (if full-text is available) -->
							<?php if (get_field('full-text')) { ?>
								<button class="more-button button icon">Read more</button>
								<button class="less-button button icon">Hide text</button>
							<?php } ?>

							<!-- Download (if available) -->
							<?php if (get_field('file')) { ?>
								<a href="<?php echo get_field('file')['url']; ?>" target="_blank" class="button icon">
									Download
								</a>
							<?php } ?>
						</div>

						<!-- Full-text (if available) -->
						<?php if (get_field('full-text')) { ?>
							<div class="more-content">
								<?php the_content(); ?>
							</div>
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
							// Display the link
							function display_anchor($anchor)
							{
								echo '<a class="record-header">' . $anchor['label'] . '</a>';
								echo '<p class="record-content">';
								echo $anchor['anchor'];
								echo '</p>';
							}

							// Display the keywords with a link back to the search page
							function display_keywords()
							{
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
							}

							// Display the custom fields, with a link back to the faceted search
							$anchors = array();
							$fields = get_field_objects();
							foreach ($fields as $title => $field)
							{
								$value = $field['value'];

								// Don't display fields without a value, or fields that are displayed/used elsewhere
								if (!$value || in_array($title, array('key', 'year_uncertain', 'bibliography', 'full-text', 'file', 'images', 'videos')))
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

								if ($anchor)
								{
									$anchors[$title] = array('anchor' => $anchor, 'label' => $field['label']);
								}
							}

							display_anchor($anchors['authors']);
							display_anchor($anchors['collection']);
							display_anchor($anchors['people']);
							display_anchor($anchors['performances']);
							display_keywords();
							display_anchor($anchors['type']);
							display_anchor($anchors['year']);
							display_anchor($anchors['languages']);
						?>
					</div>
				</div>
			</section><?php // end article section ?>
			<footer class="article-footer">
			</footer><?php // end article footer ?>
		</article><?php // end article ?>
	
	<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('includes/template', 'error'); // WordPress template error message ?>
	<?php endif; ?>

<?php get_template_part('parts/page-footer-1col'); ?> 

<?php get_footer(); ?>
