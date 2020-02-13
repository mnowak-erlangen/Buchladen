<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<html lang="de">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
        <!-- turnjs-->
		<script type="text/javascript" src="turnjs4/extras/jquery.min.1.7.js"></script>
		<script type="text/javascript" src="turnjs4/extras/modernizr.2.5.3.min.js"></script>

		<title>Buchladen</title>
	</head>
	<body>
		<!-- Header -->
		<div>
			<h2 class="card-title" style="text-align: center; color: black">Buchladen</h2>
		</div>
        
    <div class="flipbook-viewport">
        <div class="container">
            <div class="flipbook">
                <div style="background-image:url(turnjs4/samples/basic/pages/1.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/2.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/3.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/4.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/5.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/6.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/7.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/8.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/9.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/10.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/11.jpg)"></div>
                <div style="background-image:url(turnjs4/samples/basic/pages/12.jpg)"></div>
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