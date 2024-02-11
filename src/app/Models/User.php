<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => 1
    ];
    
    //HELPER FUNCTIONS
    
    /**
     * Changes field Active for current User
     * If User is active sets field 'active' to 0 
     * and 1 if user was inactive before
     * 
     * @return $this fluent interface
     */
    public function setActive()
    {
        ($this->active) ? $this->active = 0 : $this->active = 1;
        return $this;
    }
    
    public function deleteImage()
    {
        if(!$this->image){
            return $this;
        }
        $imageFilePath = public_path('/storage/users/' . $this->image);
        if(!is_file($imageFilePath)){
            return $this;
        }
        unlink($imageFilePath);
        $this->image = null;
        return $this;
    }
    
    public function getImageUrl()
    {
        if($this->image){
            return url('/storage/users/' . $this->image);
        }
        return 'https://via.placeholder.com/200';
    }
}
