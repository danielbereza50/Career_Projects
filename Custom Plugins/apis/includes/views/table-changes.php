<?php

	date_default_timezone_set('America/New_York');
	// Get the current date
	$date = getdate();
//print_r($date);

	// Get the value of day, month, year
	$mday = $date['mday'];
	$mon = $date['mon'];
	$wday = $date['wday'];
	$month = $date['month'];
	$year = $date['year'];

	//echo $month;

	$dayCount = $wday;
	$day = $mday;

	while($day > 0) {
		$days[$day--] = $dayCount--;
		if($dayCount < 0)
			$dayCount = 6;
	}

	$dayCount = $wday;
	$day = $mday;

	if(checkdate($mon,31,$year))
		$lastDay = 31;
	elseif(checkdate($mon,30,$year))
		$lastDay = 30;
	elseif(checkdate($mon,29,$year))
		$lastDay = 29;
	elseif(checkdate($mon,28,$year))
		$lastDay = 28;

	while($day <= $lastDay) {
		$days[$day++] = $dayCount++;
		if($dayCount > 6)
			$dayCount = 0;
	}	

	// Days to highlight
	if($month == $apimonthName){
		$day_to_highlight = array($date_content_modified);
	};
	
	echo("<tr>");
	echo("<th colspan='7' align='center'>$month $year</th>");
	echo("</tr>");
	echo("<tr>");
		echo("<td>Sun</td>");
		echo("<td>Mon</td>");
		echo("<td>Tue</td>");
		echo("<td>Wed</td>");
		echo("<td>Thu</td>");
		echo("<td>Fri</td>");
		echo("<td>Sat</td>");
	echo("</tr>");

	$startDay = 0;
	$d = $days[1];

	echo("<tr>");
	while($startDay < $d) {
		echo("<td></td>");
		$startDay++;
	}

	for ($d=1;$d<=$lastDay;$d++) {
		if (in_array( $d, $day_to_highlight))
			$bg = "bg-dark-blue";
		else
			$bg = "bg-white";
		// Highlights the current day	
		//if($d == $mday)
		//	echo("<td class='bg-blue'><a href='#' title='Detail of day'>$d</a></td>");
		//else 
			echo("<td class='$bg'><a href='#' title='Detail of day'>$d</a></td>");

		$startDay++;
		if($startDay > 6 && $d < $lastDay){
			$startDay = 0;
			echo("</tr>");
			echo("<tr>");
		}
	}
	echo("</tr>");


