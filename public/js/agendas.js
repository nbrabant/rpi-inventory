$(document).ready(function () {
    // $('.datepicker').datetimepicker();

	$('.select2').select2({
		tags: "true",
		placeholder: "",
		allowClear: true,
		tokenSeparators: [',', ' ']
    });
});
