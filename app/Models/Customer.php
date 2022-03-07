<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tb_customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_name', 'contact_name', 'address', 'city'];
}
