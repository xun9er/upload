<?php
    header("Content-type: text/html; charset=utf-8");
	include('../include/config.inc.php');
	$type = explode(",",$config['upload_file_type']);
    $uploadurl = $config['url']."/".$config['upload_dir'];
   
    function fileext($filename)
    {
        return substr(strrchr($filename, '.'), 1);
    }
	function random($length)
    {
        $hash = 'CELIVE-';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
            for($i = 0; $i < $length; $i++)
            {
                $hash .= $chars[mt_rand(0, $max)];
            }
        return $hash;
    }


	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(!in_array(strtolower(fileext($_FILES['fileToUpload']['name'])),$type))
	{
		$text=implode(",",$type);
		$error = "<?php echo $lang[file_type_error]?>".$text;
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " <?php echo $lang[file_name]?> " . $_FILES['fileToUpload']['name'] . ", ";
			//$msg .= " 文件大小- " . @filesize($_FILES['fileToUpload']['tmp_name']);
			$filename=explode(".",$_FILES['fileToUpload']['name']);
			$filename[0]=random(10); 
            $name=implode(".",$filename);
			$uploadfile = "../".$config['upload_dir'].$name;
			if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$uploadfile))
			{            

				$uploadfileurl = $uploadurl.$name;
				$msg .= " <?php echo $lang[file_location]?> <a href='".$uploadfileurl."' target='_blank'>".$name."</a>";
			}else{
				$error = "<?php echo $lang[upload_failed]?>";

            }

			@unlink($_FILES['fileToUpload']);		
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>