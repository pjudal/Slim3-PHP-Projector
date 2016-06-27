<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Projector</title>
  <link rel="stylesheet" href="/../css/projects.css">
  <script type="text/javascript" src="/../js/jquery-1.8.2.min.js"></script>
</head>

<body>

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a href="/">View Projects</a></li>
		<li><a href="/projects/create">Create Project</a></li>
		<li><a href="/../persons/create">Create Person</a></li>
		<li><a href="/../secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Project Assignments</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>

		<form action="/projects/assign" id="assign_form">
			<?php
			$proj_name = $_SESSION["proj_name"];
			$assigned = $_SESSION["assigned_persons"];
			$unassigned = $_SESSION["unassigned_persons"];

			echo "<h2>Assign to Project ";
			echo $proj_name;
			echo "</h2>";

			echo "<div id=\"content\">";

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
					echo "<td><a href=\"#\" onclick=\"go($(this))\">Remove</a></td>";
					//echo "<td> <a href=\"/projects/assign/remove\" onclick=\"go()\">Remove</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		    ?>

		</div>
		<script src="/../js/general.js"></script>
	</div>

</body>
</html>