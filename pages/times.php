<?php
	include_once('../include/config.php');
	$nonexists = 0;
	$fileList = glob("../FM/FMExport/*");
	if (is_array($fileList))
	{
		echo "<center>Premium User Lists Available: ".count($fileList)." / 9<br></center>";
		foreach($fileList as $folder)
		{
 			if(is_dir($folder))
 			{
  				//echo "<li>".basename($folder)."</li>";
				if(file_exists($folder. "/Channel1.txt"))
				{
					$f = fopen($folder. "/Channel1.txt", 'r');
					$line = fgets($f);
					fclose($f);
					$line = explode("%&", $line);
					$listTime = $line[0];
  					//echo "<li>".$line[0]."</li>";
					$maxTimeDiff = 30;
					$listd1 = strtotime($listTime);
					$listd2 = strtotime($date);
					$listDiff = round(abs($listd1 - $listd2) / 60, 2);
					$ListInfoEcho = "<li>".basename($folder)." - Updated $listDiff</b> minute(s) ago.</li>";
					if($listDiff > $maxTimeDiff)
					{
						echo"<font color=red>";
						$ListInfoEcho = "<li>*".basename($folder)." - Updated <b>$listDiff</b> minutes ago.";
					}
					if($listDiff <= 10)
					{
						echo"<font color=green>";
					}

					echo $ListInfoEcho;
					if($listDiff > $maxTimeDiff || $listDiff <= 10)
					{
						echo"</font>";
					}
				}else{
					$nonexists++;
					if($nonexists >= 9){
						echo "Please wait while the list populates... in approximately 2 minutes.";
					}
				}
 			}
		}
	}else{
		echo "<font color=red><center>List(s) for premium users are currently unavailable either due to maintaince or downtime.</center></font>";
	}
?>