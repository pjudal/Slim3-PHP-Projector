<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Projector</title>
	<link rel="stylesheet" href="css/projects.css">
	<script type="text/javascript" src="/../js/jquery-1.8.2.min.js"></script>

	<script>
		function go(link) {
		    //alert(link.parent().parent().find('td:first').text());
		    document.cookie = "project_to_add_to=" + link.parent().parent().find('td:first').text();
		}
	</script>

</head>

<body>

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a class="active" href="#">View Projects</a></li>
		<li><a href="projects/create">Create Project</a></li>
		<li><a href="persons/create">Create Person</a></li>
		<li><a href="secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Projects</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>

		<?php
		$conn=mysqli_connect("localhost","root","","slim-mvc");
		// Check connection
		if (mysqli_connect_errno())	{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$stmt = $conn->prepare("SELECT EXISTS(SELECT 1 FROM projects)");
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_array(MYSQLI_NUM))
	    {
	        foreach ($row as $r)
	        {
	        	if ($r == 0)	$project_empty = 1;
	        	else	$project_empty = 0;
	        }
	    }

	    if ($project_empty == 1) {
	    	echo "<h3>No projects available.</h3>";
	    }

	    else {
			$result = mysqli_query($conn,"SELECT * FROM projects");

			echo "<table border='1' class=\"viewproj_table\">
			<tr>
				<th>Code</th>
				<th>Project Name</th>
				<th>Budget</th>
				<th>Remarks</th>
				<th>Tasks</th>
			</tr>";

			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
					echo "<td>" . $row['code'] . "</td>";
					echo "<td class=\"proj-name\">" . $row['name'] . "</td>";
					echo "<td>" . number_format($row['budget'], 2) . "</td>";
					echo "<td>" . $row['remarks'] . "</td>";
					echo "<td> <a href=\"/projects/assign\" onclick=\"go($(this))\">Assignments</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}

		mysqli_close($conn);
		?>

	</div>

</body>
</html>