<?php
ob_start();
session_start();
?>
<!doctype html>
<?php include "config/connection.php";  ?>
<html lang="en">
<?php include"views/zaglavlje.php"; ?>
<body>
<div id="wrapper" class="container">
    <?php
    include "views/meni.php";
    //include "views/pocetna.php";
    //include "views/register.php";
    //include "views/prodavnica.php";
  //  include "views/proizvodDetalj.php";
    if(!isset($_GET['page'])){
        include "views/pocetna.php";
    }
    else {
        switch($_GET['page']){
            case 'prodavnica':
                include("views/prodavnica.php");
                break;
            case 'admin':
                include("views/admin.php");
                break;
            case 'logout':
                include("models/logout.php");
                break;
            case 'autor':
                include("views/autor.php");
                break;
                case 'proizvodjedan':
                include("views/proizvodDetalj.php");
                break;
            case 'register':
                include("views/register.php");
                break;
            case 'izmeni':
                include("views/izmeni.php");
                break;
            default:
                include("views/pocetna.php");
                break;
        }
    }

    include "views/footer.php";
    ?>
</div>
<?php include "views/script.php"; ?>
</body>
</html>
