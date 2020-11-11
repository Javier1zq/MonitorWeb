<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Address;
class AddressController extends Controller
{
    public function index()
    {
        //return Address::all();
        $address=Address::all();
        return view('listAddress',['addresses'=>$address]);
    }
    public function searchAddress()
    {
        $address=Address::all();
        return view('searchAddress',['addresses'=>$address]);
    }

    public function addressSearch(Request $request)
    {
        //print_r($request->input());

        $address=Address::all();
        $addressAux = new Address;
        $addressAux->street = $request->street;
        $addressAux->number = $request->number;
        $addressAux->townId = $request->townId;
        $addressAux->provinceId = $request->provinceId;
        $addressAux->type = $request->type;

        
        $found = false;
        foreach($address as $list){
            
            
            if($addressAux->street == $list->street && $addressAux->number == $list->number && $addressAux->townId == $list->townId && $addressAux->provinceId == $list->provinceId && $addressAux->type == $list->type){
                print_r("Found");
                $found = true;
            break;
            }
        }
        if($found == false){
            print_r("Not Found");
        }
        

        //$address->save();
        //return redirect('searchAddress')->with('status', 'Post Form Data Has Been inserted');*/
    }
    public function searchForm()
    {
        
        /*$foo = array('code' => '200'),array('code' => '200');
        $json = json_encode($myArr);*/
       // $json= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="plaza"')->json();
        //$json= '{}';
        //$data = $json;
        $json = null;
        $data = $json;
        return view('searchForm',['data'=>$data],['json'=>$json]);
    }
    public function searchFormAction(Request $request)
    {
        print_r(urlencode($request->address));
        
        $json= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="'.urlencode($request->address).'"')->json();

        $data = $json;

        return view('searchForm',['data'=>$data],['json'=>$json]);
    }

    
    /*
    public function store(Request $request)
    {
        $address = new Address;
        $address->street = $request->street;
        $address->number = $request->number;
        $address->townId = $request->townId;
        $address->provinceId = $request->provinceId;
        $address->type = $request->type;


        $address->save();
        return redirect('add-address-form')->with('status', 'Post Form Data Has Been inserted');
    }*/
}


