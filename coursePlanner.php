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
	<title>Courses</title>
</head>
<body>
<?php
	//User input
	$Primary = $_POST['Primary'] ;
	$Secondary = $_POST['Secondary'] ;
 	$Semester = $_POST['Semester'] ;
	$year = $_POST['year'] ;
	$course = $_POST['course'];
	//Telling the user what they inputted
	echo "Your primary degree is ";
	echo ("$Primary <Br>");

	if($Secondary != "Select Major/Minor"){
	echo "Your secondary degree is ";
	echo ("$Secondary <Br>");}
	echo "Your graduation date is ";
	echo("$Semester $year <Br>");

	//List of courses
	if(empty($_POST['course'])){
    	echo "You have not taken any coutses yet <Br>";
	}
	else{
    	$N = count($_POST['course']);
    	echo("You've taken $N courses(s): <Br>");
   	if (isset($_POST['submit'])) {
            if (!empty($_POST['course'])) {

                foreach ($_POST['course'] as $selected) {
                    echo $selected."</br>";
                }
            }
        }
	if($Secondary == "Select Major/Minor"){
	//Core courses for primary study
	echo ("In general, you must satisfy these core classes for your primary major: <Br>");
	$core_prim = "SELECT cNo from required WHERE dName = '$Primary'";

	if ( ( $core_prim_result = mysqli_query( $conn, $core_prim) ) == 0 )
	{
 	printf("Error: %s\n", mysqli_error($conn));
 	exit(1);
 	}
	while ( $row_prim = mysqli_fetch_array($core_prim_result))
 	{
	echo ($row_prim["cNo"] . "<br>");}

	//Core courses for secondary study if there is one
	}

	else{
	echo ("In general, you must satisfy these core classes for your degrees: <Br>");
        $core_secd = "SELECT cNo from required WHERE dName = '$Primary' OR dName = '$Secondary'";
        if ( ( $core_secd_result = mysqli_query( $conn, $core_secd) ) == 0 )
        {
        printf("Error: %s\n", mysqli_error($conn));
        exit(1);
        }

        while ( $row_secd = mysqli_fetch_array($core_secd_result))
        {
        echo($row_secd["cNo"] . "<br>");
	}
}
?>
</body>
</html>
