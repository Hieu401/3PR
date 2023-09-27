<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressionSetPlan extends Model
{

    use HasUuids;

    protected $table = "progression_set_plans";
    protected $primaryKey = "uuid";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "weight",
        "set_number",
        "reps",
        "type"
    ];

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class, 'goal_uuid', 'uuid');
    }


}
