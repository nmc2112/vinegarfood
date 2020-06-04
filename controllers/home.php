<?php
    $xtp = new XTemplate('views/home.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = '2' LIMIT 0,3";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('CARD',$r);
        $xtp->parse('MAIN.CARD');
    }
    
    $xtp->parse('MAIN');
    $acontent = $xtp->text('MAIN');