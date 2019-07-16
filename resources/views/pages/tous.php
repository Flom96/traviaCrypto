public function pay() {

        $secret = 'Ayt48Rbu1uji90vdq55J';

        $my_xpub = 'xpub6BnapLD2cZ97DZb4uPJxPsFWzfAPGoXWJmY5GYQ15AGhx1PrNUrm97zMcks1gkZ723Pp6LGeGY4L5udcUCNV5YjXuMfGxHskJWvzferRrsK';
        $my_api_key = 'a62b05e0-3c68-48c0-88a3-f1490efd3b81';

        $invoice = uniqid();

        $my_callback_url = 'http://www.quiz.cleanhomevip.com/received?invoice='.$invoice.'&user_id='.Auth::User()->id.'&secret='.$secret;

        $root_url = 'https://api.blockchain.info/v2/receive';

        $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key;

        $r_url = $root_url.'?'.$parameters;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $r_url);
        $ccc = curl_exec($ch);
        $json = json_decode($ccc, true);
        $payTo = $json['address'];

        return  $payTo;
    }


    public function pay() {

        $secret = 'Ayt48Rbu1uji90vdq55J';

        $my_xpub = 'xpub6BnapLD2cZ97DZb4uPJxPsFWzfAPGoXWJmY5GYQ15AGhx1PrNUrm97zMcks1gkZ723Pp6LGeGY4L5udcUCNV5YjXuMfGxHskJWvzferRrsK';
        $my_api_key = 'a62b05e0-3c68-48c0-88a3-f1490efd3b81';
        $Blockchain = new Blockchain($my_api_key);

        $invoice = uniqid();

        $my_callback_url = 'http://www.quiz.cleanhomevip.com/received?invoice='.$invoice.'&user_id='.Auth::User()->id.'&secret='.$secret;

        
        $response = $blockchain->ReceiveV2->generate($my_api_key, $my_xpub, $my_callback_url);

        return  $response->getReceiveAddress();;
    }