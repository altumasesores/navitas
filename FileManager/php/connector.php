<?php header('Access-Control-Allow-Origin: *');
//error_reporting(0); // Set E_ALL for debuging


include_once 'elFinderConnector.class.php';
include_once 'elFinder.class.php';
include_once 'elFinderVolumeDriver.class.php';
include_once 'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';


/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from  '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}
$separator="../../";
$opts = array(
	'debug' => true,
	'locale' => 'en_US.UTF-8',
	'roots' => array(
		array(
		    'defaults'   => array('read' => true, 'write' => true),
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => $separator.'documentos/'.$_GET['razon'],         // path to files (REQUIRED)
			'utf8fix'    => true,
			'acceptedName'    => '/^[^\.].*$/',
			//'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../documentos/'.$_GET['razon'], // URL to files (REQUIRED)
			'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)			
			'mimeDetect' => 'internal'
		)
	)
);

/*
echo $_GET['razon'];
echo $_GET['cmd'];
echo $_GET['name'];
echo $_GET['target'];
echo $_GET['_'];
*/

/*
$_GET['razon']="";
$_GET['cmd']="mkdir";
$_GET['name']="123";
$_GET['target']="l1_QUNUSVZPIElOVEVMSUdFTlRFIERFTCBTVVIgU0EgREUgQ1Y";
$_GET['_']="1346961856317";
*/

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

