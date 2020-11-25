$(".datepicker").datepicker({
	clearBtn: true,
	format: "yyyy-mm-dd",
	autoclose: true,
	toggleActive: true,
	todayHighlight: true,
});

$(".timepicker").timepicker({
	minuteStep: 1,
	icons: {
		time: "fa fa-clock-o",
		date: "fa fa-calendar",
		up: "fa fa-arrow-up",
		down: "fa fa-arrow-down",
		previous: "fa fa-chevron-left",
		next: "fa fa-chevron-right",
		today: "fa fa-clock-o",
		clear: "fa fa-trash-o",
	},
});
