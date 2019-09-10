<?php

namespace App\Models\Participant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;
    /**
    * The database table used by the model.
    * @var string
    */
    protected $table = 'guests';

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
    protected $fillable = ["alias_id", "name", "image", "age", "relation", "other", "participant_id"];
}
