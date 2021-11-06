<html>
    <head>
    <title>Projects View</title>
</head>
<body>

    <?php
    if (isset($_GET['pname'])) {
        $proj = $_GET['pname'];
    } else {
        $proj = "ssn not set in GET Method";
    }
    echo $proj;
    include './dbconnect.php';

//Head of the Project
         $query = "SELECT iName,rankk
                   from project p,instructor i
                   where '$proj'=pName and i.ssn=p.leadSsn ;";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
    while ($row = $result->fetch_assoc()) {
        $leadN = $row["iName"];
        $irankk = $row["rankk"]; 

    }
    echo  "<br><b>Project Head:</b>",$irankk," ",$leadN,"<br>";  
} else
    echo "Error:There is no lead insturctor for this project<br>";
echo "</table>";

//Students Working in Project(s)    
     echo "<h4>Students</h4>";
         $query = "SELECT studentname
                from project_has_gradstudent p,student s
                where '$proj'=pName and s.ssn=p.Gradssn; ";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Student Name</font></th>                   
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $stName = $row["studentname"];        
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $stName; ?></font></td>     
                    </tr>
        <?php
    }
} else
    echo "Error:There is no student working for this project<br>";
echo "</table>";

//Project Subject budget startDate endDate controllingDName
  
     echo "<h4>Information about Project</h4>";
         $query = "SELECT  subject,budget,startDate,enddate,controllingDName
                   from project
                   where '$proj'=pName";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Subject</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">Budget</font></th>
                    <th><font face="Arial, Helvetica, sans-serif">StartDate</font></th> 
                    <th><font face="Arial, Helvetica, sans-serif">EndDate </font></th> 
                    <th><font face="Arial, Helvetica, sans-serif">Department Name</font></th> 
                </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $subject = $row["subject"];
        $budget = $row["budget"];
        $startdate = $row["startDate"];
        $enddate = $row["enddate"];
        $controlDname = $row["controllingDName"];
        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $subject; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $budget; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $startdate; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $enddate; ?></font></td>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $controlDname; ?></font></td>
                    </tr>
        <?php
    }
} else
    echo "Error:There is not enaugh information about this project<br>";
echo "</table>";
    
//Instructor(s) Working for the project


echo "<h4>Instructors Working for Project</h4>";
         $query = "SELECT iname
                   FROM project_has_instructor,instructor
                   where '$proj'=pName and ssn=issn ;";
             $result = mysqli_query($conn, $query);
             $num = mysqli_num_rows($result);
             if ($num > 0) {
             ?>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th><font face="Arial, Helvetica, sans-serif">Instructor Name</font></th>
               </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
         $WinsName = $row["iname"];

        ?>  
                    <tr>
                        <td><font face="Arial, Helvetica, sans-serif"><?php echo $WinsName; ?></font></td>
                     
                    </tr>
        <?php
    }
} else
    echo "Error:There is no instructor working for this project<br>";
echo "</table>";
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    mysqli_close($conn);
?>
                    
                    
                    

            <P>
                <a href="./">Return to main page</a>   
                 </body>
                </html>