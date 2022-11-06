<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Logic extends BaseController
{
	use ResponseTrait;

	public function index()
	{
        echo view('header');
        echo view('options');
		echo view('footer');
	}

	public function buypin()
	{
        echo view('header');
        echo view('buypin');
		echo view('footer');
	}

    public function payonline()
    {
        echo view('header');
        echo view('payonline');
        echo view('footer');
    }

	public function register()
	{
        echo view('header');
        echo view('pin');
		echo view('footer');
	}

	public function pinstatus()
	{
        echo view('header');
        echo view('pinstatus');
		echo view('footer');
	}

	public function vendors()
	{
		echo view('vendors');
	}

	public function msg($mg = "Hello")
	{
        echo view('header');
		echo view('msg', ['mg' => $mg]);
        echo view('footer');
	}

	public function pin()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();
		if($value = $Pins->where(['pin'=>$incoming['pin'],'used !='=>1])->find()){
            echo view('header');
			echo view('home',['ref'=>$incoming['pin']]);
            echo view('footer');

		}else{
			$this->msg("The pin you entered is invalid");
		}
	}

	public function pinstat()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();

		$value = $Pins->where(['pin'=>$incoming['pin']])->find();
		$this->msg("Is the pin used? ". $this->boolconv($value[0]['used']));
		
	}

    private function boolconv($v)
    {
        switch ($v) {
            case '0':
                return 'No';
                break;

            case '1':
                return 'Yes';
                break;

            default:
                return 'Unknown';
                break;
        }
    }

	public function registration()
	{
		$incoming = $this->request->getPost();
		$Pins = new \App\Models\Pins();
        $Delegates = new \App\Models\Delegates();
		$Delegates21 = new \App\Models\Delegates21();
        if($incoming['lcamp'] == 'on'){
            $wdata = [
                'fname' => $incoming['fname'],
                'lname' => $incoming['lname'],
                'lb' => $incoming['lb'],
            ];
            $res = $Delegates21->where($wdata)->find();
            if($res){
                echo view('header');
                echo view('home2',['udata'=>$res[0],'ref'=>$incoming['ref']]);
                echo view('footer');
            }else{
                echo view('header');
                echo view('home',['ref'=>$incoming['ref']]);
                echo view('footer');
            }

        }else{
            $pin = $Pins->where('pin',$incoming['ref'])->find()[0];
            if($pin['used'] == 1){
                $this->msg('Sorry, this pin has been used.');
            }else{
    		  $id = $Delegates->insert($incoming);
    		  $Pins->update($pin['id'],['used'=>'1']);
    		  $this->msg('Congratulations! Your registration was successful <br> Reg. No: <b> '.$id.'</b>');
    		}
        }
	}

	public function sms()
	{
		$incoming = $this->request->getJSON();
		$Alerts = new \App\Models\Alerts();
		$res = $Alerts->insert(['message' => $incoming->message]);

		$data = [
			'message' => 'created' . $res
		];
		if ($res) {
			return $this->respond($data, 200);
		} else {
			return $this->respond(['message' => 'Not Added'], 400);
		}
	}

	public function uniqidReal($lenght = 4) {
		// uniqid gives 13 chars, but you could adjust it to your needs.
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			echo("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}

		
	public function samp()
	{
        $Pins = new \App\Models\Pins();

        for ($i=1; $i <= 3000; $i++) {
            $p = strtoupper($this->uniqidReal(5));
            echo ($i.' '.$p.'<br>');
            $id = $Pins->insert(['pin'=> $p]);

        }
		
	}

    public function proceedOnline()
    {
        $Tranx = new \App\Models\Tranx();
       $incoming = $this->request->getPost();
       $amt = 10000;
       $payment = $this->genPayLink($incoming['email'], $amt);
        $payData = json_decode($payment['response']);
        $payRef = $payment['ref'];
        $data = [
            'email' => $incoming['email'],
            'status' => 'Intialize',
            'ref' => $payRef,
            'url' => $payData->data->checkout_url
        ];
        $Tranx->insert($data);
        return redirect()->to($payData->data->checkout_url);
    }

    public function webhook()
    {
        $Alerts = new \App\Models\Alerts();
        $incoming = $this->request->getGet();
        $Alerts->insert(['message'=>json_encode($incoming), 'linked'=>0]);
    }

    private function genPayLink($email,$amt)
    {
        $ref = uniqid('phf22_', true);
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.collect.africa/payments/initialize",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"email\":\"".$email."\",\"amount\":".$amt.",\"reference\":\"".$ref."\"}",
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".$_ENV['paySK']."",
            "accept: application/json",
            "content-type: application/json"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return ['response'=>$response,'ref' => $ref];
        }
    }
	//--------------------------------------------------------------------

}



    // https://api.collect.africa
//
//