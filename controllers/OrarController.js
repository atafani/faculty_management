
const table = document.getElementsByClassName("orariTable");

for(let j=0;j<table.length;j++){
    for(let i=2;i<14;i++){
    table[j].rows[i].cells[0].innerText = i+6 + ":00";
    }
}


const dega = document.getElementById("id_dege");
const viti = document.getElementById("viti");
const lenda = document.getElementById("lende_id");
const grup = document.getElementById("id_grup");



dega.onchange = function(){
    vendosLende();
}
viti.onchange = function(){
    vendosLende();
}
lenda.onchange = function(){
    vendosLende();
}
tipi.onchange = function(){
    shfaqgrupe();
}



function vendosLende(){ 
    reset();
    let dega_id = dega.value;
    let showVite = document.getElementsByClassName(dega_id);
    
    for(let i=0;i<showVite.length;i++){                   
        showVite[i].style.removeProperty("display");
    }

    let vit = viti.value;
    let showLende = document.getElementsByClassName("lende"+dega_id+vit);
   
    for(let i=0;i<showLende.length;i++){                   
        showLende[i].style.removeProperty("display");
    }

    let showGrupe = document.getElementsByClassName("grup"+dega_id+vit);
    for(let i=0;i<showGrupe.length;i++){                   
        showGrupe[i].style.removeProperty("display");
    }
    
}


function reset(){
    for(let i=0;i<viti.options.length;i++){
        if(!viti.options[i].classList.contains(dega.value))
            viti.options[i].style.display = "none";
    }
    for(let i=0;i<lenda.options.length;i++){
        if(!lenda.options[i].classList.contains("lende" + dega.value + viti.value))
            lenda.options[i].style.display = "none";
    }
    for(let i=0;i<grup.options.length;i++){
        if(!grup.options[i].classList.contains("grup" + dega.value + viti.value))
            grup.options[i].style.display = "none";
    }
}

window.addEventListener("load",vendosLende(),false);