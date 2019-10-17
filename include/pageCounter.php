
<div class="pageCounter">
<?php 
if($page != 1 && $page <= $maxPages)
{
	$nummm = $page - 1;
	print  "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$nummm\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>&laquo;</a> | ";
}
$counter = 0;
for ($x=1; $x<=$maxPages; $x++) 
{
	if($maxPages > 7)
	{
		if($x == $page)
		{
			if($x != $maxPages)
				echo "$x  | ";
			else 
				echo "$x";
		}else{
			if($page - 3 < $x && $x < $page + 3)
			{
				$counter = 0;
				if($x == $page + 2)
					print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a>";
				else
					print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a> | ";	
			}else if($x == 1){
				print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a> | ";
			}else if($x > $maxPages - 3){
				if($x == $maxPages - 2)
					print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a> | ";
				else if($x != $maxPages)
					print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a> | ";
				else
					print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a>";
					
			}else{
				if($counter == 0)
				{
					echo " ... ";
					$counter++;
				}
			}
		}
	}else{
		if($page == $x)
			if($x != $maxPages)
				print "$page | ";
			else
				print "$page";
		else if ($x == $maxPages)
			print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a>";
		else
  			print "<a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$x\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>" . ($x) . "</a> | ";
	}

}


if($page != $maxPages && $page <= $maxPages)
{
	$nummm = $page + 1;
	print  " | <a href='#' onclick='loadOwlContents(\"$search\", \"$world\", \"$nummm\", \"$low\", \"$high\", \"$order\", \"$down\", \"$up\");'>&raquo;</a>";
}
?>
</div>