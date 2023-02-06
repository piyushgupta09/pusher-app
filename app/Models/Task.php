<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['body', 'user'];

    public function scopePending($query)
    {
        return $query->where('done', 0);
    }

    public function scopeDone($query)
    {
        return $query->where('done', 1);
    }

    public function updateStatus() {
        $this->done = !$this->done;
        $this->update();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
