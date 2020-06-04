<?php
    $xtp = new XTemplate('views/meal/dessert.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 4";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('DESSERT',$r);
        $xtp->parse('MEAL.DESSERT');
    }
    
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');