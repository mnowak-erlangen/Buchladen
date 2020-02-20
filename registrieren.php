<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "buchladen");
?>
<!DOCTYPE html> 
    <html> 
        <head>
            <title>Buchladen</title>    
            <link rel="stylesheet" href="style.css" type="text/css"></link>
        </head> 
        <body>
<?php

if(isset($_GET['register'])) {
    $vorhanden = false;

    $benutzerid = $_POST['uname'];
    $email = $_POST['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $strasse = $_POST['strasse'];
    $hausnr = $_POST['hausnr'];
    $email = $_POST['email'];
    
    $passwort = $_POST['psw'];

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

    $passwort = password_hash($passwort, PASSWORD_BCRYPT);

    if ($vorhanden == false) {
        $statement = "INSERT INTO kunde VALUES ('$benutzerid', '$passwort', '$vorname', '$nachname', '$strasse', '$hausnr', '$plz', '$ort', '$email', 0);";
        $result = mysqli_query($db, $statement);
    
        if($result) {        
            die('Du wurdest erfolgreich registriert. <a href="index.php">Zum Login</a>');
            ?>
            <script language="JavaScript" type="text/javascript">
                setTimeout("location.href='index.php'", 1000);
            </script>
            <?php
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten.<br>';
        }
    }
}

?>
        <form action="?register=1" method="post">
            <div class="imgcontainer">
                <img src="images/avatar.png" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="uname"><b>Benutzername</b></label>
                <input type="text" maxlength="50" name="uname" required>
                <label for="vorname"><b>Vorname</b></label>
                <input type="text" maxlength="50" name="vorname" required>
                <label for="nachname"><b>Nachname</b></label>
                <input type="text" maxlength="50" name="nachname" required>
                <label for="plz"><b>Postleitzahl</b></label>
                <input type="text" maxlength="5" name="plz" required>
                <label for="ort"><b>Ort</b></label>
                <input type="text" maxlength="50" name="ort" required>
                <label for="str"><b>Straße</b></label>
                <input type="text" maxlength="50" name="strasse" required>
                <label for="hausnr"><b>Hausnummer</b></label>
                <input type="text" maxlength="5" name="hausnr" required>
                <label for="email"><b>E-Mail</b></label>
                <input type="email" maxlength="50" name="email" required>
                <label for="psw"><b>Passwort</b></label>
                <input type="password" maxlength="250" name="psw" required>
                
                <button type="submit">Registrieren</button>
                <div class="container" style="background-color:#f1f1f1">
                        <button type="button" class="regbtn" onclick="window.location.href = 'index.php';">Jetzt einloggen</button>
                </div> 
            </div>
        </form>
    </body>
</html>