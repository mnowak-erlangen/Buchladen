<?php
session_start();
if(!isset($_SESSION['userid'])) {
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
            $statement = "INSERT INTO kundebuecher VALUES ('$userid', '$isbn', 0);";
            mysqli_query($db, $statement);
            echo "<script>alert('Das Buch " . $_GET['titel'] . " wurde zu deiner Bibliothek hinzugefügt!');</script>";

        }

        $statement = "SELECT isbn13, titel, autor FROM buecher WHERE isbn13 NOT IN (SELECT isbn13 FROM kundebuecher WHERE benutzerid LIKE '$userid');";
        $result = mysqli_query($db, $statement);
    ?>
    </head> 
    <body>
        <p><a href="../logout.php">Logout</a> <a href="buchhandlung.php">Zurück zur Buchauswahl</a></p>
        <table>
            <tr>
                <th>Titel</th>
                <th>Autor</th>
                <th></th>
            </tr>
<?php
    $row = mysqli_fetch_all($result);
    $zaehler = 0;
    while ($zaehler != count($row)) {
        echo "<tr>";
        echo "<td>" . $row[$zaehler][1] . "</td>";
        echo "<td>" . $row[$zaehler][2] . "</td>";
        echo "<td><button onclick=\"window.location.href = 'hinzufuegen.php?isbn=" . $row[$zaehler][0] . "&titel=" . $row[$zaehler][1] . "';\">Hinzufügen</button></td>";
        echo "</tr>";
        $zaehler = $zaehler + 1;
    }
?>
        </table>
    </body>
</html>