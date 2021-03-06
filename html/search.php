<html>
        <head>
                <head>
                        <title>Suchen</title>
                
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
                
                        <link href="../css/default.css" rel="stylesheet" type="text/css" />
                        <link href="../css/default_bis768.css" rel="stylesheet" type="text/css" media="screen"/>
                        <link href="../css/default_bis360.css" rel="stylesheet" type="text/css" media="screen" />
                    </head>
        </head>
        <body>
            <div id="header">
                <div id="search">
                    <form action="change.php" method="post">
                        <input type="text" name="suchen_all" class="dec-text">
                        <button class="dec-button" type="submit">Suchen</button>
                    </form>
                </div>               
                <div id="nav" class="right">           
                    <ul id="menu_hide_show" class="menu_hidden">
                        <div id="nav_inner">
                            <li onclick="aufrufIndex();">Startseite</li>
                            <li onclick="aufrufMonth();">Zum Kalendar</li>
                            <li onclick="aufrufSearch();">Suchen</li>
                            <li onclick="aufrufInsert();">Neuer Termin</li>
                        </div>
                    </ul>
                    <img src="../bilder/menu.svg" id="pic_menu" onclick="showMenu()">        
                </div>
            </div>
            
            <div id="content">
                <div id="content_head">
    
                </div>
                <div id="content_data">
                    <div id="search_day" class="center">
                        <h3 class="termin">Geben Sie Suchanfragen ein</h3>
                        <form method="post" action="change.php">
                            <label>Datum </br><input type="date" name="datum" /></label> </br>
                            <label>Terminname </br><input type="text" name="terminname"/></label> </br>
                            <label>Uhrzeit </br><input type="datetime" name="uhrzeit" /></label> </br>
                            <label>Notizen </br><textarea name="beschr"></textarea></label> </br>
                            <button type="submit">Suchen</button>
                        </form>
                    </div>
                </div>
            </div>
    
            <div id="footer">
    
    
            </div>
            <script src="../script/menu.js"></script>
            <script src="../script/start_sript.js"></script>
            <script src="../script/requests.js"></script>
        </body>
</html>