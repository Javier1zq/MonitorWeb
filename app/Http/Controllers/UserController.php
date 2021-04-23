<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\MailController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use PDF;
class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function user(Request $request){
        //print_r('hola');
        return $request->user();
    }
    public function data(Request $request){
        //print_r('hola2');
        $user_DNI = $request->user()->DNI;
        //print_r('this is the result of data');
        //print_r($user_DNI);
        $data = DB::table('data_consumption') ->where('DNI', '=', $user_DNI)->orderBy('date', 'desc')->get();

        if ($data) {
                return $data;
        }
        else return null;
    }
    public function services(Request $request){
        //print_r('hola2');
        $user_DNI = $request->user()->DNI;
        //print_r('this is the result of data');
        //print_r($user_DNI);
        $data = DB::table('services') ->where('DNI', '=', $user_DNI)->get();

        if ($data) {
            return $data;
        }
        else return null;
    }
    public function generateInvoice(Request $request){

        $user_DNI = $request->user()->DNI;

        $data = DB::table('services') ->where('DNI', '=', $user_DNI)->get();

        if ($data[0]) {

            //$data[0]->fiber=0;


            $customer = new Buyer([
                'name'          => $request->user()->first_name . ' ' . $request->user()->last_name,
                'custom_fields' => [
                    'email' => 'test@example.com',
                ],
            ]);
            if ($data[0]->data) {
                switch ($data[0]->data_type) {
                    case '9000':
                        $itemData = (new InvoiceItem())->title('Data 9GB')->pricePerUnit(8.90);
                        break;
                    case '17000':
                        $itemData = (new InvoiceItem())->title('Data 17GB')->pricePerUnit(12.90);
                        break;
                    case '52000':
                        $itemData = (new InvoiceItem())->title('Data 52GB')->pricePerUnit(16.90);
                        break;
                    case '92000':
                        $itemData = (new InvoiceItem())->title('Data 92GB')->pricePerUnit(20.90);
                        break;
                    case '0':
                        $itemData = (new InvoiceItem())->title('Data Unlimited GB')->pricePerUnit(29.99);
                        break;
                    default:
                    $itemData = (new InvoiceItem())->title('Data')->pricePerUnit(0.99);
                        break;
                }
            }
            if ($data[0]->fiber) {

                switch ($data[0]->fiber_type) {
                    case '100':
                        $itemFiber = (new InvoiceItem())->title('Fiber 100MB')->pricePerUnit(21.90);
                        break;
                    case '300':
                        $itemFiber = (new InvoiceItem())->title('Fiber 300MB')->pricePerUnit(25.90);
                        break;
                    case '600':
                        $itemFiber = (new InvoiceItem())->title('Fiber 600MB')->pricePerUnit(29.90);
                        break;
                    case '1000':
                        $itemFiber = (new InvoiceItem())->title('Fiber 1000MB')->pricePerUnit(33.90);
                        break;
                    default:
                    $itemFiber = (new InvoiceItem())->title('Fiber')->pricePerUnit(0.99);
                        break;
                }
            }
            if ($data[0]->tv) {
                $itemTV = (new InvoiceItem())->title('Television')->pricePerUnit(8,9);
            }
            $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

            $invoice = Invoice::make()
                ->buyer($customer)
                ->discountByPercent(10)
                ->taxRate(21)
                //->shipping(1.99)
                ->addItem($itemData)
                ->addItem($itemFiber)
                ->addItem($itemTV);

            //$invoice->download('invoice.pdf');
            /*Storage::disk('public')->put("PDFInvoice.pdf",$invoice->stream());
            return $invoice->stream();*/
            $pdf = base64_encode($invoice->stream());

            return response()->json([
                'pdf' => $pdf,
            ]);
        }
        else return null;


    }
    /*public function register(UserRegisterRequest $request){//creates USER with the information on the form
        //print_r($request->DNI);
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'DNI' => $request->DNI,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        return 'User Created successfully';
    }*/
    public function register(Request $request){//creates USER with the information on the form
        //print_r($request->DNI);

        $user= new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->DNI = $request->DNI;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());

        $user->save();

        $service= new Service();
        $service->DNI = $request->DNI;
        if ($request->tvPlan != null) {
            $service->tv = $request->tvPlan;
        }else $service->tv = false;

        switch ($request->dataPlan) {
            case '0':
                $service->data =0;
                $service->data_type = 0;
                $service->phone =0;
                $service->phone_type = 0;
                break;
            case '1':
                $service->data =1;
                $service->data_type = 9000;
                $service->phone =1;
                $service->phone_type = 50000;
                break;
            case '2':
                $service->data =1;
                $service->data_type = 17000;
                $service->phone =1;
                $service->phone_type = 50000;
                break;
            case '3':
                $service->data =1;
                $service->data_type = 52000;
                $service->phone =1;
                $service->phone_type = 50000;
                break;
            case '4':
                $service->data =1;
                $service->data_type = 92000;
                $service->phone =1;
                $service->phone_type = 50000;
                break;
            default:
                $service->data =0;
                $service->data_type = 0;
                $service->phone =0;
                $service->phone_type = 0;
                break;
        }
        switch ($request->fiberPlan) {
            case '0':
                $service->fiber =0;
                $service->fiber_type = 0;
                break;
            case '1':
                $service->fiber =1;
                $service->fiber_type = 100;
                break;
            case '2':
                $service->fiber =1;
                $service->fiber_type = 300;
                break;
            case '3':
                $service->fiber =1;
                $service->fiber_type = 600;
                break;
            case '4':
                $service->fiber =1;
                $service->fiber_type = 1000;
                break;
            default:
                $service->fiber =0;
                $service->fiber_type = 0;
                break;
        }

        $service->save();

        if ($user !=null) {
            MailController::sendSignupEmail($user->first_name, $user->email, $user->verification_code);
            return response()->json([
                'user' => $request->first_name,
                'state' => 'Created successfully',
            ]);

        }
        //show error message
        return response()->json([
            'user' => $request->first_name,
            'state' => 'User not created',
        ]);;
    }


    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();
            //return 'User Verified successfully';
            return redirect()->away('http://localhost:4200/verified');
        }

        return 'User Not verified';
    }

    public function userIsVerified(Request $request){
        $user = User::where(['email' => $request->email])->first();

        if ($user!=null) {
            return $user->is_verified;
        }
        else return false;


    }
}
