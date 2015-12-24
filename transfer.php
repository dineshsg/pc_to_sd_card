<html>
<head>
<title>
</title>
<link href="css/customize.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style='margin-top:5%;'>

<div id="information" style="text-align:center;"></div>

<div class="loading"><img src ="images/loading.gif"><p>Transferring . . .</p></div>
<?php
	include 'config.php';
	$system_url = str_replace('\'', '', $_GET['system_path']);
	$media_url = str_replace('\'', '', $_GET['media_path']);
	$type = explode(",", $system_url);
	foreach($type as $key => $value){
		if(is_dir($value)){
			shell_exec('sudo '.$doc_root.'/root.sh d '.$value.' '.$media_url);		
			sleep(15);
		}
		else{
			shell_exec('sudo '.$doc_root.'/root.sh f '.$value.' '.$media_url);
			sleep(15);
		}
	}
	/*echo '<script language="javascript">document.location ="http://10.10.10.10:8080/bftp/system_access.php?dir_name=".$system_path."</script>';*/
	header('Location: http://10.10.10.10:8080/bftp/system_access.php?dir_name='.$system_path);
?>
</div>
</body>
</html>
