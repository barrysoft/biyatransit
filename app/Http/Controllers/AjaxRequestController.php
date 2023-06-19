<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transporter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjaxRequestController extends Controller
{
    public function getTransporters(Request $request): JsonResponse
    {
        $query = Transporter::query()->select('id', 'numberplate')->limit(5);

        $search = $request->search;
        if ($search != '') {
            $query->where(function($query) use ($search) {
                $query->whereNotNull('numberplate')->where('numberplate', 'LIKE', $search . '%');
            });
        }
        $records = $query->get();

        $response = array();
        foreach($records as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->numberplate
            );
        }
        return response()->json($response);
    }

    public function getProducts(Request $request): JsonResponse
    {
        $query = Product::query()->select('id', 'designation')->limit(5)
            ->orderby('designation');

        $search = $request->search;
        if ($search != '') {
            $query->where(function($query) use ($search) {
                $query->whereNotNull('designation')->where('designation', 'LIKE', $search . '%');
            });
        }
        $records = $query->get();

        $response = array();
        foreach($records as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->designation
            );
        }
        return response()->json($response);
    }

    public function getProductsBy(Request $request): JsonResponse
    {
        $query = Product::query()->select('id', 'name')->limit(5)->orderby('name');

        $search = $request->search;
        $searchBy = $request->searchBy;
        if($search == '') {
            $query->where($searchBy, 'LIKE', $search . '%');
        }
        $records = $query->get();

        $response = array();
        foreach($records as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->name
            );
        }
        return response()->json($response);
    }

    public function getCustomers(Request $request): JsonResponse
    {
        $query = Customer::query()->select('id', 'nif', 'name')->limit(5)->orderby('name');

        $search = $request->search;
        if ($search != '') {
            $query->where(function($query) use ($search) {
                $query->whereNotNull('name')->where('name', 'LIKE', $search . '%');
            })->orWhere(function($query) use ($search) {
                $query->whereNotNull('nif')->where('nif', 'LIKE', $search . '%');
            })->orWhere(function($query) use ($search) {
                $query->whereNotNull('phone')->where('phone', 'LIKE', $search . '%');
            });
        }
        $records = $query->get();

        $response = array();
        foreach($records as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->fif.'-'.$record->name
            );
        }
        return response()->json($response);
    }

    public function getDataForSelect2($request, $model, $column): JsonResponse
    {
        $query = $model::orderby($column,'asc')->select('id',$column)->limit(5);

        $search = $request->search;
        if ($search != '') {
            $query->where(function($query) use ($search, $column) {
                $query->whereNotNull($column)->where($column, 'LIKE', $search . '%');
            });
        }
        $records = $query->get();

        $response = array();
        foreach($records as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->$column
            );
        }
        return response()->json($response);
    }
}
