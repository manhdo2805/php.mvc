<?php
require_once "../templates/admin/header.php"
?>

Danh sách tin tức | <a href="/admin/new/add">Add </a>


<form action="" method="get">
Tìm tin tức: <input type="text" name='search_description' value="<?php echo $_GET['search_description'] ?? '' ?>">
<input type="submit" value="Tìm">
</form>


<?php 
if(isset($msg))
    echo "<p> $msg </p> ";
if(isset($error))
{
    echo "<pre>";
    print_r($error);
    echo "</pre>";
}
?>
<p></p>
Trang: 
<?php
    if(isset($nPage))
    for($i = 1; $i <= $nPage ; $i++){
        echo("\n <a href='/admin/new?page=$i'> $i </a> | ");
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
<td> <a href="/admin/new?sort_by=name&sort_type=<?php echo $sort_type  ?>"> 
Name </a></td>
<td> <a href="/admin/new?sort_by=description&sort_type=<?php echo $sort_type  ?>"> 
Description</a></td>
<td> Cat</td>
<td>Action</td>

    </tr>
<?php 

    if(isset($data))
    foreach($data AS $one){
        $id = $one['id'];
        $name = $one['name'];
        $description = $one['description'];
        $cat = $one['cat'];

        echo("\n<tr>");

        
        echo("\n<td>  $id </td> <td> $name  </td> <td> $description </td>");
        echo("\n<td>  $cat </td>");
        echo("\n<td> <a href='/admin/new/edit?id=$id'>  Edit </a> | 
        <a href='/admin/new/delete?id=$id'>  Delete </a> </td>");
        echo("\n</tr>");
    }
?>
</table>




<?php
require_once "../templates/admin/footer.php"
?>