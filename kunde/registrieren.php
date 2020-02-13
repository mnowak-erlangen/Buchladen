<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "buchladen");
?>
<!DOCTYPE html> 
    <html> 
        <head>
            <title>Registrierung</title>    
        </head> 
        <body>
<?php
 
 $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $vorhanden = false;

    $benutzerid = $_POST['benutzerid'];
    $email = $_POST['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $strasse = $_POST['strasse'];
    $hausnr = $_POST['hausnr'];
    $email = $_POST['email'];
    
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];


    //Überprüfe, dass der Nutzername noch nicht registriert wurde
    $statement = "SELECT count(*) as 'Eintrag' FROM kunde WHERE benutzerid = '$benutzerid'";
    $result = mysqli_query($db, $statement);

    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Eintrag'] == 1) {
       echo 'Dieser Benutzername ist bereits vergeben!<br>';
       $vorhanden = true;
    }

    $statement = "SELECT count(*) as 'Eintrag' FROM kunde WHERE email = '$email'";
    $result = mysqli_query($db, $statement);

    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Eintrag'] == 1) {
        echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
        $vorhanden = true;
    }

    if ($vorhanden == false) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $statement = "INSERT INTO kunde (benutzerid, passwort, vorname, nachname, strasse, hausnr, plz, ort, email) VALUES ('$benutzerid', '$passwort_hash', '$vorname', '$nachname' '$strasse', '$hausnr', '$plz', '$ort', '$email')";
        $result = mysqli_query($db, $statement);
        var_dump($result);
    
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten.<br>';
        }
    }
}

if($showFormular) {
?>
<form action="?register=1" method="post">
    Benutzername:<br>
    <input type="text" size="40" maxlength="50" name="benutzerid"><br><br>
    Vorname:<br>
    <input type="text" size="40" maxlength="50" name="vorname"><br><br>
    Nachname:<br>
    <input type="text" size="40" maxlength="50" name="nachname"><br><br>
    Postleitzahl:<br>
    <input type="text" size="40" maxlength="5" name="plz"><br><br>
    Ort:<br>
    <input type="text" size="40" maxlength="50" name="ort"><br><br>
    Straße:<br>
    <input type="text" size="40" maxlength="50" name="strasse"><br><br>
    Hausnummer:<br>
    <input type="text" size="40" maxlength="5" name="hausnr"><br><br>
    E-Mail:<br>
    <input type="email" size="40" maxlength="50" name="email"><br><br>
    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="passwort"><br>
    Passwort wiederholen:<br>
    <input type="password" size="40" maxlength="250" name="passwort2"><br><br>
    
    <input type="submit" value="Abschicken">
</form>
<?php
} //Ende von if($showFormular)
?>
    </body>
</html>