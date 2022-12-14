<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
include_once("../vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;
/** @var \Yvesniyo\IntouchSms\SmsSimple */
// Get cleaner number
$query = "SELECT * FROM cleaner";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0) {
    $telephone=$rows['phone'];
}
    $messi="More users attented in the toilete please come and clean";
    $sms = new SmsSimple();
    $sms->recipients(["0788750979"])
        ->message($messi)
        ->sender("+250785773017")
        ->username("ishimwee")
        ->password("ishimwe123")
        ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
        ->callBackUrl("");
    print_r($sms->send());

?>