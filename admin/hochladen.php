<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "buchladen");
?>
<!DOCTYPE html> 
    <html> 
        <head>
            <title>Buchladen</title>    
        </head> 
        <body>
<?php

if(isset($_POST['isbn10'])) {
    $isbn10 = $_POST['isbn10'];
    $isbn13 = $_POST['isbn13'];
    $titel = $_POST['titel'];
    $autor = $_POST['autor'];
    $datei = $_FILES['datei']['name'];

    move_uploaded_file($_FILES['datei']['tmp_name'], 'tmp_files'.$datei);

    exec("gswin32c -dNOPAUSE -sDEVICE=jpeg -r144 -sOutputFile=%d.jpg tmp_files/" . $datei);
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