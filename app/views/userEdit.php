
<?php
require_once "../templates/admin/header.php";


// echo "<pre>";
// print_r( $ret);
// echo "</pre>";
?>

Edit user ...

<?php 

if(isset($msg))
    echo "<p> $msg </p> ";

if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Username: <input type="text" name='username' value='<?php echo $ret['username'] ?>'>
    <p></p>
    Email: <input type="text" name='email' value='<?php echo $ret['email'] ?>'>
    <p></p>
    Password: <input type="password" name='password' value=''>
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/admin/footer.php"
?>

