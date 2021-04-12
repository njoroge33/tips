<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $table = 'tips';
    protected $fillable = ["prediction_id", "home_team", "away_team", "game_date", "outcome"];

    public function prediction()
    {
        return $this->belongsTo(Prediction::class, 'prediction_id');
    }

    public function outcome()
    {
        return $this->belongsTo(Prediction::class, 'outcome');
    }
}
