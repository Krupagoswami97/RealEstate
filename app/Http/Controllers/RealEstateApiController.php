<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Validator;

class RealEstateApiController extends Controller
{
    private $responseTitle;

    public function __construct()
    {
        $this->responseTitle = "Real Estate Record";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $obj = RealEstate::select('id','name','real_estate_type','city','country');
        $obj = $obj->orderBy('id', 'desc')->get();
        if(count($obj) > 0)
        {
            $response = APIResponse(true, 200, [], 'Successfully Get '.$this->responseTitle, ['list_record' => $obj]);
            return response($response, 200);
        }
        else
        {
            $response = APIResponse(false, 200, [], $this->responseTitle.' Not Found', []);
            return response($response, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // It is not useful because we creating API
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $CountryRegex = '#^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$#m';
        // if($request->country){
        //     if(!preg_match($CountryRegex, $request->country)){

        //         $response = APIResponse(false, 422, "Invalid Country", 'Validation error', []);
        //         return response($response, 422);
        //     }
        // }

        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required',
            'real_estate_type' => 'required',
            'street' => 'required',
            'external_number' => 'required|regex:/^[a-zA-Z0-9-]+$/',
            'internal_number' => 'nullable|required_if:real_estate_type,Department,Commercial Ground|regex:/^[a-zA-Z0-9- ]*$/',
            'neighborhood' => 'required',
            'city' => 'required',
            'country' =>[
                'required',
                function ($attribute,$country, $fail) {
                    if (!preg_match('#^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$#m', $country)) {
                        $fail('Invalid Country');
                    }
                },
            ],
            'rooms' => 'required',
            'bathrooms' => 'required',
            'comments' => 'nullable',
        ]);
        if ($validation->fails()) {
            $response = APIResponse(false, 422, $validation->messages(), 'Validation error', []);
            return response($response, 422);
        }


        $obj = new RealEstate();
        $obj->name = stringFilter($request->name);
        $obj->real_estate_type = $request->real_estate_type;
        $obj->street = stringFilter($request->street);
        $obj->external_number = $request->external_number;
        if($request->real_estate_type == "Department" || $request->real_estate_type == "Commercial Ground"){
            $obj->internal_number = $request->internal_number;
        }
        $obj->neighborhood = $request->neighborhood;
        $obj->city = stringFilter($request->city);
        $obj->country = strtoupper($request->country);
        $obj->rooms = $request->rooms;
        if($request->real_estate_type == "Land" || $request->real_estate_type == "Commercial Ground"){
            $type = gettype($request->bathrooms);
            if($type == 'decimal'){
                $obj->bathrooms = 0;
            }
            else{
                $obj->bathrooms = $request->bathrooms;
            }
        }
        else{
            $obj->bathrooms = $request->bathrooms;
        }
        $obj->comments = $request->comments;
        $obj->save();

        $response = APIResponse(true, 200, [], 'Successfully Saved '.$this->responseTitle, ['store_record' => $obj]);
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($obj = RealEstate::where('id',$id)->first())
        {
            $response = APIResponse(true, 200, [], 'Successfully Found '.$this->responseTitle, ['show_record' => $obj]);
            return response($response, 200);
        }
        $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
        return response($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // It is not useful because we creating API
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required',
            'real_estate_type' => 'required',
            'street' => 'required',
            'external_number' => 'required|regex:/^[a-zA-Z0-9-]+$/',
            'internal_number' => 'nullable|required_if:real_estate_type,Department,Commercial Ground|regex:/^[a-zA-Z0-9- ]*$/',
            'neighborhood' => 'required',
            'city' => 'required',
            'country' =>[
                'required',
                function ($attribute,$country, $fail) {
                    if (!preg_match('#^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$#m', $country)) {
                        $fail('Invalid Country');
                    }
                },
            ],
            'rooms' => 'required',
            'bathrooms' => 'required',
            'comments' => 'nullable',
        ]);
        if ($validation->fails()) {
            $response = APIResponse(false, 422, $validation->messages(), 'Validation error', []);
            return response($response, 422);
        }

        if($obj = RealEstate::where('id', $id)->first())
        {
            $obj->name = stringFilter($request->name);
            $obj->real_estate_type = $request->real_estate_type;
            $obj->street = stringFilter($request->street);
            $obj->external_number = $request->external_number;
            if($request->real_estate_type == "Department" || $request->real_estate_type == "Commercial Ground"){
                $obj->internal_number = $request->internal_number;
            }
            $obj->neighborhood = $request->neighborhood;
            $obj->city = stringFilter($request->city);
            $obj->country = strtoupper($request->country);
            $obj->rooms = $request->rooms;
            if($request->real_estate_type == "Land" || $request->real_estate_type == "Commercial Ground"){
                $type = gettype($request->bathrooms);
                if($type == 'decimal'){
                    $obj->bathrooms = 0;
                }
                else{
                    $obj->bathrooms = $request->bathrooms;
                }
            }
            else{
                $obj->bathrooms = $request->bathrooms;
            }
            $obj->comments = $request->comments;
            $obj->save();

            $response = APIResponse(true, 200, [], $this->responseTitle.' Successfully Updated', ['update_record' => $obj]);
            return response($response, 200);
        }
        $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($obj = RealEstate::where('id', $id)->first())
        {
            RealEstate::where('id', $id)->delete();
            $objNew = RealEstate::where('id', $id)->withTrashed()->first();
            $response = APIResponse(true, 200, '', $this->responseTitle.' Deleted Successfully', ['removed_record' => $objNew]);
            return response($response, 200);
        }
        else
        {
            $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
            return response($response, 200);
        }
    }
}
