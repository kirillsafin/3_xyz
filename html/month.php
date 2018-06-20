<html>
    <head>
            <head>
                    <title>Monat</title>
            
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
            
              
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
            <?php 
                include "../php/functions1.inc.php";
            ?>
            <div id="content_head">
                <p id="header_month"><span id="button_back" onclick="aufrufLastMonth();">&#10094;</span><?php show_month1(); ?><span id="button_forw" onclick="aufrufNextMonth();">&#10095;</span></p>
            </div>
            <div id="content_data">
                <div id="month_table">
                    <?php
                        show_month2();    
                    ?>
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