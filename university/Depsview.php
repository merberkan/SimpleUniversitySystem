<html>
    <head>
    <title>Instructor View</title>
</head>
<body>

    <?php
    if (isset($_GET['dname'])) {
        $depsName = $_GET['dname'];
    } else {
        $depsName = "ssn not set in GET Method";
    }
     echo $depsName;
    include './dbconnect.php';

    
//The courses department opened  
     echo "<h4>Courses</h4>";
         $query = "select cu.courseCode
             from department d,curricula c,curriculacourses cu
               where '$depsName'=d.dName and d.dName=c.dName and c.currCode=cu.currCode ;    ; ";
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
        $coCode = $row["courseCode"]; 
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $coCode; ?></font></td>
                    </tr>
        <?php
    }
} else
    echo "Error:There is no course department opened<br>";
echo "</table>";


//Head of the Department
         $query = "select iname
                   from department d,instructor i
                   where '$depsName'=d.dName and headSsn=ssn; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
    while ($row = $result->fetch_assoc()) {
        $inName = $row["iname"]; 

    }
    echo  "<br><b>Department Head:</b>",$inName,"<br>";  
} else
    echo "Error:There is no head of this department<br>";
echo "</table>";

//students studying in this department
     echo "<h4>Students</h4>";
         $query = "select ssn,studentname
                   from student
                   where '$depsName'=dName ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Ssn</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Student Name</font></th>                    
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $ssnn = $row["ssn"];
        $StudentN = $row["studentname"]; 
              
        ?>  
                    <tr>
                        <td>
                            <a href="allStudents.php?dname=<?php echo $ssnn; ?>"><?php echo $ssnn; ?></a>  
                    </td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $StudentN; ?></font></td>
                    </tr>
        <?php
    }
} else
    echo "Error:There is no student in the deparment<br>";
echo "</table>";    
 
//Project(s) controlled by department 
     echo "<h4>Projects</h4>";
         $query = "SELECT distinct pName,p.budget,startdate,enddate
                   from project p,department d
                   where controllingDName='$depsName';";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Project Name</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Budget</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Start Date</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">End Date</font></th>

                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $projectN = $row["pName"];
        $pbudget = $row["budget"]; 
        $startd = $row["startdate"]; 
        $endd= $row["enddate"]; 
              
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $projectN; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $pbudget; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $startd; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $endd; ?></font></td>
                    </tr>
        <?php
    }
} else
    echo "Error:There is no project controlled by this department<br>";
echo "</table>";
  
    mysqli_close($conn);
?>
           <P>
                <a href="./">Return to main page</a>

                </body>
                </html>
