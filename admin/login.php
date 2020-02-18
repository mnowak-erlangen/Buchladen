<?php 
session_start();
$db = mysqli_connect("localhost", "root", "", "buchladen");
 
if(isset($_GET['login'])) {
    $benutzerid = $_POST['benutzerid'];
    $passwort = $_POST['passwort'];

    $statement = "SELECT count(*) as 'Eintrag' FROM kunde WHERE benutzerid like '$benutzerid' AND passwort like '$passwort' AND isAdmin = 1;";
    $result = mysqli_query($db, $statement);

    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Eintrag'] == 1) {
        $_SESSION['userid'] = $benutzerid;
        $_SESSION['isAdmin'] = true;
        die('Login erfolgreich. Weiter um <a href="ansicht.php">Bücher bearbeiten</a>.');
    } else {
        $errorMessage = "E-Mail oder Passwort ist ungültig<br>";
    }   
}
?>
<!DOCTYPE html> 
 <html> 
    <head>
        <title>Login</title>    
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