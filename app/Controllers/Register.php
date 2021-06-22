<?php

namespace App\Controllers;

class Register extends BaseController
{
	public function index()
	{
		echo view('auth/headerAuth');
		echo view('auth/register');
		echo view('auth/footerAuth');
	}
}