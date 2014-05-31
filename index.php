<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'mysqltrick.php';
        
        $connection = new mysqlTrickClient();
        
        $db = $connection->selectDB("social");
        
        $users = $db->selectTable("users");
        
        $variables = array('email'=>'alexander.db27@gmail.com', 'id'=>'AlexPaTruco');
        $cur = $users->select("WHERE email = :email", $variables);
        
        while ($cur->hasNext()) {
        print_r($cur->getNext());
        }
        //echo $users->insert(array("firstname"=>"hello", "fecha"=>"nose"));
        
        
        /*$conn = new MongoClient();
        
        $db = $conn->selectDB("names");
        
        $collection = $db->selectCollection("name");
        
        $collection->*/
        ?>
    </body>
</html>
