$(document).ready(function (){
    $.ajax({
        url:"models/svetabele.php",
        method:"GET",
        dataType:"json",
        success:function (data){
            prikazoption(data['narukvica'],"narukvica")
            prikazoption(data['mehanizam'],'mehanizam')
            prikazoption(data['pol'],'pol')
            prikazoption(data['precnik'],'precnik')
            prikazoption(data['vrsta'],'vrsta')
        }


    })//svi tabele



})
function prikazoption(data,id){
    let ispis="";
    for(d of data){
        ispis+=`<option value=${d['id']}>${d['naziv']}</option>`
    }
    document.getElementById(id).innerHTML=ispis;
}