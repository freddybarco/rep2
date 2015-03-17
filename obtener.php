<?php
class obtener {




	public static function recuperar($table)
	{
		$database='datos';
		$password='';
		$username='root';
		$servername='localhost';
		$dsn = 'mysql:dbname='.$database.';host='.$servername.';charset=utf8';
		$pdo = new PDO($dsn, $username, $password );
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$sql='SELECT time,value FROM '.$table;

		$result = $pdo->query($sql);
		$c=0;
   		$salida=$result->fetchAll(PDO::FETCH_ASSOC);
   		foreach ($salida as $key => $value) {
   			//echo $key.'  time : '.$value['time'].'  valor: '.$value['value'].'<br>';
   			$c=$c+1;
   		}

   		//echo $c;
   		//var_dump($salida);
   		$html= '<table border="1" style="width:50%">';
   		$html.= '<tr><td>Tiempo</td><td>Valores</td></tr>';
   		for ($i=$c-16; $i <$c ; $i++) { 
   			$html.= '<tr>';
   			$html.= '<td>'.date('d/m/Y H:i:s',$salida[$i]['time']).'</td>';
   			$html.= '<td>'.$salida[$i]['value'].'</td>';
   			$html.= '</tr>';
   		}
   		$html.= '</table>';
		
		return $html;
	}
	
	

}








?>
