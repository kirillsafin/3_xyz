function showMenu(){
    var elem_menu=document.getElementsByClassName("menu_hidden");
    alert("Klassenname: "+elem_menu.className);
    if(elem_menu.className=="menu_hidden"){
        elem_menu.className="menu_show";
    }
    else{
        elem_menu.className="menu_hidden";
    }
    alert("Klassenname: "+elem_menu.className);
}