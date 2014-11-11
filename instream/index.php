<!DOCTYPE HTML5>
<html>
<head>
	<title>InStream</title>
	<meta charset="utf-5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/lightbox.min.js"></script>
	<script src="js/app.js" type="text/javascript"></script>
	<script src="components/webcomponentsjs/webcomponents.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="import" href="imports.html">
</head>
<body>
    <core-header-panel mode = "seamed">
        <core-toolbar class = "mainHeader">
            <span flex id = "logo">InStream</span>
            <paper-icon-button raised icon="refresh" onclick="updatepage()"></paper-icon-button>
            <paper-input id = "search" label = "Enter a search tag" value = "instadaily"></paper-input>
        </core-toolbar>

        <div id = "beaker" class = "tbCenter">
            <!-- <section id="sform">
                <input type="text" id="search" name="search" class="searchField form-control" placeholder="Enter a search tag">
            </section> -->
            <div id="container" class="js-masonry container-fluid tbCenter">
            </div>
            <div id = "toast">
                <paper-toast id = "toast1" text = "Fetching results"></paper-toast>
                <paper-toast id = "toast2" text = "Please type something to search"></paper-toast>
            </div>
        </div>
    </core-header-panel>
</body>
</html>
