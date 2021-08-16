document.addEventListener("DOMContentLoaded", function () {
  // Daterangepicker

  $('input[name="datesingle"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
  });

  // Datetimepicker
  $("#datetimepicker-minimum").datetimepicker();
  $("#datetimepicker-view-mode").datetimepicker({
    viewMode: "years",
  });
  $("#datetimepicker-time").datetimepicker({
    format: "LT",
  });
  $("#datetimepicker-date").datetimepicker({
    format: "L",
  });
});
