<!DOCTYPE html>
<html>
    <head>
        <title>All Students</title>
    </head>
    <body>

        <?php
        include './dbconnect.php';
        $query = "SELECT ssn,studentname from student";
        $result = mysqli_query($conn,$query);
        $num = mysqli_num_rows($result);
        mysqli_close($conn);
        ?>
        <h4>Students at University</h4>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>Ssn </th>
                <th>Student Name</th>
            </tr>

            <?php
            while ($row=$result->fetch_assoc()) {
                $ssn = $row["ssn"];
                $sname = $row["studentname"];
                ?>

                <tr>
                    <td>
                        <a href="Studentview.php?ssn=<?php echo $ssn; ?>"><?php echo $ssn; ?></a>
                    </td>
                    <td><?php echo $sname; ?></td>
                </tr>
                <?php
            }
            ?>

        </table>

        <P>
            <a href="./">Return to main page</a>

    </body>
</html>
