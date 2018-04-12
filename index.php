<!DOCTYPE HTML>
<html>
<head>
    <!--BEGIN HEAD MATE-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="initial-scale=1.0,width=device-width"/>
    <meta name="keywords" content="ZHIHUA·WEI,文件查找系统">
    <meta name="description" content="文件查找系统,PHP开发,ZHIHUA· WEI">
    <meta name="author" content="ZHIHUA·WEI">
    <meta name="version" content="1.0.0">
    <!--END HEAD MATE-->

    <!--BEGIN HEAD LINK SHORTCUT ICON-->
    <link rel="shortcut icon" href="images/icon/zhihuawei_favicon32x32.ico">
    <!--END HEAD LINK SHORTCUT ICON-->

    <!--BEGIN HEAD LINK STYLE-->
    <!--BASE STYLE CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
    <!--PRODUCTION PHOTO CSS-->
    <link rel="stylesheet" href="css/productionPhoto.css" type="text/css" media="screen"/>
    <!--PRINT CSS-->
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print"/>
    <!--END HEAD LINK STYLE-->

    <!--BEGIN HEAD TITLE-->
    <title>文件查找系统-ZHIHUA·WEI</title>
    <!--END HEAD TITLE-->
</head>
<body>

<!--BEGIN STICKER-->
<div id="sticker"></div>
<!--END STICKER-->

<!--BEGIN WRAPPER-->
<div id="wrapper">

    <!--CONTACT TITLE-->
    <h2 id="contact" class="sectionHead">文件查找系统</h2>
    <!--CONTACT FORM-->
    <div id="contactform" class="contact">
        <form action="sendMail.php" method="post">
            <div id="contactInfo">
                <h3 style="line-height: 50px;">
                    <label class="smallInput" for="name">文件查找(注意区分大小写) <span class="required">*</span></label><br/>
                </h3>
                <p>
                    <label class="smallInput" for="path">路径(如:F:/WeiCMS)： <span class="required">*</span></label><br/>
                    <input type="text" name="path" id="path" value="" placeholder="F:/WeiCMS" class="input round3"/>
                </p>
                <p>
                    <label class="smallInput" for="file">文件名：</label><br/>
                    <input type="text" name="file" id="file" value="" placeholder="weicms.png" class="input round3"/>
                </p>
            </div>
            <p id="emailMessage">
                <label class="smallInput" for="message"> 查找结果 <span class="required">*</span></label><br/>
                <textarea name="message" id="message" class="input round3"></textarea>
            </p>            
            <input name="send" id="submit_btn" onclick="submit_variation()" type="submit" class="round3 clearRight" value="FIND FILE"/>
        </form>
		
    </div>
	
    <div class="clear"></div>
</div>
<!--END WRAPPER-->
<!--COPYRIGHT-->
<div id="copyright">&copy; 2017 - Designed and developed by
    <a href="http://resume.zhihuawei.xyz/" target="_blank" title="ZHIHUA·WEI">ZHIHUA·WEI</a>
</div>
<!--END COPYRIGHT-->

<!--BEGIN SCRIPTS-->
<!--BASIC JQUERY JS-->
<script src="js/jquery.js"></script>
<!--PROJECT PHOTO JS-->
<script src="js/projectPhoto.js"></script>
<!--BACK POSITION JS-->
<script src="js/backPosition.js"></script>
<!--CUSTOM JS-->
<script src="js/custom.js"></script>
<!--INLINE JS-->
<script>

/**
 * 提交验证
 *
 *
 */
function submit_variation(){
	var path = $("#path").val();
	var file = $("#file").val();
	console.log(file);
	
	if (path == '') {
        alert("请填写磁盘绝对路径");
		$("#path").focus();
		return false;
    }
	
	if(file == ''){
		alert("请填写所查找文件名");
		$("#file").focus();
		return false;
	}	
}
</script>
<!--END SCRIPTS-->

</body>
</html>
<?php
$path = $_POST['path'];
$file = $_POST['file'];

if(!empty($path) && !empty($file)){
	echo "在路径 ".$path."/ 中查找 ".$file" 的结果为：<hr/>";
	$file_num = $dir_num = 0;
    $r_file_num = $r_dir_num= 0;
	
	/**
	 * 用于查找路径下的所有文件夹和文件
	 * @param $dirName string 路径
	 */
	function SearchDirAndFile( $dirName ){
        if ( $handle = @opendir( "$dirName" ) ) {
            while ( false !== ( $item = readdir( $handle ) ) ) {
                if ( $item != "." && $item != ".." ) {
                    if ( is_dir( "$dirName/$item" ) ) {
                        SearchDirAndFile( "$dirName/$item" );
                    } else {
                        $GLOBALS['file_num']++;
                        if(strstr($item,$GLOBALS['findFile'])){
                            echo " <span><b> $dirName/$item </b></span><br />\n";
                            $GLOBALS['r_file_num']++;
                        }
                    }
                }
            }
            closedir( $handle );
            $GLOBALS['dir_num']++;
            if(strstr($dirName,$GLOBALS['findFile'])){
                $loop = explode($GLOBALS['findFile'],$dirName);
                $countArr = count($loop)-1;
                if(empty($loop[$countArr])){
                    echo " <span style='color:#297C79;'><b> $dirName </b></span><br />\n";
                    $GLOBALS['r_dir_num']++;
                }
            }
        }else{
            die("没有此路径！");
        }
    }	
	//这是一个很好
	
}else{
	echo "路径地址输入错误或文件名输入错误";
}


?>

