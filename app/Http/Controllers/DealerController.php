<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DealerController extends Controller
{
    public function dealerPage(){
        return view('pages.dealer-page');
    }

    public function showDealer(){
        $dealerData =Dealer::get();
        return response()->json($dealerData);
    }

    public function createDealer(Request $request){
        try{
            Dealer::create([
                'user_id' =>auth()->user()->id,
                'name' =>$request->input('name'),
                'address' =>$request->input('address'),
                'mobile' =>$request->input('mobile'),
                'jar_limit' =>$request->input('jar_limit'),
            ]);
            return response()->json([
                'status'=> 'Success',
                'message'=> 'Dealer Created Successfully',
            ],201);

        }catch(Exception $e){
            //Log::error($e->getMessage());
            return response()->json([
                'status'=> 'Failed',
                'message'=> $e->getMessage(),
            ],500);
        }
    }

    public function getDealer(Request $request){
            try{
                $dealer = Dealer::find($request->input('id'));
                if($dealer){
                    return response()->json($dealer, 200);
                }else {
                    return response()->json(['message' =>'Dealer not found'], 404);
                }
            } catch(Exception $e){
                return response()->json(['message' =>$e->getMessage()], 500);
            }
    }


    public function updateDealer(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:dealers,id',
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'mobile' => 'required|string|max:25',
        'jar_limit' => 'required|string|max:20',
    ]);

    $dealer = Dealer::find($request->input('id'));

    if ($dealer) {
        $dealer->name = $request->input('name');
        $dealer->address = $request->input('address');
        $dealer->mobile = $request->input('mobile');
        $dealer->jar_limit = $request->input('jar_limit');

       
        $dealer->save();
        return response()->json([
            'status' => 'Success',
            'message' => 'dealer updated successfully',
        ]);
    } else {
        return response()->json([
            'status' => 'Fail',
            'message' => 'dealer not found',
        ], 404);
    }
}


public function deleteDealer(Request $request) {
    try {
        $dealer_id = $request->input('id');
        $deleted = Dealer::where('id', $dealer_id)->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Dealer deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Dealer not found',
            ]);
        }
    } catch (Exception $e) {
        // Log the exception
        //Log::error('Dealer Deletion Error: ' . $e->getMessage());

        return response()->json([
            'status' => 'Fail',
            'message' => 'An error occurred while deleting the dealer.',
        ]);
    }
}

// for order system
public function getAllDealers()
    {
        $dealers = Dealer::all();
        return response()->json($dealers);
    }



}
