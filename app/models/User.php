<?php
class User
{
    public static function auth($user, $pass)
    {
        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:user OR email=:user)  AND password=:pass");
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetch();
        if ($ret)
            return $ret;
        return null;
    }

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function add($params)
    {

        $conn = Database::getConnection();
        $username = $params['username'];
        $email = $params['email'];
        $password = $params['password'];

        /////////////////////////////////////
        //Cách cơ bản này có thể insert được, nhưng dễ bị tấn công SQL Injection:
        $sql = "INSERT INTO users (username, email, password, first_name, last_name)
        VALUES ('$username', '$email' , '$password', '$first_name', '$last_name')";
        //return $conn->exec($sql);

        // $sql = "INSERT INTO users (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) 
        VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }


    public static function save($id, $params)
    {

        $conn = Database::getConnection();
        $username = $params['username'];
        $email = $params['email'];
        $password = $params['password'];

        // $sql = "INSERT INTO users (username, email, password)
        //  VALUES ('$username', '$email', '$password')";    // use exec() because no results are returned
        //$conn->exec($sql);
        //echo "New record created succesfully";

        //Ta nên dùng cách nâng cao sau để insert, là php_mysql_prepared_statements
        //Tham khảo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $conn->prepare("UPDATE users SET username = :username, email=:email, password=:password WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); //Password có thể cần thêm băm để bảo mật
        return $stmt->execute();
    }

    public static function get($id)
    {
        $conn = Database::getConnection();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
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
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $stmt = $conn->prepare("SELECT count(*) AS c FROM users");
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
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
        $search_email = $param['search_email'];

        $searchString = null;
        if($search_email){
            $searchString = " WHERE email LIKE :search_email ";
        }
        

        $sql = "SELECT * FROM users $searchString LIMIT :limit OFFSET :offset";

        if(in_array($sort_by, ['username', 'email']))
            if(in_array($sort_type, ['asc', 'desc']))
                $sql = "SELECT * FROM $searchString users ORDER BY $sort_by $sort_type LIMIT :limit OFFSET :offset";
        
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

        if($search_email){
            $search_email = "%$search_email%";
            $stmt->bindParam(':search_email', $search_email);
        }

        $stmt->execute();

        //$stmt->debugDumpParams();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ret = $stmt->fetchAll();
        return $ret;
    }
}
