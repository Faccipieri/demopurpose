

<?php 

	$livellopagina= '1';
	include('../lib/lib2021.php');

$conn=pdoconnect();		
			
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

$sql = "SELECT *, count(pillolaid) as contami, s.datains as datavista, FROM_UNIXTIME(s.datains, '%Y%m%d') as dataread FROM `fg_statpillola` s inner join fg_pillole p on pillolaid=idpillola where idpillola ='3' group by dataread order by idpillola, datavista desc" ;	 

//$sql = "SELECT *, count(pillolaid) as contami, s.datains as datavista FROM `fg_statpillola` s inner join fg_pillole p on s.pillolaid=p.idpillola  where idpillola ='3' group by dataread order by s.datains desc" ;	

		
$stmt = $conn->prepare($sql);	
$stmt ->execute();	
$row=$stmt ->fetchall();	
foreach ($row as $value) {
	echo $value['idpillola'] ;
	echo '<br>' ; 
  echo $value['titolo'] ;
	echo '<br>' ; 
	echo date('d/m/Y H:i:s',$value['datavista']);
	echo '<br>' ; 
	echo $value['dataread'] ;
	echo '<br>' ; 
	echo $value['contami'] ;
	echo '<br>' ; 
	echo '<hr>' ;
}





?>

<a target="_blank" href="../system/master.php">ciao</a>
















