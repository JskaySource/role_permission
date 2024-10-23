
        <!-- Product show section & script start -->
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table id="productData" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Add</th>
                        </tr>
                    </thead>
                    <tbody id="productList"></tbody>

                </table>
            </div>
        </div>

        <script>
            async function getProductInfo() {
                try {
                    let res = await axios.get("/show-product");
                    let productList = $("#productList");
                    let productData = $("#productData");
                    productData.DataTable().destroy();
                    productList.empty();
                    res.data.forEach(function(item, index) {
                        let row = `<tr>
                            <td>${item['p_name']} (${item['p_price']})</td>
                            <td><a data-name="${item['p_name']}" data-price="${item['p_price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Add</a></td>
                         </tr>`;
                        productList.append(row);
                    });
                    $('.addProduct').on('click', async function() {
                        let PName = $(this).data('name');
                        let PPrice = $(this).data('price');
                        let PId = $(this).data('id');
                        addModal(PId, PName, PPrice)
                    })


                    new DataTable('#productData', {
                        order: [
                            [0, 'desc']
                        ],
                        scrollCollapse: false,
                        info: false,
                        lengthChange: false
                    });
                } catch (error) {
                    console.log(error);
                    errorToast("Failed to load product data!");
                }
            }

            // Ensure this is outside of the function definition
            getProductInfo();
        </script>
        <!-- Product show section & script end -->

        <!-- add product modeal start -->
        <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                    </div>
                    <div class="modal-body">
                        <form id="add-form">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 p-1">
                                        <label class="form-label">Product ID *</label>
                                        <input type="text" class="form-control" id="PId">
                                        <label class="form-label mt-2">Product Name *</label>
                                        <input type="text" class="form-control" id="PName">
                                        <label class="form-label mt-2">Product Price *</label>
                                        <input type="text" class="form-control" id="PPrice">
                                        <label class="form-label mt-2">Product Qty *</label>
                                        <input type="text" class="form-control" id="PQty">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="modal-close" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button onclick="add()" id="save-btn" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <script>



let InvoiceItemList = [];


function ShowInvoiceItem() {

    let invoiceList = $('#invoiceList');

    invoiceList.empty();

    InvoiceItemList.forEach(function(item, index) {
        let row = `<tr class="text-xs">
                    <td>${item['product_name']}</td>
                    <td>${item['qty']}</td>
                    <td>${item['sale_price']}</td>
                    <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                 </tr>`
        invoiceList.append(row)
    })

    CalculateGrandTotal();

    $('.remove').on('click', async function() {
        let index = $(this).data('index');
        removeItem(index);
    })

}


function removeItem(index) {
    InvoiceItemList.splice(index, 1);
    ShowInvoiceItem()
}

            function add() {
                let PId = document.getElementById('PId').value;
                let PName = document.getElementById('PName').value;
                let PPrice = document.getElementById('PPrice').value;
                let PQty = document.getElementById('PQty').value;
                let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);
                if (PId.length === 0) {
                    errorToast("Product ID Required");
                } else if (PName.length === 0) {
                    errorToast("Product Name Required");
                } else if (PPrice.length === 0) {
                    errorToast("Product Price Required");
                } else if (PQty.length === 0) {
                    errorToast("Product Quantity Required");
                } else {
                    let item = {
                        product_name: PName,
                        product_id: PId,
                        qty: PQty,
                        sale_price: PTotalPrice
                    };
                    InvoiceItemList.push(item);
                    console.log(InvoiceItemList);
                    $('#create-modal').modal('hide')
                    ShowInvoiceItem();
                }
            }

            function addModal(id, name, price) {
                document.getElementById('PId').value = id
                document.getElementById('PName').value = name
                document.getElementById('PPrice').value = price
                $('#create-modal').modal('show')
            }
        </script>
        <!-- add product modal close -->

