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
						if(is_dir($dir_name."/".$vv)){
							echo "<li>
									<span class='li-bg'>
										<input type='checkbox' name='employee' class='checkbox' value='".$dir_name.'/'.$vv."' />
									</span>
									<a href='#'><label class='file-name' for='employee'> ".(strlen($vv)>15?substr($vv,0,15).'...':$vv)." </label></a>
								  </li>";
						}
						else{
							echo "<li>
									<span class='li-bg'>
										<input type='checkbox' name='employee' class='checkbox' value='".$dir_name.'/'.$vv."' />
									</span>
									<label class='file-name' for='employee'> ".(strlen($vv)>15?substr($vv,0,15).'...':$vv)." </label>
								  </li>";
						}
					}
					$j++;
				}
			}
			echo '</ul>';
		}
		else{
			echo "<div>No More Directories</div>";
		}
		echo "<input type='button' class='buttons copy' onClick='getCheckedCheckboxesFor(\"employee\");' value='Copy' />";
?>
</div>
</body>
<script type="text/javascript">
function getCheckedCheckboxesFor(checkboxName) {
    var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el){
        values.push(el.value);
    });
	//return values;
    media_url = window.top.media.document.getElementById("media_url").value;
	window.location="transfer.php?system_path='"+values+"'&media_path='"+media_url+"'";
	var page = "http://localhost/bftp";

	var $dialog = $('<div></div>')
			   .html('<iframe style="border: 0px; " src="' + page + '" width="100%" height="100%"></iframe>')
               .dialog({
                   autoOpen: false,
                   modal: true,
                   height: 625,
                   width: 500,
                   title: "Some title"
               });

}
$dialog.dialog('open');
</script>
</html>
