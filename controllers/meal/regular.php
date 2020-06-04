<?php
    $xtp = new XTemplate('views/meal/regular.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 1";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('REGULAR',$r);
        $xtp->parse('MEAL.REGULAR');
    }
    
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');