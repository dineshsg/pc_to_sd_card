<html>
<head>
	<title>Access Page</title>
</head>
<link href="css/customize.css" rel="stylesheet" type="text/css" />

<body>
	<div class="page-content wrap push">
	<div class="header clearfix">
	<div class="logo"> <a href="index.html"> <img src="images/logo.png" /> </a> </div></div>
	<?php
		include 'connect.php';
		$dir_name = $_GET['dir_name'];
		$filelist = ftp_rawlist($ftp_conn, $dir_name);
		$j=0;
		foreach ($filelist as $child){ 
			$chunks = preg_split("/\s+/", $child); 
			@list($item['rights'], $item['number'], $item['user'], $item['group'], $item['size'],$item['month'], $item['day'], $item	['time'], $item['filename']) = $chunks; 
			@$item['type'] = $chunks[0]{0} === 'd' ? 'directory' : 'file'; 
			@array_splice($chunks, 0, 8); 
			@$items[implode(" ", $chunks)] = $item; 
		} 
		if($items){
			echo "<div class='select-file data'><h1> Applications </h1><ul class='clearfix'>";
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
									if(($l!='var')&&($l!='www')&&($l!='html'))
									{
					                	echo "<a href='system_access.php?dir_name=".$b."'>".$l."&nbsp;&nbsp;>></a>";
									}
            					}
					            $b .= '/';
         					}
							echo "</div>";
							$count++;
						}
						else{}
						if(is_dir($dir_name."/".$vv)){
							echo "<li>
									<span class='li-folder'>
										<input type='checkbox' name='employee' class='checkbox folder' value='".$dir_name.'/'.$vv."' />
									</span>
									<label class='file-name' for='employee'> ".$vv." </label>
								  </li>";
						}
						else{
							echo "<li>
									<span class='li-bg'>
										<input type='checkbox' name='employee' class='checkbox file' value='".$dir_name.'/'.$vv."' />
									</span>
									<label class='file-name' for='employee'> ".(strlen($vv)>15?substr($vv,0,10).'...':$vv)." </label>
								  </li>";
						}
					}
					$j++;
				}
			}
			echo '</ul>';
		}
		else{
			echo "<div style='clear:both;'>No More Directories</div>";
		}
		echo "<input type='button' class='buttons copy' onClick='getCheckedCheckboxesFor(\"employee\");' value='Copy' />";

?>
</div>
<div class="loading_ini" id="loading_ini"><img src ="images/loading_ini.gif"><p>Transferring . . .</p></div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
function getCheckedCheckboxesFor(checkboxName) {
    var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el){
        values.push(el.value);
    });
    
    if(values.length > 0 )
    {
	document.getElementById('loading_ini').style.display = "block";
	media_url = window.top.media.document.getElementById("media_url").value;
        window.location="transfer.php?system_path='"+values+"'&media_path='"+media_url+"'";
    }
    else
    {
    }
    
}

$(document).ready(function() {
$(".file").change(function() {
    if(this.checked) {
      $(this).parent('span').css('background-image', 'url(images/file-hover.png)');
    }
    else{
      $(this).parent('span').css('background-image', 'url(images/file.png)');
    }
});
$(".folder").change(function() {
    if(this.checked) {
     $(this).parent('span').css('background-image', 'url(images/folder-hover.png)');
    }
    else{
      $(this).parent('span').css('background-image', 'url(images/folder.png)');
    }
});

});
</script>
</html>
