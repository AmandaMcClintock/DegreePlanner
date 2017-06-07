<?php
	$conn = mysqli_connect("localhost","cs377","cs377_s17","degree_planner");
  	if (mysqli_connect_errno())
        {
              printf("Connect failed: %s\n", mysqli_connect_error());
              exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Degree Planner</title>
</head>
<body>
	<form ACTION="coursePlanner.php" METHOD="POST">>
	<p>Please select your Primary Major.</p>
	<select name = "Primary">

	<option name = "Primary Concentration">Select Major</option>
	<?php $query1="select name from DEGREE where name LIKE 'BS%' OR name LIKE 'BA%'";
		$result1 = mysqli_query($conn, $query1);
		while($Major=mysqli_fetch_array($result1)):;
	?>
		<option><?php ECHO $Major["name"];?></option>
	<?php endwhile;?>
	</select>

	<p>If you have a Secondary Major or Minor, please select it below.</p>
        <select name = "Secondary">

        <option name="Secondary">Select Major/Minor</option>
        <?php $query2="select name from DEGREE";
                $result2 = mysqli_query($conn, $query2);
                while($MajorMinor=mysqli_fetch_array($result2)):;
        ?>
                <option name="Secondary"><?php ECHO $MajorMinor["name"];?></option>
        <?php endwhile;?><br>
	</select>

	<p>Select your graduation date.</p>
  	<input type="radio" name="Semester" <?php if (isset($Semester) && $gender=="Fall") echo "checked";?> value="Fall">Fall
  	<input type="radio" name="Semester" <?php if (isset($Semester) && $Semester=="Spring") echo "checked";?> value="Spring">Spring

  	<br><br>
	<select name ="year">
        <option name = "year">Graduation year</option>
        <?php $x = 2017;
                while( $x < 2100):;
        ?>
                <option name = "year"><?php ECHO $x; ++$x;?></option> 
        <?php endwhile;?><br>
	</select>

	<p>Please check all the classes you have taken and are currently taking.</p>
        <?php $query3="select cNo,cName from COURSE";
                $result3 = mysqli_query($conn, $query3);
                while($row = $result3->fetch_assoc())
		echo '<input type=checkbox name=course[] value="'.$row["cNo"].'"> '.$row["cNo"].' : '.$row["cName"].'<Br>';
        ?>
        <p><input type="submit" name ="submit" value="submit"></p>
	</form>
</body>
</html>
