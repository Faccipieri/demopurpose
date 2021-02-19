

<?php 

	$livellopagina= '2';
	include('../lib/lib2021.php');






$query = http_build_query([
  'access_key' => 'bc38824923a2cbeaeae113629352e748',
  'ua' => $_SERVER['HTTP_USER_AGENT'],
]);

$ch = curl_init('http://api.userstack.com/detect?' . $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

 $json = curl_exec($ch);
curl_close($ch);

 $api_result = json_decode($json, true);
echo '<br>' ; 

echo $api_result['type'] ;
echo '<br>' ; 
echo $api_result['os']['name'] ;
echo '<br>' ; 
echo $api_result['os']['code'] ;
echo '<br>' ; 
echo $api_result['os']['family'] ;
echo '<br>' ; 
echo $api_result['os']['family_code'] ;
echo '<br>' ; 

echo $api_result['device']['type'] ;
echo '<br>' ; 

echo ($api_result['device']['is_mobile_device'] == true) ?'Mobile device' : 'Fixed device';
echo '<br>' ; 

echo $api_result['browser']['name'];
echo '<br>' ; 
echo $api_result['browser']['version'];
echo '<br>' ; 
echo $api_result['browser']['version_major'];
echo '<br>' ; 
echo $api_result['browser']['engine'];
echo '<br>' ; 

echo ($api_result['crawler']['is_crawler']==true)?'Crawler' :'No Crowler' ; 
echo '<br>' ; 
echo $api_result['crawler']['category'];
echo '<br>' ; 
echo $api_result['crawler']['last_seen'];
echo '<br>' ; 

//uagent::add();

$conn=pdoconnect();

$sql = 'SELECT * FROM fg_uagent';
$stmt = $conn->prepare($sql);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$ua=$row['agent'] ;
    echo '' .  $row['iduagent'] . ' ' . $row['unique_ua'] . ' '   . '';
		//uagent::add();
		echo '<br>' ; 
}






class uagent{
	public static function add(){
		$conn=pdoconnect();
		$ua=$_SERVER['HTTP_USER_AGENT'] ; 
		$datains=time();
		$unique_ua=md5($ua);
		$query = http_build_query([
			'access_key' => 'bc38824923a2cbeaeae113629352e748',
			'ua' => $ua,
		]);

		$ch = curl_init('http://api.userstack.com/detect?' . $query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);

		$api_result = json_decode($json, true);
		$type = $api_result['type'] ; 
		$os_name =  $api_result['os']['name'] ;
		$os_code = $api_result['os']['code'] ;
		$os_family = $api_result['os']['family'] ;
		$os_family_code = $api_result['os']['family_code'] ;	
		$device_type = $api_result['device']['type'] ;
		$device_mobile = ($api_result['device']['is_mobile_device'] == true) ?'Mobile device' : 'Fixed device';
		$browse_name = $api_result['browser']['name'];
		$browse_version = $api_result['browser']['version'];
		$browse_version_major =  $api_result['browser']['version_major'];
		$browse_engine = $api_result['browser']['engine'];
		$crawler_is_crawler = ($api_result['crawler']['is_crawler']==true)?'Crawler' :'No Crowler' ; 
		$crawler_category = $api_result['crawler']['category'];
		$crawler_last_seen = $api_result['crawler']['last_seen'];	
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "insert into fg_uagent (browse_name,browse_version,browse_version_major,browse_engine,crawler_is_crawler,crawler_category,crawler_last_seen,	device_type, device_mobile, os_family, os_family_code, os_name, os_code, agent, unique_ua, datains, type)	values ('$browse_name',	'$browse_version',	'$browse_version_major',	'$browse_engine',	'$crawler_is_crawler',	'$crawler_category',	'$crawler_last_seen','$device_type', '$device_mobile', '$os_family', '$os_family_code', '$os_name', '$os_code', '$ua', '$unique_ua', '$datains',  '$type' )ON DUPLICATE KEY UPDATE os_family= '$os_family', os_family_code = '$os_family_code', os_name ='$os_name', os_code = '$os_code', agent ='$ua', device_type = '$device_type', browse_name='$browse_name',
		browse_version='$browse_version',browse_version_major='$browse_version_major',browse_engine='$browse_engine',crawler_is_crawler='$crawler_is_crawler',crawler_category='$crawler_category',crawler_last_seen='$crawler_last_seen'	
		";
		$conn->exec($sql);
		echo "New record created successfully";
			
		
	}
	  
											
	


}


















?>