<?php
if(isset($_POST['email'])){
    //Sign up
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    include('db_connect.php');
    $databass="C111151131";
    $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
    $sql_str_1="insert into `user`(`user`,`sex`,`email`,`password`) values('{$name}','{$sex}','{$email}','{$password}')";
    $sql_str_id="SELECT `id` FROM `user` WHERE `user`.`user` = '{$name}'";
    if(mysqli_query($link,$sql_str_1)){
        echo"註冊成功_前往創建畫面";
        if(mysqli_query($link,$sql_str_id)){
            //取得user id
            $id=mysqli_query($link,$sql_str_id);
            $id_pet=mysqli_fetch_assoc($id);
            foreach($id_pet as $key =>$item){
                echo $item;
            }
            //取得時間
            date_default_timezone_set('Asia/Taipei'); 
            $time=date('Y-m-d H:i:s ', time()+60*60*6);
            //創建pet
            $sql_str_pet="insert into `pet`(`id`,`heart`,`time`,`hunger`,`favorable`) values('{$item}','3','{$time}','3','3')";
            if(mysqli_query($link,$sql_str_pet)){
                echo "創建成功_將前往遊戲畫面";
                header("Location:locate.php?id=$item");
            }
            else{
                echo "創建失敗";
            }
        }
        else{
            echo"創建失敗";
        }
    }
    else{
        echo"註冊失敗_user重複或email已被使用";
    }
    mysqli_close($link);
}
else{
    //login
    $cheack=0;
    $name=$_POST['name'];
    $password=$_POST['password'];
    include('db_connect.php');
    $databass="C111151131";
    $db_select=mysqli_select_db($link,$databass) or die ("連線失敗");
    $sql_str_user="SELECT * FROM `user` WHERE `user`.`user` = '{$name}'";
    if(mysqli_query($link,$sql_str_user)){
        $user=mysqli_query($link,$sql_str_user);
        $user_data=mysqli_fetch_assoc($user);
        if(!empty($user_data)){
            foreach($user_data as $key =>$value){
                if($key=='id'){
                    $id=$value;
                }
                if($key=='password'){
                    if($value==$password){
                        echo "即將跳轉";
                        header("Location:locate.php?id=$id",3000);
                    }
                    else{
                        echo "密碼錯誤";
                    }
                }
            }
        }
        else{
            echo "查無此帳號_";
        }
    }
    else{
        echo "查無此帳號_";
    }
    mysqli_close($link);
}
?>