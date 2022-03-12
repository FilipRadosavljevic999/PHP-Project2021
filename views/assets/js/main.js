$(document).ready(function(){
    $.ajax
    ({
        url: "models/pocetnaproizvodi.php",
        method: "post",
        datatype:'json',
        success: function (data){
            //console.log(data)
            prikazproizvoda(data)
        },
        error: function(xhr){
            console.error(xhr);
            // if 500...
            // if 404...
        }
    });//kraj ajaxa svi proizvodi






})//kraj dokumenta
function prikazproizvoda(data)
{

    let ispis="";
    if(data==null){
        ispis=`<h1>Nema trenutno porizvoda sa tim kritterijumom</h1>`
    }
    else {
        for (d of data)
        {
            ispis+=
                `<li className="span4">
                <div className="product-box">
                    <span className="sale_tag"></span>
                    <a href="index.php?id=${d['idartikl']}&page=proizvodjedan">
                        <div class="">
                            <img  style="height: 200px; " 
                            alt="slika" class="thumbnail"  src="views/assets/img/${d['manjaslika']}">
                        </div>
                    </a>
                    
                    <br/>
                    <a href="index.php?id=${d['idartikl']}&page=proizvodjedan" className="title" ><p class="text-center">${d['naziv']}</a></p><br/>
                    <p className="price" class="text-center ">${d['cena']} EUR</p>
                </div>
            </li>`
        }
    }


    document.getElementById('proizvodi').innerHTML=ispis;
}