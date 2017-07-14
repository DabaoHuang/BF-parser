<?

function name2ID($name) {
	global $db;

	$rec = $db->fetch_record($db->query("select hero_name, h_id from heros Where hero_name LIKE ?", array(trim($name))));
	return $rec['h_id'];
}

?>