public function sendBitcoin() {
        
        $to_address = '3DwFMPRr6YwJsP2WMc4TGbQCsvV2Wze5yb';
        $amount = 100000;
        $from = '1DHTkjZkBBqeetaabmfFQJUKa6qhndpRF6';
        $fee = 1000;
        $index = 0;
        

        $r_url = 'http://127.0.0.1:3000/merchant/9208bf1e-e382-45d9-8410-d9c0fb514817/payment?password=07068870589&to='.$to_address.'&amount='.$amount.'&from='.$from.'&index='.$index.'&fee_per_byte='.$fee;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $r_url);
        return $ccc = curl_exec($ch);
        $json = json_decode($ccc, true);
        return $json;
    }