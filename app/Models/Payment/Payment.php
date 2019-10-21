<?php

namespace App\Models\Payment;

use App\Utilities\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'payments';
    private static $storeID;
    private static $storePassword;
    private static $transactionAPI;
    private static $validationAPI;

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
    protected $fillable = [
        "participant_id", "tran_id", "currency", "amount", "store_amount", "currency_amount", "card_issuer"
    ];

    /**
     * SET SSL Commerz Store id pass and api
     */
    public static function setStore()
    {
        if (env('APP_ENV') == 'production') {
            self::$storeID = env('LIVE_SSL_STORE_ID');
            self::$storePassword = env('LIVE_SSL_STORE_PASSWORD');
            self::$transactionAPI = env('LIVE_SSL_TRANSACTION_API');
            self::$validationAPI = env('LIVE_SSL_VALIDATION_API');
        } else {
            self::$storeID = env('TEST_SSL_STORE_ID');
            self::$storePassword = env('TEST_SSL_STORE_PASSWORD');
            self::$transactionAPI = env('TEST_SSL_TRANSACTION_API');
            self::$validationAPI = env('TEST_SSL_VALIDATION_API');
        }
    }

    /**
     * @param array $data
     * total_amount, currency, tran_id, success_url, fail_url, cancel_url
     * cus_name, cus_email, cus_add1, cus_add2(optional), cus_city, cus_state(optional),
     * cus_postcode, cus_country, cus_phone, cus_fax(optional),
     * shipping_method, num_of_item, product_name, product_category, product_profile
     * emi_option(0,1)
     *
     * OPTIONAL
     * value_a, value_b, value_c, value_d
     *
     *
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function process(array $data)
    {
        self::setStore();

        $data['store_id'] = self::$storeID;
        $data['store_passwd'] = self::$storePassword;

        $sslcommerzResponse = RequestHandler::sendRequest(self::$transactionAPI, 'POST', [], $data);
        $code = $sslcommerzResponse['res']->getStatusCode();

        if ($code != 200) {
            return ['status' => 'failed', 'message' => 'FAILED TO CONNECT WITH SSLCOMMERZ API'];
        }

        //PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse['content'], true);

        if ($sslcz['status'] == 'SUCCESS') {
            if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                return ['status' => 'success', 'gateway_page_url' => $sslcz['GatewayPageURL']];
            } else {
                return ['status' => 'failed', 'message' => 'JSON Data parsing error!'];
            }
        }

        return false;
    }

    /**
     * @param $val_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function validation($val_id)
    {
        self::setStore();

        $url = self::$validationAPI . "?val_id=$val_id&store_id=" . self::$storeID . "&store_passwd=" . self::$storePassword;
        $result = RequestHandler::sendRequest($url);

        if ($result['res']->getStatusCode() == 200) {
            return json_decode($result['content'], true);
        }
    }
}
