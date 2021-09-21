<?php

namespace App\Models;

use App\Models\CancelledPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $guarded = [];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'id_payment_method');
    }

    public function userMembreship(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_user_membreship');
    }

    /**
     * Get the CancelledPayment associated with the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cancelledpayment(): HasOne
    {
        return $this->hasOne(CancelledPayment::class);
    }
    /**
     * The products that belong to the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');;
    }

    /**Scopes  Para comprotbar stado del pago autorizado standby o passed  o rejected **/
    // public function scopeStandby($query)
    // {
    //     return $query->where('authorized', 'standby');
    // }

    // public function scopePassed($query)
    // {
    //     return $query->where('authorized', 'passed');
    // } 
    // public function scopeRejected($query)
    // {
    //     return $query->where('authorized', 'rejected');
    // }
    /**end Socpes autorizado */

    // Scope  payments where Auth::user
    public function scopePaymentAuthSponsor($query)
    {
        return $query->where('id_user_sponsor', auth()->user()->id);
    }
}
