<?php

namespace App\Controllers\auth; //Necesario cuando se tiene controllers en subcarpetas
use App\Controllers\BaseController;

class Register extends BaseController
{
	public function index()
	{
		echo view('auth/headerAuth');
		echo view('auth/register');
		echo view('auth/footerAuth');
	}
}