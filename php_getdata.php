#!/usr/bin/php
<?
include "include/sql.php";
include "include/phpQuery.php";
include "include/function.php";


if ($argv[1] == '') {
	$meid = $db->fetch_record($db->query("SELECT h_id from `heros` Order By CAST(h_id as UNSIGNED) DESC LIMIT 0, 1 ", array()));
	$me_id = intval($meid['h_id'])+1;
} else {
	$me_id =$argv[1];
}


if ( $db->num_rows($db->query("SELECT h_id from `heros` Where h_id = ?" , array($me_id))) != 0) {
	print_r("$me_id 已有資料。跳過記錄\n");
	exit(2);
}

print_r("獲取 ".$me_id . " 編號寵物中。請稍後....\n");
$url = 'gamemonkey.jp/bf/unit/'. $me_id;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
// curl_setopt($ch, CURLOPT_USERAGENT,      $this->getUserAgent(/*$proxyIp*/));
curl_setopt($ch ,CURLOPT_HTTPHEADER, array("Accept-Language: zh-tw,zh;q=0.8,en-us;q=0.5,en;q=0.3","Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Accept-Charset: Big5,utf-8;q=0.7,*;q=0.7" ));
curl_setopt($ch, CURLOPT_MAXREDIRS,      4);
curl_setopt($ch, CURLOPT_TIMEOUT,        5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$response = curl_exec($ch);
phpQuery::newDocument($response);

$data['hero_name'] = trim(pq("h1.hdr-big")->text());

if ($data['hero_name'] == '') {
	print_r("無 $me_id 編號寵物\n");
	exit(4);
}

foreach (pq('article.article div.table-wrapper:eq(1) table')  as $tableIndex => $table ) {
	switch ( $tableIndex ) {
		case 0:
			foreach (pq('tr:eq(1) td', pq($table))  as $tdIndex => $td ) {
				switch ($tdIndex) {
					case 0: break;
					case 1: $data['star'] = trim(pq($td)->text()); break;
					case 2: $data['prop'] = trim(pq($td)->text()); break;
					case 3: $data['maxlv'] = trim(pq($td)->text()); break;
					case 4: $data['cost'] = trim(pq($td)->text()); break;
				}
			}
			break;
		case 1:
			$data['attacktimes'] = intval( trim(pq('tr:eq(1) td:eq(0)', pq($table))->text()));
			break;
		default:


			switch( trim( pq('tr:eq(0)', pq($table))->text() ) ) {
				case 'ブレイブバースト':
					$data['bb'] = trim( pq('tr:eq(1) p', pq($table))->text() );
				break;
				case 'スーパーブレイブバースト':
					$data['sbb'] = trim( pq('tr:eq(1) p', pq($table))->text() );
				break;
				case 'アルティメットブレイブバースト':
					$data['ubb'] = trim( pq('tr:eq(1) p', pq($table))->text() );
				break;

				case 'リーダースキル':
					$data['leaderskill'] = trim( pq('tr:eq(1) p', pq($table))->text() );
				break;
				case 'エクストラスキル':
					$data['extraskill'] = trim( pq('tr:eq(1) p', pq($table))->text() );
				break;
				case '進化':
					//進化前
						$evolve['parentid'] = str_replace("/bf/unit/", "",  trim(pq('tr:eq(1) td:eq(1) a', pq($table))->attr('href')) );
					//進化後
						$evolve['childid'] =  str_replace("/bf/unit/", "",  trim(pq('tr:eq(2) td:eq(1) a', pq($table))->attr('href')) );
					//材料
						foreach (pq('tr:eq(3) td:eq(1) a', pq($table)) as $materials) {
							$evolve['materials'][] = str_replace("/bf/unit/", "",   trim(pq($materials)->attr('href')) );
						}


				break;
			}

		break;
	}
}


foreach( array('initial', 'lord', 'animal', 'breaker', 'guardian', 'oracle', 'bonus') as $colName ) {
 				$data[$colName]['HP']  = trim(pq('article.article div.table-wrapper:eq(2) table tr.'.$colName.' td.hp')->text());
 				$data[$colName]['atk'] 	= trim(pq('article.article div.table-wrapper:eq(2) table tr.'.$colName.' td.attack')->text());
 				$data[$colName]['def'] 	= trim(pq('article.article div.table-wrapper:eq(2) table tr.'.$colName.' td.defense')->text());
 				$data[$colName]['heal'] =  trim(pq('article.article div.table-wrapper:eq(2) table tr.'.$colName.' td.cure')->text());
 				$data[$colName] = serialize($data[$colName]);
}



foreach ( $data as $k => $v ) {

	 $colarray[] = " $k=:$k";
	 $val[":$k"] = trim($v);
}

	$val[":h_id"] = $me_id;
	$colarray[] = " h_id=:h_id";




 	if ( $db->num_rows($db->query("SELECT h_id from `heros` Where h_id = ?" , array($me_id))) == 0) {
	 	try {
			$db->query("INSERT INTO `heros` SET ".implode(",",$colarray), $val);
		} catch (Exception $e) {
			print_r("插入資料到 heros 表格發生錯誤\n");
			exit(3);
		}
  	}

  	if ( $db->num_rows($db->query("SELECT heroid from `evolve` Where heroid = ?" , array($me_id))) == 0) {
	 	try {
	 		$db->query("INSERT INTO `evolve` SET heroid=?, parentid=?, childid=?, materials=? ;", array( $me_id, $evolve['parentid'],$evolve['childid'], serialize($evolve['materials']) ) );
		} catch (Exception $e) {
			print_r("插入資料到 evolve 表格發生錯誤\n");
			exit(3);
		}

	}
print_r("資料 ".$data['hero_name']."($me_id) 新增成功 \n");
exit(0);
?>
