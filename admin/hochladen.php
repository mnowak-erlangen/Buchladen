<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "buchladen");
    $userid = $_SESSION['userid'];
?>
<!DOCTYPE html> 
    <html> 
        <head>
            <title>Buchladen</title>    
        </head> 
        <body>
        <p><a href="../logout.php">Logout</a> <a href="ansicht.php">zurück zur Übersicht</a></p>
<?php

if(isset($_POST['isbn10'])) {
    $isbn10 = $_POST['isbn10'];
    $isbn13 = $_POST['isbn13'];
    $titel = $_POST['titel'];
    $autor = $_POST['autor'];
    $datei = $_FILES['datei']['name'];

    $statement = "SELECT COUNT(*) as Anzahl FROM buecher WHERE isbn13 = '" . $isbn13 . "';";
    $result = mysqli_query($db, $statement);
    $eintrag = mysqli_fetch_assoc($result);
    if ($eintrag['Anzahl'] == 1) {
       echo 'Die ISBN ist bereits im System vorhanden!';
    } else {
        move_uploaded_file($_FILES['datei']['tmp_name'], 'tmp_files/' . $datei);

        $pfad = strtolower(str_replace(' ', '_', $titel));  
        if (!file_exists('../buecher/' . $pfad)) {
            mkdir('../buecher/' . $pfad, 0777, true);
        }

        $statement = "INSERT INTO buecher VALUES ('" . $isbn10 . "','" . $isbn13 . "','" . $titel . "','" . $autor . "','" . $pfad . "/','" . $userid . "','" . date("Y-m-d") . "');";
        mysqli_query($db, $statement);

        exec("gswin32c -dNOPAUSE -sDEVICE=jpeg -r144 -sOutputFile=../buecher/" . $pfad . "//%d.jpg tmp_files/" . $datei);
        unlink('tmp_files/' . $datei);
        echo 'Das Buch wurde erfolgreich hinzugefügt!';
    }
}

?>
        <form action="" method="post" enctype="multipart/form-data">
            ISBN10:<br>
            <input type="text" size="40" maxlength="10" name="isbn10"><br><br>
            ISBN13:<br>
            <input type="text" size="40" maxlength="13" name="isbn13"><br><br>
            Titel:<br>
            <input type="text" size="40" maxlength="50" name="titel"><br><br>
            Autor:<br>
            <input type="text" size="40" maxlength="50" name="autor"><br><br>
            <input type="file" name="datei"/><br><br>
            <input type="submit" value="Abschicken">
        </form>
    </body>
</html>