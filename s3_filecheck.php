<?php
function getExtension($str) 
{
$i = strrpos($str,'.');

if (!$i) 
    { return ''; }
else
    {
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
    }
}

  
//Only allow the following file extensions- others are possible- these are examples
$valid_formats = array('doc', 'docx', 'pdf', 'avi','mp4','DOC','DOCX','PDF','AVI','MP4');
?>