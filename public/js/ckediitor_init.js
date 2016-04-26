$(document).ready(function() {
	CKEDITOR.replace(
		'instructions',
		{
			customConfig : 'config.js',
			toolbar : 'simple'
		});	
});
