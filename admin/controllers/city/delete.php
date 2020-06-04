<?php 
    $id = $_GET['id'];
    $sql1 = "DELETE FROM tblcities WHERE cat_id=$id;
    ";
    $sql2 = "DELETE FROM tblbranches WHERE cat_id=$id;
    ";
    if($db->executeSQL($sql1) && $db->executeSQL($sql2)){
        ?><script>alert("You have deleted successfully")</script><?php
        $f->redir("../../city/list/");
    }