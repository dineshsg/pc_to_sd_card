<html>
	<head>
		<title>Access Page</title>
	</head>
<link href="css/customize.css" rel="stylesheet" type="text/css" />
<body>
	<div class="page-content wrap push">
	<form id='form' name='form' method='post' action=''>
	<input type="hidden" id='url' name="system_url">
	<?php
		include 'connect.php';
		include 'config.php';
		$dir_name = $_GET['dir_name'];
		echo "<input type='hidden' id='media_url' name='media_url' value='$dir_name'>";
		$filelist = ftp_rawlist($ftp_conn, $dir_name);
		foreach ($filelist as $child){ 
			$chunks = preg_split("/\s+/", $child); 
			@list($item['rights'], $item['number'], $item['user'], $item['group'], $item['size'],$item['month'], $item['day'], $item['time'], $item['filename']) = $chunks; 
			@$item['type'] = $chunks[0]{0} === 'd' ? 'directory' : 'file'; 
			@array_splice($chunks, 0, 8); 
			@$items[implode(" ", $chunks)] = $item; 
		} 
		echo "<div class='folder-grp clearfix'><h2> Device Folders </h2><div class='copy-reset-btn'>";
		if($dir_name!=$media_path){
			echo"<input type='button' value='Back' class='buttons' id='back'/>";
		}
		//$path = realpath('/media/sd-card/');
		$filesize = count(glob('/media/sd-card/*'));
		if($filesize <= 0)
		{
			echo "<input type='button' value='Connect' class='buttons' id='connect'/>";
		}
		else
		{
			echo "<input type='button' value='Disconnect' class='buttons' id='disconnect'/>";
		}
		echo "<input type='reset'  value='Refresh' class='buttons refresh'/></div>";

		if($items){
			echo "<div class='folder-name'> <div class='device-folders'>";
			foreach($items as $key => $cell){
				foreach($cell as $kk => $vv){
					if($kk=='filename'){
						if($count==0){
							$temp_url = $dir_name."/".$vv;
							$b = '';
        					$links = explode('/',rtrim($temp_url,'/'));
						array_pop($links);
						echo "<div class='breadcrumb'>";
					        foreach($links as $l){
					            $b .= $l;
					            if($url == $b){
					                echo $l;
					            }else{
					                echo "<a href='media_access.php?dir_name=".$b."'>".$l."&nbsp;&nbsp;>></a>";
            					}
					            $b .= '/';
         					}
							echo "</div>";
							$count++;
						}
						else{}
						if(is_dir($dir_name.'/'.$vv)){
							echo "<a href='media_access.php?dir_name=$dir_name/$vv'>$vv</a>";
						}
						else{
							echo "<a href='media_access.php?dir_name=$dir_name/$vv'>$vv</a>";
						}
					}
				}
			}
		echo "</div></div>";
		}
		else{
			echo "<div style='clear:both;'>No More Directories</div>";
		}
		echo $temp;
?>
</form>
	<div class="footer">© 2015 Shotformats Digital Productions Private Limited.</div> 
	</div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript"> 
$(document).ready(function() {
	//$("#disconnect").hide();
	$( ".refresh" ).click(function() {
		location.reload(true);
	});
	$( "#back" ).click(function() {
		$(location).attr('href','media_access.php?dir_name=/media');
	});
	$("#connect").click(function(){
		//$("#connect").hide();
		//$("#disconnect").show();
		$.ajax(
		{
		 url:'http://10.10.10.10:8080/bftp/media-connect.php',
		 success:function(){alert("Hi");location.reload(true);}
		});
	});
	$("#disconnect").click(function(){
		//$("#disconnect").hide();
		//$("#connect").show();
		$.ajax(
		{
		 url:'http://10.10.10.10:8080/bftp/media-disconnect.php',
		 success:function(){location.reload(true);}
		});
	});
});
</script>
</html>
