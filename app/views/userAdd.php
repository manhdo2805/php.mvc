
<?php
require_once "../templates/admin/header.php"
?>

Add user ...

<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
    echo "<p> $error </p> ";

?>

<form action="" method="post">

    Username: <input type="text" name='username' >
    <p></p>
    Email: <input type="text" name='email' >
    <p></p>
    Password: <input type="password" name='password' >
    <p></p>
    <input type="submit">

</form>


<?php 



?>

<?php
require_once "../templates/admin/footer.php"
?>

