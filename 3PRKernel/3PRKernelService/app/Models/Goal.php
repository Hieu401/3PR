<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Goal extends Model
{
    use HasUuids;

    protected $table = "goals";
    protected $primaryKey = "uuid";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "user_uuid",
        "name",
        "weight_goal",
        "rep_goal",
        "note"
    ];

    public function progressionSetPlans(): HasMany
    {
        return $this->hasMany(ProgressionSetPlan::class, 'goal_uuid', 'uuid');
    }
}
