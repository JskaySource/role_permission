<div class="container-fluid p-4" style="background-color:#dfdede">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2>Order Information</h2>
                    <a href="{{route('invoicePage')}}" class="btn btn-success"> Add New</a>
                    <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Add New
      </button> -->
                </div>
                <div class="card-body mt-2">
                    <table id="orderData" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Dealer Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Vat</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Payable</th>
                                <th scope="col">Status</th>
                                <th scope="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderList"></tbody>
                        <tr>

                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        async function getInvoiceInfo() {
            try {
                let res = await axios.get("/show-invoice");

                let orderList = $("#orderList");
                let orderData = $("#orderData");

                // Destroy and reset the DataTable
                orderData.DataTable().destroy();
                orderList.empty();

                res.data.forEach(function(item, index) {
                    // Apply status formatting or check the value
                    let statusLabel = '';
                    if (item['status'] === 'pending') {
                        statusLabel = `<span class="badge bg-warning">Pending</span>`;
                    } else if (item['status'] === 'delivered') {
                        statusLabel = `<span class="badge bg-success">Delivered</span>`;
                    } else {
                        statusLabel = `<span class="badge bg-secondary">${item['status']}</span>`;
                    }

                    let row = `<tr>
                        <td>${index + 1}</td>
                        <td>
                            ${new Date(item['invoice_date']).getDate().toString().padStart(2, '0')}-
                            ${(new Date(item['invoice_date']).getMonth() + 1).toString().padStart(2, '0')}-
                            ${new Date(item['invoice_date']).getFullYear()}
                        </td>
                        <td>${item['dealer']['name']}</td>
                        <td>${item['total']}</td>
                        <td>${item['total']}</td>
                        <td>${item['vat']}</td>
                        <td>${item['discount']}</td>
                        <td>${item['payable']}</td>
                        <td>${statusLabel}</td>
                        <td>
                            <button data-id="${item['id']}" class="btn viewBtn btn-sm btn-outline-success">
                                <i class="far fa-eye"></i>
                            </button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                     </tr>`;

                    orderList.append(row);
                });


                // Handle edit button click
                $(document).on('click', '.viewBtn', async function() {
                    let id = $(this).data('id'); // Get the invoice ID from the button's data-id attribute
                    let status = $(this).closest('tr').find('td:nth-child(9) .badge').text(); // Find the status in the same row

                    if (status === 'Pending') {
                        errorToast("Pending orders cannot be viewed!"); // Show error toast
                    } else if (status === 'Delivered') {
                        await InvoiceDetails(id); // Call the InvoiceDetails function and pass the invoice ID
                        $("#details-modal").modal('show'); // Show the modal
                    }
                });

                // Event delegation to handle dynamic elements
                $(document).on('click', '.deleteBtn', function() {
                    let id = $(this).data('id'); // Get the invoice ID from the button
                    $('#deleteID').val(id); // Store it in the hidden input field in the modal
                    $('#delete-modal').modal('show'); // Show the confirmation modal
                });

                // Reinitialize the DataTable
                new DataTable('#orderData', {
                    order: [
                        [0, 'desc']
                    ],
                    lengthMenu: [5, 10, 15, 20, 30]
                });

            } catch (error) {
                console.log(error);
                errorToast("Failed to load order data!");
            }
        }

        getInvoiceInfo();
    </script>