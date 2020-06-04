<?php
    $xtp = new XTemplate("views/meal/edit.html");
    if($_GET['id']){
        $id = $_GET['id'];
    }
    if($_GET['cat_id']){
        $cat_id = $_GET['cat_id'];
        
    }
    $do_save = 1;
    $arrFileType = array('png','jpg','gif','svg','jpeg');
    $urlServer = '../.././img';
    $urlServer_copy = 'img';
    $maxSize    = 10000000;
    $sql = "SELECT * FROM tblmeals WHERE meal_id = '{$id}'";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('EDIT',$r);
        //$cat_id = $r['cat_id'];
    }
    if($_POST){
        $name = $_POST['meal_name'];
        $ingre = $_POST['meal_ingre'];
        $adv = $_POST['meal_adv'];
        $price = $_POST['meal_price'];
        $img = $_FILES['upload_file_added'];
        $meal_img =$f->uploadFile($img,$urlServer,$urlServer_copy,$arrFileType,$maxSize);
        $meal_name_err_mess = $meal_price_err_mess = $meal_img_err_mess = '';
        if(empty($name)){
            $meal_name_err_mess='Meal Name must be filled';
            $xtp->assign('meal_name_err_mess',$meal_name_err_mess);
            $do_save = 0;
        }
        if(!$valid->isNumber($price)){
            $meal_price_err_mess='Price must be a number';
            $xtp->assign('meal_price_err_mess',$meal_price_err_mess);
            $do_save = 0;
        }
        if($meal_img=='101'){
            $meal_img_err_mess = 'File type not allow';
            $xtp->assign('meal_img_err_mess',$meal_img_err_mess);
            $do_save=0;
        }
        if($meal_img=='102'){
            echo ($file['size']);
            $do_save=0;
        }
        if($do_save==1){
            $sql1="UPDATE tblmeals SET 
                meal_name = '{$name}',
                meal_price = '{$price}',
                meal_ingre = '{$ingre}',
                meal_adv = '{$adv}',
                meal_img = '{$meal_img}'
                WHERE meal_id = '{$id}'
            ";
            echo $sql1;
            if($db->executeSQL($sql1)){
                $f->redir("../../meal/list&cat_id={$cat_id}/");
            }
        }

    }


    $xtp->parse('EDIT');
    $acontent = $xtp->text('EDIT');


?>