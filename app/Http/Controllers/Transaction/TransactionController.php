<?php


namespace App\Http\Controllers\Transaction;


use App\Exports\InvoicesExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Helpers\FileTypeDetector;
use phpDocumentor\Reflection\Types\Collection;

class TransactionController extends Controller
{
    public function transactionEscrow(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.escrow.com/2017-09-01/transaction',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERPWD => 'error500developerhelpme@gmail.com:Aa123456789',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode(
                array(
                    'parties' => array(
                        array(
                            'role' => 'buyer',
                            'customer' => 'me',
                        ),
                        array(
                            'role' => 'seller',
                            'customer' => 'david656558a@gmail.com',
                        ),
                    ),
                    'currency' => 'usd',
                    'description' => '1962 Fender Stratocaster',
                    'items' => array(
                        array(
                            'title' => '1962 Fender Stratocaster',
                            'description' => 'Like new condition, includes original hard case.',
                            'type' => 'general_merchandise',
                            'inspection_period' => 259200,
                            'quantity' => 1,
                            'schedule' => array(
                                array(
                                    'amount' => 100.0,
                                    'payer_customer' => 'cexpert01000011@gmail.com',
                                    'beneficiary_customer' => 'error500developerhelpme@gmail.com',
                                )
                            )
                        )
                    )
                )
            )
           /* CURLOPT_POSTFIELDS => json_encode(
                array(
                    'currency' => 'usd',
                    'items' => array(
                        array(
                            'description' => 'buy watch',
                            'schedule' => array(
                                array(
                                    'payer_customer' => 'me',
                                    'amount' => '100',
                                    'beneficiary_customer' => 'david656558a@gmail.com',
                                ),
                            ),
                            'title' => 'buy watch',
                            'inspection_period' => '259200',
                            'type' => 'chronogrid.com',
                            'quantity' => '5',
                            'extra_attributes' => array(
                                'image_url' => 'https://app.chronogrid.com/assets/custom/img/logo.png',
                                'merchant_url' => 'https://chronogrid.com/'
                            ),
                        ),
                    ),
                    'description' => 'The sale of johnwick.com',
                    'parties' => array(
                        array(
                            'customer' => 'me',
                            'role' => 'buyer',
                        ),
                        array(
                            'customer' => 'david656558a@gmail.com',
                            'role' => 'seller',
                        ),
                    ),
                )
            )*/
        ));

        $output = curl_exec($curl);
        echo '<pre>'.$output.'</pre>';
        curl_close($curl);
    }

    public function creteUserEscrow(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERPWD => 'error500developerhelpme@gmail.com:Aa123456789',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode(
                array(
                    'phone_number' => '8885118600',
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'middle_name' => 'Kane',
                    'address' => array(
                        'city' => 'San Francisco',
                        'post_code' => '10203',
                        'country' => 'US',
                        'line2' => 'Apartment 301020',
                        'line1' => '1829 West Lane',
                        'state' => 'CA',
                    ),
                    'email' => 'cexpert01000011@gmail.com',
                )
            )
        ));

        $output = curl_exec($curl);
        echo '<pre>'.$output.'</pre>';
        curl_close($curl);
    }



    public function test(Request $request)
    {
        $user = User::query()->get()->map(function ($q){
            $tt = [
                'email' => $q->email,
                'name' => $q->name,
            ];
            return $tt;
        })->toArray();
        $user_pass = User::query()->get()->map(function ($q){
            $tt = [
                'password' => $q->password,
                'name' => $q->id,
            ];
            return $tt;
        })->toArray();

        $data = [
            'user' => $user,
            'user_pass' => $user_pass,
        ];
        return response()->json($data,200);
    }


}
