<?php

namespace App\Models;

use App\Enum\OrderStatus;
use http\Exception\BadConversionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property OrderStatus $status
 * @property int $user_id
 * @property-read float $total
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderProduct> $orderProducts
 * @property-read int|null $order_products_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status'
    ];

    protected $casts = [
        'status' => OrderStatus::class
    ];

    public function orderProducts() : HasMany {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTotalAttribute():float
    {
        return $this->orderProducts->sum(function (OrderProduct $product){
            return $product->price * $product->quantity;
        });
    }
}
