<?php

require(dirname(__FILE__). '/../secache.php');

$cacheFileName = 'R:\cachedatadefault';
$insertCount = 1000;

$cache = new secache();
$cache->workat($cacheFileName);

function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$begin_time = microtime_float();

for($i=0;$i<$insertCount;$i++){

    $key = md5($i); //You must *HASH* it by your self
    $value = 'No. '.$i.' is ok'; // must be a *STRING*

    $cache->store($key,$value);
}

echo '================='. PHP_EOL;
echo 'Insert '. $insertCount. ' Count Cost: ' .( microtime_float() - $begin_time) .' ms'. PHP_EOL;
echo '================='. PHP_EOL;

echo 'Test read'. PHP_EOL;
echo '================='. PHP_EOL;
testRead($cache, $insertCount);

echo '================='. PHP_EOL;
echo 'Test read again'. PHP_EOL;
echo '================='. PHP_EOL;

unset($cache);
$cache = new secache();
$cache->workat($cacheFileName);
testRead($cache, $insertCount);

function testRead($cache, $insertCount){

    for($i=0;$i<$insertCount;$i+=200){

        $key = md5($i); //You must *HASH* it by your self
	
        if($cache->fetch($key,$value)){
            echo $i. '[KEY='. $key.'] DATA: '.$value. PHP_EOL;
        }else{
            echo $i. '[KEY='. $key.'] DATA GET FAILED '. PHP_EOL;
	    	exit();
        }
    }

}