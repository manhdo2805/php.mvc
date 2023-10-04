
<?php
require_once "../templates/admin/header.php"
?>

Danh sách user | <a href="/admin/users/add">Add </a>


<form action="" method="get">
Tìm email: <input type="text" name='search_email' value="<?php echo $_GET['search_email'] ?? '' ?>">
<input type="submit" value="Tìm">
</form>


<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
    echo "<p> $error </p> ";

?>
<p></p>
Trang: 
<?php
    if(isset($nPage))
    for($i = 1; $i <= $nPage ; $i++){
        echo("\n <a href='/admin/users?page=$i'> $i </a> | ");
    }
    $sort_type = "asc";
    if($_GET['sort_type'] ?? ''){
        $sort_type = $_GET['sort_type'];
        if($sort_type == 'asc')
            $sort_type = 'desc';
        else
            $sort_type = 'asc';
    }
?>

<table border="1">
    <tr>
<td>Id</td>
<td> <a href="/admin/users?sort_by=username&sort_type=<?php echo $sort_type  ?>"> 
Username </a></td>
<td> <a href="/admin/users?sort_by=email&sort_type=<?php echo $sort_type  ?>"> 
Email </a></td>

<td>Action</td>

    </tr>
<?php 

    if(isset($data))
    foreach($data AS $one){
        $id = $one['id'];
        $username = $one['username'];
        $email = $one['email'];
        $first_name = $one['first_name'];
        $last_name = $one['last_name'];

        echo("\n<tr>");

        
        echo("\n<td>  $id </td> <td> $username  </td> <td> $email </td>");
        echo("\n<td> <a href='/admin/users/edit?id=$id'>  Edit </a> | 
        <a href='/admin/users/delete?id=$id'>  Delete </a> </td>");
        echo("\n</tr>");
    }
?>
</table>




<?php
require_once "../templates/admin/footer.php"
?>

