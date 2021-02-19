

<?php 

	$livellopagina= '2';
	include('../lib/lib2021.php');

//SELECT * FROM `fg_log` inner join fg_uagent on ua=unique_ua ORDER BY `idlog`  DESC 


$conn=pdoconnect();

$sql = 'SELECT * FROM fg_log';
$stmt = $conn->prepare($sql);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$ua=md5($row['agent']) ;
	$id = $row['idlog'] ;
    echo '' .  $row['idlog'] ;
		
$sql = "update fg_log set ua = '$ua' where idlog ='$id'    ";


$conn->query($sql);
		
		
		//uagent::add();
		echo '<br>' ; 
		òfgfgfhglòfhlòfkhòlfdkhfdòkhflh
}















?>