const table = document.getElementsByClassName("orariTable");

for(let j=0;j<table.length;j++){
    for(let i=2;i<14;i++){
    table[j].rows[i].cells[0].innerText = i+6 + ":00";
    }
}
