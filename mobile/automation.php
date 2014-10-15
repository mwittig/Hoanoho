<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="shortcut icon" type="image/x-icon" href="../img/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="../img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Hoanoho">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="msapplication-TileImage" content="../img/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="../img/favicons/browserconfig2.xml">
        <meta name="application-name" content="Hoanoho">

        <script src="./js/ratchet.js"></script>
        <script src="./js/standalone.js"></script>

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Steuerung</title>
    </head>
    <body>
        <header class="bar-title">
            <h1 class="title">Steuerung</h1>
        </header>

        <div class="content">
            <ul class="list">
                <?php
                    $sql = "SELECT * FROM device_floors WHERE position = 0 order by position asc";
                    $result = mysql_query($sql);
                    while ($floor = mysql_fetch_object($result)) {
                        echo "<li class=\"list-divider\">".$floor->name."</li>";
                        $sql2 = "SELECT * FROM devices where floor_id = ".$floor->floor_id." and isHidden != 'on' order by name asc";
                        $result2 = mysql_query($sql2);
                        while ($device = mysql_fetch_object($result2)) {
                            echo "<li><a href=\"device.php?device=".$device->dev_id."\" data-transition=\"slide-in\" data-ignore=\"push\">".$device->name."</a>";
                              echo "<span class=\"chevron\"></span></li>";
                        }
                    }

                    $sql = "SELECT *, (select count(room_id) from rooms where rooms.floor_id = device_floors.floor_id) as roomcount FROM device_floors WHERE position > 0 order by position asc";
                    $result = mysql_query($sql);
                    while ($floor = mysql_fetch_object($result)) {
                        echo "<li class=\"list-divider\">".$floor->name."</li>";
                        $sql2 = "SELECT * FROM rooms where floor_id = ".$floor->floor_id." order by name asc";
                        $result2 = mysql_query($sql2);
                        while ($room = mysql_fetch_object($result2)) {
                            echo "<li><a href=\"room.php?room=".$room->room_id."\" data-transition=\"slide-in\">".$room->name."</a>";
                              echo "<span class=\"chevron\"></span></li>";
                        }
                    }
                ?>
            </ul>
            <br><br><br>
        </div>
        <?php include "includes/nav.php"; ?>
    </body>
</html>
