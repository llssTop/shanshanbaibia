{__NOLAYOUT__}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>消失在宇宙星空中的404页面</title>
    <link href="__HCSS_PATH__404.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="fullScreen" id="fullScreen">
    <img class="rotating" src="http://www.jq22.com/demo/jQuery-40420160406/images/spaceman.svg" />
    <canvas id="canvas2d"></canvas>
    </div>
<script type="text/javascript" src="jhttp://www.jq22.com/demo/jQuery-40420160406/js/jq22.js"></script>
<!-- 代码 结束 -->
    <div class="system-message">
        <?php switch ($code) {?>
        <?php case 1:?>

        <p class="success"><?php echo(strip_tags($msg));?></p>
        <?php break;?>
        <?php case 0:?>

        <p class="error"><?php echo(strip_tags($msg));?></p>
        <?php break;?>
        <?php } ?>
        <p class="detail"></p>
        <p class="jump">
            页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>
        </p>
    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),
                href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            },1000);
        })();
    </script>
</body>
</html>
