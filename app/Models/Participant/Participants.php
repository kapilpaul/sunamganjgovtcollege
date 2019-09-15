<?php

namespace App\Models\Participant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participants extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'participants';

    /**
     * The database primary key value.
     * @var string
     */
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ["alias_id", "uid", "title", "name", "email", "mobile_no", "image", "year_of_birth", "admission_year", "class", "group", "subject", "address", "city", "state", "country", "zip_code", "occupation", "occupation_details", "current_student", "outside_of_bd", "only_register", "paid"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guests()
    {
        return $this->hasMany(Guest::class, 'participant_id', 'id');
    }
}
