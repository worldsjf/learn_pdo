<?php
   $DB_TYPE = 'mysql';
   $DB_HOST = 'localhost';
   $DB_NAME = 'learnpdo';
   $USER = 'root';
   $PW = '';
   
   try {
       $conn = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME", $USER, $PW);
       $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   } catch (Exception $e) {
       die("Connection failed: " . $e->getMessage());
   }
    function prepareSQL($sql){
        global $conn;
        return $conn->prepare($sql);
    }
    // Lấy dữ liệu ra nè
    function getData(){
        $sql = "SELECT * FROM category";
        $select = prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }

    function getOneData($data){
        $sql = "SELECT * FROM category WHERE id = :id";
        $select = prepareSQL($sql);
        $select->execute($data);
        return $select->fetchAll();
    }

    function createNewData($data){
        $sql = "INSERT INTO category (name) VALUES (:name)";
        $create = prepareSQL($sql);
        $create->execute($data);
    }

    function updateData($data){
        $sql = "UPDATE category SET name = :name WHERE id = :id";
        $update = prepareSQL($sql);
        $update->execute($data);
    }
    function deleteData($data){
        $sql = "DELETE FROM category WHERE id = :id";
        $update = prepareSQL($sql);
        $update->execute($data);
    }


    function getProdData(){
        $sql = "SELECT * FROM product INNER JOIN category ON product.cateId = category.id";
        $select = prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }

    function getOneProdData($data){
        $sql = "SELECT * FROM product WHERE prodId = :id";
        $select = prepareSQL($sql);
        $select->execute($data);
        return $select->fetchAll();
    }

    function createNewProdData($data){
        $sql = "INSERT INTO product VALUES (:prodId, :prodName, :prodPrice, :cateId)";
        $create = prepareSQL($sql);
        $create->execute($data);
    }

    function updateProdData($data){
        $sql = "UPDATE product SET prodName = :prodName, prodPrice = :prodPrice, cateId = :cateId  WHERE prodId = :id";
        $update = prepareSQL($sql);
        $update->execute($data);
    }
    function deleteProdData($data){
        $sql = "DELETE FROM product WHERE prodId = :id";
        $update = prepareSQL($sql);
        $update->execute($data);
    }
?>