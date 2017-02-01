<?php
/**
 * Custom colofon, in which the only thing shown is the logo of the Digital Humanities Lab.
 */

if (is_active_sidebar('colofon')) : 
?>

<footer id="colophon" class="footer hidden-print" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php dynamic_sidebar('colofon'); ?>
			</div>
		</div>	
	</div>	
</footer>

<?php else : ?>

<footer id="colophon" class="footer hidden-print" role="contentinfo">
	<div id="inner-footer" class="container clearfix">
		<div class="row">
			<div class="col-sm-9">
			</div>
			<div class="col-sm-3 footer-img">
				<a href="http://dig.hum.uu.nl/" target="_blank">
					<img width="100%" alt="Digital Humanities Lab" src="https://theaterdramaturgiebank.sites.uu.nl/wp-content/uploads/sites/150/2017/01/LogoLab.png">
				</a>
			</div>
		</div>
	</div>

<?php endif; ?>
