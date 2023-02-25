<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="alert/dist/sweetalert-dev.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <title>DekD</title>
</head>
<style>
    body {
        font-family: 'Sarabun', sans-serif;
    }

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

    input::placeholder {
        font-weight: bold;
    }

    .showContent {
        display: inline;
        text-align: center;

    }

    .line {
        word-wrap: break-word;
        white-space: pre-wrap;
    }
</style>

<body>

    <?php

    $headname = "";
    $name = "เนื้อหากระทู้";
    $contentErr = "";
    $content = "";
    $saveContent = "";
    $nameErr = "";
    $loggedin = true;
    $checkerrName = false;
    $checkerrCon = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["headname"])) {
            $nameErr = "* ใส่หัวข้อกระทู้";
            $checkerrName = false;
        } else {
            $length = mb_strlen(($_POST["headname"]));
            if ($length <= 140 && $length >= 4) {
                $check = valid_input_hname(($_POST["headname"]));
                if ($check  == false) {
                    $nameErr = "* ชื่อกระทู้จะไม่อนุญาตให้ใส่ HTML";
                    $checkerrName = false;
                } else {
                    $headname = $check;
                    $checkerrName = true;
                }
            } else {
                $nameErr = "* ชื่อกระทู้ต้องยาว 4-140 ตัวอักษร";
                $checkerrName = false;
            }
        }
        if (empty($_POST["content"])) {
            $contentErr = "* ใส่เนื้อหากระทู้";
            $checkerrCon = false;
        } else {
            $length = mb_strlen(($_POST["content"]));
            if ($length <= 2000 && $length >= 6) {
                $saveContent = $_POST["content"];
                $content = valid_input_content(($_POST["content"]));
                $checkerrCon = true;

            } else {
                $contentErr = "* เนื้อหากระทู้ต้องยาว 6-2000 ตัวอักษร";
                $checkerrCon = false;

            }
        }
        if($checkerrCon === true && $checkerrName === true){
            $loggedin = false;
        }else if($checkerrCon === false || $checkerrName === false){
            $loggedin = true;
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
                            <div style="margin-bottom: 0.5vw;">
                                <p class="" type="text" name="" style="display: inline; font-size: 1vw;" placeholder="เนื้อหากระทู้"><?php echo $name; ?></p>
                                <p class="num" style="display: inline;;"><span class="error" style=" color: red; font-size: 1vw; float:right; padding-right: 0.5vw"> <?php echo $contentErr; ?></span></p>
                            </div>

                            <div style="display: block;">

                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'> &#xf1c9;</i> Source</p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf0c4; &#xf24d; &#xf15c; &#xf1c3; &#xf1c2; &#xf3e5; &#xf064;</i> </p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481; padding: 0.5 vw' class='fas'>&#xf03e; &#xf674; &#xf328; &#xf008; &#xf118;</i> </p>

                            </div>
                            <div style="display: block; margin-top: 0.5vw">

                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf032; &#xf033; &#xf0cd; &#xf034;</i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf036; &#xf037; &#xf038; &#xf039;</i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf0c1; &#xf127; &#xf02b;</i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"> size <i style='font-size:16px; color:#A69481' class='fas'>&#xf150; </i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf031; 	&#xf891;</i></p>
                                <p style=" display: inline; border-style:ridge; padding-left: 0.5vw; padding-right: 0.5vw;"><i style='font-size:16px; color:#A69481' class='fas'>&#xf0b2; </i></p>
                            </div>
                            <div style="height: 25vw; border-style:ridge; ">
                                <textarea class="css" type="text" name="content" style="height: 100%" placeholder="" value="<?php echo $content; ?>"><?php echo $saveContent; ?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <p style="justify-items: center; justify-content: center; ">
                    <input style="border-radius: 12px;  cursor: pointer; border-style: bold; border-color: #F85A18 ; background-color: #F85A18; color: white;" type="submit" name="submit" value="Submit">
                </p>

            </div>
        </div>



    </form>
    <?php if($loggedin===false){?>

    <div class="body">
        <div class="showContent">
            <div style="margin-top: 2vw">
                <p style="font-size: 2vw;"><?php echo "กระทู้ของคุณ" ?></p>
                <div style="width: 50%; height: 50%; display: inline-block; background-color: white; border-style: outset; border-color: #8F785F;">
                    <div style="background-color: #E7996C; height: 15%">
                        <div style="background-color: #E7996C; color:#FFFFFF; font-size: 2vw;"><?php echo $headname ?></div>
                    </div>
                    <div class="line" style="width: 100%; text-align: left; margin-left:0.1vw;">
                        <?php echo $saveContent ?>

                    </div>
                </div>

            </div>

        </div>
    </div>
<?php }?>


</body>

</html>