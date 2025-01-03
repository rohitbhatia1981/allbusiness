<?php
	include_once("../private/settings.php");
?>
<script language="JavaScript">
var targetDate = new Date();

// Initialize the calendar display once the page loads.

window.onload = setCalendar;

//----------------------------------------------------------------------------
// This function updates the calendar display to reflect the current target
// date.
//----------------------------------------------------------------------------

function setCalendar(event) {

  var el, tableEl, rowEl, cellEl, linkEl;
  var tmpDate, tmpDate2;
  var i, j;

  // Force a redraw by hiding the entire page.

  document.body.style.display = "none";

  // Update month name.
	alert(targetDate);
  el = document.getElementById("calendarHeader").firstChild;
  el.nodeValue = targetDate.getMonthName() + "\u00a0" + targetDate.getFullYear();

  // Start with the first day of the month and go back if necessary to
  // the previous Sunday.

  tmpDate = new Date(Date.parse(targetDate));
  tmpDate.setDate(1);
  while (tmpDate.getDay() != 0) {
    tmpDate.addDays(-1);
  }

  // Go through each calendar day cell in the table and update it.

  tableEl = document.getElementById("calendar");
  for (i = 2; i <= 7; i++) {
    rowEl = tableEl.rows[i];

    // Hide row if it contains no dates in the current month.

    tmpDate2 = new Date(Date.parse(tmpDate));
    tmpDate2.addDays(6);
    if (tmpDate.getMonth()  != targetDate.getMonth() &&
        tmpDate2.getMonth() != targetDate.getMonth())
      rowEl.className = "empty";
    else
      rowEl.className = "";

    // Loop through a week.

    for (j = 0; j < rowEl.cells.length; j++) {
      cellEl = rowEl.cells[j];
      linkEl = cellEl.firstChild;

      if (tmpDate.getMonth() == targetDate.getMonth()) {
        linkEl.date = new Date(Date.parse(tmpDate));
        s = tmpDate.toString().split(" ");
        linkEl.title = "";;
        linkEl.firstChild.nodeValue = tmpDate.getDate();
        linkEl.style.visibility = "";
      }
      else
        linkEl.style.visibility = "hidden";

      // Highlight the current date.

      if (cellEl.oldClass == null)
        cellEl.oldClass = cellEl.className;
      if (Date.parse(tmpDate) == Date.parse(targetDate))
        cellEl.className = cellEl.oldClass + " target";
      else
        cellEl.className = cellEl.oldClass;

      // Go to the next day.

      tmpDate.addDays(1);
    }
  }

  // Restore the page display.

  document.body.style.display = "";
}

//----------------------------------------------------------------------------
// Event handlers for the calendar elements.
//----------------------------------------------------------------------------

function addMonths(event, n) {

  // Advance the calendar month and update the display.

  targetDate.addMonths(n);
  setCalendar(event);
}

function addYears(event, n) {

  // Advance the calendar year and update the display.

  targetDate.addYears(n);
  setCalendar(event);
}

function setTargetDate(event, link) {
  // Change the target date and update the calendar.
  if (link.date != null) {
    targetDate = new Date(Date.parse(link.date));
    setCalendar(event);
  }
}

function displayDate(event) {

  // Display the current target date as a formatted string.

  alert(formatDate(targetDate));
}

function formatDate() {

  var mm, dd, yyyy;

  // Return the target date in "mm/dd/yyyy" format.

  mm = String(targetDate.getMonth() + 1);
  while (mm.length < 2)
    mm = "0" + mm;
  dd = String(targetDate.getDate());
  while (dd.length < 2)
    dd = "0" + dd;
  yyyy = String(targetDate.getFullYear());
  while (yyyy.length < 4)
    yyyy = "0" + yyyy;

  return mm + "/" + dd + "/" + yyyy;
}

//============================================================================
// Add new properties and methods to the Date object.
//============================================================================

// Properties

Date.prototype.monthNames = new Array("<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_JANUARY; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_FEBRUARY; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_MARCH; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_APRIL; ?>",
  "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_MAY; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_JUNE; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_JULY; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_AUGUST; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_SEPTEMBER; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_OCTOBER; ?>", "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_NOVEMBER; ?>",
  "<?php echo SITE_TEXT_FOR_CALENDAR_PAGE_DECEMBER; ?>");
Date.prototype.savedDate  = null;

// Methods

Date.prototype.getMonthName = dateGetMonthName;
Date.prototype.getDays      = dateGetDays;
Date.prototype.addDays      = dateAddDays;
Date.prototype.addMonths    = dateAddMonths;
Date.prototype.addYears     = dateAddYears;

//----------------------------------------------------------------------------
// getMonthName(): Returns the name of the date's month.
//----------------------------------------------------------------------------

function dateGetMonthName() {

  return this.monthNames[this.getMonth()];
}

//----------------------------------------------------------------------------
// getDays(): Returns the number of days in the date's month.
//----------------------------------------------------------------------------

function dateGetDays() {

  var tmpDate, d, m;

  tmpDate = new Date(Date.parse(this));
  m = tmpDate.getMonth();
  d = 28;
  do {
    d++;
    tmpDate.setDate(d);
  } while (tmpDate.getMonth() == m);

  return d - 1;
}

//----------------------------------------------------------------------------
// addDays(n): Adds the specified number of days to the date.
//----------------------------------------------------------------------------

function dateAddDays(n) {

  // Add the specified number of days.

  this.setDate(this.getDate() + n);

  // Reset the new day of month.

  this.savedDate = this.getDate();
}

//----------------------------------------------------------------------------
// addMonths(n): Adds the specified number of months to the date, adjusting
// the day of the month if necessary.
//----------------------------------------------------------------------------

function dateAddMonths(n) {

  // Save the day of month if not already set.

  if (this.savedDate == null)
    this.savedDate = this.getDate();

  // Set the day of month to the first to avoid rolling.

  this.setDate(1);

  // Add the specified number of months.

  this.setMonth(this.getMonth() + n);

  // Restore the saved day of month, if possible.

  this.setDate(Math.min(this.savedDate, this.getDays()));
}

//----------------------------------------------------------------------------
// addYears(n): Adds the specified number of years to the date, adjusting the
// day of the month for leap years.
//----------------------------------------------------------------------------

function dateAddYears(n) {

  // Save the day of month if not already set.

  if (this.savedDate == null)
    this.savedDate = this.getDate();

  // Set the day of month to the first to avoid rolling.

  this.setDate(1);

  // Add the specified number of years.

  this.setFullYear(this.getFullYear() + n);

  // Restore the saved day of month, if possible.

  this.setDate(Math.min(this.savedDate, this.getDays()));
}
</script>