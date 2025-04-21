<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    use HasFactory;

    protected $fillable = [
        'schedule_code',
        'origin_terminal_id',
        'destination_terminal_id',
        'bus_id',
        'departure_time',
        'arrival_time',
        'price',
    ];

    public function origin() {
        return $this->belongsTo(Terminal::class, 'origin_terminal_id');
    }
    public function destination() {
        return $this->belongsTo(Terminal::class, 'destination_terminal_id');
    }
    public function bus() {
        return $this->belongsTo(Bus::class);
    }
}
