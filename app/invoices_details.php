<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'section',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];
    
}