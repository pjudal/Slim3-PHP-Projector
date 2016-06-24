<?php

	session_start();

	$proj_name = $_SESSION["proj_name"];
	$assigned = $_SESSION["assigned_persons"];
	$unassigned = $_SESSION["unassigned_persons"];

	echo "<select id=\"assign_sel\">";
	foreach ($unassigned as $row) {
		echo "<option value=" . $row['id'] . ">"
		. $row['first_name'] . " " . $row['last_name'] . "</option>";
	}
	echo "</select>";
	echo "<input class=\"sel_button\" type=\"submit\" value=\"Add\">";
	echo "</form>";


	echo "<h2 class=\"second_h2\">Current Members</h2>";
	echo "<table id=\"current_members\">";		    
	foreach ($assigned as $row) {
		echo "<tr>";
			echo "<td class=\"hidden\">" . $row['id'] . "</td>";
			echo "<td>\"" . $row['first_name'] . " " . $row['last_name'] . "\"</td>";
			//echo "<td> <a href=\"#\">Remove</a></td>";
			echo "<td><a href=\"#\" onclick=\"go($(this))\">Remove</a></td>";
		echo "</tr>";
	}
	echo "</table>";

?>