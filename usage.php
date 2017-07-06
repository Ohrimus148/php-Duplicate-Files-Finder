<?php 
$dir="Files"; 
require("phpDuplicateFilesFinder.php"); 
$obj=new phpDuplicateFilesFinder(); 
$duplicateFiles=$obj->findDuplicateFiles($dir); 

//Display Results 
$c=count($duplicateFiles); 
if($c===0){ echo "No Duplicate Files were found in \"$dir\""; } 
else{ 
    echo "<div>$c duplicate files found in \"$dir\"</div>"; 
    $col=0; 
    foreach($duplicateFiles as $duplicate){ 
        $c=count($duplicate); 
        if($col%2==0){$color="#FFDFF8";} else {$color="#DFFFE3"; } 
        echo "<p><br /></p><div style='background-color:$color'>"; 
        for($a=0;$a<$c;$a++){ 
            $file=$duplicate[$a]; 
            echo "<div><a href='$file'>$file</a></div>"; 
        } 
        echo "</div>"; 
        $col++; 
    } 
} 
?> 