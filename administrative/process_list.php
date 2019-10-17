<?php
include_once('../include/config2.php');
if($adminStatus <= 0)
{
	echo "<script>top.location = 'home.php?p=index';</script>";
}else{

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!isset($loginCookie) || !isset($passwordCookie))
		die("Your login session has expired. Please refresh the page.");
	$time = $_POST['time'];
	$userID = $_POST['users'];
	$currentDate = date('Y-m-d H:i:s');
	$query = mysql_query("SELECT * FROM accounts WHERE LoginID = '$loginCookie'");
	$data = mysql_fetch_array($query);
	if($data['Admin'] >= '1')
	{	
		if(isset($_POST['refreshFreeList']))
		{
			if($data['Admin'] > 1)
			{
				mysql_query("UPDATE administrative SET lastOwlRefresh = '$currentDate'");
				$src = "../FM/FMExport/";
				$dst = "../FM/FMExport2/";
				recursiveDelete($dst);
				recurse_copy($src, $dst);
				die("Success");
			}
			else
			{
				die("You do not have permission to use this function.");
			}
		}
		elseif(isset($_POST['enableFree']))
		{
			if($data['Admin'] > 1)
			{
				mysql_query("UPDATE administrative SET enableRefresh = '1'");
				die("Success");
			}
			else
			{
				die("You do not have permission to use this function.");
			}
		}
		elseif(isset($_POST['disableFree']))
		{
			if($data['Admin'] > 1)
			{
				mysql_query("UPDATE administrative SET enableRefresh = '0'");
				die("Success");
			}
			else
			{
				die("You do not have permission to use this function.");
			}
		}
		elseif(isset($_POST['disableFreeandDelete']))
		{
			if($data['Admin'] > 1)
			{
				mysql_query("UPDATE administrative SET enableRefresh = '0'");
				$dst = "../FM/FMExport2/";
				recursiveDelete($dst);
				die("Success");
			}
			else
			{
				die("You do not have permission to use this function.");
			}
		}
	}
	else
	{
		die("You do not have the correct permissions to use this function.");
	}
}


}


function recursiveDelete($str){
        if(is_file($str)){
            return @unlink($str);
        }
        elseif(is_dir($str)){
            $scan = glob(rtrim($str,'/').'/*');
            foreach($scan as $index=>$path){
                recursiveDelete($path);
            }
            return @rmdir($str);
        }
    }


function recurse_copy($src,$dst) 
{
    
	$dir = opendir($src); 
    
	@mkdir($dst); 
    
	while(false !== ( $file = readdir($dir)) ) 
	{ 
        
		if (( $file != '.' ) && ( $file != '..' )) 
		{ 
            
			if ( is_dir($src . '/' . $file) ) 
			{ 
                
				recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            
			} 
            
			else 
			{ 
                
				copy($src . '/' . $file,$dst . '/' . $file); 
            
			} 
        
		} 
    
	} 
    
	closedir($dir); 

}



?>