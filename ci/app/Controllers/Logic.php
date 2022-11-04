<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Logic extends BaseController
{
	use ResponseTrait;

	public function index()
	{
<<<<<<< HEAD
		echo view('options');
=======
        echo view('header');
        echo view('options');
		echo view('footer');
>>>>>>> 5b6c122 (2022)
	}

	public function buypin()
	{
<<<<<<< HEAD
		echo view('buypin');
=======
        echo view('header');
        echo view('buypin');
		echo view('footer');
>>>>>>> 5b6c122 (2022)
	}

	public function register()
	{
<<<<<<< HEAD
		echo view('pin');
=======
        echo view('header');
        echo view('pin');
		echo view('footer');
>>>>>>> 5b6c122 (2022)
	}

	public function pinstatus()
	{
<<<<<<< HEAD
		echo view('pinstatus');
=======
        echo view('header');
        echo view('pinstatus');
		echo view('footer');
>>>>>>> 5b6c122 (2022)
	}

	public function vendors()
	{
		echo view('vendors');
	}

	public function msg($mg = "Hello")
	{
<<<<<<< HEAD
		echo view('msg', ['mg' => $mg]);
=======
        echo view('header');
		echo view('msg', ['mg' => $mg]);
        echo view('footer');
>>>>>>> 5b6c122 (2022)
	}

	public function pin()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();

<<<<<<< HEAD
		if($value = $Pins->where(['pin'=>$incoming['pin'],'used !='=>'yes'])->find()){
			// $Pins->update($value[0]['id'],['used'=>'using']);
			echo view('home',['ref'=>$incoming['pin']]);
=======
		if($value = $Pins->where(['pin'=>$incoming['pin'],'used !='=>1])->find()){
			// $Pins->update($value[0]['id'],['used'=>'using']);
            echo view('header');
			echo view('home',['ref'=>$incoming['pin']]);
            echo view('footer');

>>>>>>> 5b6c122 (2022)
		}else{
			$this->msg("The pin you entered is invalid");
		}
	}

	public function pinstat()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();

		$value = $Pins->where(['pin'=>$incoming['pin']])->find();
<<<<<<< HEAD
		$this->msg("Is the pin used? ". strtoupper($value[0]['used']));
		
	}

=======
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

>>>>>>> 5b6c122 (2022)
	public function registration()
	{
		$incoming = $this->request->getPost();
		$Pins = new \App\Models\Pins();
<<<<<<< HEAD
		$Delegates = new \App\Models\Delegates();
		$pin_id = $Pins->where('pin',$incoming['ref'])->find()[0]['id'];
		if($value = $Pins->where(['id'=>$pin_id,'used'=>'yes'])->find()){
			$this->msg('Sorry, this pin has been used.');
		}else{
		$id = $Delegates->insert($incoming);
		$Pins->update($pin_id,['used'=>'yes']);
		$this->msg('Congratulations! Your registration was successful <br> Reg. No: <b> '.$id.'</b>');
		}
=======
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
    		// $pin_id = $Pins->where('pin',$incoming['ref'])->find()[0]['id'];

    		// if($value = $Pins->where(['id'=>$pin_id,'used'=>'yes'])->find()){
      //           $this->msg('Sorry, this pin has been used.');
      //       }else{
            if($pin['used'] == 1){
                $this->msg('Sorry, this pin has been used.');
            }else{
    		  $id = $Delegates->insert($incoming);
    		  $Pins->update($pin['id'],['used'=>'1']);
    		  $this->msg('Congratulations! Your registration was successful <br> Reg. No: <b> '.$id.'</b>');
    		}
        }
>>>>>>> 5b6c122 (2022)
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
<<<<<<< HEAD
		echo ($this->uniqidReal(8));
=======
        $Pins = new \App\Models\Pins();

        for ($i=1; $i <= 3000; $i++) {
            $p = strtoupper($this->uniqidReal(5));
            echo ($i.' '.$p.'<br>');
            $id = $Pins->insert(['pin'=> $p]);

        }
>>>>>>> 5b6c122 (2022)
		
	}
	//--------------------------------------------------------------------

}
<<<<<<< HEAD
=======

>>>>>>> 5b6c122 (2022)
