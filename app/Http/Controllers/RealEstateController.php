<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Validator;

class RealEstateController extends Controller
{
    private $responseTitle;

    public function __construct()
    {
        $this->responseTitle = "Real Estate Record";
    }

    public function list()
    {
        $obj = RealEstate::all();
        $obj = $obj->orderBy('id', 'desc')->get();
        if(count($obj) > 0)
        {
            $response = APIResponse(true, 200, [], 'Successfully Get '.$this->responseTitle, ['records' => $obj]);
            return response($response, 200);
        }
        else
        {
            $response = APIResponse(false, 200, [], $this->responseTitle.' Not Found', []);
            return response($response, 200);
        }
    }

    public function get_single(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            $response = APIResponse(false, 422, $validation->messages(), 'Validation error', []);
            return response($response, 422);
        }
        if($obj = RealEstate::where('id',$request->id)->first())
        {
            $response = APIResponse(true, 200, [], 'Successfully Found '.$this->responseTitle, ['records' => $obj]);
            return response($response, 200);
        }
        $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
        return response($response, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required',
            'real_estate_type' => 'required',
            'street' => 'required',
            'external_number' => 'required|/^[a-zA-Z0-9-]+$/',
            'internal_number' => 'nullable|required_if:real_estate_type,Department,Commercial Ground|/^[a-zA-Z0-9- ]*$/',
            'neighborhood' => 'required',
            'city' => 'required',
            'country' => 'required|/^[A-Z]{2}$/gm', // ^([^(]+)\s*(\(([^(]+)\))?\s*(\(([A-Z]{2})\))$
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

        $response = APIResponse(true, 200, [], 'Successfully Saved '.$this->responseTitle, ['records' => $obj]);
        return response($response, 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required',
            'real_estate_type' => 'required',
            'street' => 'required',
            'external_number' => 'required|/^[a-zA-Z0-9-]+$/',
            'internal_number' => 'nullable|required_if:real_estate_type,Department,Commercial Ground|/^[a-zA-Z0-9- ]*$/',
            'neighborhood' => 'required',
            'city' => 'required',
            'country' => 'required|/^[A-Z]{2}$/gm', // ^([^(]+)\s*(\(([^(]+)\))?\s*(\(([A-Z]{2})\))$
            'rooms' => 'required',
            'bathrooms' => 'required',
            'comments' => 'nullable',
        ]);
        if ($validation->fails()) {
            $response = APIResponse(false, 422, $validation->messages(), 'Validation error', []);
            return response($response, 422);
        }

        if($obj = RealEstate::where('id', $request->id)->first())
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

            $response = APIResponse(true, 200, [], $this->responseTitle.' Successfully Updated', ['records' => $obj]);
            return response($response, 200);
        }
        $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
        return response($response, 200);
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, [
            'id' => 'required|array'
        ]);

        if ($validation->fails()) {
            $response = APIResponse(false, 422, $validation->messages(), 'Validation error', []);
            return response($response, 422);
        }

        $obj = RealEstate::whereIn('id', $request->id)->get();
        if(count($obj) > 0)
        {
            $obj = RealEstate::whereIn('id', $request->id)->delete();
            $response = APIResponse(true, 200, '', $this->responseTitle.' Deleted Successfully', []);
            return response($response, 200);
        }
        else
        {
            $response = APIResponse(false, 200, '', $this->responseTitle.' Not Found', []);
            return response($response, 200);
        }
    }
}
