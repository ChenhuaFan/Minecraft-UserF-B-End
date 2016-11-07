<?php
include ("config.php");

class checkcode {
    private $sess_name="verify";

	private function buildRandomString($length){
        header("Content-Type:text/html; charset=utf8");
	    $chars=join("",array_merge(range("a","z"),range(0,9))); //,range("A","Z")
	    $chars=str_shuffle($chars);
	    return substr($chars,0,$length);
	}

	public function verifyImage(){
        header("Content-Type:text/html; charset=utf8");
        //echo "<script>alert('111');</script>";
		$width=80;
		$height=40;
		$image=imagecreatetruecolor($width, $height);
		$white=imagecolorallocate($image, 255, 255, 255);
		imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
		$chars=$this->buildRandomString($length=4);
		$_SESSION[$this->sess_name]=$chars;
		$fontfiles=array("AGENCYB.TTF","AGENCYR.TTF");
		for($i=0;$i<$length;$i++){
		    $size=mt_rand(18, 18);
		    $angle=mt_rand(-15, 15);
		    $x=5+$i*$size;
		    $y=mt_rand(20, 26);
		    $fontfile="../fonts/".$fontfiles[mt_rand(0,count($fontfiles)-1)];
		    $color=imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
		    $text=substr($chars, $i,1);
		    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
		    
		}
		imagegif($image);
		imagedestroy($image);
	}

	public function verifyCheckcode($formCode) {
        if($formCode == $_SESSION[$this->sess_name]){
            return true;
        }
        else {
            return false;
        }
	}
}

