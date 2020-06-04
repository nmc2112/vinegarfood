<?php
    $xtp = new XTemplate('views/city/list.html');
    if($_POST){
        $cat_name = $_POST['cat_name_added'];
        $sql = "SELECT city_name FROM tblcities WHERE city_name = '{$cat_name}'";
        $rsult = $db->fetchOne($sql);
        if($rsult['city_name']==''){
            $sql = "INSERT INTO tblcities(city_name) VALUES ('$cat_name')";
            if($db->executeSQL($sql)){
                $f->redir("../../city/list/");
            }
        }
        else{
            ?><script>alert("This city name has already existed");</script><?php
        }
    }
    $xtp->parse('LS');
    $acontent = $xtp->text('LS');