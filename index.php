<?php get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 
	<div class="home-blog">
		<p class="lead">
			Welkom bij de TheaterDramaturgie.Bank!
		</p>
		<div class="row">
			
			<div id="home_search" class="col-sm-6">
				<h2>Zoeken in de database</h2>
				Je kunt zoeken in de database met onderstaand zoekveld, of je kunt <a href="category/entry/">starten met een lege zoekvraag</a>.
				<form method="get" action="category/entry/">
				<input type="text" name="fwp_search" placeholder="Doorzoek de database" class="searchfield">
				<input type="submit" id="searchsubmit" class="searchbutton" value="">
				</form>
			</div>

			<div class="col-sm-6">
				<h2>Willekeurige entry</h2>

				<div class="agenda-archive">
					<?php 

					// Show 1 random entry from the archive
					$args2 = array(
						'post_type'				=> 'post',
						'category_name' 		=> 'entry',
						'posts_per_page'		=> 1,
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
