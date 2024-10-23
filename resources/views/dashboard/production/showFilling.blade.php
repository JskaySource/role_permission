
<div class="container-fluid p-4" style="background-color:#dfdede">
    <div class="row">
        <div class="col-md-12">
            <di class="card">
        <div class="card-header d-flex justify-content-between">
    <h2>Production Information</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Add New
      </button>
 </div>
  <div class="card-body mt-2">
    <table id="productionData" class="table table-hover">
        <thead class="table-light">
            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Production Date</th>
                                <th scope="col">Zara Fillup</th>
                                <th scope="col">Refil Fillup</th>
                                <th scope="col">Total Quantity</th>
                                <th scope="col-2">Action</th>
            </tr>
        </thead>
        <tbody id="productionList"></tbody>

    </table>
</div>
</div>
        </div>
    </div>
</div>

<script>
async function getProductionInfo() {
    try {
        let res = await axios.get("/show-filling");

        let productionList = $("#productionList");
        let productionData = $("#productionData");

       productionData.DataTable().destroy();
       productionList.empty();

        let totalZaraFill = 0;
        let totalRefilFill = 0;
        let totalQuantitySum = 0;

        res.data.forEach(function (item, index) {
            let dateParts = item['date'].split('-');
            let formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;

            let zaraFilling = parseFloat(item['zara_filling']) || 0;
            let refilFilling = parseFloat(item['refil_filling']) || 0;

            let totalQuantity = zaraFilling + refilFilling;

            totalZaraFill += zaraFilling;
            totalRefilFill += refilFilling;
            totalQuantitySum += totalQuantity;

            let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${formattedDate}</td>
                        <td>${zaraFilling}</td>
                        <td>${refilFilling}</td>
                        <td>${totalQuantity}</td>
                        <td>
                            <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success"><i class="far fa-edit"></i></button>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                     </tr>`;
            productionList.append(row);
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

        // Reinitialize the DataTable
        new DataTable(productionData, {
            order: [[0, 'asc']],
            lengthMenu: [5, 10, 15, 20, 30]
        });

    } catch (error) {
        console.log(error);
        errorToast("Failed to load data!");
    }
}

getProductionInfo();


</script>
