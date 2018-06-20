<?php
    include "classes1.inc.php";

    function del_update_insert_appointment(){
        $connection=mysqli_connect("", "root");
        mysqli_select_db($connection, "kalendar_elina");

        if(isset($_POST["delupdate"]) && $_POST["delupdate"]=="delete"){
            $sqlanfrage="select * from termine where id='".$_POST["id"]."'";
            $result=mysqli_query($connection, $sqlanfrage);
            $datensatz=mysqli_fetch_assoc($result);
            $tempMyDay=new MyDay($datensatz["id"], $datensatz["datum"], $datensatz["uhrzeit"],$datensatz["titel"], $datensatz["beschr"]);
            $tempDatumArr=explode(".", $tempMyDay->getDatum());
            $url="../html/output.php?monat=".$tempDatumArr[1]."&jahr=".$tempDatumArr[2]."&tag=".$tempDatumArr[0];
            $sqlanfrage="delete from termine where id='".$_POST["id"]."'";
            mysqli_query($connection, $sqlanfrage);
            $num=mysqli_affected_rows($connection);
            if($num>0){
                header("Location: ".$url);
                exit;
            }
        }
        else if(isset($_POST["delupdate"]) && $_POST["delupdate"]=="update"){
            $sqlanfrage="select * from termine where id='".$_POST["id"]."'";
            $result=mysqli_query($connection, $sqlanfrage);
            $datensatz=mysqli_fetch_assoc($result);
            $tempMyDay=new MyDay($datensatz["id"], $datensatz["datum"], $datensatz["uhrzeit"],$datensatz["titel"], $datensatz["beschr"]);
            $tempDatumArr=explode(".", $tempMyDay->getDatum());
            $url="../html/output.php?monat=".$tempDatumArr[1]."&jahr=".$tempDatumArr[2]."&tag=".$tempDatumArr[0];

            $sqlanfrage="update termine set datum='".$_POST["datum"]."',uhrzeit='".$_POST["uhrzeit"]."',titel='".$_POST["terminname"]."', beschr='".$_POST["beschr"]."' where id='".$_POST["id"]."'";

            mysqli_query($connection, $sqlanfrage);
            $num=mysqli_affected_rows($connection);
            if($num>0){
                header("Location: ".$url);
                exit;
            }
        }
        else if(isset($_POST["id"]) && $_POST["id"]=="0"){     
            $tempMyDay=new MyDay(0, $_POST["datum"], $_POST["uhrzeit"],$_POST["terminname"], $_POST["beschr"]);
            $tempDatumArr=explode(".", $tempMyDay->getDatum());
            $url="../html/output.php?monat=".$tempDatumArr[1]."&jahr=".$tempDatumArr[2]."&tag=".$tempDatumArr[0];
            $sqlanfrage="insert into termine (datum, titel, uhrzeit, beschr) values('".$_POST["datum"]."','".$_POST["terminname"]."','".$_POST["uhrzeit"]."','".$_POST["beschr"]."')";
            mysqli_query($connection, $sqlanfrage);
            $num=mysqli_affected_rows($connection);
            if($num>0){
                header("Location: ".$url);
                mysqli_close($connection);
                exit;
            }
            mysqli_close($connection);
        } 
    }
    
    function search(){
        if(isset($_GET["id"])){

            $connection=mysqli_connect("", "root");
            mysqli_select_db($connection, "kalendar_elina");
            $sqlanfrag="select * from termine where id='".$_GET["id"]."'";
            $result=mysqli_query($connection, $sqlanfrag);
            $anzahl=mysqli_num_rows($result);
            while($datensatz=mysqli_fetch_assoc($result)){
                echo "<form method='post' action='../php/aufrufe.php' onsubmit='return check(event);'>";
                echo "<label>Datum </br><input type='date' name='datum' value='".$datensatz["datum"]."'/></label> </br>";
                echo "<label>Terminname</br><input type='text' name='terminname' value='".$datensatz["titel"]."'/></label> </br>";
                $tempStringArray=explode(":", $datensatz["uhrzeit"]);
                $uhrzeitPrep=mktime(intval($tempStringArray[0]), intval($tempStringArray[1]),0,0,0,0);
                $uhrzeit=strftime("%H:%M", $uhrzeitPrep);
                echo "<label>Uhrzeit</br><input name='uhrzeit' type='datetime' value='".$uhrzeit."'/></label> </br>";
                echo "<label>Notizen </br><textarea name='beschr'>".$datensatz["beschr"]." </textarea></label> </br>";
                echo "<input type='hidden' name='id' value='".$datensatz["id"]."' />";
                echo "<input type='hidden' name='delupdate' id='delupdate'/>";
                echo "<div id='action_buttons'>";
                echo "<button type='submit' onclick='aufruf_UpdateInsert(event);'>Speichern</button>";
                echo "<button type='submit' onclick='aufruf_Del(event);'>Termin löschen</button>";
                echo "</div>";
                echo "</form>";
            }
            mysqli_close($connection);
        }
        else if(isset($_POST["datum"]) || isset($_POST["terminname"]) ||isset($_POST["beschr"]) || isset($_POST["uhrzeit"])){
            $alleWerte=array();
            $connection=mysqli_connect("", "root");
            mysqli_select_db($connection, "kalendar_elina");
            $sqlanfrage="select * from termine";
            $result=mysqli_query($connection, $sqlanfrage);
            $anzahl=mysqli_num_rows($result);
            if($anzahl>0){
                while($datensatz=mysqli_fetch_assoc($result)){
                    $tempTermin=new MyDay($datensatz["id"], $datensatz["datum"], $datensatz["uhrzeit"], $datensatz["titel"], $datensatz["beschr"]);
                    array_push($alleWerte, $tempTermin);
                }

                $tempTermin=new MyDay(0,$_POST["datum"], $_POST["uhrzeit"],$_POST["terminname"], $_POST["beschr"]);

                for($i=0; $i<count($alleWerte); $i++){
                    if($alleWerte[$i]->vergleich2($tempTermin)){
                        echo "<form method='post' action='../php/aufrufe.php' onsubmit=' return check(event);'>";
                        echo "<label>Datum </br><input type='date' name='datum' value='".$alleWerte[$i]->getSQLDatum()."'/></label> </br>";
                        echo "<label>Terminname</br><input type='text' name='terminname' value='".$alleWerte[$i]->getTitel()."'/></label> </br>";
                        echo "<label>Uhrzeit</br><input name='uhrzeit' type='datetime'  value='".$alleWerte[$i]->getUhrzeit()."'/></label> </br>";
                        echo "<label>Notizen </br><textarea name='beschr' >".$alleWerte[$i]->getBeschr()." </textarea></label> </br>";
                        echo "<input type='hidden' name='id' value='".$alleWerte[$i]->getId()."' />";
                        echo "<input type='hidden' name='delupdate'/>";
                        echo "<div id='action_buttons'>";
                        echo "<button type='submit' onclick='aufruf_UpdateInsert(event);'>Speichern</button>";
                        echo "<button type='submit' onclick='aufruf_Del(event);'>Termin löschen</button>";
                        echo "</div>";
                        echo "</form>";
                    }
                }
            }
            mysqli_close($connection);
        }
        else if(isset($_POST["suchen_all"])){
            $alleWerte=array();
            $connection=mysqli_connect("", "root");
            mysqli_select_db($connection, "kalendar_elina");
            $sqlanfrage="select * from termine";
            $result=mysqli_query($connection, $sqlanfrage);
            $anzahl=mysqli_num_rows($result);
            if($anzahl>0){
                while($datensatz=mysqli_fetch_assoc($result)){
                    $tempTermin=new MyDay($datensatz["id"], $datensatz["datum"], $datensatz["uhrzeit"], $datensatz["titel"], $datensatz["beschr"]);
                    array_push($alleWerte, $tempTermin);
                }

                $tempTermin=new MyDay(0,$_POST["suchen_all"], $_POST["suchen_all"],$_POST["suchen_all"], $_POST["suchen_all"]);

                for($i=0; $i<count($alleWerte); $i++){
                    if($alleWerte[$i]->vergleich3($tempTermin)){
                        echo "<form method='post' action='../php/aufrufe.php' onsubmit=' return check(event);'>";
                        echo "<label>Datum </br><input type='date' name='datum' value='".$alleWerte[$i]->getSQLDatum()."'/></label> </br>";
                        echo "<label>Terminname</br><input type='text' name='terminname' value='".$alleWerte[$i]->getTitel()."'/></label> </br>";
                        echo "<label>Uhrzeit</br><input name='uhrzeit' type='datetime'  value='".$alleWerte[$i]->getUhrzeit()."'/></label> </br>";
                        echo "<label>Notizen </br><textarea name='beschr' >".$alleWerte[$i]->getBeschr()." </textarea></label> </br>";
                        echo "<input type='hidden' name='id' value='".$alleWerte[$i]->getId()."' />";
                        echo "<input type='hidden' name='delupdate' />";
                        echo "<div id='action_buttons'>";
                        echo "<button type='submit' onclick='aufruf_UpdateInsert(event);'>Speichern</button>";
                        echo "<button type='submit' onclick='aufruf_Del(event);'>Termin löschen</button>";
                        echo "</div>";
                        echo "</form>";
                    }
                }
            }
            mysqli_close($connection);
        }
        else if(isset($_GET["monat"]) && isset($_GET["jahr"]) &&isset($_GET["uhrzeit"])){
            $datumprep=mktime(0,0,0,intval($_GET["monat"]),intval($_GET["tag"]), intval($_GET["jahr"]));
            $datum=date("Y-m-d", $datumprep);
            echo "<form method='post' action='../php/aufrufe.php' onsubmit=' return check(event);'>";
            echo "<label>Datum </br><input type='date' name='datum' value='".$datum."'/></label> </br>";
             echo "<label>Terminname</br><input type='text' name='terminname' /></label> </br>";
            echo "<label>Uhrzeit</br><input name='uhrzeit' type='datetime' value='".$_GET["uhrzeit"]."' /></label> </br>";
            echo "<label>Notizen </br><textarea name='beschr' ></textarea></label> </br>";
            echo "<input type='hidden' name='id' value='0' />";
            echo "<input type='hidden' name='insert'/>";
            echo "<div id='action_buttons'>";
            echo "<button type='submit' onclick='aufruf_UpdateInsert(event);'>Speichern</button>";
            echo "<button type='submit' onclick='aufruf_Del(event);'>Termin löschen</button>";
            echo "</div>";
            echo "</form>";
        }
        else{
            echo "<form method='post' action='../php/aufrufe.php' onsubmit=' return check(event);'>";
            echo "<label>Datum </br><input type='date' name='datum'/></label> </br>";
             echo "<label>Terminname</br><input type='text' name='terminname' /></label> </br>";
            echo "<label>Uhrzeit</br><input name='uhrzeit' type='datetime' /></label> </br>";
            echo "<label>Notizen </br><textarea name='beschr' ></textarea></label> </br>";
            echo "<input type='hidden' name='id' value='0' />";
            echo "<input type='hidden' name='insert'/>";
            echo "<div id='action_buttons'>";
            echo "<button type='submit' onclick='aufruf_UpdateInsert(event);'>Speichern</button>";
            echo "<button type='submit' onclick='aufruf_Del(event);'>Termin löschen</button>";
            echo "</div>";
            echo "</form>";
        }   
    }

    function show_day(){
        if(isset($_GET["monat"]) && isset($_GET["jahr"]) && isset($_GET["tag"])){
            $tag=$_GET["tag"];
            $monat=$_GET["monat"];
            $jahr=$_GET["jahr"];
            $tempDAtumprep=mktime(0,0,0,$monat,$tag,$jahr);
            $tempDatum=date("Y-m-d", $tempDAtumprep);
            
            $connection=mysqli_connect("", "root");
            mysqli_select_db($connection, "kalendar_elina");

            echo "<table id='appointments' style='border: 1px solid black'>";
            echo "<tr>";
            echo "<th class='appointment_row uhrzeit'>Uhrzeit</th>";
            echo "<th class='appointment_row terminname'>Terminname</th>";
            echo "<th class='appointment_row notizen'>Notizen</th>";
            echo "</tr>";

            for($i=0; $i<24; $i++){
                $tempTimeStart=$i.":00:00";
                $tempTimeEnde=($i+1).":00:00";
                $tempTimeStart2;
                if($i<=9){
                    $tempTimeStart2="0".$i.":%";
                }
                else{
                    $tempTimeStart2=$i.":%";
                }
                $sqlanfrage="select * from termine where datum='".$tempDatum."' and uhrzeit like '".$tempTimeStart2."'";
                //SELECT * FROM `termine` WHERE datum like '2018-06-20' and uhrzeit like '07:%';
                $result=mysqli_query($connection, $sqlanfrage);
                $anzahl=mysqli_num_rows($result);

                $tempTimeAusgabe;
                if($i<=9){
                    $tempTimeAusgabe="0".$i.":00";
                }
                else{
                    $tempTimeAusgabe=$i.":00";
                }
                if($anzahl!=0){
                    while($datensatz=mysqli_fetch_assoc($result)){
                        echo "<tr class='trefferTag eintrag'>";
                        echo "<td class='appointment_row uhrzeit'>".$tempTimeAusgabe."</td>";
                        echo "<td class='appointment_row terminname'>".$datensatz["titel"]."</td>";
                        echo "<td class='appointment_row notizen'>".$datensatz["beschr"]."</td>";
                        echo "<td class='appointment row_hidden' hidden>".$datensatz["id"]."</td>";
                        echo "</tr>";
                    }                   
                } 
                else{
                    echo "<tr class='eintrag'>";
                    echo "<td class='appointment_row uhrzeit'>".$tempTimeAusgabe."</td>";
                    echo "<td class='appointment_row terminname'>&nbsp;</td>";
                    echo "<td class='appointment_row notizen'>&nbsp;</td>";
                    echo "</tr>";
                }  
            }
            mysqli_close($connection);
            echo "</table>";
        }

    }

    function show_month1(){
        $monate=array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");

        $monat=intval($_GET["monat"]);
        $jahr=intval($_GET["jahr"]);

        $datumprep=mktime(0,0,0,$monat,1,$jahr);
        $monatIndex=intval(date("m", $datumprep));
        echo "<span id='month_text'>".$monate[$monatIndex-1]."</span>";
        echo "<span id='year_text' hidden>".$_GET["jahr"]."</span>";

    }

    function show_month2(){
        $weekDays=array("Mo","Di", "Mi", "Do", "Fr", "Sa", "So");
        if(isset($_GET["monat"])&&isset($_GET["monat"])){
            $monatbegin=intval($_GET["monat"]);
            $jahrbegin=intval($_GET["jahr"]);
            $tagbegin=1;

            $connection=mysqli_connect("", "root");
            mysqli_select_db($connection, "kalendar_elina");
            
            echo "<table id='month_tab'>";
            echo "<tr id='tab_heading'>";
            echo "<th class='month_row'><span class='date_weekday'>Mo</span></th>" ;
            echo "<th class='month_row'><span class='date_weekday'>Di</span></th>";
            echo "<th class='month_row'><span class='date_weekday'>Mi</span></th>";
            echo "<th class='month_row'><span class='date_weekday'>Do</span></th>";
            echo "<th class='month_row'><span class='date_weekday'>Fr</span></th>";
            echo "<th class='month_row'><span class='date_weekday'>So</span></th>";
            echo "<th class='month_row'><span class='date_weekday'>So</span></th>";
            echo "</tr>";
            
            $datumprep=mktime(0,0,0,$monatbegin,$tagbegin,$jahrbegin);
            $datum=date("Y-m-d", $datumprep);
            $tageImMonat=date("t",$datumprep);
            $tag=intval(date("w", $datumprep));
            if($tag==0){
                $tag=7;
            }
            
            if($tag>0){
                $tag=-$tag+2;
            }
            $tag7=1;

            while($tag<=$tageImMonat){
                if($tag7==1){
                    echo "<tr id='tab_week'>";
                }
                if($tag<1){
                    while($tag<1){
                        $tempString=($tag-1)." day";
                        $monatVor=strtotime($tempString, $datumprep);
                        $tempAus=date("d",$monatVor);
                        echo "<td class='month_row'><span class='date_button disableK'>".$tempAus."</span></td>";
                        $tag7++;
                        $tag++;
                    }
                }

                $datumprep=mktime(0,0,0,$monatbegin,$tag, $jahrbegin);
                $datum=date("Y-m-d", $datumprep);
                //$tag=intval(date("w", $datum));

                $sqlanfrag="select * from termine where datum='".$datum."'";
                $result=mysqli_query($connection, $sqlanfrag);
                $anzahl=mysqli_num_rows($result);
                if($anzahl!=0){
                    //echo "Anzahl ".$anzahl;
                    $datensatz=mysqli_fetch_assoc($result);
                    echo "<td class='month_row'><span class='date_button activeK treffer'>".$tag."</span></td>";
                }
                else{
                    echo "<td class='month_row'><span class='date_button activeK'>".$tag."</span></td>";
                }



                if($tag7==7){
                    echo "</tr>";
                    $tag7=0;
                }
                $tag++;
                $tag7++;
                
            }
            if($tag7!=1){
                $tag=1;
                while($tag7!=1){
                    echo "<td class='month_row'><span class='date_button disableK'>".$tag."</span></td>";
                    if($tag7==7){
                        $tag7=0;
                    }
                    $tag7++;
                    $tag++;
                }
            }
            echo "</table>";
            mysqli_close($connection);
        }
    }

?>
