<?php   

require_once '../functions.php';
$ac_no = $mysqli->real_escape_string($_POST['ac_no']);
$bank = $mysqli->real_escape_string($_POST['bank_code']);

$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=".$ac_no."&bank_code=".$bank,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer sk_test_b1acf4c6db9df3dc822e6fa3afd9ba8f4f5bbc2d",
            "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
        	echo "cURL Error #: ". $err; 
        }else{
        	echo $response;
        }






?>