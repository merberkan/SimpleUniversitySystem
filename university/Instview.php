<html>
    <head>
    <title>Instructor View</title>
</head>
<body>

    <?php
    if (isset($_GET['ssn'])) {
        $issn = $_GET['ssn'];
    } else {
        $issn = "ssn not set in GET Method";
    }
    echo $issn;
    include './dbconnect.php';

//The courses that instructor gives.
    $query = "select distinct  courseName
                  from course c, sectionn s
                  where s.issn = '$issn' and s.courseCode = c.courseCode;";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    if ($num > 0){

    while ($row = $result->fetch_assoc()) {
        $courseN = $row["courseName"];
             ?>           
   <br><?php echo "Given Course(s):", $courseN; ?></br>           
        <?php
    } 
    }else{
      ?>           
   <br><?php echo "Error:There is no course given:" ?></br>           
        <?php
    echo "</table>";}
//Weekly Schedule
    echo "<h4>Weekly Schedule:</h4>";
    $query = "SELECT courseCode,dayy,hourr FROM weeklyschedule where issn='$issn'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        ?>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial, Helvetica, sans-serif">day</font></th>
                <th><font face="Arial, Helvetica, sans-serif">Hour</font></th>
                <th><font face="Arial, Helvetica, sans-serif">Course Code</font></th>
            </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $day = $row["dayy"];
        $hour = $row["hourr"];
        $courseCod = $row["courseCode"];
        ?>  
                <tr>
                    <td><font face="Arial, Helvetica, sans-serif"><?php echo $day; ?></font></td>
                    <td><font face="Arial, Helvetica, sans-serif"><?php echo $hour; ?></font></td>
                    <td><font face="Arial, Helvetica, sans-serif"><?php echo $courseCod; ?></font></td>
                </tr>
        <?php
    }
} else
    echo "Error:There is no Weekly Schedule<br>";
echo "</table>";
//Students of Each Course
echo "<h4>Students</h4>";
$query = "select courseCode,s.ssn
from Student s, instructor i,enrollment e
where issn='$issn' and e.issn=i.ssn and e.sssn=s.ssn ; ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">courseCode</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Student ssn</font></th>                    

                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $courseN = $row["courseCode"];
        $students = $row["ssn"];       
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $courseN; ?></font></td>
                        <td>  <a href="allStudents.php?ssn=<?php echo $students; ?>"><?php echo $students; ?></a> 
                       </td>
                        
                    </tr>
        <?php
    }
} else
    echo "Error:There is no students<br>";
echo "</table>";

//The project Lead by Instructor
echo "<h4>Leading in Project</h4>";
$query = "select distinct pName
from project p,instructor i
where p.leadSsn='$issn'  ; ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Pname</font></th>                    

                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $Pname = $row["pName"];       
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $Pname; ?></font></td>
                        
                    </tr>
 <?php
    }
} else
    echo "Error:There is no project you lead<br>";
echo "</table>";


//Project(s) works
echo "<h4>Working in Project</h4>";
$query = "select distinct pName
from project_has_instructor ip,instructor i
where '$issn'=ip.issn and ip.issn=i.ssn  ; ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Pname</font></th>                    

                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $pN = $row["pName"];    
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $pN; ?></font></td>                        
                        
                    </tr>
 <?php
    }
} else
    echo "Error:There is no project(s) you are working<br>";
echo "</table>";


//Advised students
echo "<h4>Students of Advisor</h4>";
$query = "select s.ssn,s.studentname
from student s,instructor i
where '$issn'=s.advisorSsn and s.advisorSsn=i.ssn; ; ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Student Ssn</font></th>                    
                    <th><font face="Arial, Helvetica, sans-serif">Student Name</font></th>  
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $sssn = $row["ssn"];    
        $ssName = $row["studentname"];  
        ?>  
                    <tr>
                        <td>  <a href="allStudents.php?ssn=<?php echo $sssn; ?>"><?php echo $sssn; ?></a> 
                       </td>                        
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $ssName; ?></font></td>
                    </tr>
 <?php
    }
} else
    echo "Error:There is no student(s) you are a advisor<br>";
echo "</table>";

//Gradstudent Supervisor
echo "<h4>Gradstudents of Supervisor</h4>";
$query = "select s.ssn
from gradstudent s,instructor i
where '$issn'=s.supervisorSsn  and s.supervisorSsn=i.ssn; ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if ($num > 0) {
    ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">GradStudent Ssn</font></th>                      
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $gsssn = $row["ssn"];    
       
        ?>  
                    <tr>
                        <td>  <a href="allStudents.php?ssn=<?php echo $gsssn; ?>"><?php echo $gsssn; ?></a> 
                       </td>                          
                    </tr>
 <?php
    }
} else
    echo "Error:There is no gradstudent you're his/her supervisor<br>";
echo "</table>";
//Free Hours for week
 echo "<h4>Free Hours</h4>";
    
     $query = "select T.dayy, T.hourr
from timeslot T
where (T.dayy, T.hourr) not in (SELECT W.dayy, W.hourr
                           		from enrollment E NATURAL JOIN weeklyschedule W
                               	where  E.issn in (SELECT E2.issn
                                from enrollment E2
				where E2.issn = E.issn and E2.issn='$issn' 
				));";
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
        $dayyy = $row["dayy"]; 
        $hourrr = $row["hourr"];
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $dayyy; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $hourrr; ?></font></td>
                        
                    </tr>
        <?php
    }
} else
    echo "Error:There is no free hour<br>";
echo "</table>";

mysqli_close($conn);
?>
                    
                    
                    

            <P>
                <a href="./">Return to main page</a>   
                 </body>
                </html>
