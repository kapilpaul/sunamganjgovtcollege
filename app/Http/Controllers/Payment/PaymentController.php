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
        dd($request->all());
        $post_data = [];
        $post_data['store_id'] = $this->storeID;
        $post_data['store_passwd'] = $this->storePassword;
        $post_data['total_amount'] = "50";
        $post_data['currency'] = "BDT";
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
        $post_data['cus_phone'] = '';
        $post_data['cus_fax'] = "";

# SHIPMENT INFORMATION
        $post_data['shipping_method'] = "NO";
        $post_data['num_of_item'] = 1;
        $post_data['product_name'] = "Registration Fee";
        $post_data['product_category'] = "Registration";
        $post_data['product_profile'] = "non-physical-goods";

# OPTIONAL PARAMETERS
//        $post_data['value_a'] = "ref001";
//        $post_data['value_b '] = "ref002";
//        $post_data['value_c'] = "ref003";
//        $post_data['value_d'] = "ref004";

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
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close($handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

# PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true);

//dd($sslcz); exit;

        if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
            // this is important to show the popup, return or echo to sent json response back
            return json_encode(['status' => 'success', 'data' => $sslcz['GatewayPageURL'], 'logo' => $sslcz['storeLogo']]);
        } else {
            return json_encode(['status' => 'fail', 'data' => null, 'message' => "JSON Data parsing error!"]);
        }
    }

    public function status($status)
    {

    }
}
