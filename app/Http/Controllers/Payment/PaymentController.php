<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $storeID;
    private $storePassword;
    private $transactionAPI;

    /**
     * PaymentController constructor.
     */
    public function __construct()
    {
        if (env('APP_ENV') == 'production') {
            $this->storeID = env('LIVE_SSL_STORE_ID');
            $this->storePassword = env('LIVE_SSL_STORE_PASSWORD');
            $this->transactionAPI = env('LIVE_SSL_TRANSACTION_API');
        } else {
            $this->storeID = env('TEST_SSL_STORE_ID');
            $this->storePassword = env('TEST_SSL_STORE_PASSWORD');
            $this->transactionAPI = env('TEST_SSL_TRANSACTION_API');
        }
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function process(Request $request)
    {
        $post_data = [];
        $post_data['store_id'] = $this->storeID;
        $post_data['store_passwd'] = $this->storePassword;
        $post_data['total_amount'] = "1";
        $post_data['currency'] = "USD";
        $post_data['tran_id'] = Str::random(10);
        $post_data['success_url'] = route('payment.status', 'success');
        $post_data['fail_url'] = route('payment.status', 'failed');
        $post_data['cancel_url'] = route('payment.status', 'canceled');

# CUSTOMER INFORMATION
        $post_data['cus_name'] = "Kapil Paul";
        $post_data['cus_email'] = "test@test.com";
        $post_data['cus_add1'] = "Dhaka";
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "Dhaka";
        $post_data['cus_postcode'] = "1000";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '01111';
        $post_data['cus_fax'] = "";

# SHIPMENT INFORMATION
        $post_data['shipping_method'] = "NO";
        $post_data['num_of_item'] = 1;
        $post_data['product_name'] = "TEST Registration Fee";
        $post_data['product_category'] = "Registration";
        $post_data['product_profile'] = "non-physical-goods";

# OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b '] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

# EMI STATUS
        $post_data['emi_option'] = "0";


# REQUEST SEND TO SSLCOMMERZ
        $direct_api_url = $this->transactionAPI;

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

# PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
            # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
            # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
//            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }
    }

    /**
     * @param Request $request
     * @param $status
     */
    public function status(Request $request, $status)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id={$request->val_id}&store_id=$this->storeID&store_passwd=$this->storePassword&format=json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        dd($result);
    }
}
