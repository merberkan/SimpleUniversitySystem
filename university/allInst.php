<!DOCTYPE html>
<html>
    <head>
        <title>All Instructors</title>
    </head>
    <body>

        <?php
        include './dbconnect.php';
        $query = "SELECT ssn,iname,rankk from instructor";
        $result = mysqli_query($conn,$query);
        $num = mysqli_num_rows($result);
        mysqli_close($conn);
        ?>

        <h4>Instructors of University</h4>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>Ssn </th>
                <th>Instructor Name</th>
                <th>Instructor Title</th>
            </tr>

            <?php
            while ($row=$result->fetch_assoc()) {
                $issn = $row["ssn"];
                $iname = $row["iname"];
                $rank = $row["rankk"];
                ?>

                <tr>
                    <td>
                        <a href="Instview.php?ssn=<?php echo $issn; ?>"><?php echo $issn; ?></a>
                    </td>
                    <td><?php echo $iname; ?></td>
                    <td><?php echo $rank; ?></td>
                    
                </tr>
                <?php
            }
            ?>

        </table>

        <P>
            <a href="./">Return to main page</a>

    </body>
</html>
