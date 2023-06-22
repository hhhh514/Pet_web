<?php

$link = @mysqli_connect('203.64.95.42','C111151131','aas659800123') or die ("連線錯誤");
if ( !$link ) {
   //echo "MySQL資料庫連接錯誤!<br/>";
   exit();
}
else {
   //echo "MySQL資料庫連接成功!<br/>";
}
mysqli_query($link,"SET NAMMES 'utf8'");
mysqli_query($link,"SET CHEARACTER SET 'utf8'");

?>