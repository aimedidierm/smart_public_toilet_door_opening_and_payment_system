<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
include_once("vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;
/** @var \Yvesniyo\IntouchSms\SmsSimple */
// Get cleaner number
$newamount=0;
$price1=100;
$price2=150;
$query = "SELECT * FROM cleaner";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0) {
    $telephone=$rows['phone'];
}
//Report 1
if(isset($_POST['report1'])){
$messi="There is dity in urinary";
$sms = new SmsSimple();
$sms->recipients(["0788750979"])
    ->message($messi)
    ->sender("+250785773017")
    ->username("ishimwee")
    ->password("ishimwe123")
    ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
    ->callBackUrl("");
print_r($sms->send());
}
//Report 2
if(isset($_POST['report2'])){
    $messi="There is dity in great toilet";
    $sms = new SmsSimple();
    $sms->recipients(["0788750979"])
        ->message($messi)
        ->sender("+250785773017")
        ->username("ishimwee")
        ->password("ishimwe123")
        ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
        ->callBackUrl("");
    print_r($sms->send());
    }
// Toilet 1
if(isset($_POST['card1'])){
    $card=$_POST['card1'];
    $query = "SELECT * FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    if ($stmt->rowCount()>0) {
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $user=$rows['id'];
        $am=$rows['balance'];
        if ($price1 <= $am) {
            $newamount=$am-$price1;
            $sql ="UPDATE user SET balance = ? WHERE id = ? limit 1";
            $stm = $db->prepare($sql);
            if ($stm->execute(array($newamount, $user))) {
                $sql ="INSERT INTO transactions (credit,user) VALUES (?,?)";
                $stm = $db->prepare($sql);
                $stm->execute(array($price1,$user));
                $data = array("cstatus" =>"2","balance" =>$newamount); 
                echo $response = json_encode($data);
            }
        } else {
            $data = array("cstatus" =>"1"); 
            echo $response = json_encode($data);
        }
    }
}
//Toilet 2
if(isset($_POST['card2'])){
    $card=$_POST['card2'];
    $query = "SELECT * FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    if ($stmt->rowCount()>0) {
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $user=$rows['id'];
        $am=$rows['balance'];
        if ($price1 <= $am) {
            $newamount=$am-$price2;
            $sql ="UPDATE user SET balance = ? WHERE id = ? limit 1";
            $stm = $db->prepare($sql);
            if ($stm->execute(array($newamount, $user))) {
                $sql ="INSERT INTO transactions (credit,user) VALUES (?,?)";
                $stm = $db->prepare($sql);
                $stm->execute(array($price2,$user));
                $data = array("cstatus" =>"4","balance" =>$newamount); 
                echo $response = json_encode($data);
            }
        } else {
            $data = array("cstatus" =>"3"); 
            echo $response = json_encode($data);
        }
    }
}
?>