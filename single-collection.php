<?php 
/**
 * The template for displaying a single post with the 'collection' category.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			<section class="clearfix" itemprop="articleBody">
				<div class="collection-main">
					<div class="collection-image pull-left">
						<?php the_post_thumbnail('full', array('class' => 'img-responsive img-thumbnail')); ?>
					</div>
					<h2>
						<?php the_title(); ?>
					</h2>

					<!-- Article content (excerpt + content) -->
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>

					<div class="buttons">
						<button class="more-button button icon">Read more</button>
						<button class="less-button button icon">Hide text</button>
					</div>
					
					<div class="more-content">
						<?php the_content(); ?>
					</div>

					<h3>
						Linked records
					</h3>

					<?php
						$q = collection_linked_records(get_the_id());
						if ($q->have_posts()) :
					?>
						<!-- TODO: can we maybe refactor this? -->

						<table id="records" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 25%">Author(s)</th>
									<th style="width: 70%">Title</th>
									<th style="width: 5%">Year</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($q->have_posts()) : $q->the_post(); ?>
									<?php get_template_part('parts/record-loop'); ?> 
								<?php endwhile; ?>
							</tbody>
						</table>

					<?php else : ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>
			</section><?php // end article section ?>
			<footer class="article-footer">
			</footer><?php // end article footer ?>
		</article><?php // end article ?>
	
	<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('includes/template','error'); // WordPress template error message ?>
	<?php endif; ?>

<?php get_template_part('parts/page-footer-1col'); ?> 

<?php get_footer(); ?>
