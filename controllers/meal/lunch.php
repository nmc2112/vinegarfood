<?php
    $xtp = new XTemplate('views/meal/lunch.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 2";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LUNCH',$r);
        $xtp->parse('MEAL.LUNCH');
    }
    
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');