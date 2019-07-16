public function sendBitcoin(Request $request) {
        if($request->amount == NULL) {
            return back()->with('success', 'Amount cant be empty');
        }
        elseif (!is_numeric($request->amount)) {
            return back()->with('success', 'Amount must be a numeric value');
        }
        else{
            $int = (int)$request->amount;
            $amount = (float)$int;
            if($amount < 0.0) {
                return back()->with('success', 'Invalid amount');
            }
            elseif($amount > $request->wal_let) {
                return back()->with('success', 'Insufficient balance');
            }
        }
        return back()->with('success', 'yes');
        $my_api_key = 'a62b05e0-3c68-48c0-88a3-f1490efd3b81';
        $to_address = '3DwFMPRr6YwJsP2WMc4TGbQCsvV2Wze5yb';
        $amount = '100000';
        $from_address = NULL;
        $fee = NULL;

        $Blockchain = new Blockchain($my_api_key);
        $Blockchain->setServiceUrl("http://127.0.0.1:3000");
        $Blockchain->Wallet->credentials('9208bf1e-e382-45d9-8410-d9c0fb514817', '07068870589');
        
        $balance = $Blockchain->Wallet->getBalance();
        return $balance;
    }