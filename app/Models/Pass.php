<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model {
    use HasFactory;

    protected $fillable = [
      'pass_code','user_id','schedule_id','start_date','end_date'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
    public function schedule() {
      return $this->belongsTo(Schedule::class)->with('origin','destination','bus');
    }
}
