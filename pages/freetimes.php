<?php		
	include_once('../include/config2.php');
	$nonexists = 0;
	$fileList = glob("../FM/FMExport2/*");
	if (is_array($fileList))
	{
		if($refreshEnabled == 0)
		{
			echo "<font color='red'>------ FREE LIST REFRESH DISABLED ------</font>";
		}else{
			echo "Free Lists Available: ".count($fileList)." / 9 -- Last Refreshed: $lastFreeOwlRefresh";
		}
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
				}
 			}
		}
	}else{
		if($refreshEnabled == 0)
		{
			echo "<font color='red'>List(s) for free-registered users are currently disabled and offline. Please check back later.</font>";
		}
		else
		{
			echo "<font color=red>List(s) for free-registered users are currently unavailable either due to maintaince, downtime or deletion. </font>";
		}
	}
?>