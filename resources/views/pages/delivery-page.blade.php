@extends('dashboard.include.d-master')
@section('title', 'Delivery page')



@section('content')




<div class="container-fluid p-4">
    <div class="row">



        <div class="col-md-4 col-sm-12"> 
        @include('dashboard.order.orderList')
        </div>

        <!-- this section is for product list show -->
        <div class="col-md-3 col-sm-12">
            <!-- Product show section & script start -->
            @include('dashboard.order.productlist')
        </div>



        
        <div class="col-md-5 col-sm-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="card-title text-center ">Delivery Challan</h5>
                </div>
                <div class="card-body p-0 m-0">

                <input type="text" id="invoiceId" >

                    <table class="table table-bordered p-0 m-0">
                        <tr>
                            <th class="w-25">Challan No:</th>
                            <td class="w-25"> <span id="Did"></span></td>
                            <th class="w-25">Date :</th>
                            <td class="w-25">
                                <input type="date" id="delivery_date">
                            </td>
                        </tr>
                        <tr>
                            <th> Name : </th>
                            <td colspan="3"> <span id="Dname"></span></td>
                        </tr>
                        <tr>
                            <th>Address : </th>
                            <td colspan="3"> <span id="Daddress"></span> -<span id="Dphone"></span> </td>
                        </tr>
                    </table>
                    <!-- import product list from invoice table  dynamicaly -->
                    <table class="table table-bordered p-0 m-0">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">#</th>
                                <th class="w-50" scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Remark</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <!-- Product rows will be dynamically inserted here -->
                        </tbody>
                    </table>



                    <!-- for empty jar received table -->
                    <table class="table table-bordered p-0 m-0 " id="invoiceTable">
                        <h5 class="text-center card-title">Empty Jar Received</h5>
                        <thead>
                            <tr class="table-secondary">
                                <th class="w-50" scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceList">

                        </tbody>
                    </table>

                </div>
            </div>

            <button type="submit" onclick="deliverySubmit()" class="btn btn-success w-100 mt-1 deliverySubmit">
                Submit
            </button>
        </div>

        
<script>
    
    async function deliverySubmit() {
    try {
        let delivery_date = document.getElementById('delivery_date').value;
        let selectedDeliveryId = document.getElementById('Did').textContent.trim(); // Fetch selected invoice ID

        if(!delivery_date){
            errorToast("Please Select a delivery date.");
            return;
        }
        let full_qty = document.querySelector('.totalQty').innerText;

        //console.log('full_qty', full_qty);
        let products = [];
        document.querySelectorAll('#productTableBody tr').forEach(row => {
            let invoiceId = document.querySelector('#invoiceId').value;
            let full_qty = document.querySelector('.totalQty').innerText;
            let empty_qty = document.querySelector('.empty_qty')?.value || 0;
            let remark = document.querySelector('.remark') ?.value || '';

            //console.log('invoiceId', invoiceId);
            
            if(!full_qty){
                throw new Error("Full quantity is required.");
            }
            products.push({
                //invoice_id: invoiceId,
                full_qty: full_qty,  // Consistent naming with back-end
                empty_qty: empty_qty,
                remark: remark
            });
        });

        let data = {
            delivery_date: delivery_date,
            invoice_id:selectedDeliveryId,
            products: products

            
        };

        console.log(products);

        let response = await fetch('/delivery-info', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        let res = await response.json();
        if (res.success) {
            successToast("Delivery recorded successfully.");
            await markAsDelivered(selectedDeliveryId);  // Mark as delivered
            getPendingOrders();  // Refresh pending deliveries
            clearDeliveryDetails();  // Clear form
        } else {
            errorToast(res.error || "Failed to save delivery.");
        }
    } catch (error) {
        console.error(error);
        errorToast("An error occurred while submitting the form.");
    }
}








async function markAsDelivered(id) {
    try {
        let res = await axios.post(`/mark-as-delivered/${id}`);
        if (res.data.success) {
            successToast("Invoice marked as delivered.");
            getPendingOrders();  // Refresh pending orders
        } else {
            errorToast("Failed to mark as delivered.");
        }
    } catch (error) {
        console.error(error);
        errorToast("Error occurred while marking as delivered.");
    }
}

function clearDeliveryDetails() {
    document.getElementById('Did').textContent = '';
    document.getElementById('Dname').textContent = '';
    document.getElementById('Daddress').textContent = '';
    document.getElementById('Dphone').textContent = '';
    document.getElementById('productTableBody').innerHTML = '';
}

</script>

    </div>
</div>




@endsection