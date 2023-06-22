<?php

include('db_connect.php');
$databass="C111151131";
/*
if(isset($_POST['interactive'])){
$touch=$_POST['interactive'];
$db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
$sql_str="update `pet`set `favorable`='{$touch}' WHERE `pet`.`id` = '{$id}'";
if(mysqli_query($link,$sql_str)){
    echo"寫入成功";
}
else{
    echo"寫入失敗";
}
}
*/
if(isset($_POST['feed_id'])){
    $id=$_POST['feed_id'];
    include('db_connect.php');
    $databass="C111151131";
    $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
    //找現在的飢餓值
    $sql_str_hunger="SELECT `hunger` FROM `pet` WHERE `pet`.`id` = '{$id}'";
    $hunger=mysqli_query($link,$sql_str_hunger);
    $hunger_data=mysqli_fetch_assoc($hunger);
    foreach($hunger_data as $key =>$value){
        if($key=='hunger'){
            echo $value;
            if($value<3){
                $value++;
            }
        }
    }
    date_default_timezone_set('Asia/Taipei'); 
    $time=date('Y-m-d H:i:s ', time()+6*60*60);
    //更改飢餓值
    $sql_str="update `pet`set `time`='{$time}',`hunger`='{$value}' WHERE `pet`.`id` = '{$id}'";
    if(mysqli_query($link,$sql_str)){
        echo"寫入成功";
    }
    else{
        echo"寫入失敗";
    }
    }/*
    if((isset($_POST['hunger']))&&(isset($_POST['id']))){
        $hunger=$_POST['hunger'];
        $id=$_POST['id'];
        include('db_connect.php');
        $databass="C111151131";
        $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
        date_default_timezone_set('Asia/Taipei'); 
        $time=date('Y-m-d H:i:s ', time()+6*60*60);
        //更改飢餓值與時間
        $sql_str="update `pet`set `time`='{$time}',`hunger`='{$hunger}' WHERE `pet`.`id` = '{$id}'";
        if(mysqli_query($link,$sql_str)){
            echo"寫入成功";
        }
        else{
            echo"寫入失敗";
        }
    }
    if((isset($_POST['heart']))&&(isset($_POST['id']))){
        $heart=$_POST['heart'];
        $id=$_POST['id'];
        include('db_connect.php');
        $databass="C111151131";
        $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
        date_default_timezone_set('Asia/Taipei'); 
        $time=date('Y-m-d H:i:s ', time()+6*60*60);
        //更改生命值與時間
        $sql_str="update `pet`set `time`='{$time}',`heart`='3' WHERE `pet`.`id` = '{$id}'";
        if(mysqli_query($link,$sql_str)){
            echo"寫入成功";
        }
        else{
            echo"寫入失敗";
        }
        }*/
    //用json格式顯示給game_web的fetch讀取值
    $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
    $sql_switch="SELECT * FROM `pet`"; 
    $result_switch=mysqli_query($link,$sql_switch);
    $datas_switch = array();
     if($result_switch) {
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        echo "[";
        if (mysqli_num_rows($result_switch)>0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            $size=mysqli_num_rows($result_switch)-1;
            while ($row_switch = mysqli_fetch_assoc($result_switch)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas_switch= $row_switch;
                echo json_encode($datas_switch);
                if($size>0){
                    echo ",";
                    $size=$size-1;
                }
            }
        }
        else {
            // 為空表示沒資料
            echo "無資料";
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result_switch);
        echo ']';
    }
    else {
        echo "{$sql_switch} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
    mysqli_close($link);
?>