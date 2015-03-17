<?php
class guardar {


public static function almacenar()
	{	$c=0;
		$a=array();
		$a[0]='';
		$m=0;
		while($m<15) { 
			sleep(0.25);
			$obj=json_decode(guardar::curlFile('http://engels.soy/concurso2015i/api.php?val=kW','10.164.1.27','8080','SESA372104:Avanzados1'));
			$c=$c+1;
			$a[$c]=$obj->{'value'};
	
			if($a[$c-1]!=$a[$c])
			{	$m=$m+1;
				//echo $obj->{'time'}.'  '.$obj->{'value'}.'<br>';
			guardar::insertar('lista',$obj->{'time'},$obj->{'value'});
			}

		}
		return 'recibido';
	}
	

	public static function insertar($table,$tiempo,$valor)
	{
			$database='datos';
			$password='';
			$username='root';
			$servername='localhost';
			$dsn = 'mysql:dbname='.$database.';host='.$servername.';charset=utf8';
			$pdo = new PDO($dsn, $username, $password );
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
			$sql='INSERT INTO '.$table.' (time, value)
			VALUES ('.$tiempo.', '.$valor.')';

			//echo $sql.'<br>' ;
			$pdo->query($sql);
			
/*
			if ($pdo->query($sql) === TRUE) {
    				echo "Nueva registro grabado";
			} else {
    				echo "Error: " ;
					}
*/			
	}



	public static function curlFile($url,$proxy_ip,$proxy_port,$loginpassw)
	{


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
    curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
    curl_setopt($ch, CURLOPT_PROXY, $proxy_ip);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $loginpassw);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
	}


	public static  function temporal()
	{
		$valeurs = range(1, 40);
		$proba = array_fill(1, 40, 0);
		for ($i = 0; $i < 10000; ++$i)
		{
   			 $tirage_tab = array_rand($valeurs, 10);
    	foreach($tirage_tab as $key => $value)
    	{
        	$proba[$valeurs[$value]]++;
    	}
	
		}

		asort($proba);

		$ar = array('time'=>1+$proba[1], 'value'=>2+$proba[2]/1000);
		return $ar;

	}
}






	echo guardar::almacenar();




?>
