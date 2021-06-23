<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("header.inc.php");

require_once 'autoload.php';
use GuzzleHttp\Client;

function CreateHeaderForAPICall($salt)
{
    $value_for_hash = $salt . $_SESSION['PersonID'];
    $hash = password_hash($value_for_hash, PASSWORD_BCRYPT);
    return array('PERSON-ID' => $_SESSION['PersonID'],
    'USER-ROLES' => empty($_SESSION['UserRole']) ? 0 : $_SESSION['UserRole'],
    'SYS-CODE' => $_SESSION['SystemCode'],
    'IP-ADDRESS' => $_SESSION['LIPAddress'],
    'USER-ID' => $_SESSION['UserID'],
    'H-TOKEN' => $hash);
}

HTMLBegin();
?>
<div class="col-md-8 mx-auto">
    <?
        $salt = "SALAMATIMA99z135"; //  = config::$db_servers['master']["msrt_hashsalt"]
        $header = CreateHeaderForAPICall($salt);

        $url = "http://api-dataservice.um.ac.ir:3000/basicinfo/EducationalGroups/13";
        $params = array('FromRec' => 1);
        $client = new Client();
        try
        {
            $response = $client->request("get", $url,  ['query' => $params, 'headers'=> $header ]);
        } 
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            echo "StatusCode: ".$response->getStatusCode()."<br>";
            echo $response->getBody()->getContents();
            die();
        }        

        /*
        $response = $client->request($method, $url,  ['form_params' => $params, 'headers'=> $header ]);
        $multipartArr = array();
        foreach($params as $key => $value)
            $multipartArr[] = array("name" => $key, "contents" => $value);

        $response = $client->request($method, $url,  ['multipart' => $multipartArr, 'headers'=> $header ]);
        */

        $StatusCode = $response->getStatusCode();
        $content = ($response->getBody()->getContents()); 

        $arr = json_decode($content);
        for($i=0; $i<count($arr); $i++)
        {
            echo $arr[$i]->EduGrpCode;
            echo " : ";
            echo $arr[$i]->PEduName;
            echo "<br>";
        }

    ?>
</div>