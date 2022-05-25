<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelOtentikasi;

class Otentikasi extends BaseController
{
	use ResponseTrait;
	public function index()
	{
		$validation = \Config\Services::validation();
		$aturan = [
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Silakan masukkan email',
					'valid_email' => 'Silakan masukkan email yang valid'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Silakan masukkan password',

				]
			]
		];
		$validation->setRules($aturan);
		if (!$validation->withRequest($this->request)->run()) {
			return $this->fail($validation->getErrors());
		}

		$model = new ModelOtentikasi();

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$data = $model->getEmail($email);
		if ($data['password'] != md5($password)) {
			return $this->fail("Password tidak sesuai");
		}

		helper('jwt');
		$response = [
			'message' => 'Otentikasi berhasil dilakukan',
			'data' => $data,
			'access_token' => createJWT($email)
		];
		return $this->respond($response);
	}
}
