<head>
<title>Getting Things Done</title>


<style type="text/css">

div {
	margin: 0px;
	border-width: 0px;
	padding: 0px
}


#container {
	width: 650px;
	margin-top: 40px;
	margin-left: auto;
	margin-right: auto;
}

#topicon {
	background-image: url("./todo.png");
	background-origin: content;
	background-repeat: no-repeat;
	background-size: contain;
	width: 90px;
	height: 90px;
	margin-top: 20px;
	float: left;
}

#msgsendbox {
	float: left;
}

.msgtable {
	border-collapse:collapse;
}


.msgtable td {
	border-style: solid;
	border-width: 0px;
	border-color: #fa7d3c;
	padding: 0px;
	vertical-align: top;
	width: 550px;
}

.msgdiv {
	clear: left;
	width: 560px;
	padding: 10px;
	padding-left: 15px;
	padding-right: 15px;
	border-style: solid;
	border-width: 1px;
	border-color: #a0c0ff;
	margin-top: 4px;

}

#footer {
	width: 600px;
	text-align: center;
	color: grey;
	font-size: 12px;
}


table {
	border-collapse:collapse;
}

textarea {
	margin: 0px; 
	padding: 5px; 
	border-style: solid; 
	border-width: 1px; 
	border-color:#fa7d3c;
	font-size: 14px; 
	word-wrap: break-word; 
	line-height: 18px; 
	overflow-y: auto; 
	overflow-x: hidden; 
	outline: none;
	resize: none;
	width: 350px;
	height: 100px;
	}

.td-del {
	text-align: right;
	padding: 0px;
}

.td-del a {
	font-size:18px;
	color:lime;
	text-decoration: none;
}

.td-del a:visited {
	font-size:18px;
	color:lime;
}

.td-del a:hover {
	font-size:18px;
	color:red;
}


</style>

</head>
<body>
<div id="container">

<div id="topicon"></div>

<div id="msgsendbox">
<form action="./action.php?op=w" method="post">
<div style="color:#1b7fb6;font-size:18px;">今天需要完成什么事情?</div>
<textarea title="事项输入框" name="guestword" rows="5" cols="50"></textarea>
<button type="submit" style="width:105px;height:40px;padding:0px;border-width:0px;position:relative;top:-30px;left:20px;"><img src="./submit.jpg"></button>
</form>
</div>



<?php
//读取文件代码 
$fh = fopen("./msg.txt", 'r');
$row=0;
$msgsteam=array();


while (($data=fgetcsv($fh))!==FALSE) {
	$row++;
	//echo "<tr><td>".$data[0]."</td><td>".$data[1]."</td></tr>";
	$msgsteam[$row*3-2]=$data[0];
	$msgsteam[$row*3-1]=$data[1];
	$msgsteam[$row*3]=$data[2];
	//如果多列，需使用count($data)计算出列数
}

for ($i=$row;$i>0;$i--) { 

	if($msgsteam[$i*3-2]==0)
	{
	echo "<div class='msgdiv'><table class='msgtable'>";
	echo "<tr><td style='color:gray;font-size:10px;line-height:30px;vertical-align:top;'>".$msgsteam[$i*3-1]."</td>";
	echo "<td class='td-del'><a href='./action.php?op=d&row=".$i."'>完成</a></td></tr>";
	echo "<tr><td colspan='2'>".$msgsteam[$i*3]."</td></tr>";
	echo "</table></div>";
	}
}

for ($i=$row;$i>0;$i--) { 

	if($msgsteam[$i*3-2]!=0)
	{  
	echo "<div class='msgdiv'><table class='msgtable'>";
	echo "<tr><td style='color:gray;font-size:10px;line-height:30px;vertical-align:top;'>".$msgsteam[$i*3-1]."</td>";
	echo "<td style='color:red; text-align:right;font-size:12px;'>已完成</td></tr>";
	echo "<tr><td colspan='2'>".$msgsteam[$i*3]."</td></tr>";
	echo "</table></div>";
	}
}


fclose($fh);


 ?>


<div id="footer">
<br />
2016 Copyright Weihusan Power Build<br/>
<?php
$olddate = '2015-04-28'; 
$oldtime = strtotime($olddate);   
$passtime = time()-$oldtime; //经过的时间戳。   
echo '宝宝出生'.floor($passtime/(24*60*60)).'天了'.'<br />';   
?>
</div>

</div>
 </body>