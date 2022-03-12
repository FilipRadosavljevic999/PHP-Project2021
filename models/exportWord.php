<?php
header("Content-Type: application/vnd.ms-word");
header("content-disposition: attachment;filename=autor.doc");

include("../config/connection.php");

$query = "SELECT * FROM autor";
$pol = executeQuery($query);
?>

<html>
<head></head>
<body>
<?php
foreach($pol as $p){
    echo "<p>" . $p->ime . "</p>";
}
?>
</body>
</html>