// Hide the additional content until the "more"-button is clicked.
// Note that this uses window.load instead of document.ready,
// otherwise embedded videos won't be loaded before the div is hidden.
// See: https://stackoverflow.com/a/545005/3710392
jQuery(window).on("load", function() {
	jQuery(".more-content").hide();
	jQuery(".more-button").click(function() {
		jQuery(".more-content").show();
		jQuery(".less-button").show();
		jQuery(this).hide();
	});
	jQuery(".less-button").click(function() {
		jQuery(".more-content").hide();
		jQuery(".more-button").show();
		jQuery(this).hide();
	});
});
