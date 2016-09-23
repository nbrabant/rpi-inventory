$(document).ready(function () {
	$('.select2').select2({
		tags: "true",
		placeholder: "",
		allowClear: true,
		tokenSeparators: [',', ' ']
    });

	// http://www.eyecon.ro/bootstrap-datepicker/
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
});
