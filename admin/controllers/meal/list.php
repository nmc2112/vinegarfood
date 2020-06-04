<?php
    $xtp = new XTemplate("views/meal/list.html");

    /* Add product */
    $do_save = 1;
    $arrFileType = array('png','jpg','gif','svg');
    $urlServer = '../.././img';
    $urlServer_copy = 'img';
    $maxSize    = 10000000;
    $id = $_GET['cat_id'];
    $xtp->assign('id',$id);
    if($_POST){
        $meal_name = $_POST['meal_name_added'];
        $meal_price = $_POST['meal_price_added'];
        $meal_ingre = $_POST['meal_ingre_added'];
        $meal_adv = $_POST['meal_adv_added'];
        $file = $_FILES['upload_file_added'];
        $meal_img =$f->uploadFile($file,$urlServer,$urlServer_copy,$arrFileType,$maxSize);
        $meal_name_err_mess = $meal_price_err_mess = $meal_quantity_err_mess = $meal_img_err_mess = '';
        if(empty($meal_name)){
            $meal_name_err_mess='Meal Name must be filled';
            $xtp->assign('meal_name_err_mess',$pro_name_err_mess);
            $do_save = 0;
        }
        if(!$valid->isNumber($meal_price)){
            $meal_price_err_mess='Price must be a number';
            $xtp->assign('meal_price_err_mess',$pro_price_err_mess);
            $do_save = 0;
        }
        if($meal_img=='101'){
            $meal_img_err_mess = 'File type not allow';
            $xtp->assign('meal_img_err_mess',$pro_img_err_mess);
            $do_save=0;
        }
        if($meal_img=='102'){
            echo ($file['size']);
            $do_save=0;
        }
        if($do_save==1){
            $time = time();
            $time=date("Y-m-d",$time);
            $sql = "INSERT INTO tblmeals(cat_id,meal_name,meal_price,meal_ingre,meal_img,meal_adv,meal_time) 
                    VALUES('{$id}','{$meal_name}','{$meal_price}','{$meal_ingre}','{$meal_img}','{$meal_adv}','{$time}')";
            $db->executeSQL($sql);
        }

    }

    /*Get the brand name */
    $sql1 = "SELECT c.cat_name FROM tblcategories c
        WHERE c.cat_id = '{$id}'
    ";
    $brand=($db->fetchOne($sql1));
    $brand1 =($brand['cat_name']);
    $brand1 = "Meals of "."{$brand1}";
    $xtp->assign('CategoryName',$brand1);

    $sql = "SELECT * FROM tblmeals WHERE cat_id={$id}";  
    $rs = $db->fetchAll($sql);
    $count = count($rs);
    $xtp->assign('count',$count);


    $p = (isset($_GET['page']))?$_GET['page']:1;
    $xtp->assign('page',$p);

    $kw = (isset($_GET['keyword']))?$_GET['keyword']:'';
    $xtp->assign('keyword',$kw);

    /* $_SESSION['keyword'] */
    /* Display table - Pagination */
    /* $sql = "SELECT p.*,c.* FROM tblproducts p
            LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
            WHERE c.cat_id = '{$id}'
            ";
    $tbl = $db->fetchAll($sql);
    $L=3;
    $p = (isset($_GET['page']))?$_GET['page']:1;
    $url="";
    $ofs = ($p-1)*$L;
    $T=count($tbl);
    $prev = $p-1;
    $next = $p+1;
    $maxPage = ceil($T/$L);
    if($prev==0) $prev=1;
    if($next>=($maxPage+1)) $next=$maxPage;
    $pi = $f->better_pagination($url,$T,$L,$p,$prev,$next);
    $sql = "SELECT p.*,c.* FROM tblproducts p
            LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
            WHERE c.cat_id = '{$id}'
            LIMIT {$ofs},{$L}
            ";
    $tbl = $db->fetchAll($sql); */ 
   

    /** Display */
    /* foreach($tbl as $r){
        $xtp->assign('nbr',$i);
        $xtp->assign('PRODUCT',$r);
        $xtp->parse('LIST.PRODUCT');
        $i++;
    } */
    //$xtp->assign('pi',$pi);
    $xtp->parse('LIST');
    $acontent = $xtp->text('LIST');