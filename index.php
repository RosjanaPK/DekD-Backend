<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="alert/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <title>Document</title>
</head>
<style>
    .body {
        background-color: white;
        display: inline-block;
        width: 100%;
    }

    .content {
        display: inline;
        text-align: center;

    }

    .head-text {
        color: #F85A18;
        font-size: 2vw;
        font-weight: bold;
        justify-items: center;
        justify-content: center;
    }

    .mid-content {
        width: 100%;
        display: inline-block;
    }

    .middle,
    .top {
        display: inline-block;
        left: 50%;
        width: 50%;
        text-align: left;

    }

    .middle {
        border-style: outset;

    }

    .css {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom: #FEFDFC ridge;
        background-color: #FFFFFF;
        width: 100%;
    }

    .num {}
</style>

<body>
    <?php

    $headname = "";
    $name = "หัวข้อกระทู้";
    $contentErr = "";
    $content = "";
    $saveContent = "";
    $nameErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["headname"])) {
            $nameErr = "* ใส่หัวข้อกระทู้";
        } else {
            $length = strlen(($_POST["headname"]));
            if ($length <= 140 && $length >= 4) {
                $check = valid_input_hname(($_POST["headname"]));
                if($check  == false){
                    $nameErr = "* ชื่อกระทู้จะไม่อนุญาตให้ใส่ HTML";

                }else{
                    $headname = $check;
                }
                
            } else {
                $nameErr = "* ชื่อกระทู้ต้องยาว 4-140 ตัวอักษร";
            }
        }
        if (empty($_POST["content"])) {
            $contentErr = "* ใส่เนื้อหากระทู้";
        } else {
            $length = strlen(($_POST["content"]));
            if ($length <= 2000 && $length >= 6) {
                $saveContent = $_POST["content"];
                
                $content = valid_input_content(($_POST["content"]));
            } else {
                $contentErr = "* เนื้อหากระทู้ต้องยาว 6-2000 ตัวอักษร";
            }
        }
    }
    function valid_input_hname($data)
    {
        $processed = strip_tags($data);
        if ($processed != $data) return false;
        return $data;
    }
    function valid_input_content($data)
    {
        $processed = htmlentities($data);
        return $processed;
       
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="body">

            <div class="content">
                <p class="head-text">ตั้งกระทู้ใหม่</p>
                <div class="mid-content">
                    <div class="top">
                        <div style="display: inline-block; border-right: double; padding-right: 5vw; color:#A69481; padding-left: 5vw; ">
                            <i style='font-size:24px; color:#A69481' class='fas'>&#xf304;</i>
                            <p style='color:#A69481;'> ปกติ</p>
                        </div>
                        <div style="display: inline-block; border-right: double; padding-right: 5vw; padding-left: 5vw; color:#A69481">
                            <i style='font-size:24px; color:#A69481' class='fas'>&#xf03e;</i>
                            <p style='color:#A69481'>รูปภาพ</p>
                        </div>
                        <div style="display: inline-block; border-right: double; padding-right: 5vw; padding-left: 5vw; color:#A69481">
                            <i style='font-size:24px; color:#A69481' class='fas'>&#xf201;</i>
                            <p style='color:#A69481'>โพลล์</p>
                        </div>
                        <div style="display: inline-block; padding-left: 5vw; color:#A69481">
                            <i style='font-size:24px; color:#A69481' class='fas'>&#xf086;</i>
                            <p style='color:#A69481'>โต้วาที</p>
                        </div>
                    </div>
                    <div class="middle">
                        <div>
                            <input class="css" type="text" name="headname" style="font-size: 2vw; " placeholder="หัวข้อกระทู้" value="<?php echo $headname; ?>"><span class="error" style="color: red; font-size: 1vw;"> <?php echo $nameErr; ?></span>

                        </div>
                        <div>
                            <div>
                                <p class="" type="text" name="" style="display: inline; font-size: 1vw;" placeholder="เนื้อหากระทู้"><?php echo $name; ?></p>
                                <p class="num" style="display: inline;;"><span class="error" style=" color: red; font-size: 1vw; float:right; padding-right: 0.5vw"> <?php echo $contentErr; ?></span></p>
                            </div>

                            <div style="display: block;">

                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086;</i> Source</p>
                                <p style=" display: inline; border-style:ridge; padding-left: 1vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086; &#xf086; &#xf086; &#xf086; &#xf086; &#xf086;</i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 1vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086; &#xf086; &#xf086; &#xf086;</i></p>

                            </div>
                            <div style="display: block; margin-top: 0.5vw">

                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086; &#xf086; &#xf086;</i></p>
                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086; &#xf086; &#xf086;</i></p>
                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086; &#xf086;</i></p>
                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; </i></p>
                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; &#xf086;</i></p>
                                <p style=" display: inline; border-style:ridge;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf086; </i></p>
                            </div>
                            <div style="height: 25vw; border-style:ridge; ">
                                <textarea class="css" type="text" name="content" style="height: 100%" placeholder="" value="<?php echo $content; ?>"><?php echo $saveContent; ?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" value="Submit">


    </form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $headname;
    echo "<br>";
    echo html_entity_decode($saveContent);

    ?>

</body>

</html>