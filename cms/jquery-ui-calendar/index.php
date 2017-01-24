<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jQuery UI Datepicker - Select a Date Range</title>
<link rel="stylesheet" href="css/jquery-ui-1.10.3-smoothness.css">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.js"></script>
<script>
$(function() {
	$("#from").datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function(selectedDate) {
			$("#to").datepicker("option","minDate",selectedDate);
		}
	});
	$("#to").datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function(selectedDate) {
			$("#from").datepicker("option","maxDate",selectedDate);
		}
	});
});
</script>
</head>

<body>
<label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
</body>
</html>