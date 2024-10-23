<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{

    public function deliveryPage()
    {
        return view('pages.delivery-page');
    }
    // Display pending deliveries

    public function getPendingOrders()
    {
        $pendingOrders = Invoice::where('status', 'pending')
            ->with(['dealer', 'invoiceProducts.product']) // Including dealer and product details
            ->get();

        return response()->json($pendingOrders);
    }



   


    // Function to save delivery data
    public function saveDelivery(Request $request)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::find(6);

            if (!$invoice) {
                return response()->json(['success' => false, 'error' => 'Invoice not found']);
            }
            //dd($invoice);

            $dealer_id = $invoice->dealer_id;

            foreach ($request->products as $product) {
                if (empty($product['full_qty'])) {
                    return response()->json(['success' => false, 'error' => 'Invalid product data']);
                }

                Delivery::create([
                    'invoice_id' => $request->invoice_id,
                    'delivery_date' => $request->delivery_date,
                    'dealer_id' => $dealer_id,
                    'product_id' => $product['product_id'] ?? null,
                    'full_qty' => $product['full_qty'] ?? 0,
                    'empty_qty' => $product['empty_qty'] ?? 0,
                    'remark' => $product['remark'] ?? '',
                ]);
            }

            $invoice->status = 'delivered';
            $invoice->save();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
           // Log::error('Delivery Save Error', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }








    
    // Function to mark an order as delivered
public function markAsDelivered($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice) {
            $invoice->status = 'delivered';
            $invoice->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'Invoice not found']);
    }

}








