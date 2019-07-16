public function sendBitcoin() {
        $my_api_key = 'a62b05e0-3c68-48c0-88a3-f1490efd3b81';
        $Blockchain = new Blockchain($my_api_key);
        $Blockchain->setServiceUrl("https://api.blockchain.info");
        $Blockchain->Wallet->credentials('9208bf1e-e382-45d9-8410-d9c0fb514817', '07068870589');
        $to_address = '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
        $amount = '0.001';
        $from_address = NULL;
        $fee = NULL;
        $response = $Blockchain->Wallet->send($to_address, $amount, $from_address, $fee);
        return $response;
    }


    public function sendBitcoin() {
        
        $to_address = '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
        $amount = '0.001';
        $from_address = NULL;
        $fee = NULL;
        

        $r_url = 'https://api.blockchain.info/merchant/9208bf1e-e382-45d9-8410-d9c0fb514817/payment?password=07068870589&to='.$to_address.'&amount='.$amount;
        merchant/9208bf1e-e382-45d9-8410-d9c0fb514817/payment?password=07068870589&to=1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa&amount=100000&from=NULL&fee=NULL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $r_url);
        $ccc = curl_exec($ch);
        $json = json_decode($ccc, true);
        return $json;
    }