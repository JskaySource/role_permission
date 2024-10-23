

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Pending Order List</h3>
                </div>
                <div class="card-body mt-2">
                    <table id="deliveryData" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <!-- <th scope="col">No</th> -->
                                <th scope="col">Order Number</th>
                                <!-- <th scope="col">Order Date</th> -->
                                <th scope="col">Dealer Name</th>
                                <!-- <th scope="colspan-2">Products</th> -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="deliveryList"></tbody>
                    </table>
                </div>

        </div>


<!-- Include jQuery and Axios -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let selectedDeliveryId = null;

    // Function to get pending orders
    async function getPendingOrders() {
        try {
            let res = await axios.get("/get-pending-order");

            let deliveryList = $("#deliveryList");
            let deliveryData = $("#deliveryData");

            // Destroy old DataTable and clear the table body
            if ($.fn.DataTable.isDataTable('#deliveryData')) {
                deliveryData.DataTable().destroy();
            }
            deliveryList.empty();



            // Append rows dynamically from fetched data
            res.data.forEach(function(item, index) {
                let products = item.invoice_products.map(product =>
                    `(${product.product.p_name} - ${product.qty})`
                ).join('<br>');

                let productData = JSON.stringify(item.invoice_products);

                let row = `<tr>

                                <td>${item.invoice_number}</td>

                                <td>${item.dealer.name}</td>

                                <td>
                                    <button data-id="${item.invoice_number}" 
                                            data-invoice="${item.id}"
                                            data-name="${item.dealer.name}" 
                                            data-address="${item.dealer.address}" 
                                            data-mobile="${item.dealer.mobile}" 
                                            data-products='${productData}' 
                                            class="btn btn-outline-success btn-sm viewBtn">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>`;
                deliveryList.append(row);
            });

            // Handle "View Details" button click
            $('.viewBtn').on('click', function() {
                let invoiceId = $(this).data('invoice');
                let Did = $(this).data('id');
                let Dname = $(this).data('name');
                let Daddress = $(this).data('address');
                let Dphone = $(this).data('mobile');
                let products = $(this).data('products');

                selectedDeliveryId = Did;

                // Populate the delivery details
                $("#invoiceId").val(invoiceId);
                $("#Did").text(Did);
                $("#Dname").text(Dname);
                $("#Daddress").text(Daddress);
                $("#Dphone").text(Dphone);

                // Clear the product table body
                let productTableBody = $('#productTableBody');
                productTableBody.empty();

                // Add each product row to the table
                products.forEach(function(product, index) {
                    let productRow = `<tr>
                                          <th>${index + 1}</th>
                                          <td>${product.product.p_name}</td>
                                          <td>${product.qty}</td>
                                          <td>
                                              <input type="text" class="form-control remark-input" 
                                                     data-product-id="${product.product.id}" 
                                                     placeholder="Enter remark">
                                          </td>
                                      </tr>`;
                    productTableBody.append(productRow);
                });

                // Add a row for the total quantity
                let totalQty = products.reduce((sum, product) => sum + parseFloat(product.qty), 0);
                productTableBody.append(`
                    <tr>
                        <th colspan="2" class="table-success">Total</th>
                        <th colspan="2" class="table-success totalQty ">${totalQty}</th>
                    </tr>`);
            });

            // Reinitialize DataTable
            new DataTable('#deliveryData', {
                order: [
                    [0, 'desc']
                ],
                //lengthMenu: [3, 10, 15, 20, 30],
                lengthChange:false,
                searching:false,
                
            });

        } catch (error) {
            console.error(error);
            alert("Failed to load pending Order List!");
        }
    }



    // Initialize the function to fetch data
    getPendingOrders();
</script>