<?php
/* PHP7+
   Write by hank9999
*/
$servername = "";
$username = "";
$password = "";
$dbname = "";

if (($_GET["boot"] != "send") && ($_GET["boot"] != "check") && ($_GET["boot"] != "received") && ($_GET["install"] != "yes")) {
	$conn = mysqli_connect($servername, $username, $password, $dbname); //创建连接
	if (mysqli_connect_errno()) {
        echo "数据库连接失败: " . mysqli_connect_error() . "<br>"; //返回报错
    } else {
		echo "<!DOCTYPE html><html><body><p>Server OK</p><br><a href=\"./remote.php?boot=send\"><input type=\"button\" value=\"BOOT\"></a></body></html>";
    }
	
	mysqli_close($conn);
}

if ($_GET["boot"] == "send") {
    $conn = mysqli_connect($servername, $username, $password, $dbname); //创建连接
    // 检测连接
    if (mysqli_connect_errno()) {
        echo "Connect_Failed"; //返回报错
    } else if (mysqli_query($conn, "UPDATE boot SET is_boot=1")) {		//更新数据库内容
		echo "Send OK"; //返回成功
	} else {
		echo "Send Failed"; //返回失败
	}
	
	mysqli_close($conn);
}

if ($_GET["boot"] == "check") {
    $conn = mysqli_connect($servername, $username, $password, $dbname); // 创建连接
    // 检测连接
    if (mysqli_connect_errno()) {
        echo "Connect_Failed"; //返回报错
    } else {
		$result = mysqli_query($conn, "SELECT is_boot FROM boot");
        if (mysqli_num_rows($result) > 0) {
            // 输出数据
            while($row = mysqli_fetch_assoc($result)) {
                $row["is_boot"];
            }
        } else {
            echo "0";
        }
	}
	
	mysqli_close($conn);
}

if ($_GET["boot"] == "received") {
	$conn = mysqli_connect($servername, $username, $password, $dbname); //创建连接
    // 检测连接
    if (mysqli_connect_errno()) {
        echo "Connect_Failed"; //返回报错
    } else if (mysqli_query($conn, "UPDATE boot SET is_boot=0")) { //更新数据库内容
			echo "Update_OK"; //返回成功
		} else {
			echo "Update_Failed"; //返回失败
		}
	
	mysqli_close($conn);
}

if ($_GET["install"] == "yes") {
	$conn = mysqli_connect($servername, $username, $password, $dbname); //创建连接
    // 检测连接
    if (mysqli_connect_errno()) {
        echo "数据库连接失败: " . mysqli_connect_error() . "<br>"; //返回报错
    } else {
		$result = $conn->query("SELECT * FROM boot");
		if (mysqli_affected_rows($conn) > 0) {
			echo "请勿重复安装！";
		} else if (mysqli_affected_rows($conn) == 0) {
			echo "未完全安装<br>正在继续安装过程<br>";
			if (mysqli_query($conn, "INSERT INTO boot (is_boot) VALUES ('0')")) { //插入数据
				echo "数据插入成功<br>";
			} else {
				echo "数据插入失败: " . mysqli_error($conn) . "<br>";
			}
			echo "安装完成<br>";
		} else {
			echo "正在安装<br>";
			if (mysqli_query($conn, "CREATE TABLE boot (is_boot INT(1))")) { //创建数据表
				echo "数据表创建成功<br>";
			} else {
				echo "创建数据表错误: " . mysqli_error($conn) . "<br>";
			}
			if (mysqli_query($conn, "INSERT INTO boot (is_boot) VALUES ('0')")) { //插入数据
				echo "数据插入成功<br>";
			} else {
				echo "数据插入失败: " . mysqli_error($conn) . "<br>";
			}
			echo "安装完成<br>";
		}
	}
	
	mysqli_close($conn);
}

?>