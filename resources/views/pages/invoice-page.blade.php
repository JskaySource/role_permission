@extends('dashboard.include.d-master')
@section('title', 'Order page')


@section('content')



<div class="container-fluid">
    <div class="row">



        @include('dashboard.invoice.dealerList')
        @include('dashboard.invoice.productlist')


        <!-- invoice section start -->
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <div class="row">
                    <div class="col-8">
                        <span class="text-bold text-dark">BILLED TO </span>
                        <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                        <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span></p>
                        <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>
                        <!-- <p class="text-xs mx-0 my-1">Date:<input type="date" name="invoice_date" id="invoiceDate">
</p> -->
                        <p class="text-xs mx-0 my-1">
                            Date:
                            <input type="date" name="invoice_date" id="invoiceDate">
                        </p>
                        <script>
    // Get today's date
    const today = new Date();    
    // Format today's date as YYYY-MM-DD
    const formattedDate = today.toISOString().split('T')[0];    
    // Set the value of the date input to today's date
    document.getElementById('invoiceDate').value = formattedDate;
</script>
                    </div>

                    <div class="col-4">
                        <img class="w-50" src="{{"image/account.png"}}">

                        <p class="text-bold mx-0 my-1 text-dark">Invoice No: <span id="invoiceNumber"></span></p>

                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary" />
                <div class="row">
                    <div class="col-12">
                        <table class="table w-100" id="invoiceTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                    <td>Remove</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="invoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary" />
                <div class="row">
                    <div class="col-12">
                        <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                        <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i> <span id="payable"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i> <span id="vat"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i> <span id="discount"></span></p>
                        <span class="text-xxs">Discount(%):</span>
                        <input onkeydown="return false" value="0" min="0" type="number" step="0.25" onchange="DiscountChange()" class="form-control w-40 " id="discountP" />
                        <p>
                            <button onclick="createInvoice()" class="btn  my-3 btn-primary w-40">Confirm</button>
                        </p>
                    </div>
                    <div class="col-12 p-2">

                    </div>

                </div>
            </div>
        </div>
        <!-- invoice section end -->








    </div>
    <!-- main row end -->
</div>
<!-- main container end  -->




<script>
    (async () => {
        //showLoader();
        await getDealerList();
        await getProductInfo();
        //hideLoader();
    })()


    function DiscountChange() {
        CalculateGrandTotal();
    }

    function CalculateGrandTotal() {
        let Total = 0;
        let Vat = 0;
        let Payable = 0;
        let Discount = 0;
        let discountPercentage = (parseFloat(document.getElementById('discountP').value));

        if(!Array.isArray(InvoiceItemList) || InvoiceItemList.length === 0){
            alert('Please add products');
            return;            
        }
        InvoiceItemList.forEach((item, index) => {
            Total = Total + parseFloat(item['sale_price'])
        })

        if (discountPercentage === 0) {
            Vat = ((Total * 5) / 100).toFixed(2);
        } else {
            Discount = ((Total * discountPercentage) / 100).toFixed(2);
            Total = (Total - ((Total * discountPercentage) / 100)).toFixed(2);
            Vat = ((Total * 5) / 100).toFixed(2);
        }

        Payable = (parseFloat(Total) + parseFloat(Vat)).toFixed(2);

        document.getElementById('total').innerText = Total;
        document.getElementById('payable').innerText = Payable;
        document.getElementById('vat').innerText = Vat;
        document.getElementById('discount').innerText = Discount;
    }

    async function createInvoice() {
        let total = document.getElementById('total').innerText;
        let discount = document.getElementById('discount').innerText
        let vat = document.getElementById('vat').innerText
        let payable = document.getElementById('payable').innerText
        let CId = document.getElementById('CId').innerText;
        let invoiceDate = document.getElementById('invoiceDate').value;

        let Data = {
            "total": total,
            "discount": discount,
            "vat": vat,
            "payable": payable,
            "dealer_id": CId,
            "invoice_date": invoiceDate,
            "products": InvoiceItemList
        };

        if (CId.length === 0) {
            errorToast("Customer Required !")
        } else if (InvoiceItemList.length === 0) {
            errorToast("Product Required !")
        } else {
            //showLoader();
            let res = await axios.post("/create-invoice", Data)
            //hideLoader();
            if (res.data === 1) {
                window.location.href = '/order-page'
                successToast("Invoice Created");
            } else {
                errorToast("Something Went Wrong") 
            }
        }

    }
</script>



@endsection