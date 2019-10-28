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
        abort(404);
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

        if($status == 'failed' || $status == 'canceled') {
            return redirect()->route('registration.payment', $request->value_a)->with(['error' => "Payment $status"]);
        }

        if ($request->status == 'VALID') {
            if (isset($request->val_id)) {
                $paymentValid = Payment::validation($request->val_id);

                switch ($paymentValid['status']) {
                    case "VALID":
                        if($paymentData = $this->validPayment($paymentValid)) {
                            return redirect()->route('ticket.show', $request->value_a);
                        }
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
