<?php
    $id = $_GET['id']; 
    $newCat = $_GET['branch_name'];
    $sql = "UPDATE tblbranches SET branch_name = '{$newCat}' WHERE branch_name={$id}";
    if($db->executeSQL($sql)){
        $sql = "SELECT city_id FROM tblbranches WHERE branch_id = {$id}";
        $cityid = $db->fetchOne($sql);
        $f->redir("../../branch/list&city_id={$cityid[0]}/");
    }
    
   