<?php
    $id = $_GET['id']; 
    $newCat = $_GET['city_name'];
    $sql = "UPDATE tblcities SET city_name = '{$newCat}' WHERE city_id={$id}";
    if($db->executeSQL($sql)){
        $f->redir("../../city/list/");
    }
    
   