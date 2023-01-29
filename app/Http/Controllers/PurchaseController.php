<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Item;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customers = Customer::select('id', 'name', 'kana')->get();
        $lists = array();
        $selectOption = array();
        for ($i=1;$i<=4;$i++) {
            $lists['lists'][$i] = array(
                'no' => $i,
                'name' => null
            );
            $selectOption[$i] = array(
                'no' => $i,
                'name' => "オプション".$i,
                'image_url' => "",
                'name2' => "オプション２つ目".$i,
            );
        }
        $selectOption[5] = array(
            'no' => 5,
            'name' => "オプション5",
            'image_url' => asset('storage/1031.jpg'),
            'name2' => "オプション２つ目5",
        );
        // $a = storage_path('app\public\1031.jpg');
        $a = asset('storage/1031.jpg');
        $items = Item::select('id', 'name', 'price')
            ->where('is_selling', true)->get();

        return Inertia::render('Purchases/Create', [
            // 'customers' => $customers,
            'items' => $items,
            'lists' => array_values($lists),
            'selectOption' => $selectOption,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try{
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);

            foreach ($request->items as $item) {
                $purchase->items()->attach( $purchase->id, [
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
        }

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
