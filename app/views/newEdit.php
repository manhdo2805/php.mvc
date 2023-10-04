<?php
require_once "../templates/admin/header.php";


// echo "<pre>";
// print_r( $ret);
// echo "</pre>";
?>

Edit tin tức ...

<?php 

if(isset($msg))
    echo "<p> $msg </p> ";

if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Newsname: <input type="text" name='newname' value='<?php echo $ret['name'] ?>'>
    <p></p>
    Description: <input type="text" name='description' value='<?php echo $ret['description'] ?>'>
    <p></p>
    Cat: <input type="cat" name='cat' value=''>
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/admin/footer.php"
?>