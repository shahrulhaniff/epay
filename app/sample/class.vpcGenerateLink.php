<?php

class vpcGenerateLink {
	var $SECURE_SECRET;
	var $vpcURL;
	var $payTitle;
	var $payPreMerchTxnRef;
	var $payReturnURL;
	var $payType;
	var $accessCode;
	var $merchantId;
	private $hashInput;
	private $postData;                        // Data to be posted to the payment server

	public function getHashInput() {
		return $this->hashInput;
	}

	public function addDigitalOrderField($field, $value) {
		
		if (strlen($value) == 0) return false;      // Exit the function if no $value data is provided
		if (strlen($field) == 0) return false;      // Exit the function if no $value data is provided
		
		// Add the digital order information to the data to be posted to the Payment Server
		$this->postData .= (($this->postData=="") ? "" : "&") . urlencode($field) . "=" . urlencode($value);
		
		// Add the key's value to the hash input (only used for 3 party)
		$this->hashInput .= $field . "=" . $value . "&";
		return true;
	}
	public function getDigitalOrder($vpcURL) {
		$redirectURL = $vpcURL.$this->postData;
		return $redirectURL;
	}
	public function hashAllFields() {
		$this->hashInput=rtrim($this->hashInput,"&");
		return strtoupper(hash_hmac('SHA256',$this->hashInput, pack("H*",$this->SECURE_SECRET)));
	}

	function __construct($server,$payTitle,$payPreMerchTxnRef,$payReturnURL,$arrayType=null) {
		if ($server == 'demo') {
			$this->SECURE_SECRET = "597D92FB004E05764B2DFBF153547E7D";
			$this->accessCode = "07499739";
			$this->merchantId = "TEST10701100008";
			$this->vpcURL = 'https://migs-mtf.mastercard.com.au/vpcpay' . "?";
		} else if ($server == 'prod') {
			$this->SECURE_SECRET = "D78FD608C929A27AC9E071C5E293B5A7";
			$this->accessCode = "6A3E62EC";
			$this->merchantId = "10701100006";
			$this->vpcURL = 'https://migs.mastercard.com.au/vpcpay' . "?";
		}
		//$vpcURL = 'https://migs.mastercard.com.au/vpcpay' . "?";

		$this->payTitle = $payTitle;
		$this->payPreMerchTxnRef = $payPreMerchTxnRef;
		$this->payReturnURL = $payReturnURL;
		$this->arrayType = $arrayType;

	}

	public function processSubmit() {
		global $convert,$cat_acr;
		if (@$_POST['pay'] != '') {
			// uPDATE WHEN USING SHA256,, COMMENT BELOW 19/1/2017
			//$sha256HashData = $this->SECURE_SECRET;
			$sha256HashData = '';
			
			$fee_type = trim($_POST['fee_type']);

			$fee3 = $this->arrayType;

		    $amount = $fee_type;//$fee3[$fee_type];

			$type = $fee_type;
			$email = trim($_POST['email']);
			$registerid = trim($_POST['registerid']);
			$registername = trim($_POST['registername']);
			$contactno = '0199941900'; //trim($_POST['contactno']);
			
			unset($_POST);
			
			$_POST['vpc_Version']	= '1';
			$_POST['vpc_Command']	= 'pay';
			$_POST['vpc_AccessCode']	= $this->accessCode;
			$_POST['vpc_MerchTxnRef']	= $this->payPreMerchTxnRef."-$registerid"."RAXSOFTTEST";
			$_POST['vpc_Merchant'] 	= $this->merchantId;
			$_POST['vpc_OrderInfo']	= "$type";
			$_POST['vpc_TicketNo']	= "";
			$_POST['vpc_TxSourceSubType']	= "";
			$_POST['vpc_Amount'] 	= $amount*100;
			$_POST['vpc_Locale'] 	= "en";
			$_POST['vpc_Currency'] 	= "MYR";
			$_POST['vpc_ReturnURL'] = $this->payReturnURL;

			ksort($_POST);

			foreach($_POST as $key => $value) {
				if (strlen($value) > 0) {
					$this->addDigitalOrderField($key, $value);
				}
			}

			$secureHash = $this->hashAllFields();
			$this->addDigitalOrderField("Title", $this->payTitle);
			$this->addDigitalOrderField("vpc_SecureHash", $secureHash);
			$this->addDigitalOrderField("vpc_SecureHashType", "SHA256");

			$this->vpcURL = $this->getDigitalOrder($this->vpcURL);

			
			header("Location: ".$this->vpcURL);
			exit;
		}
	}
}

?>