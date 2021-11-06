<!DOCTYPE html>
<html>
    <head>
        <title>All Projects</title>
    </head>
    <body>

        <?php
        include './dbconnect.php';
        $query = "SELECT pName,leadSsn FROM project";
        $result = mysqli_query($conn,$query);
        $num = mysqli_num_rows($result);
        mysqli_close($conn);
        ?>

        <h4>Projects of University</h4>
        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>Project Name</th>
                <th>LeadSsn</th>
            </tr>

            <?php
            while ($row=$result->fetch_assoc()) {
                $pname = $row["pName"];
                $leadSsn = $row["leadSsn"];
                ?>

                <tr>
                    <td>
                        <a href="Projsview.php?pname=<?php echo $pname; ?>"><?php echo $pname; ?></a>
                    </td>
                    <td>
                        <a href="allInst.php?dno=<?php echo $leadSsn; ?>"><?php echo $leadSsn; ?></a>
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
