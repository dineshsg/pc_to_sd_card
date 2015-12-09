<html>
<head>
<title>
</title>
<body>
<div style='margin-top:5%;'>
<div id="progress" style="width:500px;border:1px solid #ccc;margin:0px auto 0px auto;"></div>
<div id="information" style="text-align:center;"></div>
<?php
	include 'config.php';
	$total = 100; 
	$system_url = str_replace('\'', '', $_GET['system_path']);
	$media_url = str_replace('\'', '', $_GET['media_path']);
	$type = explode(",", $system_url);
	foreach($type as $key => $value){
		if(is_dir($value)){
			echo shell_exec('sudo '.$doc_root.'/root.sh d '.$value.' '.$media_url);		
			sleep(15);
		}
		else{
			echo shell_exec('sudo '.$doc_root.'/root.sh f '.$value.' '.$media_url);
			sleep(15);
		}
	}
	for($i=1; $i<=$total; $i++){
		$percent = intval($i/$total * 100)."%";
		echo '<script language="javascript">
		document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;background-image:url(images/pbar-ani.gif);\">&nbsp;</div>";
		document.getElementById("information").innerHTML="'.$i.' % copied.";
		</script>';
		echo str_repeat(' ',1024*64);
		flush();
		sleep(1);
	}
	
	echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
	echo '<script language="javascript">document.location ="http://localhost/bftp/system_access.php?dir_name=/home/shotformats";</script>';
?>
</div>
</body>
</html>
