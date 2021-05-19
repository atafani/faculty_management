const menu_icon = document.getElementById("menu_icon");

menu_icon.onclick = function() {
    const navbar = document.getElementById("navbar");
    const logoutBtn = document.getElementById("logout_btn");
    
    if( navbar.style.display == "block"){
        navbar.style.display = "none";
        logoutBtn.style.display = "none";
        menu_icon.classList.remove("menu_clicked");
      
    }else{
        navbar.style.display = "block";
        logoutBtn.style.display = "block";
        menu_icon.classList.add("menu_clicked");
    }
   
}


