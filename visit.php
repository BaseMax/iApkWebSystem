<?php
include "_core.php";
$d=jalaliDate();
print "Today Visits: " . $db->count("visit", ["date"=>$d["year"].$d["month"].$d["day"]]);
print "<br>";
//print "Today Visitors: " . $db->count("visit", ["date"=>$d["year"].$d["month"].$d["day"]], "GROUP BY `ip`", "ip");

