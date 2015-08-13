<?php

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

// Create a handler function
function assertFail($file, $line, $code)
{
    echo "<hr>Assertion Failed:
        File '$file'<br />
        Line '$line'<br />
        Code '$code'<br /><hr />";
}

function getMAC(){
	$ipAddress=$_SERVER['REMOTE_ADDR'];
	//echo 'remote ip'.$ipAddress;
	//echo 'server ip'.$_SERVER['SERVER_ADDR'];
	$comando=false;
	//si estamos accediendo desde el mismo pc que hace de server y estamos en windows
	if(($ipAddress==$_SERVER['SERVER_ADDR'] || $ipAddress=='127.0.0.1' || $ipAddress=='::1') && (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		echo "entro en ip local y en win\n";
		$comando = 'ipconfig /all';
		ob_start();
		system($comando);
		$mycom=ob_get_contents();
		ob_clean();
		$findme = "sica";
		$pmac = strpos($mycom, $findme);
		$mac=substr($mycom,($pmac+32),17);
	}
	//si estamos accediendo desde un pc distinto al que hace de server
	else{
		echo "entro en ip no local";
		$mac=false;
		//si el server esta con windows
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			echo "ip no local en windows\n";
			$comando = 'arp -a ';
			ob_start();
			$arp=system($comando.$ipAddress);
			ob_clean();
			$lines=explode("\n", $arp);
			foreach($lines as $line)
			{
			   $cols=preg_split('/\s+/', trim($line));
			   if ($cols[0]==$ipAddress)
			   {
				   $mac=$cols[1];
			   }
			}
		}
		//si estamos con linux
		else{
			echo 'esto debería de mostrarse si sirve la raspberry y entro desde lenovo o desde movil';
			$comando = 'arp -a | grep '.$ipAddress.' | awk \'{print $4}\'';
			echo $comando;
			ob_start();
			$mac = exec($comando);
			//$mac = exec("ls");
			ob_clean();
			echo "<br>".utf8_decode($mac)."<br>";
		}
	}
	return $mac;
}