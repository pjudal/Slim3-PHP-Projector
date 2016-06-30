<?php

	session_start();

	$proj_name = $_SESSION["proj_name"];
	$proj_id = $_SESSION["proj_id"];
	$assigned = $_SESSION["assigned_persons"];
	$unassigned = $_SESSION["unassigned_persons"];

	echo "<select id=\"assign_sel\" ng-model=\"person_id\">";
	foreach ($unassigned as $row) {
		echo "<option value=" . $row['id'] . ">"
		. $row['first_name'] . " " . $row['last_name'] . "</option>";
	}
	echo "</select>";
	echo "<input class=\"sel_button\" type=\"submit\" value=\"Add\"
		ng-click=\"assign(person_id, " . $proj_id . ")\"
			>";
	echo "</form>";


	echo "<h2 class=\"second_h2\">Current Members</h2>";

	echo
	"
	<table id=\"current_members\"
		ng-init=\"names =" . htmlspecialchars(json_encode($assigned)) . "\">
	<tr ng-repeat=\"x in names\">
		<td class=\"hidden\">{{x.id}}</td>
		<td>{{x.first_name}} {{x.last_name}}</td>
		<td><a href=\"/projects/assign\" ng-click=\"remove(x.id, " . $proj_id . ")\">Remove</a></td>
	</tr>
	</table>
	"
?>