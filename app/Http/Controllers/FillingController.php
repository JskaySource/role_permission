<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Filling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FillingController extends Controller
{
    public function productionPage(){
        return view('pages.production-page');
    }

    public function showFilling(){
        $fillingData = Filling::get();
        return response()->json($fillingData);        
    }
    public function createFilling(Request $request){

        $request->validate([
            'date' => 'required|date',
            'zara_filling' => 'required|numeric',
            'refil_filling' => 'required|numeric',
        ]);
    
        try {
            Filling::create([
                'user_id'=>auth()->user()->id,
                'date' => $request->input('date'),
                'zara_filling' => $request->input('zara_filling'),
                'refil_filling' => $request->input('refil_filling'),
            ]);
            //Log::info('Filling created successfully');
            return response()->json([
                'status' => 'Success',
                'message' => 'Insert Filling Successfully',
            ], 201);
        } catch (Exception $e) {
            Log::error('Error creating filling: ' . $e->getMessage());
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage(),
            ], 500);
        }
        
    }

    public function deleteFilling(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        try {
            Filling::where('id', $request->input('id'))->delete();
            return response()->json([
                'status' => 'success', // Change 'Success' to 'success'
                'message' => 'Delete Filling Successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    
    public function getFilling(Request $request) {
        try {
            $fillingData = Filling::where('id', $request->input('id'))->first(); // Use first() instead of get()
            if ($fillingData) {
                return response()->json($fillingData, 200);
            } else {
                return response()->json(['message' => 'Filling not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    public function updateFilling(Request $request) {
        $request->validate([
            'id' => 'required',
            'date' => 'required|date',
            'zara_filling' => 'required|numeric',
            'refil_filling' => 'required|numeric',
        ]);
    
        try {
            $filling = Filling::where('id', $request->input('id'))->first();
            if (!$filling) {
                return response()->json(['status' => 'Failed', 'message' => 'Filling not found'], 404);
            }
    
            $filling->update([
                'date' => $request->input('date'),
                'zara_filling' => $request->input('zara_filling'),
                'refil_filling' => $request->input('refil_filling'),
            ]);
    
            return response()->json(['status' => 'success', 'message' => 'Update Filling Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'Failed', 'message' => $e->getMessage()], 500);
        }
    }
    
}
