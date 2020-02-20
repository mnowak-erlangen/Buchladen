<?php
    session_start();
    if(!isset($_SESSION['userid']) && !isset($_SESSION['isAdmin'])) {
        die('Bitte loggen Sie sich zuerst ein. <a href="../index.php">Zum Login</a>.');
        ?>
        <script language="JavaScript" type="text/javascript">
            setTimeout("location.href='index.php'", 1000);
        </script>
        <?php
    }
    $db = mysqli_connect("localhost", "root", "", "buchladen");
    $userid = $_SESSION['userid'];
?>
<!DOCTYPE html> 
    <html> 
        <head>
            <title>Buchladen</title>    
            <link rel="stylesheet" href="../style.css" type="text/css"></link>
            <style>
                a {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    padding-right: 12px;
                    color: black;
                }
            </style>  
        </head> 
        <body>
        <p><a href="../logout.php">Logout</a> <a href="ansicht.php">zurück zur Übersicht</a></p>
        <h1>Bücher hochladen</h1>
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
        <div class="container">
            <label for="isbn10"><b>ISBN10</b></label>
            <input type="text" size="40" maxlength="10" name="isbn10" required>
            <label for="isbn13"><b>ISBN13</b></label>
            <input type="text" size="40" maxlength="13" name="isbn13" required>
            <label for="titel"><b>Titel</b></label>
            <input type="text" size="40" maxlength="50" name="titel" required>
            <label for="autor"><b>Autor</b></label>
            <input type="text" size="40" maxlength="50" name="autor" required>
            <input type="file" name="datei" id="datei" required/>
            <button type="submit">Abschicken</button>
        </div>
        </form>
    </body>
</html>