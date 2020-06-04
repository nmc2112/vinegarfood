<?php
    include("../../libs/bootstrap.php");


    $id = $_GET['id'];
    if(isset($_GET['page'])) $p = $_GET['page'];
    else $p=1;
    if(isset($_GET['query']) && !empty($_GET['query']) ){
        $keyword = $_GET['query'];
        $sql = "SELECT p.*,c.* FROM tblmeals p
        LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
        WHERE c.cat_id = '{$id}' and (p.meal_name LIKE '%{$keyword}%' OR c.cat_name LIKE '%{$keyword}%' OR p.meal_id LIKE '%{$keyword}%' )
        ";
        $tbl = $db->fetchAll($sql);
        $url="../../meal/list&cat_id={$id}";
        $T=count($tbl);
        $L=10;
        $maxPage = ceil($T/$L);
        if($maxPage<$p) $p=1;
        $ofs = ($p-1)*$L;
        $prev = $p-1;
        $next = $p+1;
        if($prev==0) $prev=1;
        if($next>=($maxPage+1)) $next=$maxPage;
        $pi = $f->better_pagination($url,$T,$L,$p,$prev,$next,$keyword);
        $sql = "SELECT p.*,c.* FROM tblmeals p
                LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
                WHERE c.cat_id = '{$id}' and (p.meal_name LIKE '%{$keyword}%' OR c.cat_name LIKE '%{$keyword}%' OR p.meal_id LIKE '%{$keyword}%' )
                ORDER BY c.cat_id
                LIMIT {$ofs},{$L}
                ";
        $table = $db->fetchAll($sql);

    }
    else{
        $keyword = '';
        $p = $_GET['page'];
        $sql = "SELECT p.*,c.* FROM tblmeals p
        LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
        WHERE c.cat_id = '{$id}' and (p.meal_name LIKE '%{$keyword}%' OR c.cat_name LIKE '%{$keyword}%' OR p.meal_id LIKE '%{$keyword}%' )
        ORDER BY c.cat_id
        ";
        $tbl = $db->fetchAll($sql);
        $L=10;
        $url="../../meal/list&cat_id={$id}";
        $ofs = ($p-1)*$L;
        $T=count($tbl);
        $prev = $p-1;
        $next = $p+1;
        $maxPage = ceil($T/$L);
        if($prev==0) $prev=1;
        if($next>=($maxPage+1)) $next=$maxPage;
        $pi = $f->better_pagination($url,$T,$L,$p,$prev,$next,$keyword);
        $sql = "SELECT p.*,c.* FROM tblmeals p
                LEFT JOIN tblcategories c ON c.cat_id = p.cat_id
                WHERE c.cat_id = '{$id}' and (p.meal_name LIKE '%{$keyword}%' OR c.cat_name LIKE '%{$keyword}%' OR p.meal_id LIKE '%{$keyword}%' )
                ORDER BY c.cat_id
                LIMIT {$ofs},{$L}
                ";
        $table = $db->fetchAll($sql);
    }
    $output='';
    if(count($table)>0){
        $output .= '
            <div class="table-responsive">
            <table class="table table bordered">
                <tr>
                    <th>ID</th>
                    <th>Meal Image</th>
                    <th>Category Name</th>
                    <th width="20%">Meal Name</th>
                    <th>Meal Price</th>
                    <th colspan="2">Action</th>
                    <th><input onclick="checkAll(this)"  type="checkbox"></th>
                </tr>
            ';
        foreach($table as $row){
            $output .= '
                <tr>
                    <td>'.$row["meal_id"].'</td>
                    <td><img src="../../'.$row["meal_img"].'"></td>
                    <td>'.$row["cat_name"].'</td>
                    <td><a style="color: rgb(19, 41, 165) ;" href="../../meal/edit&cat_id='.$row["cat_id"].'&id='.$row["meal_id"].'/">'.$row["meal_name"].'</td>
                    <td>$'.$row["meal_price"].'</td>
                    <td>
                        <button type="button" data-id="&cat_id='.$row["cat_id"].'&id='.$row["meal_id"].'" id="btnEdit" class="tabledit-edit-button btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                    </td>
                    <td>
                        <button data-id='.$row["meal_id"].' type="button" id="btnDelete"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </td>
                    <td><input name="box" value='.$row["meal_id"].' type="checkbox"></td>
                </tr>
                ';
        }
        $output .= '<div>'.$pi.'<div style="display:inline-block"><p style="text-align: right; font-size: 16px">Show '.$T.' results of "'.$keyword.'"</p></div></div>';
        echo $output;
    }
    else{
        echo 'Data Not Found';
    }    