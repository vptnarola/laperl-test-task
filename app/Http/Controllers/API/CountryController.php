<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Country;
use Validator;
use App\Http\Resources\Country as CountryResource;


class CountryController extends Controller
{
    public function store(Request $request)

    {
    	dd(1);
        $product = Country::create($input);
        return $this->sendResponse(new CountryResource($product), 'Product created successfully.');

    } 
}
