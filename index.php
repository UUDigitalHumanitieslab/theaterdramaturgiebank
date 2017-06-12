<?php 
/**
 * The template for displaying the home page content.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * This front page displays a lead text, followed by two columns with a search bar and a random record from the database.
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 
	<div class="home-blog">
		<div class="row">
			
			<div id="home_search" class="col-sm-6">
				<h2>Search the database</h2>

				<?php
					// Include the content from the page with the slug 'about-home'
					$page = get_page_by_path('about-home');
  					echo apply_filters('the_content', $page->post_content);
  				?>

				<div id="home_search_form">
					<form method="get" action="<?php echo SEARCH_PAGE; ?>">
						<input type="hidden" name="fwp_sort" value="year_desc"> <!-- necessary to keep default sort order -->
						<input type="hidden" name="fwp_per_page" value="10"> <!-- necessary to keep default amount of results per page -->
						<input type="text" name="fwp_search" placeholder="Search the database" class="searchfield">
						<input type="submit" id="searchsubmit" class="searchbutton" value="">
					</form>
				</div>
			</div>

			<div class="col-sm-3">
				<!-- White space -->
			</div>

			<div id="home_random" class="col-sm-3">
				<h2>What's in?</h2>

				<div>
					<?php
					// Show 1 random record from the archive
					$q = array(
						'post_type'				=> 'post',
						'category_name' 		=> 'record',
						'posts_per_page'		=> 1,
						'orderby' 				=> 'rand',
					);

					$query = new WP_Query($q);

					if ($query->have_posts()) : ?>
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<?php get_template_part('parts/record-random'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>

</div> <!-- /page-content -->
</div> <!-- /col-sm-8 /col-sm-12 -->
</div> <!-- /container -->

<?php get_footer();
