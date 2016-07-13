<title>Operation</title>
<?php
date_default_timezone_set('prc');
$operation=$_GET['op'];
$rdrownum=$_GET['row'];

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];



if ($operation=='w') {
/*debug
	echo date('Y-m-d H:i');
	echo $msg;
*/

	//$msg = htmlspecialchars($_POST["guestword"]);
	$msg = $_POST["guestword"];
	$order=array("\r\n","\n","\r");
	$msg=str_replace($order, '<br/>', $msg);
	$order=",";
	$msg=str_replace($order, '，', $msg);

	$fh = fopen("./msg.txt", 'a');
	fwrite($fh, date('Y-m-d H:i').",".$msg."\n");
	fclose($fh);
//	echo "留言成功,现在返回";
	header('Location: '.$uri.'/gtd/');
 		}


	elseif($operation=='d') {
	$row=0;
	//echo '即将删除第'.$rdrownum.'行';
	$fh = fopen("./msg.txt", 'r');
	$msgsteam=array();

	while (($data=fgetcsv($fh))!==FALSE) {
		$row++;	
		$msgsteam[$row*2-1]=$data[0];
		$msgsteam[$row*2]=$data[1];	
		}
	fclose($fh);

echo "一共有".$row."行<br/>";
echo "需要删除第".$rdrownum."行<br/>";
echo "msgsteam数组有".sizeof($msgsteam)."个成员<br/>";

$fh = fopen("./msg.txt", 'w');
$fh2 = fopen("./done.txt",'a');

	for($i=1;$i<=$row;$i++) {
		if($rdrownum!=$i) {
			//echo $msgsteam[$i].",".$msgsteam[$i+1]."<br>";
			fwrite($fh, $msgsteam[$i*2-1].",".$msgsteam[$i*2]."\n");
		}
		else {
			fwrite($fh2,$msgsteam[$i*2-1].",".$msgsteam[$i*2]."\n");
		}

	}

	fclose($fh);
	fclose($fh2);
	header('Location: '.$uri.'/gtd/');

	}

 	else
 	{
	header('Location: '.$uri.'/gtd/');
	 }



  ?>