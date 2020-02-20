<?php
	session_start();
	if(!isset($_SESSION['userid'])) {
		die('Bitte loggen Sie sich zuerst ein. <a href="index.php">Zum Login</a>.');
		?>
		<script language="JavaScript" type="text/javascript">
			setTimeout("location.href='index.php'", 1000);
		</script>
		<?php
	}
	$db = mysqli_connect("localhost", "root", "", "buchladen");
	$isbn = $_GET['isbn'];
	$lesezeichen = $_GET['lesezeichen'];

	$statement = "SELECT titel, verzeichnispfad FROM buecher b WHERE isbn13 = '$isbn'";
	$result = mysqli_query($db, $statement);
	$eintrag = mysqli_fetch_assoc($result);
	$titel = $eintrag["titel"];
	$url = "buecher/" . $eintrag["verzeichnispfad"];

	$files = scandir($url);
	$anzahlSeiten = count($files) - 2;
?>

<html lang="de">
	<head>
		<title>Buchladen</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="turnjs4/extras/jquery.min.1.7.js"></script>
		<script type="text/javascript" src="turnjs4/extras/modernizr.2.5.3.min.js"></script>
		<link rel="stylesheet" href="tabelle.css" type="text/css"></link>  
		<style>
            a, p {
                padding-top: 12px;
                padding-bottom: 12px;
				padding-right: 12px;
				padding-left: 12px;
                color: black;
            }
        </style>
	</head>
	<body>
	<p><a href="logout.php">Logout</a> <a href="kunde/buchhandlung.php">Zurück zur Buchauswahl</a></p>
		<!-- Header -->
		<div>
			<?php echo "<h1>" . $titel . "</h1>" ?>
		</div>
		<div class="flipbook-viewport">
			<div class="container">
				<div class="flipbook">
				<?php
					$seite = 1;
					while ($seite <= $anzahlSeiten) {
						echo "<div id=\"" . $seite . "\" style=\"background-image:url(" . $url . $seite . ".jpg)\"></div>";
						$seite = $seite + 1;
					}
				?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function loadApp() {
				$('.flipbook').turn({
						width:922,
						height:600,
						elevation: 50,
						gradients: true,
						autoCenter: true
				});
			}

			yepnope({
				test : Modernizr.csstransforms,
				yep: ['turnjs4/lib/turn.js'],
				nope: ['turnjs4/lib/turn.html4.min.js'],
				both: ['turnjs4/samples/basic/css/basic.css'],
				complete: loadApp
			});
		</script>
	</body>
</html>