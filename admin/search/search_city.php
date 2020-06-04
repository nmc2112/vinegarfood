<?php
    include("../../libs/bootstrap.php");
    
    
    if(isset($_GET['query'])){
        $keyword = $_GET['query'];
        $sql = "SELECT * FROM tblcities WHERE city_name LIKE '%{$keyword}%' OR city_id LIKE '%{$keyword}%' ORDER BY city_id";
    }
    else{
        $sql = "SELECT * FROM tblcities ORDER BY city_id ";
    }
    $table = $db->fetchAll($sql);
    $output='<br>';
    if(count($table)>0){
        $output .= '
            <div class="table-responsive">
            <table class="table table bordered">
                <tr>
                    <th width="15%">City ID</th>
                    <th>City Name</th>
                    <th width="20%" colspan="2">Action</th>
                </tr>
            ';
        foreach($table as $row){
            $output .= '
                <tr>
                    <td>'.$row["city_id"].'</td>
                    <td><a style="color: rgb(19, 41, 165) ;" href="../../branch/list&city_id='.$row["city_id"].'/">'.$row["city_name"].'</td>
                   
                    <td>
                        <button type="button" data-value='.$row["city_name"].'  data-id='.$row["city_id"].' id="btnEdit" data-toggle="modal" data-target="#editcat"  class="tabledit-edit-button btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                    </td>
                    <td>
                        <button data-id='.$row["city_id"].' type="button" id="btnDelete"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </td>
                </tr>
                ';
        }
        echo $output;
    }
    else{
        echo '<br><br><br><br>Data Not Found';
    }