<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Users extends Model implements Authenticatable
{
    use BasicAuthenticatable;
    use Notifiable;

    protected $fillable = ['email', 'password'];

    /**
     * Get the password for the user.
     *
     * @return string
     */

    public function getAuthPassword()
    {
      if($this->password != null){
        return $this->password;
      }
    }

    public function getRememberTokenName() {

      return '';

    }
}
