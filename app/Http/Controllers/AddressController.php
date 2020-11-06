<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
    public function addressLookUp(Request $request)
    {
        $address=Address::all();
        $addressAux = new Address;
        $addressAux->street = $request->street;
        $addressAux->number = $request->number;
        $addressAux->townId = $request->townId;
        $addressAux->provinceId = $request->provinceId;
        $addressAux->type = $request->type;

        foreach($address as $list){
            if($addressAux == $list){
                return redirect('searchAddress')->with('status', 'Address is found');
            }
        }

        $address->save();
        return redirect('searchAddress')->with('status', 'Post Form Data Has Been inserted');
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
