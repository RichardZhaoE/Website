<?php
if(isset($_POST['queryString'])) {
	if(file_exists("../include/info/itemNames.txt"))
	{
		$list = array();
    		$export = file("../include/info/itemNames.txt", FILE_IGNORE_NEW_LINES);
   		$list = array_merge($list, $export); 
		$search = stripslashes($_POST['queryString']);
		$NA="No Suggestions";
		$NA2="No item database found";
		$count = 0;
		if ($search !== "")
		{
			$search=strtolower($search); 
			$len=strlen($search);
			foreach($list as $name)
			{ 
				if (stristr($search, substr($name,0,$len)))
				{ 
					$count = $count + 1;
					echo '<li onClick="fill2(\''.$name.'\');">'.$name.'</li>';
				}
			}
			if($count == 0)
			{
					echo '<li onClick="fill2(\'\');"><b>'.$NA.'</b></li>';
			}
		}

	}else{
		echo '<li onClick="fill2(\'\');"><b>'.$NA.'</b></li>';
	}
	
}else{

}
?>