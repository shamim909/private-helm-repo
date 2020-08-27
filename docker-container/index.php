<?php
$uploaddir = '/var/www/cc-helm-repo/';
$uploadfile = $uploaddir . basename($_FILES['chart']['name']);
//echo '<pre>';

try{
   if (move_uploaded_file($_FILES['chart']['tmp_name'], $uploadfile)) {
      echo shell_exec("helm repo index .");
      echo "Chart was successfully uploaded.\n";
      print_r($_FILES['chart']['name']."\n");
   }else {
    echo "Possible file upload attack!\n";
   } 
 } catch(Exception $e){
   echo 'Message: ' .$e->getMessage();   
 }
/*
echo 'Here is some more debugging info:';
print_r($_FILES);
echo "-------------";
echo '</pre>';
 */
?>
