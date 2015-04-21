
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">
<!--    <link rel="stylesheet" href="./css/style.css">-->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
<!--    <script src="./js/script.js"></script>-->
</head>
<body>

<div data-role="page" id="content">

    <div data-role="header">
        <a href="#myPanel" class="ui-btn ui-btn-left ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Menu</a>
        <h1><?=$this->pageTitle;?></h1>
    </div>

    <div data-role="main" class="ui-content">
        <h1>internal page</h1>
    </div>

    <div data-role="panel" id="myPanel" data-display="overlay">
        <ul data-role="listview">
            <li><a href="http://188.226.210.182/about.html">Register car</a></li>
            <li><a href="http://188.226.210.182/contacts.html">Register trip</a></li>
            <li><a href="#">Basic data</a></li>
        </ul>
    </div>
</div>

</body>
</html>