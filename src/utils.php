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
	$comando=false;
	if(($ipAddress==$_SERVER['SERVER_ADDR'] || $ipAddress=='127.0.0.1' || $ipAddress=='::1') && (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$comando = 'ipconfig /all';
		ob_start();
		system($comando);
		$mycom=ob_get_contents();
		ob_clean();
		$findme = "sica";
		$pmac = strpos($mycom, $findme);
		$mac=substr($mycom,($pmac+32),17);
	}
	else{
		$mac=false;
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
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
		} else {
			$comando = 'arp -a | grep '.$ipAddress.' | awk \'{print $4}\'';
			$mac=system($comando);
		}
	}
	return $mac;
}