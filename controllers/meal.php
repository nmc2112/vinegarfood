<?php
    $xtp = new XTemplate('views/meal.html');
    $sql = "SELECT * FROM tblmeals WHERE cat_id = 2";
    $tbl = $db->fetchAll($sql);
    $cnt = 0;
    $countRow = count($tbl);
    $pageNum = ceil($countRow/3);
    $start = 0;
    for($i=0; $i<=$pageNum; $i++){
        $xtp->parse('MEAL.SLIDE');
        $sql = "SELECT * FROM tblmeals WHERE cat_id = 2 LIMIT {$start},3";
        $tbl = $db->fetchAll($sql);
        foreach($tbl as $r){
            $xtp->assign("REGULAR",$r);
            $xtp->parse('MEAL.SLIDE.REGULAR');
            $start=$start+3;
        }
    }
    $xtp->parse('MEAL');
    $acontent = $xtp->text('MEAL');