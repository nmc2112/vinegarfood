<?php
    $xtp = new XTemplate('views/meal/beverages.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 5";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('BEVER',$r);
        $xtp->parse('MEAL.BEVER');
    }
    
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');