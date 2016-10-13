<div id="brandbar" class="affix-top">
	<div class="container">
		<div class="row">

			<div class="col-sm-4 col-xs-8 logodiv">
				<button type="button" class="navbar-toggle hidden-print" data-toggle="collapse" data-target="#main-menu-collapse">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

<?php if(function_exists('get_field') && get_field('uu_options_custom_logo', 'options') )	{ 
	$image = get_field('uu_options_custom_logo', 'options'); ?>

	<?php if(get_field('uu_options_custom_logo_url', 'options')) { ?>	
		<a href="<?php get_field('uu_options_custom_logo_url', 'options'); ?>"> 
	<?php } else { ?>
		<a href="<?php echo get_option('siteurl'); ?>">
	<?php  } ?>
			<img src="<?php echo $image['url']; ?>" class="alternative-logo" alt="logo" />
		</a>			
<?php 

} else { ?>

		<a href="
				<?php $mylocale = get_bloginfo('language');
										if($mylocale == 'en-US') {
										echo 'http://www.uu.nl/en';
										} else {
										echo 'http://www.uu.nl';
										} ?>
				"><img src="<?php echo get_template_directory_uri() ?>/images/uu-logo.svg" alt="<?php _e('Logo Utrecht University', 'uu2014'); ?>" /></a>
			
<?php } ?>

		<div class="visible-print-block">	
			<h1><?php bloginfo('name'); ?></h1>
		</div>	
			</div>

			<!-- TDB: Add the blog name to the header, but remove the search functionality !-->

		<div class="col-sm-8 col-xs-8 blog-name">
			<h1>
				<a href="<?php  echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
					<?php bloginfo('name'); ?>
				</a>
			</h1>
		</div>
		</div>
	</div>
</div>
