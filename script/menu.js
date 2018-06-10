function showMenu(){
    var elem_menu=document.getElementById("menu_hide_show");
    if(elem_menu.className=="menu_hidden"){
        elem_menu.className="menu_show";
    }
    else{
        elem_menu.className="menu_hidden";
    }
}