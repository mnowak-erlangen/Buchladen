<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=buchladen', 'root', '');
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
    $error = false;
    $errorMessage = 'Fehlermeldungen: <br>';

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
  
    if(strlen($benutzerid) == 0) {
        $errorMessage += 'Bitte eine BenutzerID angeben<br>';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage += 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
    }     
    if(strlen($vorname) == 0) {
        $errorMessage += 'Bitte einen Vornamen angeben<br>';
    }
    if(strlen($nachname) == 0) {
        $errorMessage += 'Bitte einen Nachnamen angeben<br>';
    }
    if(strlen($plz) == 0) {
        $errorMessage += 'Bitte eine Postleitzahl angeben<br>';
    }
    if(strlen($ort) == 0) {
        $errorMessage += 'Bitte einen Ort angeben<br>';
    }
    if(strlen($strasse) == 0) {
        $errorMessage += 'Bitte eine Straße angeben<br>';
    }
    if(strlen($hausnr) == 0) {
        $errorMessage += 'Bitte eine Hausnummer angeben<br>';
    }
    if(strlen($passwort) == 0) {
        $errorMessage += 'Bitte ein Passwort angeben<br>';
    }
    if($passwort != $passwort2) {
        $errorMessage += 'Die Passwörter müssen übereinstimmen<br>';
    }

    if(strlen($errorMessage) == 0) {
        $error = true;
    }

    //Überprüfe, dass der Nutzername noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM kunde WHERE benutzerid = :benutzerid");
        $result = $statement->execute(array('benutzerid' => $benutzerid));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Dieser Nutzername ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO kunde (benutzerid, passwort, vorname, nachname, strasse, hausnr, plz, ort, email) VALUES (:benutzerid, :passwort, :vorname, :nachname :strasse, :hausnr, :plz, :ort, :email)");
        $result = $statement->execute(array('benutzerid' => $benutzerid, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'strasse' => $strasse, 'hausnr' => $hausnr, 'plz' => $plz, 'ort' => $ort, 'email' => $email));

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