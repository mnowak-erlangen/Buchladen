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
$statement = "SELECT b.isbn13, b.titel, b.autor, k.lesezeichen FROM buecher b, kundebuecher k WHERE k.benutzerid like '$userid' AND b.isbn13 = k.isbn13;";
$result = mysqli_query($db, $statement);
?>
<!DOCTYPE html> 
<html> 
    <head>
        <title>Buchladen</title>    
    </head> 
    <body>
        <p><a href="../logout.php">Logout</a> <a href="hinzufuegen.php">Neue Bücher hinzufügen</a></p>
        <table>
            <tr>
                <th>Titel</th>
                <th>Autor</th>
                <th>Dein Lesezeichen</th>
            </tr>
<?php
    $row = mysqli_fetch_all($result);
    $zaehler = 0;
    while ($zaehler != count($row)) {
        echo "<tr>";
        echo "<td><a href=\"../lesen.php?isbn=" . $row[$zaehler][0] . "&lesezeichen=" . $row[$zaehler][3] . "\">" . $row[$zaehler][1] . "</a></td>";
        echo "<td>" . $row[$zaehler][2] . "</td>";
        echo "<td>" . $row[$zaehler][3] . "</td>";
        echo "</tr>";
        $zaehler = $zaehler + 1;
    }
?>
        </table>
    </body>
</html>