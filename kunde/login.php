<?php 
session_start();
$db = mysqli_connect("localhost", "root", "", "buchladen");
 
if(isset($_GET['login'])) {
    $benutzerid = $_POST['benutzerid'];
    $passwort = $_POST['passwort'];

    $statement = "SELECT count(*) as 'Eintrag' FROM kunde WHERE benutzerid like '$benutzerid' AND passwort like '$passwort';";
    $result = mysqli_query($db, $statement);

    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Eintrag'] == 1) {
        $_SESSION['userid'] = $benutzerid;
        die('Login erfolgreich. Weiter zum <a href="buchhandlung.php">Kundenbereich</a>.');#
        ?>
        <script language="JavaScript" type="text/javascript">
            setTimeout("location.href='buchhandlung.php'", 1000);
        </script>
        <?php
    } else {
        $errorMessage = "E-Mail oder Passwort ist ungültig<br>";
    }   
}
?>
<!DOCTYPE html> 
 <html> 
    <head>
        <title>Buchladen</title>    
    </head> 
    <body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
        <form action="?login=1" method="post">
            Benutzername:<br>
            <input type="text" size="40" maxlength="50" name="benutzerid"><br><br>
            
            Dein Passwort:<br>
            <input type="password" size="40"  maxlength="250" name="passwort"><br>
            
            <input type="submit" value="Abschicken">
        </form> 
    </body>
</html>