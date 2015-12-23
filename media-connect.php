<?php
include 'connect.php';
include 'config.php';
$dir = '/dev/disk/by-uuid/';
$filelist = scandir($dir);
$media = '/media/sd-card/';
foreach($filelist as $key => $value)
{
	if((strlen($value)==9)&&(strlen($value)<10))
	{
		$final = $dir.$value;
		echo 'sudo '.$doc_root.'/root.sh t '.$final.' '.$media.$value.'<br>';
		shell_exec('sudo '.$doc_root.'/root.sh t '.$final.' '.$media.$value);
	}
	else
	{}
}
?>
