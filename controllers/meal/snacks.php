<?php
    $xtp = new XTemplate('views/meal/snacks.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 3";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('SNACK',$r);
        $xtp->parse('MEAL.SNACK');
    }
    
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');