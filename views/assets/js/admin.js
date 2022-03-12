$(document).ready(function (){
    $.ajax({
        url:"models/adminmodul.php",
        method:"GET",
        dataType:"json",
        success:function (data){
            //console.log(data)
            prikazkorisnika(data['korisnici'],"korisnici")
        }
    })//ajaks korisnici
    $.ajax({
        url:"models/adminmodul.php",
        method:"GET",
        dataType:"json",
        success:function (data){
            console.log(data)
            prikazproizvoda(data['proizvodi'],"proizvodi")
        }
    })//svi proizvodi
    $.ajax({
        url:"models/adminmodul.php",
        method:"GET",
        dataType:"json",
        success:function (data){
            prikazorder(data['order'],"order")
        }
    })//svi order
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
    $.ajax({
        url:"models/logfajl.php",
        method:"GET",
        dataType:"json",
        success:function (data){
            prikazfajla(data,'prikaz')
        }


    })//svi tabele


})//kraj dokumenta
function prikazkorisnika(data,id){

    let ispis=""
    let br=1;
    for(d of data){
        ispis+=`<tr>
            <td>${br}</td>
            <td>${d['ime']}</td>
            <td>${d['prezime']}</td>
            <td>${d['email']}</td>
            <td><a href="models/obrisikorisnika.php?id=${d['idkorisnik']}" >Obrisi korisnika</a> </td>
        </tr>`
        br++;
    }

    document.getElementById(id).innerHTML=ispis
}
function prikazproizvoda(data,id){

    let ispis=""
    let br=1;
    for(d of data){
        ispis+=`<tr>
            <td>${br}</td>
            <td><img src="views/assets/img/${d['manjaslika']}" class="img-circle" style="width: 100%;height: 50px;" alt="slika"/></td>
            <td>${d['naziv']}</td>
            <td>${d['cena']} din</td>
            <td><a href="index.php?page=izmeni&id=${d['idartikl']}" >Izmeni proizvod</a> </td>
            <td><a href="models/obrisiproizvod.php?id=${d['idartikl']}" >Obrisi proizvod</a> </td>
        </tr>`
        br++;
    }

    document.getElementById(id).innerHTML=ispis
}
function prikazorder(data,id){

    let ispis=""
    let br=1;
    for(d of data){
        ispis+=`<tr>
            <td>${br}</td>
            <td><img src="views/assets/img/${d['manjaslika']}" class="img-circle" style="width: 100%;height: 50px;" alt="slika"/></td>
            <td>${d['naziv']}</td>
            <td>${d['ime']}</td>
            <td>${d['prezime']}</td>
            <td>${d['adresa']}</td>
            <td>${d['brojtelefona']}</td>
            <td>${d['datumnarudzvine']}</td>
            <td>${d['email']}</td>
            <td>${d['cena']} din</td>
            <td><a href="#" >Obrisi porudzbinu</a> </td>
            
            
        </tr>`
        br++;
    }

    document.getElementById(id).innerHTML=ispis
}
function prikazoption(data,id){
    let ispis="";
    for(d of data){
        ispis+=`<option value=${d['id']}>${d['naziv']}</option>`
    }
    document.getElementById(id).innerHTML=ispis;
}
function prikazfajla(data,id){
    let ispis="";
    ispis+=`<tr>
                <td>${data['pocetna']}</td>
                <td>${data['prodavnica']}</td>
                <td>${data['register']}</td>
                <td>${data['admin']}</td>
            
            </tr>
`
    document.getElementById(id).innerHTML=ispis

}