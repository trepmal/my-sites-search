jQuery(document).ready( function($) {
	$('#wp-admin-bar-my-sites-search.hide-if-no-js').show();
	$('#wp-admin-bar-my-sites-search input').keyup( function( ) {

		var searchValRegex = new RegExp( $(this).val(), 'i');

		$('#wp-admin-bar-my-sites-list > li.menupop').hide().filter(function() {

			return searchValRegex.test( $(this).find('> a').text() );

		}).show();

	});
});
