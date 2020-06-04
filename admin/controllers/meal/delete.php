<?php
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblmeals WHERE meal_id IN ($id) ;
    ";
    $id = explode(',',$id);
    print_r($id);
    $sql2 = "SELECT cat_id FROM tblmeals WHERE meal_id= $id[0]";
    $rs = $db->fetchOne($sql2);
    $cat_id = $rs['cat_id'];
    $db->executeSQL($sql1);
    $f->redir("../../meal/list&cat_id={$cat_id}/");