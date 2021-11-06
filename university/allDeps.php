<!DOCTYPE html>
<html>
    <head>
        <title>All Departments in University</title>
    </head>
    <body>

        <?php
        include './dbconnect.php';
        $query = "SELECT dName,headSsn FROM department";
        $result = mysqli_query($conn,$query);
        $num = mysqli_num_rows($result);
        mysqli_close($conn);
        ?>

        <h4>Departments of University</h4>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>Department Name</th>
                <th>Department Head</th>
            </tr>

            <?php
            while ($row=$result->fetch_assoc()) {
                $dname = $row["dName"];
                $headSsn = $row["headSsn"];
                ?>
                <tr>
                    <td>
                        <a href="Depsview.php?dname=<?php echo $dname; ?>"><?php echo $dname; ?></a>  
                    </td>
                     
                    <td>  <a href="Instview.php?ssn=<?php echo $headSsn; ?>"><?php echo $headSsn; ?></a> 
                       </td>
                </tr>
                <?php
            }
            ?>
                

        </table>

        <P>
            <a href="./">Return to main page</a>

    </body>
</html>
