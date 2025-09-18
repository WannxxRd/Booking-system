<?php

namespace App\Validation;

use App\Models\AdminModel;

class PasslamaValidation
{
    public function passlama($value)
    {
        $admin = new AdminModel();
        $result = $admin->find(session()->get('id'));

        if (password_verify($value, $result['password'])) {
            return true;
        }

        return false;
    }
}
