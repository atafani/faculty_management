const ndryshoFjalekalim = document.getElementById("ndrysho_fjalekalim_btn");
const shtoAdmin = document.getElementById("shto_admin_btn");
const ndryshoAdmin = document.getElementById("ndrysho_admin_btn");

const ndryshoFjalekalimForm = document.getElementById("ndrysho_fjalekalim_form");
const shtoAdminForm = document.getElementById("shto_admin_form");
const ndryshoAdminForm = document.getElementById("ndrysho_admin_form");

ndryshoAdmin.onclick = function(e){
    shfaqForme(e);
}
ndryshoFjalekalim.onclick = function(e) {
    shfaqForme(e);
}

shtoAdmin.onclick = function(e) {
    shfaqForme(e);
}

function shfaqForme(e) {
    if(e.target == ndryshoFjalekalim){
        if(ndryshoFjalekalimForm.style.display == "none"){
            reset();
            ndryshoFjalekalimForm.style.removeProperty("display");
            ndryshoFjalekalim.classList.add("active_btn");
        }else{
            ndryshoFjalekalimForm.style.display = "none";
            ndryshoFjalekalim.classList.remove("active_btn");
        }
       
    }else if(e.target == shtoAdmin){
        if(shtoAdminForm.style.display == "none"){
            reset();
            shtoAdminForm.style.removeProperty("display");
            shtoAdmin.classList.add("active_btn");
        }else{
            shtoAdminForm.style.display = "none";
            shtoAdmin.classList.remove("active_btn");
        }
    }else{
        if(ndryshoAdminForm.style.display == "none"){
            reset();
            ndryshoAdminForm.style.removeProperty("display");
            ndryshoAdmin.classList.add("active_btn");
        }else{
            ndryshoAdminForm.style.display = "none";
            ndryshoAdmin.classList.remove("active_btn");
        }
    }
}
function reset(){
    ndryshoFjalekalimForm.style.display = "none";
    shtoAdminForm.style.display = "none";
    ndryshoAdminForm.style.display = "none";
    ndryshoFjalekalim.classList.remove("active_btn");
    shtoAdmin.classList.remove("active_btn");
    ndryshoAdmin.classList.remove("active_btn");
}
window.addEventListener("load", reset(), false );