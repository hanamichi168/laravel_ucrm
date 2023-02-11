<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class RequestTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Test/RequestTest');
    }

    public function confirm(Request $request)
    {
        $data = $request->all();
        foreach ($data['items'] as $key =>$value) {
            if ($value['file']) {
                $disk = Storage::disk('local');
                $data['items'][$key]['file_path'] = $disk->putFile('RequestTest', $value['file']);
            }
        }
        return Inertia::render('Test/RequestTestConfirm', [
            'requests' => $data,
            ]);
    }

    public function createBack(Request $request)
    {
        return to_route('request.create')->withInput();
        return Inertia::render('Test/RequestTestBack', [
            'requests' => $request,
            ]);
    }

}
