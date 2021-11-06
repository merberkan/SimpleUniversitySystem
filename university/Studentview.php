<html>
    <head>
    <title>Instructor View</title>
</head>
<body>

    <?php
    if (isset($_GET['ssn'])) {
        $ssn = $_GET['ssn'];
    } else {
        $ssn = "ssn not set in GET Method";
    }
    echo $ssn;
    include './dbconnect.php';

//Graduation
    $query = "SELECT gradorUgrad
              from Student
              where '$ssn'=ssn ;";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    
    while ($row = $result->fetch_assoc()) {
       
        $gorU = $row["gradorUgrad"]; 
        if($gorU!=0){
               echo  "<br><b>Graduation</b><br>";
        }else{
             echo  "<br><b>UnderGraduation</b><br>";
        }
    }       
//The courses she/he is taking      
     echo "<h4>Courses</h4>";
         $query = "SELECT sssn,courseCode
                   FROM enrollment e,student s
                   where  '$ssn'=ssn and ssn=sssn       ; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Student Ssn</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Course Code</font></th>                    

                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $students = $row["sssn"]; 
        $courseN = $row["courseCode"];
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $students; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $courseN; ?></font></td>
                        
                    </tr>
        <?php
    }
} else
    echo "Error:There is no course you are taking<br>";
echo "</table>";

//Grades
echo "<h4>Grade Report</h4>";
         $query = "SELECT sssn,courseCode,grade
                   FROM enrollment e,student s
                   where  '$ssn'=ssn and ssn=sssn; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Student Ssn</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Course Code</font></th>                    
                    <th><font face="Arial, Helvetica, sans-serif">Grade</font></th> 
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $students = $row["sssn"]; 
        $courseN = $row["courseCode"];
        $grade =$row["grade"];
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $students; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $courseN; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $grade; ?></font></td>

                    </tr>
        <?php
    }
} else
    echo "Error:There is no grade report(There is no course you are taking)<br>";
echo "</table>";
     
     
//Weekly Schedule
echo "<h4>Weekly Schedule</h4>";
         $query = "SELECT E.courseCode, E.sectionId, W.buildingName, W.roomNumber, W.dayy,W.hourr
                   FROM weeklyschedule W NATURAL JOIN enrollment E 
                   where E.sssn ='$ssn' ; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Course Code/Section</font></th>                  
                    <th><font face="Arial, Helvetica, sans-serif">Building Name/Room Number</font></th> 
                    <th><font face="Arial, Helvetica, sans-serif">Day/Hour</font></th>
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $courseC = $row["courseCode"];
        $sectionS = $row["sectionId"]; 
        $buildingN = $row["buildingName"]; 
        $roomN = $row["roomNumber"]; 
        $dayy = $row["dayy"];
        $hourr =$row["hourr"];
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo"<br>",$courseC,".",$sectionS,"<br>"; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo"<br>",$buildingN,"/",$roomN,"<br>"; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo"<br>", $dayy," ",$hourr,"<br>"; ?></font></td>

                    </tr>
        <?php
    }
} else
    echo "Error:There is no weekly schedule(There is no course you are taking)<br>";
echo "</table>";
     
//Advisor     
         $query = "select iname,rankk
                 from student s,instructor i
                  where '$ssn'=s.ssn and s.advisorSsn=i.ssn;";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
    while ($row = $result->fetch_assoc()) {
 
        $insName = $row["iname"];                    
        $rankk = $row["rankk"];                    

    }
    echo  "<br><b>Advisor:</b>",$rankk," ",$insName,"<br>";
} else
    echo "Error:There is no advisor information<br>";
echo "</table>";

//Course(s) Taken
 echo "<h4>Curricula</h4>";
         $query = "SELECT courseCode
            FROM curriculacourses c,student s
            where '$ssn'=s.ssn and s.currCode=c.currCode;";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Course Code</font></th>
                
                 
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $courseCode = $row["courseCode"];      
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo  $courseCode; ?></font></td>
                    </tr>
        <?php
    }
} else
    echo "Error:There is no course(s) you must take <br>";
echo "</table>";

//Department 
  $query = "SELECT dName
            from Student
            where '$ssn'=ssn ;";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
    while ($row = $result->fetch_assoc()) {
        $dnname = $row["dName"];
    }  
    echo  "<br><b>Department:</b>",$dnname,"<br>";  
} 
    else{
        echo "Error:There is no department information<br>";
echo "</table>";  
    }
    //Supervisor and projects of Graduate student
  echo "<h4>Supervisor and projects of Graduate student</h4>";
         $query = "SELECT i.iName,gp.pName
                   FROM gradstudent g,instructor i,project_has_gradstudent gp
                   WHERE '$ssn'=g.ssn and g.supervisorSsn=i.ssn and gp.Gradssn=g.ssn; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Instructor Name</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Gradstudent Project Name</font></th> 
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) { 
        $instructorName = $row["iName"];
        $gradProjectName =$row["pName"];

        ?>
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $instructorName; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $gradProjectName; ?></font></td>

                    </tr>
        <?php
    }
} else
    echo "Error:This student has not yet graduated.<br>";
echo "</table>";
    
 
    mysqli_close($conn);
?>
                    
                    
                    
                    

            <P>
                <a href="./">Return to main page</a>

                </body>
                </html>
