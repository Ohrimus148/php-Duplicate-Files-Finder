<?php 
//set_time_limit(99999); 
//ini_set("max_execution_time",99999); 

  
class PhpDuplicateFilesFinder { 
   
   
   
   
    public function findDuplicateFiles($dirName){ 
        $dirName=trim($dirName); 
        if(count(glob("$dirName/*")) === 0){ die("Fatal Error 0x01: Directory Name can NOT be empty"); } 
        if(!is_dir($dirName)){ die("Fatal Error 0x02: $dir is not a valid or readable Directory"); } 
        $filesArray=$this->parseDirectory($dirName); 
        $c=count($filesArray); 
        for($i=0;$i<$c;$i++){ 
            $md5FilesArray[$i]=md5_file($filesArray[$i]); 
        } 
        $duplicateFilesArray=array(); 
        $duplicateFiles=array_count_values($md5FilesArray); 
        foreach($duplicateFiles as $key=>$value){ 
            if($value!==1){ 
                $names=array_keys($md5FilesArray, $key); 
                $duplicate=array(); 
                foreach($names as $name){ 
                    $duplicate[]=$filesArray[$name]; 
                } 
                $duplicateFilesArray[]=$duplicate; 
            } 
        } 
        return $duplicateFilesArray; 
    } 
    
   
    public function parseDirectory($rootPath,$returnOnlyFiles=true, $seperator="/"){ 
        $fileArray=array(); 
        if (($handle = opendir($rootPath))!==false) { 
            while( ($file = readdir($handle))!==false) { 
                if($file !='.' && $file !='..'){ 
                    if (is_dir($rootPath.$seperator.$file)){ 
                        $array=$this->parseDirectory($rootPath.$seperator.$file); 
                        $fileArray=array_merge($array,$fileArray); 
                        if($returnOnlyFiles!==true){ 
                            $fileArray[]=$rootPath.$seperator.$file; 
                        } 
                    } 
                    else { 
                        $fileArray[]=$rootPath.$seperator.$file; 
                    } 
                } 
            } 
        } 
        return $fileArray; 
    } 
    
    
} 
?> 
