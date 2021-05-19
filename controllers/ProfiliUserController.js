const ndryshoFjalekalim = document.getElementById("ndrysho_fjalekalim_btn");

const ndryshoFjalekalimForm = document.getElementById("ndrysho_fjalekalim_form");

ndryshoFjalekalim.onclick = function() {
    shfaqForme();
}

function shfaqForme() {

        if(ndryshoFjalekalimForm.style.display == "none"){
            reset();
            ndryshoFjalekalimForm.style.removeProperty("display");
            ndryshoFjalekalim.classList.add("active_btn");
        }else{
            ndryshoFjalekalimForm.style.display = "none";
            ndryshoFjalekalim.classList.remove("active_btn");
        }
   
}

function reset(){
    ndryshoFjalekalimForm.style.display = "none";
    ndryshoFjalekalim.classList.remove("active_btn");;
}
window.addEventListener("load", reset(), false );