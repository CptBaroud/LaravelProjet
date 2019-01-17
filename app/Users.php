<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Users extends Model implements Authenticatable
{
    use BasicAuthenticatable;

    protected $fillable = ['email', 'password'];

    /**
     * Get the password for the user.
     *
     * @return string
     */

    public function getAuthPassword()
    {
        return $this->password;
    }
}
