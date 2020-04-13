
<?php
$flag="";
if(isset($_GET["file"]))
{
$flag = $_GET["file"];
}
class xun
{	

    var $output = 'echo "ok";';
    function __destruct()
    {
        eval($this->output);
    }
}
file_exists($flag);
?>
<!DOCTYPE html>
<html>
<head>
	<title>pharmaceutical</title>
</head>
<body>
<a href="./upload.php">upload</a>
</body>
</html>