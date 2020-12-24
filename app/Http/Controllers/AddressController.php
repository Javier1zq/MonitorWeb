<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Address;
use App\Models\check_address;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
class AddressController extends Controller
{
    public function index()
    {
        $address=Address::all();
        return view('listAddress',['addresses'=>$address]);
    }
    public function searchAddress()
    {
        $address=Address::all();
        return view('searchAddress',['addresses'=>$address]);
    }
    public function listDB(Request $request)//local DB search
    {
        $addressAux = new check_address;
        $addressAux->street = $request->street;
        $addressAux->number = $request->number;
        $addressAux->town = $request->town;

        $address = DB::table('check_addresses') ->where('Localidad', '=', Helper::removeAccents($request->town))
                                                ->where('Nombre', '=', Helper::removeAccents($request->street))
                                                ->where('Nº', '=', Helper::removeAccents($request->number))
                                                ->get();

        foreach ($address as $list) {
            if (strcasecmp(Helper::removeAccents($addressAux->street), Helper::removeAccents($list->Nombre))==0) {
                print_r('loco funciona');
            }

        }

        print_r($address);
        return view('listAddress');
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
    public function checkCoverageApi(Request $request) //API call for finding coverage in SQL database
    {

        $address = DB::table('check_addresses') ->where('Localidad', '=', Helper::removeAccents($request->town))
                                                ->where('Nombre', '=', Helper::removeAccents($request->street))
                                                ->where('Nº', '=', Helper::removeAccents($request->number))
                                                ->get();

        $found = false;
        foreach($address as $list){

            if(strcasecmp(Helper::removeAccents($request->street), Helper::removeAccents($list->Nombre))==0 && strcasecmp(Helper::removeAccents($request->number), Helper::removeAccents($list->Nº))==0 && strcasecmp(Helper::removeAccents($request->town), Helper::removeAccents($list->Localidad))==0){
                return "found";
                $found = true;
            break;
            }
        }
        if($found == false){
            return "not_found";
        }
    }
    public function searchForm()
    {

        $json = null;
        $data = $json;
        return view('searchForm',['data'=>$data],['json'=>$json]);
    }
    public function searchFormAction(Request $request) //local requests
    {
        print_r(urlencode($request->address));
        $json= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="'.urlencode($request->address).'"')->json();
        $data = $json;
        return view('searchForm',['data'=>$data],['json'=>$json]);
    }
    public function searchFormActionApi(Request $request)//Api requests e.g. http://localhost:8000/api/searchFormActionApi?address=Plaza los portales
    {
        print_r(urlencode($request->address));
        $json= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="'.urlencode($request->address).'"')->json();
        $data = $json;
        return ['json'=>$json];
    }

    public function confirmAddress(Request $request)
    {
        print_r($request->get('type'));
        print_r($request->number);
        $json1= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="'.urlencode($request->get('type')).'"')->json();

        foreach($json1['data'] as $item ){
            $addressAux = new Address;
            $addressAux->street = $item['street'];
            $addressAux->number = $request->number;
            $addressAux->townId = $item['townId'];
            $addressAux->provinceId = $item['provinceId'];
            $addressAux->type = $item['type'];
            $addressAux->province = $item['province'];
            $addressAux->town = $item['town'];
        }

        $json= Http::get('https://www.finetwork.com/api/v2/fiber/addresses?street='.$addressAux->street.'&number='.$addressAux->number.'&province='.$addressAux->province.'&town='.$addressAux->town.'&provinceId='.$addressAux->provinceId.'&townId='.$addressAux->townId.'&type='.$addressAux->type)->json();
        print_r($json);
        $data = $json;
        $json=null;
    return view('searchForm'/*,['data'=>$data]*/,['json'=>$json]);
    }
    public function confirmAddressApi(Request $request)
    {
        print_r($request->get('type'));
        print_r($request->number);
        $json1= Http::get('https://www.finetwork.com/api/v2/fiber/normalizer?address="'.urlencode($request->get('type')).'"')->json();

        foreach($json1['data'] as $item ){
            $addressAux = new Address;
            $addressAux->street = $item['street'];
            $addressAux->number = $request->number;
            $addressAux->townId = $item['townId'];
            $addressAux->provinceId = $item['provinceId'];
            $addressAux->type = $item['type'];
            $addressAux->province = $item['province'];
            $addressAux->town = $item['town'];
        }

        $json= Http::get('https://www.finetwork.com/api/v2/fiber/addresses?street='.$addressAux->street.'&number='.$addressAux->number.'&province='.$addressAux->province.'&town='.$addressAux->town.'&provinceId='.$addressAux->provinceId.'&townId='.$addressAux->townId.'&type='.$addressAux->type)->json();
        print_r($json);
        $data = $json;
        $json=null;
    return ['json'=>$json];
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



