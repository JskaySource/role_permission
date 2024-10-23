
<div class="container-fluid p-4" style="background-color:#dfdede">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
        <div class="card-header d-flex justify-content-between">
    <h2>Product Information</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Add New
      </button>
 </div>
  <div class="card-body mt-2">
    <table id="productData" class="table table-hover">
        <thead class="table-light">
            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col-2">Action</th>
            </tr>
        </thead>
        <tbody id="productList"></tbody>

    </table>
</div>
</div>
        </div>
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

            res.data.forEach(function (item, index) {
                let row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item['p_name']}</td>
                            <td>${item['p_price']}</td>
                            <td>
                                <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success"><i class="far fa-edit"></i></button>
                                <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                         </tr>`;
                productList.append(row);
            });

            $('.editBtn').on('click', async function () {
                let id = $(this).data('id');
                await fillUpUpdateForm(id);
                $("#update-modal").modal('show');
            });

            $('.deleteBtn').on('click', function () {
                let id = $(this).data('id');
                $("#delete-modal").modal('show');
                $("#deleteID").val(id);
            });

            new DataTable('#productData', {
                order: [[0, 'asc']],
                lengthMenu: [5, 10, 15, 20, 30]
            });

        } catch (error) {
            console.log(error);
            errorToast("Failed to load product data!");
        }
    }

    // Ensure this is outside of the function definition
    getProductInfo();
</script>
