<?php 
session_start();
$db = mysqli_connect("localhost", "root", "", "buchladen");
 
if(isset($_GET['login'])) {
    $benutzerid = $_POST['uname'];
    $passwort = $_POST['psw'];

    $statement = "SELECT count(*) as 'Eintrag' FROM kunde WHERE benutzerid like '$benutzerid' AND passwort like '$passwort';";
    $result = mysqli_query($db, $statement);

    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Eintrag'] == 1) {
        $_SESSION['userid'] = $benutzerid;
        $statement = "SELECT count(*) as 'isAdmin' FROM kunde WHERE benutzerid like '$benutzerid' AND passwort like '$passwort' AND isAdmin = 1";
        $result = mysqli_query($db, $statement);
        $eintrag = mysqli_fetch_assoc($result);

        if ($eintrag['isAdmin'] == 0) {
            die('Login erfolgreich. Weiter zum <a href="kunde/buchhandlung.php">Kundenbereich</a>.');#
            ?>
            <script language="JavaScript" type="text/javascript">
                setTimeout("location.href='kunde/buchhandlung.php'", 1000);
            </script>
            <?php
        } else {
            $_SESSION['isAdmin'] = $eintrag['isAdmin'];
            die('Login erfolgreich.<br>Weiter zum <a href="kunde/buchhandlung.php">Kundenbereich</a>.<br>Weiter zum <a href="admin/ansicht.php">Adminbereich</a>.');
            ?>
            <script language="JavaScript" type="text/javascript">
                setTimeout("location.href='admin/ansicht.php'", 1000);
            </script>
            <?php
        }
    } else {
        $errorMessage = "E-Mail oder Passwort ist ungültig<br>";
    }   
}
?>
<!DOCTYPE html> 
 <html> 
    <head>
        <title>Buchladen</title>  
        <link rel="stylesheet" href="style.css" type="text/css"></link>  
    </head> 
    <body>
 
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
        <form action="?login=1" method="post">
            <div class="imgcontainer">
                <img src="images/avatar.png" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" maxlength="50" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password"  maxlength="250" name="psw" required>

                <button type="submit">Login</button>
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="regbtn" onclick="window.location.href = 'registrieren.php';">Jetzt registrieren</button>
                </div> 
            </div>
        </form>
    </body>
</html>