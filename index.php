<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 
	<div class="home-blog">
		<div class="row">
			
		<!-- We use the default "news" and "agenda" posts and settings for "recently added" and "recommended" posts respectively, 
			so that settings are modifiable from the administration and stay more or less in line with the defaults. -->
			<div class="col-sm-6">
				<h2><?php if(get_field('uu_options_alternative_title_news', 'option')) { the_field('uu_options_alternative_title_news', 'option'); } else { _e('News', 'uu2014'); } ?></h2>

				<?php 
					$newsamount = get_field('uu_options_news_amount', 'option');
					$newscats = get_field('uu_options_news_frontpage_cat', 'option');
					if ($newscats) { 
						$terms = implode(', ', $newscats);	
					} else {
						$terms='';
					}
				
					$args = array(
						'post_type'	 			=> 'post',
						'pagination'    		=> true,
						'posts_per_page' 		=> $newsamount,
						'cat' 					=> $terms,
						'ignore_sticky_posts'   => false,
					);
					the_field('uu_options_alternative_title_news');
					$newsquery = new WP_Query( $args );
					if ( $newsquery->have_posts() ) {
							while ( $newsquery->have_posts() ) {
									$newsquery->the_post(); 
					
					get_template_part( 'parts/post-loop'); ?> 
					<hr />
				

				<?php } } else { ?>

				<?php get_template_part('includes/template','error'); // WordPress template error message ?>

				<?php } ?>
				
			</div>

			<div class="col-sm-6">
				<h2><?php if(get_field('uu_options_alternative_title_agenda', 'option')) { the_field('uu_options_alternative_title_agenda', 'option'); } else { _e('Agenda', 'uu2014'); } ?></h2>

				<div class="agenda-archive">
					<?php 

					// Show 3 random entries from the archive
					$args2 = array(
						'post_type'				=> 'post',
						'category_name' 		=> 'entry',
						'posts_per_page'		=> 3,
						'orderby' 				=> 'rand',
					);

					$agenda_query = new WP_Query( $args2 );

						if ( $agenda_query->have_posts() ) : ?>

							<?php while ($agenda_query->have_posts()) : $agenda_query->the_post(); ?>

								<?php get_template_part( 'parts/post-loop'); ?>
								<hr />

							<?php endwhile; ?>

								

						<?php else : ?>
						<div class="no-events">
							<?php _e('No upcoming events', 'uu2014') ?>
						</div>
						<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>

<?php // get_template_part( 'parts/widgetarea', 'below-content' ); ?>  

			</div> <!-- /page-content -->
		</div> <!-- /col-sm-8 /col-sm-12 -->
	


</div> <!-- /container -->
			
<?php get_footer();
