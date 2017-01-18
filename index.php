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
		<p class="lead">
			TheaterDramaturgie.Bank (intro text here)
		</p>
		<div class="row">
			
			<div id="home_search" class="col-sm-6">
				<h2>Search the database</h2>
				<p>
					You can search the database using the free search field below,
					or <a href="<?php echo SEARCH_PAGE; ?>">start with an empty search query</a>.
				</p>
				<div id="home_search_form">
					<form method="get" action="<?php echo SEARCH_PAGE; ?>">
						<input type="hidden" name="fwp_sort" value="year_desc"> <!-- necessary to keep default sort order -->
						<input type="text" name="fwp_search" placeholder="Search the database" class="searchfield">
						<input type="submit" id="searchsubmit" class="searchbutton" value="">
					</form>
				</div>
			</div>

			<div id="home_random" class="col-sm-6">
				<h2>Random record</h2>

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
