<?php
    include "classes1.inc.php";

    function change_appointment(){
        

    }

    function delete_appointment(){

    }

    function presearch(){

    }

    function search_all(){

    }
    
    function search(){

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
                       
                        echo "<td class='appointment_row uhrzeit'>".$tempTimeAusgabe."</td>";
                        echo "<td class='appointment_row terminname'>".$datensatz["titel"]."</td>";
                        echo "<td class='appointment_row notizen'>".$datensatz["beschr"]."</td>";
                        echo "</tr>";
                    }                   
                } 
                else{
                    echo "<tr>";
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

    //Tests:
    //echo "<link href='../css/default.css' rel='stylesheet type='text/css' />";
    //echo "<link href='../css/default_bis768.css' rel='stylesheet' type='text/css' media='screen'/>";
    //echo "<link href='../css/default_bis360.css' rel='stylesheet' type='text/css' media='screen' />";
    //show_day();
?>
