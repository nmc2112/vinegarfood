<?php
    $xtp = new XTemplate("views/branch/list.html");
    $id = $_GET['city_id'];
    /* Add product */
    $do_save = 1;
    $arrFileType = array('png','jpg','gif','svg');
    $urlServer = '../.././img';
    $urlServer_copy = 'img';
    $maxSize    = 10000000;
    $xtp->assign('id',$id);
    if($_POST){
        $address = $_POST['address_name_added'];
        $sql = "INSERT INTO tblbranches(city_id,branch_name) VALUES ('{$id}','{$address}')";
        $db->executeSQL($sql);
    }

    /*Get the brand name */
    $sql1 = "SELECT c.city_name FROM tblcities c
        WHERE c.city_id = '{$id}'
    ";
    $brand=($db->fetchOne($sql1));
    $brand1 =($brand['city_name']);
    $brand1 = "Branch of "."{$brand1}";
    $xtp->assign('CategoryName',$brand1);

    $sql = "SELECT * FROM tblbranches WHERE city_id={$id}";  
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