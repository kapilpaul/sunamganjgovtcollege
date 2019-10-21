<?php

namespace App\Http\Controllers\Payment;

use App\Models\Participant\Participants;
use App\Models\Payment\Payment;
use App\Utilities\RequestHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $storeID;
    private $storePassword;
    private $transactionAPI;
    private $validationAPI;

    /**
     * PaymentController constructor.
     */
    public function __construct()
    {
        if (env('APP_ENV') == 'production') {
            $this->storeID = env('LIVE_SSL_STORE_ID');
            $this->storePassword = env('LIVE_SSL_STORE_PASSWORD');
            $this->transactionAPI = env('LIVE_SSL_TRANSACTION_API');
            $this->validationAPI = env('LIVE_SSL_VALIDATION_API');
        } else {
            $this->storeID = env('TEST_SSL_STORE_ID');
            $this->storePassword = env('TEST_SSL_STORE_PASSWORD');
            $this->transactionAPI = env('TEST_SSL_TRANSACTION_API');
            $this->validationAPI = env('TEST_SSL_VALIDATION_API');
        }
    }

    /**
     * @param Request $request
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function process(Request $request)
    {
        $post_data = [];
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

        $response = Payment::process($post_data);
        return $response;

    }

    /**
     * @param Request $request
     * @param $status
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status(Request $request, $status)
    {
        $allowedParams = ['success', 'failed', 'canceled'];
        if (! in_array($status, $allowedParams)) {
            abort(404);
        }

        if ($request->status == 'VALID') {
            if (isset($request->val_id)) {
                $paymentValid = Payment::validation($request->val_id);

                switch ($paymentValid['status']) {
                    case "VALID":
                        return $this->validPayment($paymentValid);
                        break;
                    default:
                        break;
                }
            }
        }
        abort(404);
    }

    /**
     * @param $paymentData
     * @return mixed
     */
    public function validPayment($paymentData)
    {
        $participant = Participants::where('uid', $paymentData['value_a'])->first();

        if ($participant) {
            $participant->update(['paid' => 1]);

            $data = [
                'tran_id' => $paymentData['tran_id'],
                "participant_id" => $participant->id,
                "currency" => $paymentData['currency'],
                "amount" => $paymentData['amount'],
                "store_amount" => $paymentData['store_amount'],
                "currency_amount" => $paymentData['currency_amount'],
                "card_issuer" => $paymentData['card_issuer']
            ];

            return Payment::create($data);
        }

    }
}
