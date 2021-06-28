<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeIgniter\Validation;

use CodeIgniter\HTTP\RequestInterface;
use Config\Mimes;
use Config\Services;

/**
 * File validation rules
 */
class CustomeRules
{
    public function validate_password($password)
	{
		$regex = '/^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
        if (preg_match($regex,$password)) {
            return true;
        } else {
            return false;
        }
	}
}