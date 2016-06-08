<?php
/**
 * Created by PhpStorm.
 * User: asingh43
 * Date: 16/05/2016
 * Time: 4:24 PM
 */


//This is the most important coding.
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=filename.ics");

$location = "LOCATION:".$_POST["event_calendar_location"];
$name = "DESCRIPTION:".$_POST["event_calendar_name"];


$time = substr($_POST["event_calendar_location"] , 0, 3);


$date = $_POST["event_calendar_date"];
$timestamp = strtotime($date);

$timestamp_date = date("Ymd",$timestamp);
$timestamp_time = date("His",$time);

$timestamp = $timestamp_date.'T'.$timestamp_time.'Z';

$date_created =  "CREATED:".$timestamp;
$date_stamp_end =  "DTEND:".$timestamp;
$date_start =  "DTSTAMP:".$timestamp;
$date_end =  "DTSTART:".$timestamp;
$date_last_modified =  "LAST-MODIFIED:".$timestamp;

$summary = "SUMMARY;LANGUAGE=en-us:".$_POST["event_calendar_name"];


echo "BEGIN:VCALENDAR\n";
echo "PRODID:-//Microsoft Corporation//Outlook 12.0 MIMEDIR//EN\n";
echo "VERSION:2.0\n";
echo "METHOD:PUBLISH\n";
echo "X-MS-OLK-FORCEINSPECTOROPEN:TRUE\n";
echo "BEGIN:VEVENT\n";
echo "CLASS:PUBLIC\n";
echo  $date_created;
echo "\n";
echo $name;
echo "\n";
echo $date_stamp_end;
echo "\n";
echo $date_start;
echo "\n";
echo $date_end;
echo "\n";
echo $date_last_modified;
echo "\n";
echo $location;
echo "\n";
echo "PRIORITY:5\n";
echo "SEQUENCE:0\n";
echo $summary;
echo "\n";
echo "TRANSP:OPAQUE\n";
echo "UID:040000008200E00074C5B7101A82E008000000008062306C6261CA01000000000000000\n";
echo "X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n";
echo "X-MICROSOFT-CDO-IMPORTANCE:1\n";
echo "X-MICROSOFT-DISALLOW-COUNTER:FALSE\n";
echo "X-MS-OLK-ALLOWEXTERNCHECK:TRUE\n";
echo "X-MS-OLK-AUTOFILLLOCATION:FALSE\n";
echo "X-MS-OLK-CONFTYPE:0\n";
//Here is to set the reminder for the event.
echo "BEGIN:VALARM\n";
echo "TRIGGER:-PT1440M\n";
echo "ACTION:DISPLAY\n";
echo "DESCRIPTION:Reminder\n";
echo "END:VALARM\n";
echo "END:VEVENT\n";
echo "END:VCALENDAR\n";
?>
