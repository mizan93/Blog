<?php 
class Format{
    public function formatDate($date){

       return date('l jS \of F Y h:i:s A', strtotime($date));
    }
    public function Readmore($text, $limit=300){
       $text=$text. ' ';
       $text=substr($text,0,$limit);
       $text=substr($text,0,strrpos($text, ' '));
       $text= $text.'....';
       return  $text;
    }
    public function validation($data){
       $data=trim($data);
       $data=stripslashes($data);
       $data=htmlspecialchars($data);
       return $data;

    }
    public function title(){
       $path=$_SERVER['SCRIPT_FILENAME'];
       $title=basename($path,'.php');
       if ($title=='index') {
          # code...
          $title='home';
          
       }elseif($title == 'contact'){
$title='contact';
       }
       return $title=ucfirst($title);
    }

}

?>