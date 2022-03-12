<?php
if(!isset($_SESSION['korisnik']) && $_SESSION['korisnik']['nazivuloge']!="admin"){
    header('Location:404.php');
}
zabeleziPristupStranici('admin');
?>

<section class="main-content">
    <div class="row">
        <br>
        <div class="span12 center">

         <h3 class="text-left">Korisnici:</h3>
         <div class="block">
             <table class="table table-bordered table-hover  ">
                 <thead>
                 <tr>
                     <td>Rb</td>
                     <td>Ime</td>
                     <td>Prezime</td>
                     <td>Email</td>
                     <td>Obrisi korisnika</td>
                 </tr>
                 </thead>
                 <tbody id="korisnici">

                 </tbody>
             </table>

         </div>

     </div>
        <br>
        <div class="span12 center">

            <h3 class="text-left">Proizvodi:</h3>
            <div class="block">
                <table class="table table-bordered table-hover ">
                    <thead>
                    <tr>
                        <td>Rb</td>
                        <td>Slika</td>
                        <td>Ime</td>
                        <td>Cena</td>
                        <td>Izmeni proizvod</td>
                        <td>Obrisi proizvod</td>
                    </tr>
                    </thead>
                    <tbody id="proizvodi">

                    </tbody>
                </table>

            </div>

        </div>
        <br>
        <div class="span12 center">

            <h3 class="text-left">Porudzbine:</h3>
            <div class="block">
                <table class="table table-bordered table-hover  ">
                    <thead>
                    <tr>
                        <td>Rb</td>
                        <td>Slika artikla</td>
                        <td>Naziv artikla</td>
                        <td>Ime</td>
                        <td>Prezime</td>
                        <td>Adresa</td>
                        <td>Broj Telefona</td>
                        <td>Datum Porudzbine</td>
                        <td>Email</td>
                        <td>Cena</td>
                        <td>Obrisi porudzbinu</td>
                    </tr>
                    </thead>
                    <tbody id="order">

                    </tbody>
                </table>

            </div>

        </div>
        <br>
        <div class="span12 center">

            <h3 class="text-left">Dodaj artikl:</h3>
            <div class="block">
                <form action="models/dodajproizvod.php" method="post" class="form-stacked" enctype="multipart/form-data">
                        <fieldset>
                            <div class="span12">
                                <div class="span4 left">
                                    <div class="control-group left">
                                        <label class="control-label">Izaberi sliku:</label>
                                        <div class="controls">
                                            <input type="file" placeholder="Izaberi sliku" name="slika" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label">Naziv:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Unesi naziv" name="naziv" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label">Kolicina:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Unesi kolicinu" name="kol" class="input-xlarge">
                                        </div>
                                    </div>
                                </div>
                                <div class="span4 center">
                                    <div class="control-group left">
                                        <label class="control-label ">Vodootpornost:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Unesi vodootpornost" name="vod" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label ">Narukvica:</label>
                                        <div class="controls">
                                          <select id="narukvica" name="narukvica">
                                              <option>izaberi narukvicu</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label ">Mehanizam:</label>
                                        <div class="controls">
                                            <select id="mehanizam" name="mehanizam">
                                                <option>izaberi mehanizam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3 right" >
                                    <div class="control-group left">
                                        <label class="control-label ">Pol:</label>
                                        <div class="controls">
                                            <select id="pol" name="pol">
                                                <option>izaberi pol</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label ">Precnik:</label>
                                        <div class="controls">
                                            <select id="precnik" name="precnik">
                                                <option>izaberi precnik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label ">Vrsta:</label>
                                        <div class="controls">
                                            <select id="vrsta" name="vrsta">
                                                <option>izaberi vrstu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group left">
                                        <label class="control-label ">Cena:</label>
                                        <div class="controls">
                                           <input type="text" placeholder="Unesi cenu" name="cena">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group left">
                                <hr>
                                <div class="actions center">
                                    <input tabindex="9" class="btn btn-inverse large" name="dugmeDodaj" type="submit" value="Dodaj proizvod">
                                </div>
                            </div>


                        </fieldset>
                </form>

                <ul>
                    <?php if(isset($_SESSION['uspeloDodaj'])):?>
                    <li><?=$_SESSION['uspeloDodaj']?></li>
                    <?php
                    endif;
                    unset($_SESSION['uspeloDodaj']);
                    ?>
                    <?php if(isset($_SESSION['greskeDodaj'])):
                        foreach ($_SESSION['greskeDodaj'] as $g):?>
                        <li><?=$g?></li>
                    <?php
                    endforeach;
                    endif;
                    unset($_SESSION['greskeDodaj'])
                    ?>


                </ul>


            </div>

        </div>
        <br>
        <div class="span12 center">

            <h3 class="text-left">Pristum stranicama danas:</h3>
            <div class="block">
                <table class="table table-bordered table-hover  ">
                    <thead>
                    <tr>
                        <td>Pocetna</td>
                        <td>Prodavnica</td>
                        <td>Registracija</td>
                        <td>Admin</td>

                    </tr>
                    </thead>
                    <tbody id="prikaz">

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</section>
<script src="views/assets/js/admin.js"></script>