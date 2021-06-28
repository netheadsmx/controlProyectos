<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function regex() {
        $password ="G03659143e";
        $regex = '/^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
        if (preg_match($regex,$password)) {
            echo "MATCH";
        } else {
            echo "NO MATCH";
        }
    }
}
