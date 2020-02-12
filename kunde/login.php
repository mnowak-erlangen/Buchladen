<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=buchladen', 'root', '');
 
if(isset($_GET['login'])) {
    $benutzerid = $_POST['benutzerid'];
    $passwort = $_POST['passwort'];
    
    $statement = $pdo->prepare("SELECT * FROM kunde WHERE benutzerid = :benutzerid");
    $result = $statement->execute(array('benutzerid' => $benutzerid));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
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