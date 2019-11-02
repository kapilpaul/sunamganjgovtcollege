<?php

namespace App\Models\Participant;

use App\Models\Payment\Payment;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'participant_id', 'id');
    }

    /**
     * @param $participant_uid
     * @return float|int
     */
    public static function calculateFee($participant_uid)
    {
        $participant = Participants::where('uid', $participant_uid)->with('guests')->first();

        if ($participant) {
            $noOfGuests = $totalAmount = 0;
            $fee = [];

            if (count($participant->guests) > 0) {
                $noOfGuests = count($participant->guests);
            }

            if ($participant->outside_of_bd) {
                $fee = self::feeByStudentType('outside_of_bd');
            } else {
                $fee = self::feeByStudentType('former_student_in_bd');
            }

            if ($participant->current_student) {
                $fee = self::feeByStudentType('current_student');
            }

            if ($participant->only_register) {
                $fee = self::feeByStudentType('only_registration');
            }

            $guestFee = ($noOfGuests * $fee['guest']);
            $totalAmount = $fee['self'] + $guestFee;

            return $totalAmount;
        }
    }

    /**
     * @param $studentType
     * @return mixed
     */
    public static function feeByStudentType($studentType)
    {
        $fees = self::feeAmounts();

        switch ($studentType) {
            case "only_registration" :
                return $fees['only_registration'];
                break;
            case "outside_of_bd" :
                return $fees['immigrant_former_student'];
                break;
            case "current_student" :
                return $fees['current_student'];
                break;
            default:
                return $fees['former_student_in_bd'];
                break;
        }
    }

    /**
     * @return array
     */
    public static function feeAmounts()
    {
        $fees = [
            "only_registration" => [
                "self" => 500,
                "guest" => 0
            ],
            "nrb_only_registration" => 6,
            "former_student_in_bd" => [
                "self" => 1000,
                "guest" => 500
            ],
            "immigrant_former_student" => [
                "self" => 12,
                "guest" => 6,
            ],
            "current_student" => [
                "self" => 300,
                "guest" => 300,
            ]
        ];

        return $fees;
    }
}
