<?php
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblbranches WHERE branch_id IN ($id) ;
    ";
    $id = explode(',',$id);
    $sql2 = "SELECT city_id FROM tblbranches WHERE branch_id= $id[0]";
    $rs = $db->fetchOne($sql2);
    $cat_id = $rs['city_id'];
    $db->executeSQL($sql1);
    $f->redir("../../branch/list&city_id={$cat_id}/");