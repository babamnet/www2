<?php
function convert($text)
{
$tmp="";
for($i=0, $m=strlen($text); $i< $m; $i++)
{
$char=ord($text[$i]);
 
if ($char<=127) {$tmp.=chr($char); continue; }
if ($char>=192 && $char<=207)    {$tmp.=chr(208).chr($char-48); continue; }
if ($char>=208 && $char<=239) {$tmp.=chr(208).chr($char-48); continue; }
if ($char>=240 && $char<=255) {$tmp.=chr(209).chr($char-112); continue; }
if ($char==184) { $tmp.=chr(209).chr(145); continue; };
if ($char==168) { $tmp.=chr(208).chr(129);  continue; };
}
return $tmp;
}
?>