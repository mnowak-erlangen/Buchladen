<?php
session_start();
if(!isset($_SESSION['userid']) && !isset($_SESSION['isAdmin'])) {
    die('Bitte loggen Sie sich zuerst ein. <a href="login.php">Zum Login</a>.');
    ?>
    <script language="JavaScript" type="text/javascript">
        setTimeout("location.href='login.php'", 1000);
    </script>
    <?php
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

$db = mysqli_connect("localhost", "root", "", "buchladen");
?>
<!DOCTYPE html> 
<html> 
    <head>
        <title>Buchladen</title>    
    <?php
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn'];

            $statement = "DELETE FROM kundebuecher WHERE ISBN13 = '" . $isbn . "';";
            mysqli_query($db, $statement);
            $statement = "DELETE FROM buecher WHERE ISBN13 = '" . $isbn . "';";
            mysqli_query($db, $statement);

            echo "<script>alert('Das Buch " . $isbn . " wurde erfolgreich gelöscht!');</script>";
        }

        $statement = "SELECT * FROM buecher;";
        $result = mysqli_query($db, $statement);
    ?>
    </head> 
    <body>
        <p><a href="../logout.php">Logout</a> <a href="hochladen.php">neues Buch hochladen</a></p>
        <table>
            <tr>
                <th>ISBN10</th>
                <th>ISBN13</th>
                <th>Titel</th>
                <th>Autor</th>
                <th>Verzeichnispfad</th>
                <th>bearbeitet von</th>
                <th>bearbeitet am</th>
                <th></th>
            </tr>
<?php
    $row = mysqli_fetch_all($result);
    $zaehler = 0;
    while ($zaehler != count($row)) {
        echo "<tr>";
        echo "<td>" . $row[$zaehler][0] . "</td>";
        echo "<td>" . $row[$zaehler][1] . "</td>";
        echo "<td>" . $row[$zaehler][2] . "</td>";
        echo "<td>" . $row[$zaehler][3] . "</td>";
        echo "<td>" . $row[$zaehler][4] . "</td>";
        echo "<td>" . $row[$zaehler][5] . "</td>";
        echo "<td>" . $row[$zaehler][6] . "</td>";
        echo "<td><button onclick=\"window.location.href = 'ansicht.php?isbn=" . $row[$zaehler][1] . "';\">Löschen</button></td>";
        echo "</tr>";
        $zaehler = $zaehler + 1;
    }
?>
        </table>
    </body>
</html>