<?php
session_start();
session_destroy();
 
echo "Logout erfolgreich";
?>
<script language="JavaScript" type="text/javascript">
    setTimeout("location.href='index.php'", 1000);
</script>