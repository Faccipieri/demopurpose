

<?php 

//https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://www.faccipieri.eu&key=AIzaSyAkIlc7wdU7O8G0nxEnD0q60eIE5bgBYlQ


$ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://wwww.weTransfer.com&key=AIzaSyAkIlc7wdU7O8G0nxEnD0q60eIE5bgBYlQ");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch); 

$apiResult = json_decode($output, true);

//print_r($apiResult);

//echo $output ; 

echo $apiResult['captchaResult'] ; 
echo '<br>' ;

echo $contaitems= count($apiResult['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items']);
echo '<br>' ; 

for ($x = 0; $x <= $contaitems - 1 ; $x++) {
    echo "The number is: $x <br>";

 
echo '<img  src="' . $apiResult['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items'][$x]['data'] . '">' ; 
echo '<br>' ; 

}











?>