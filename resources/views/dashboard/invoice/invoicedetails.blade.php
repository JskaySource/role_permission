<!-- Modal -->
<div class="modal animated zoomIn" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div id="invoice" class="modal-body p-3">
                    <div class="container-fluid">
                        <br/>
                        <div class="row">
                            <div class="col-8">
                                <span class="text-bold text-dark">BILLED TO </span>
                                <p class="text-xs mx-0 my-1">Name:  <span id="CName"></span> </p>
                                <p class="text-xs mx-0 my-1">Mobile:  <span id="Cmobile"></span></p>
                            </div>
                            <div class="col-4">
                            <img src="{{asset('image/account.png')}}" class="avatar img-fluid" alt="">
                                <p class="text-bold mx-0 my-1 text-dark">Invoice : <span id="invoiceNo"></span> </p>
                                <p class="text-xs mx-0 my-1">Date: <span id="date"></span> </p>
                            </div>
                        </div>
                        <hr class="mx-0 my-2 p-0 bg-secondary"/>
                        <div class="row">
                            <div class="col-12">
                                <table class="table w-100" id="invoiceTable">
                                    <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="invoiceList">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="mx-0 my-2 p-0 bg-secondary"/>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                                <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i>  <span id="vat"></span></p>
                                <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i>  <span id="discount"></span></p>
                                <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>  <span id="payable"></span></p>
                            </div>

                        </div>
                    </div>
            </div>
            
            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button onclick="PrintPage()" class="btn btn-success">Print</button>
            </div>
        </div>
    </div>
</div>

<script>


// async function InvoiceDetails(id) {
//     try {
//         // Make an axios GET request to fetch invoice details by ID
//         let res = await axios.get(`/get-invoice-by-id/${id}`);

//         console.log(res.data); //Check response in console for debugging

//         let {dealer, invoice, products} = res.data;


//         // Populate modal with invoice data
//         document.getElementById('CName').innerText = dealer.name;
//         document.getElementById('Cmobile').innerText = dealer.mobile;
//         document.getElementById('total').innerText = invoice.total;
//         document.getElementById('payable').innerText =invoice.payable;
//         document.getElementById('vat').innerText = invoice.vat;
//         document.getElementById('discount').innerText = invoice.discount;
//         document.getElementById('invoiceNo').innerText =invoice.id

//         // Clear and append invoice product data
//         let invoiceList = $('#invoiceList');
//         invoiceList.empty(); // Clear previous data

//         // Loop through the products and append them to the modal
//         products.forEach(function(item) {
//             let row = `<tr class="text-xs">
//                           <td>${item.product_name}</td>
//                           <td>${item.qty}</td>
//                           <td>${item.sale_price}</td>
//                        </tr>`;
//             invoiceList.append(row);
//         });

//         // Show the modal
//         $("#details-modal").modal('show');

//     } catch (error) {
//         console.error(error);
//         errorToast("Failed to load invoice details!"); // Custom error toast function
//     }
// }








// Function to print the invoice


async function InvoiceDetails(id) {
    try {
        // Make an axios GET request to fetch invoice details by ID
        let res = await axios.get(`/get-invoice-by-id/${id}`);
        console.log(res.data); // For debugging

        let { dealer, invoice, product } = res.data;

        // Populate modal with invoice and dealer data
        document.getElementById('CName').innerText = dealer.name || 'N/A';
        document.getElementById('Cmobile').innerText = dealer.mobile || 'N/A';
        document.getElementById('total').innerText = invoice.total || '0';
        document.getElementById('payable').innerText = invoice.payable || '0';
        document.getElementById('vat').innerText = invoice.vat || '0';
        document.getElementById('discount').innerText = invoice.discount || '0';
        document.getElementById('invoiceNo').innerText = invoice.invoice_number || 'N/A';
        document.getElementById('date').innerText = invoice.invoice_date || 'N/A';

        // Clear and append product data
        let invoiceList = $('#invoiceList');
        invoiceList.empty(); // Clear previous data

        // Check if the 'product' array exists and has items
        if (Array.isArray(product) && product.length > 0) {
            product.forEach(function(item) {
                let row = `<tr class="text-xs">
                              <td>${item.product ? item.product.p_name : 'N/A'}</td>

                              <td>${item.qty || '0'}</td>
                              <td>${item.sale_price || '0'}</td>
                           </tr>`;
                invoiceList.append(row);
            });
        } else {
            // Display a message if no products are found
            invoiceList.append(`<tr><td colspan="3" class="text-center">No products found</td></tr>`);
        }

        // Show the modal
        $("#details-modal").modal('show');

    } catch (error) {
        console.error(error);
        errorToast("Failed to load invoice details!"); // Custom error toast function
    }
}





function PrintPage() {
    let printContents = document.getElementById('invoice').innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    // Optionally reload the page after printing
    setTimeout(function() {
        location.reload();
    }, 1000);
}

</script>