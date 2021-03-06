<?php
/**
 *  This file is part of amfPHP
 *
 * LICENSE
 *
 * This source file is subject to the license that is bundled
 * with this package in the file license.txt.
 * @package Amfphp_BackOffice_ClientGenerator
 */
/**
 * includes
 */
require_once(dirname(__FILE__) . '/ClassLoader.php');
$accessManager = new Amfphp_BackOffice_AccessManager();
$isAccessGranted = $accessManager->isAccessGranted();
if(!$isAccessGranted){
    die('User not logged in');
}
//test values
/* $services = json_decode('{"ExampleService":{"name":"ExampleService","methods":{"returnOneParam":{"name":"returnOneParam","parameters":[{"name":"param","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"SommeriaSearchService":{"name":"SommeriaSearchService","methods":{"searchTwitter":{"name":"searchTwitter","parameters":[{"name":"query","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"AmfphpDiscoveryService":{"name":"AmfphpDiscoveryService","methods":{"discover":{"name":"discover","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"}}');
  $services = json_decode('{"AuthenticationService":{"name":"AuthenticationService","methods":{"login":{"name":"login","parameters":[{"name":"userId","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"},{"name":"password","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"logout":{"name":"logout","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"adminMethod":{"name":"adminMethod","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"ByteArrayTestService":{"name":"ByteArrayTestService","methods":{"uploadCompressedByteArray":{"name":"uploadCompressedByteArray","parameters":[{"name":"ba","type":"Amfphp_Core_Amf_Types_ByteArray","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"DummyService":{"name":"DummyService","methods":{"returnNull":{"name":"returnNull","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"ExampleSerializationDebugService":{"name":"ExampleSerializationDebugService","methods":{"getDataThatCreatesProblems":{"name":"getDataThatCreatesProblems","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"getSerializedObject":{"name":"getSerializedObject","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"bla\/BlaService":{"name":"bla\/BlaService","methods":{"returnDouble":{"name":"returnDouble","parameters":[{"name":"param","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"SommeriaSearchService":{"name":"SommeriaSearchService","methods":{"searchTwitter":{"name":"searchTwitter","parameters":[{"name":"query","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"TestService":{"name":"TestService","methods":{"returnOneParam":{"name":"returnOneParam","parameters":[{"name":"param","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnSum":{"name":"returnSum","parameters":[{"name":"number1","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"},{"name":"number2","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnNull":{"name":"returnNull","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnBla":{"name":"returnBla","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"throwException":{"name":"throwException","parameters":[{"name":"arg1","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnAfterOneSecond":{"name":"returnAfterOneSecond","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"},"AmfphpDiscoveryService":{"name":"AmfphpDiscoveryService","methods":{"discover":{"name":"discover","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"}} ');
  $services = json_decode('{"TestService":{"name":"TestService","methods":{"returnOneParam":{"name":"returnOneParam","parameters":[{"name":"param","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnSum":{"name":"returnSum","parameters":[{"name":"number1","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"},{"name":"number2","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnNull":{"name":"returnNull","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnBla":{"name":"returnBla","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"throwException":{"name":"throwException","parameters":[{"name":"arg1","type":"","_explicitType":"AmfphpDiscovery_ParameterDescriptor"}],"_explicitType":"AmfphpDiscovery_MethodDescriptor"},"returnAfterOneSecond":{"name":"returnAfterOneSecond","parameters":[],"_explicitType":"AmfphpDiscovery_MethodDescriptor"}},"_explicitType":"AmfphpDiscovery_ServiceDescriptor"}} ');
 */

$servicesStr = null;
if (isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
    $servicesStr = $GLOBALS['HTTP_RAW_POST_DATA'];
}else{
    $servicesStr = file_get_contents('php://input');
}
    
$services = json_decode($servicesStr);
$generatorClass = $_GET['generatorClass'];
$generatorManager = new Amfphp_BackOffice_ClientGenerator_GeneratorManager();
$generators = $generatorManager->loadGenerators(array('ClientGenerator/Generators'));

$config = new Amfphp_BackOffice_Config();

$generator = $generators[$generatorClass];
$newFolderName = date("Ymd-his-") . $generatorClass;
//temp for testing. 
//$newFolderName = $generatorClass;
$genRootRelativeUrl = 'ClientGenerator/Generated/';
$genRootFolder = AMFPHP_BACKOFFICE_ROOTPATH . $genRootRelativeUrl;
$targetFolder = $genRootFolder . $newFolderName;
$generator->generate($services, $config->resolveAmfphpEntryPointUrl(), $targetFolder);
$urlSuffix = $generator->getTestUrlSuffix();
echo '<br/><br/>';
echo 'client project written to ' . $targetFolder;

if ($urlSuffix !== false) {
    echo '<br/><br/><a href="' . $genRootRelativeUrl . $newFolderName . '/' . $urlSuffix . '"> try it here</a>';
}
if (Amfphp_BackOffice_ClientGenerator_Util::serverCanZip()) {
    $zipFileName = "$newFolderName.zip";
    $zipFilePath = $genRootFolder . $zipFileName;
    Amfphp_BackOffice_ClientGenerator_Util::zipFolder($targetFolder, $zipFilePath, $genRootFolder);
    echo '<br/><br/><a href="' . $genRootRelativeUrl . $zipFileName . '"> get zip here</a>';
} else {
    echo " Server can not create zip of generated project, because ZipArchive is not available.";
}
?>
