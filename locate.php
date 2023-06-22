<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <link rel="stylesheet" href="pet2.css">
    <title>Document</title>
</head>
<body onload="newTimer(),nowpet()">
    <div class="position_relative_container">
        <div id="bkgd">
            <img id="bkgd_size"src="background.png"/>
        </div>
        <div id="bkgd">
            <img id="bkgd_size"src="background.png"/>
        </div>
        <div id="food_1">
            <img class="food" src="food.png"/>
        </div>
        <div id="food_2">
            <img class="food" src="food.png"/>
        </div>
        <div id="food_3">
            <img class="food" src="food.png"/>
        </div>
        <div id="heart_4">
            <img class="hart" src="heart.png"/>
        </div>
        <div class="pet">
            <img id="pet" src="BackgroundEraser_20230609_160234129.png"/>
        </div>
        <div id="heart_1">
            <img class="hart" src='heart.png'/>
        </div>
        <div id="heart_2">
            <img class="hart" src='heart.png'/>
        </div> 
        <div id="heart_3">
            <img class="hart" src='heart.png'/>
        </div>
        <div id="feed">
            <button onclick="feed()"><img class="food" src="feed.png"/></button>
        </div>
    </div>
    <script>
    <?php
    //接收user_id
    $id=$_GET['id'];
    echo "var jsvar ='$id';";
    ?>
        console.log(jsvar);
        function feed(){
            //傳值更改飽食度
            $.ajax({
                type: "POST",
                url: "back.php",
                data:{feed_id:jsvar
                },
                success:function(result) {
                    console.log(result)
                },
                error:function(xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });
            //冒愛心
            var kop=document.getElementById("heart_4");
                kop.style.display="inline";
                setTimeout(function(){
                    var kop=document.getElementById("heart_4");
                        kop.style.display="none";
                    },5000);
                }
         function hunger_1(hunger,before_time){
            let now_time=newTimer();
            //確認要扣多少飽食度
            while(now_time>before_time) { 
                before_time=parseInt(before_time)+6*1000*60*60;
                console.log(hunger);
                hunger--;
            }
            //傳值更改飽食度
            console.log(hunger);
            $.ajax({
                type: "POST",
                url: "back.php",
                data:{  id:jsvar,
                        hunger:hunger
                    },
                success:function(result) {
                    console.log(result)
                },
                error:function(xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });

        }
        function  heart_1(heart,before_time){
            let now_time=newTimer();
            //確認要扣多少心
            while((now_time>before_time)&&(heart>0)) {
                before_time=parseInt(before_time)+6*1000*60*60;
                heart--;
                console.log(heart);
            }
            //傳值更改心
            console.log(heart);
            $.ajax({
                type: "POST",
                url: "back.php",
                data:{  id:jsvar,
                        heart:heart
                    },
                success:function(result) {
                    console.log(result)
                },
                error:function(xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });
        }
        //時間
        function newTimer(){
            let timestamp = Date.now();
            let date = new Date(timestamp);
            return date.getTime();
        }
function settingFunc(value,type){
    for (let index = 1; index <= value; index++) {
        //顯示
        type_number='_'+index;
        type_change=type+type_number;
        var kop=document.getElementById(type_change);
        kop.style.display="inline";
    }
}
//pet狀態
function nowpet(){
        fetch('back.php').then(function(response){
            return response.json();
        }).then(function time(data){
            for (let i = 0; i < data.length; i++) {
                let date=data[i];
                if(jsvar==date.id){
                    let heart='heart';
                    let hunger='food';
                    //顯示飽食度
                    settingFunc(date.hunger,hunger);
                    //顯示心
                    settingFunc(date.heart,heart);
                    let time=new Date(date.time);
                    let before_time=time.getTime();
                    let now_time=newTimer();
                    if(now_time>before_time){
                           //減hunger or heart
                           compare_time=parseInt(before_time)+3*6*1000*60*60;
                           if ((date.hunger==0) || (now_time>compare_time)) {
                            heart_1(date.heart,before_time);
                            //refresh_window();
                           } else {
                            hunger_1(date.hunger,before_time);
                            // refresh_window();
                           }
                    }
                }
                    
                
        }
    })  
    .catch(function(error){
        console.log(error);
    });
      //重整pet現在狀態
      setTimeout(nowpet,1000);
}
function refresh_window()
{   //referesh_window
    window.location.reload();
}
    </script>
</body>
</html>
<?php

?>