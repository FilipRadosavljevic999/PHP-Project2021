$(document).ready(function (){

    let keyword=document.getElementById("pretraga").value;
    let min=document.getElementById("min").value;
    let max=document.getElementById("max").value;
    let strana=brojstrane();

    $.ajax
    ({
        url: "models/prodavnicamodels.php",
        method: "get",
        datatype: 'json',
        data:{
          keyword:keyword,
          min:min,
          max:max,
          strana:strana
        },
        success: function (data) {
            console.log(data)
            pagincaija(data['brojstrana'])
            prikazproizvoda(data['artikli'])
            $(".klik").click(function (e){
                e.preventDefault();
                let broj = $(this).data("id");
                console.log(broj);
                $.ajax({
                    url: "models/prodavnicamodels.php",
                    method: "get",
                    datatype: 'json',
                    data:{
                        keyword:keyword,
                        min:min,
                        max:max,
                        strana:broj
                    },
                    success:function(data){
                        //console.log(data)

                        prikazproizvoda(data['artikli'])
                    }

                })//kraj ajaks sklika





            })//kraj klik funkcije
        },
        error: function (xhr) {
            console.error(xhr);
            // if 500...
            // if 404...
        }
    });

    $("#filter").click(function (e){
        e.preventDefault();
        let keyword=document.getElementById("pretraga").value;
        let min=document.getElementById("min").value;
        let max=document.getElementById("max").value;
        let strana=brojstrane();
        console.log(keyword)
        $.ajax
        ({
            url: "models/prodavnicamodels.php",
            method: "get",
            datatype: 'json',
            data:{
                keyword:keyword,
                min:min,
                max:max,
                strana:strana
            },
            success: function (data) {
                console.log(data)
                pagincaija(data['brojstrana'])
                prikazproizvoda(data['artikli'])
                $(".klik").click(function (e){
                    e.preventDefault();
                    let broj = $(this).data("id");
                    console.log(broj);
                    $.ajax({
                        url: "models/prodavnicamodels.php",
                        method: "get",
                        datatype: 'json',
                        data:{
                            keyword:keyword,
                            min:min,
                            max:max,
                            strana:broj
                        },
                        success:function(data){
                            //console.log(data)

                            prikazproizvoda(data['artikli'])
                        }

                    })//kraj ajaks sklika





                })//kraj klik funkcije
            },
            error: function (xhr) {
                console.error(xhr);
                // if 500...
                // if 404...
            }
        });








    })//kraj filetra






})//kraj documenta
function prikazproizvoda(data)
{

    let ispis="";
    if(data.length==0){
        ispis=`<li><h3>Nema trenutno porizvoda sa tim kriterijumom</h3></li>`
    }
    else {
        for (d of data)
        {
            ispis+=
                `<li className="span3">
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
                    <p className="price" class="text-center ">${d['cena']} din</p>
                </div>
            </li>`
        }
    }


    document.getElementById('proizvodi').innerHTML=ispis;
}
function pagincaija(data)
{
    let ispisstrana=""
    for(let i=1;i<data+1;i++)
    {
        ispisstrana+=`<li><a href="#" class="klik" data-id=${i}>${i}</a></li>`
    }
    document.getElementById('paginacija').innerHTML=ispisstrana;
}
function brojstrane()
{
    let broj=localStorage.getItem("strana");
    let strana;
    if(broj==null){
        strana=1;
    }
    else {
        strana=localStorage.getItem("strana")
    }
    return strana
}