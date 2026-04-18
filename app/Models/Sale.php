<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no','total','tax','discount','customer_name','customer_phone'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
