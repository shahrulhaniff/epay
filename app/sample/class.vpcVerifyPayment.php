<?php
require_once("class.vpcGenerateLink.php");

class vpcVerifyPayment {
    public $SECURE_SECRET;
    public $vpc_Txn_Secure_Hash;
    public $vpc_Txn_Secure_Hash_Type;
    public $sha256HashData;
    private $vpcGenerate;

    function __construct($server) {
        if ($server == 'demo')
            $this->SECURE_SECRET = "597D92FB004E05764B2DFBF153547E7D";
        else if ($server == 'prod')
            $this->SECURE_SECRET = "D78FD608C929A27AC9E071C5E293B5A7";
        $this->vpcGenerate = new vpcGenerateLink($server,"","","",null);
    }

    function setSecureHash() {
        $this->vpc_Txn_Secure_Hash = @$_GET["vpc_SecureHash"];
        $this->vpc_Txn_Secure_Hash_Type = @$_GET["vpc_SecureHashType"];
        unset($_GET["vpc_SecureHash"]); 
        unset($_GET["vpc_SecureHashType"]);
    }

    function generateHash() {
        unset($_GET["vpc_SecureHash"]); 
        unset($_GET["vpc_SecureHashType"]); 
        foreach($_GET as $key => $value) {
            if (($key!="vpc_SecureHash") && ($key != "vpc_SecureHashType") && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                $this->vpcGenerate->addDigitalOrderField($key, $value);
            }
        }  
        $this->sha256HashData = $this->vpcGenerate->getHashInput();
    }

    function getResponseDescription($responseCode) {
        switch ($responseCode) {
            case "0" : $result = "Transaction Successful"; break;
            case "?" : $result = "Transaction status is unknown"; break;
            case "1" : $result = "Unknown Error"; break;
            case "2" : $result = "Bank Declined Transaction"; break;
            case "3" : $result = "No Reply from Bank"; break;
            case "4" : $result = "Expired Card"; break;
            case "5" : $result = "Insufficient funds"; break;
            case "6" : $result = "Error Communicating with Bank"; break;
            case "7" : $result = "Payment Server System Error"; break;
            case "8" : $result = "Transaction Type Not Supported"; break;
            case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
            case "A" : $result = "Transaction Aborted"; break;
            case "C" : $result = "Transaction Cancelled"; break;
            case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
            case "F" : $result = "3D Secure Authentication failed"; break;
            case "I" : $result = "Card Security Code verification failed"; break;
            case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
            case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
            case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
            case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
            case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
            case "T" : $result = "Address Verification Failed"; break;
            case "U" : $result = "Card Security Code Failed"; break;
            case "V" : $result = "Address Verification and Card Security Code Failed"; break;
            default  : $result = "Unable to be determined"; 
        }
        return $result;
    }

    //  -----------------------------------------------------------------------------

    // This method uses the verRes status code retrieved from the Digital
    // Receipt and returns an appropriate description for the QSI Response Code

    // @param statusResponse String containing the 3DS Authentication Status Code
    // @return String containing the appropriate description

    function getStatusDescription($statusResponse) {
        if ($statusResponse == "" || $statusResponse == "No Value Returned") {
            $result = "3DS not supported or there was no 3DS data provided";
        } else {
            switch ($statusResponse) {
                Case "Y"  : $result = "The cardholder was successfully authenticated."; break;
                Case "E"  : $result = "The cardholder is not enrolled."; break;
                Case "N"  : $result = "The cardholder was not verified."; break;
                Case "U"  : $result = "The cardholder's Issuer was unable to authenticate due to some system error at the Issuer."; break;
                Case "F"  : $result = "There was an error in the format of the request from the merchant."; break;
                Case "A"  : $result = "Authentication of your Merchant ID and Password to the ACS Directory Failed."; break;
                Case "D"  : $result = "Error communicating with the Directory Server."; break;
                Case "C"  : $result = "The card type is not supported for authentication."; break;
                Case "S"  : $result = "The signature on the response received from the Issuer could not be validated."; break;
                Case "P"  : $result = "Error parsing input from Issuer."; break;
                Case "I"  : $result = "Internal Payment Server system error."; break;
                default   : $result = "Unable to be determined"; break;
            }
        }
        return $result;
    }

    //  -----------------------------------------------------------------------------
       
    // If input is null, returns string "No Value Returned", else returns input
    function null2known($data) {
        if ($data == "") {
            return "No Value Returned";
        } else {
            return $data;
        }
    } 

    function compareHash() {
        $secureHash = $this->vpcGenerate->hashAllFields();
        
        if (strtoupper($this->vpc_Txn_Secure_Hash) == $secureHash) {
            return true;
        } else {
            return false;
        }
    }
}
?>