<?

function name2ID($name) {

	global $db;
	$rec = $db->fetch_record($db->query("select hero_name, h_id from heros Where hero_name LIKE ?", array(trim($name))));
	return $rec['h_id'];

} // end function 

function saveThumbnail($saveToDir, $imagePath, $imageName, $max_x, $max_y) {

    preg_match("'^(.*)\.(gif|jpe?g|png)$'i", $imageName, $ext);

    switch (strtolower($ext[2])) {
        case 'jpg' :
        case 'jpeg': $im   = imagecreatefromjpeg ($imagePath);
                     break;
        case 'gif' : $im   = imagecreatefromgif  ($imagePath);
                     break;
        case 'png' : $im   = imagecreatefrompng  ($imagePath);
                     break;
        default    : $stop = true;
                     break;
    } // end switch
   
    if (!isset($stop)) {
        $x = imagesx($im);
        $y = imagesy($im);
   
        if (($max_x/$max_y) < ($x/$y)) $save = imagecreatetruecolor($x/($x/$max_x), $y/($x/$max_x));
        else $save = imagecreatetruecolor($x/($y/$max_y), $y/($y/$max_y));

        imagecopyresampled($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);



	    switch (strtolower($ext[2])) {

	        case 'jpg' :
	        case 'jpeg': imagejpeg($save, "{$saveToDir}{$imageName}",95);
	                     break;
	        case 'gif' : imagegif($save, "{$saveToDir}{$imageName}");
	                     break;
	        case 'png' : imagepng($save, "{$saveToDir}{$imageName}");
	                     break;
	        default    : $stop = true;
	                     break;

	    }

	    imagedestroy($im);
	    imagedestroy($save);

    } // end if

} // end function


?>