<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property string $name
 * @property int $quantity
 * @property string $price
 * @property-read float $total_price
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProduct whereQuantity($value)
 * @mixin \Eloquent
 */
class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'quantity',
        'price'
    ];

    public function order():BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function getTotalPriceAttribute():float
    {
        return round((float) $this->attributes['price'] * $this->quantity, 2);
    }
}
