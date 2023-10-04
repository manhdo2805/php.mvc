<?php
require_once "../templates/admin/header.php"
?>

Add new ...

<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Newsname: <input type="text" name='name' >
    <p></p>
    description: <input type="text" name='description' >
    <p></p>
    cat: <input type="cat" name='cat' >
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/admin/footer.php"
?>