<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $fillable = ['file_path'];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
