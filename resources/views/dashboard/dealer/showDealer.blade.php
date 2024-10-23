
<div class="container-fluid p-4" style="background-color:#dfdede">
    <div class="row">
        <div class="card"> 
        <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card-header d-flex justify-content-between">
    <h2>Dealer Information</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Add New
      </button>
 </div>
  <div class="card-body mt-2">
    <table id="dealerData" class="table table-hover">
        <thead class="table-light">
            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Dealer Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Jar Limit</th>
                                <th scope="col-2">Action</th>
            </tr>
        </thead>
        <tbody id="dealerList"></tbody>

    </table>
</div>
        </div>
    </div>
    </div>
</div>

<script>
    async function getDealerList() {
        try {
            let res = await axios.get("/show-dealer");

            let dealerList = $("#dealerList");
            let dealerData = $("#dealerData");

            dealerData.DataTable().destroy();
            dealerList.empty();

            res.data.forEach(function (item, index) {
                let row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item['name']}</td>
                            <td>${item['address']}</td>
                            <td>${item['mobile']}</td>
                            <td>${item['jar_limit']}</td>
                            <td>
                                <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success"><i class="far fa-edit"></i></button>
                                <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                         </tr>`;
                dealerList.append(row);
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

            new DataTable('#dealerData', {
                order: [[0, 'asc']],
                lengthMenu: [5, 10, 15, 20, 30]
            });

        } catch (error) {
            console.log(error);
            errorToast("Failed to load product data!");
        }
    }

    // Ensure this is outside of the function definition
    getDealerList();
</script>


