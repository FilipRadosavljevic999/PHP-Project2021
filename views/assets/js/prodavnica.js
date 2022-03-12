console.log("jjjj")
$(document).ready(function() {
    console.log("sss")
    /*$.ajax
    ({
        url: "models/sviproizvodi.php",
        method: "post",
        datatype: 'json',
        success: function (data) {
            console.log(data)
            prikazproizvoda(data)
        },
        error: function (xhr) {
            console.error(xhr);
            // if 500...
            // if 404...
        }
    });*///kraj ajaxa svi proizvodi
    /*$.ajax
    ({
        url: "models/brojartikla.php",
        method: "post",
        datatype: 'json',
        success: function (data) {
            pagincaija(data)
            $('.klik').click(function (e) {
                e.preventDefault()
                let broj = $(this).data("id");

                localStorage.setItem("strana", broj)
                $.ajax({
                    url: "models/sviproizvodi.php",
                    method: 'get',
                    data: {
                        brojstrane: broj
                    },
                    datatype: 'JSON',
                    success: function (data) {
                        prikazproizvoda(data)
                    }
                })
            })//paginacija dogadjaj
            //$('.klik').click(stranicenje(e));


        },

        error: function (xhr) {
            console.error(xhr);
            // if 500...
            // if 404...
        }
    })*///paginacija

   /* $("#sort").change(function (){
        let selektovan=$(this).val();
        let strana=brojstrane()
        console.log(strana);
        $.ajax({
            url:"models/sortiranje.php",
            method:"get",
            datatype:"json",
            data: {
                selektivani:selektovan,
                strana:strana
            },
            success:function (data){
                prikazproizvoda(data['data'])

            }
        })//sortiranje ajax




    })*///sortiranje

    /*$("#filter").click(function (e){
        e.preventDefault()
        let min=$("#min").val();
        let max=$("#max").val();
        let key=$("#pretraga").val();
        console.log(key)

        if(min==""){
            min=0;
        }
        if(max==""){
            max=30000000000;
        }
        $.ajax({
            url:"models/filtriranje.php",
            method:"post",
            datatype:"json",
            data:{
                key:key,
                min:min,
                max:max,
            },
            success:function (data){
                prikazproizvoda(data)
            }

        })//ajaks filter



    })*///filtriranje
let keyword=document.getElementById("pretraga").value;
let min=document.getElementById("min").value;
let max=document.getElementById("max").value;











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
                `<li className="span3">
                <div className="product-box">
                    <span className="sale_tag"></span>
                    <a href="index.php?id=${d['idartikl']}&page=proizvodjedan">
                        <div class="">
                            <img  style="height: 200px; " 
                            alt="slika" class="thumbnail"  src="assets/img/${d['manjaslika']}">
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
function pagincaija(data)
{
    let ispisstrana=""
    for(let i=1;i<data['broj']+1;i++)
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

