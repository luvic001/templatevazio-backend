<?php function jQuery(){ ?>
<?php global $TEMPLATE_DIRECTORY_URI; ?>
<script type="text/javascript" src="<?= $TEMPLATE_DIRECTORY_URI ?>/source/jQuery.min.js"></script>
<?php /*<script type="text/javascript" src="<?= $TEMPLATE_DIRECTORY_URI ?>/source/jQuery.mobile.min.js"></script> */ ?>
<script>
	jQuery(function($){
		$(document).bind("mobileinit", function (e) {
	    	e.mobile.ajaxEnabled = false;
	    	e.extend(  $.mobile , {
	    		ajaxFormsEnabled: false
	    	});
		});
		$('.ui-loader').remove()
	})
</script>
<?php
}