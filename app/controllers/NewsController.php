<?php
require_once '../app/models/News.php';
class NewsController
{

    public function list()
    {        
        try{
            //sort_by=username&sort_type=asc
            $sort_by = $_GET['sort_by'] ?? 0;
            $sort_type = $_GET['sort_type'] ?? 0;

            $search_str = $_GET['search_description'] ?? '';
            

            //Limit/Offset 
            $page = $_GET['page'] ?? 1;
            $limit = 5;
            $param = ['page'=>$page, 
            'limit' => $limit,
            'sort_by' => $sort_by,
            'sort_type' => $sort_type,
            'search_description'=> $search_str,
            ];

            $data = News::list($param);


            $total = News::count();
            $nPage = ceil($total / $limit);
            
            
        } catch (PDOException $e) {
            $error =  "Có lỗi: " . $e->getMessage() ."<br>- ". $e->getTraceAsString();
            // return null;
        }

        require_once "../app/views/newList.php";
    }

    public function add()
    {
        print_r($_POST);
        if($_POST['name'] ?? ''){

            try{
                $ret = News::add($_POST);
                if($ret){
                    Header("Location: /admin/new");
                }
            } catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage();
                return null;
            }
        }

        require_once "../app/views/newAdd.php";
    }

    public function edit()
    {

        $ret  = null;
        if($id = ($_GET['id'] ?? '')){
            try{
                
                $ret = News::get($id);
                if($_POST['newname'] ?? ''){
                    
                    News::save($id, $_POST);

                    $ret = News::get($id);

                    $msg = "Update thành công!";
                    
                }
                
                //  if($ret){
                //      Header("Location: /admin/users");
                // }
            } 
            catch (PDOException $e) {
                $error =  "Có lỗi: " . $e->getMessage()."-".$e->getTraceAsString();
               // return null;
            }
        }
       

        require_once "../app/views/newEdit.php";
    }

    public function delete()
    {
        if($id = ($_GET['id'] ?? '')){
            try{
                $ret = News::delete($id);
                if($ret){
                    Header("Location: /admin/new");
                }
            } catch (PDOException $e) {
                echo "<br>Có lỗi: " . $e->getMessage();
                return null;
            }
        }
    }
}