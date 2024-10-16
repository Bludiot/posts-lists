/**
 * Frontend scripts
 */

jQuery(document).ready( function($) {
	$( '#posts-list-select' ).on( 'change', function() {
		$( '.posts-lists-date-block' ).hide();
		$( '#' + $(this).val() ).show();
	});
});
