<?php
class News
{

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function add($params)
    {

        $conn = Database::getConnection();
        $name = $params['name'];
        $description = $params['description'];
        $cat= $params['cat'];

        /////////////////////////////////////
        //Cách cơ bản này có thể insert được, nhưng dễ bị tấn công SQL Injection:
        $sql = "INSERT INTO news (name, description, cat)
        VALUES ('$name', '$description' , '$cat')";
        //return $conn->exec($sql);

        // $sql = "INSERT INTO news (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("INSERT INTO news (name, description, cat) 
        VALUES (:name, :description, :cat)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':cat', $cat); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }


    public static function save($id, $params)
    {
        print_r($params);
       // die('abc 123');
        $conn = Database::getConnection();
        $newname = $params['newname'];
        $description = $params['description'];
        $cat = $params['cat'];

        // $sql = "INSERT INTO news (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("UPDATE news SET name = :name, description=:description, cat=:cat WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $newname);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':cat', $cat); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }

    public static function get($id)
    {
        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT * FROM news WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        if ($ret)
            return $ret[0];
        return null;
    }

    public static function count($param = null)
    {
        $conn = Database::getConnection();

        $sql = "SELECT count(*) AS c FROM news";
    
        $search_description = $param['search_description'] ?? "";
        $searchString = null;
        if($search_description){
            $searchString = " WHERE description LIKE :search_description ";            
            $sql = "SELECT count(*) AS c FROM news $searchString ";
        }        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare($sql);
        if($search_description){
            $search_description = "%$search_description%";
            $stmt->bindParam(':search_description', $search_description);
        }
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        //        $stmt->debugDumpParams();

        return $ret[0]['c'];
    }

    public static function list($param)
    {
        $page = $param['page'];
        //Page = 0 -> offset = 0,
        //Page = 1 -> offset = 5,
        //Page = 2 -> offset = 10,...
        $limit = $param['limit'];
        $offset = ($page - 1) * $limit;

        $sort_by = $param['sort_by'];
        $sort_type = $param['sort_type'];
        $search_description = $param['search_description'] ?? '';
        
        echo "<pre>";
        print_r($param);
        echo "</pre>";

        $searchString = null;
        if($search_description){

            $searchString = " WHERE description LIKE :search_description ";
        }
        

        $sql = "SELECT * FROM news $searchString LIMIT :limit OFFSET :offset";

        if(in_array($sort_by, ['name', 'description']))
            if(in_array($sort_type, ['asc', 'desc']))
                $sql = "SELECT * FROM $searchString news ORDER BY $sort_by $sort_type LIMIT :limit OFFSET :offset";
        
        // echo "<pre>";
        // print_r($param);
        // echo "</pre>";
        // die($sql);

        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if($search_description){
            $search_description = "%$search_description%";
            $stmt->bindParam(':search_description', $search_description);
        }

        $stmt->execute();

        //$stmt->debugDumpParams();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        return $ret;
    }
}
