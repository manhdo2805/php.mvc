<?php
require_once '../app/models/User.php';
class UserController
{

    public function list()
    {        
        try{
            //sort_by=username&sort_type=asc
            $sort_by = $_GET['sort_by'] ?? 0;
            $sort_type = $_GET['sort_type'] ?? 0;

            $search_email = $_GET['search_email'] ?? '';
            

            //Limit/Offset 
            $page = $_GET['page'] ?? 1;
            $limit = 5;
            $param = ['page'=>$page, 
            'limit' => $limit,
            'sort_by' => $sort_by,
            'sort_type' => $sort_type,
            'search_email'=> $search_email,
            ];

            $data = User::list($param);


            $total = User::count();
            $nPage = ceil($total / $limit);
            
            
        } catch (PDOException $e) {
            $error =  "Có lỗi: " . $e->getMessage();
            // return null;
        }

        require_once "../app/views/userList.php";
    }

    public function add()
    {

        if($_POST['username'] ?? ''){
            try{
                $ret = User::add($_POST);
                if($ret){
                    Header("Location: /admin/users");
                }
            } catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage();
                return null;
            }
        }

        require_once "../app/views/userAdd.php";
    }

    public function edit()
    {

        $ret  = null;
        if($id = ($_GET['id'] ?? '')){
            try{
                $ret = User::get($id);
                if($_POST['username'] ?? ''){
                    User::save($id, $_POST);
                    $ret = User::get($id);
                    $msg = "Update thành công!";
                }
                //  if($ret){
                //      Header("Location: /admin/users");
                // }
            } catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage();
                return null;
            }
        }

        require_once "../app/views/userEdit.php";
    }

    public function delete()
    {
        if($id = ($_GET['id'] ?? '')){
            try{
                $ret = User::delete($id);
                if($ret){
                    Header("Location: /admin/users");
                }
            } catch (PDOException $e) {
                echo "<br>Có lỗi: " . $e->getMessage();
                return null;
            }
        }
    }
}
