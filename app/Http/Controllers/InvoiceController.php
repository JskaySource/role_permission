<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\Dealer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class InvoiceController extends Controller
{

    public function invoicePage(): view
    {
        return view('pages.invoice-page');
    }

    public function orderPage(): view
    {
        return view('pages.order-page');
    }



    //Invoice Created Funtion is here
    public function createInvoice(Request $request)
{
    // Testing Log 
    //Log::info('Incoming Request:', $request->all());

    // Validate the request
    $validated = $request->validate([
        'total' => 'required|numeric',
        'discount' => 'required|numeric',
        'vat' => 'required|numeric',
        'payable' => 'required|numeric',
        'dealer_id' => 'required|integer',
        'invoice_date' => 'required|date',
        'products' => 'required|array',
        'products.*.product_name' => 'required|string',
        'products.*.product_id' => 'required|integer',
        'products.*.qty' => 'required|integer',
        'products.*.sale_price' => 'required|numeric',
    ]);

    // Use a transaction to ensure both inserts succeed
    DB::transaction(function () use ($request) {
        $invoiceNumber = Invoice::generateInvoiceNumber();

        // Insert into the invoices table
        $invoice = Invoice::create([
            'invoice_number' => $invoiceNumber,
            'user_id' => auth()->user()->id,
            'dealer_id' => $request->dealer_id,
            'invoice_date' => $request->input('invoice_date', Carbon::now()),
            'total' => $request->total,
            'vat' => $request->vat,
            'discount' => $request->discount,
            'payable' => $request->payable,
        ]);

        // Insert into the invoice_products table
        foreach ($request->products as $product) {
            InvoiceProduct::create([
                'invoice_id' => $invoice->id, // Access User id from Invoice
                'product_id' => $product['product_id'],
                'qty' => $product['qty'],
                'sale_price' => $product['sale_price'],
            ]);
        }
    });

    return response()->json(1); // Return 1 on success
}

    public function showInvoice()
    {
        $orderData = Invoice::with('dealer')->get();
        // DD($orderData);
        return response()->json($orderData);
    }
    function invoiceSelect(Request $request)
    {
        $user_id = $request->header('id');
        return Invoice::where('user_id', $user_id)->with('dealer')->get();
    }


    public function InvoiceDetails(Request $request)
    {
        $user_id = $request->header('id');

        $dealerDetails = Dealer::where('user_id', $user_id)
            ->where('id', $request->input('del_id'))
            ->first();

        $invoiceTotal = Invoice::where('user_id', $user_id)
            ->where('id', $request->input('inv_id'))
            ->first();
            // $product = Product::where('product_id', $request->input('product_id'))
            // ->first();

        if (!$dealerDetails || !$invoiceTotal) {
            return response()->json(['error' => 'Details not found'], 404);
        }

        $invoiceProduct = InvoiceProduct::where('invoice_id', $request->input('inv_id'))
            ->where('user_id', $user_id)
            ->with('product')
            ->get();
        

        return response()->json([
            'customer' => $dealerDetails,
            'invoice' => $invoiceTotal,
            'product' => $invoiceProduct,
        ]);
    }



    public function deleteInvoice(Request $request)
    {
        //Log::info('Delete Invoice Request: ', $request->all());

        DB::beginTransaction();
        try {
            // Retrieve the user ID from the request header
            $user_id = $request->header('id');
            //Log::info('User ID: ' . $user_id . ' | Invoice ID: ' . $request->input('invoice_id'));

            // Delete related products for the invoice
            InvoiceProduct::where('invoice_id', $request->input('invoice_id'))
                ->where('user_id', $user_id)
                ->delete();

            // Delete the invoice
            Invoice::where('id', $request->input('inv_id'))->delete();

            // Commit the transaction if everything is successful
            DB::commit();
            return 1; // Return success status
        } catch (Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollBack();
            return 0; // Return failure status
        }
    }


    //get Invoice by id for show modal page before submit

    public function getInvoice($id)
    {
        $invoice = Invoice::with(['dealer', 'products.product'])->find($id);
        if ($invoice) {
            return response()->json([
                'dealer' => $invoice->dealer,
                'invoice' => $invoice,
                'product' => $invoice->products,
            ]);
        }
        return response()->json(['success' => false, 'message'=> 'Invoice not found'], 404);
    }






}
