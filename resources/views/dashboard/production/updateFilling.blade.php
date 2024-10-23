<!-- Modal -->
<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productionUpdateForm">
                    <div class="mb-3">
                        <label for="date">Production Date</label>
                        <input type="date" id="date_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="zara_filling">Zara Filling</label>
                        <input type="number" id="zara_filling_update" class="form-control">                    
                    </div>
                    <div class="mb-3">
                        <label for="refil_filling">Refil Filling</label>
                        <input type="number" id="refil_filling_update" class="form-control">                    
                    </div>
                    
                    <input class="d-none" id="updateID">
                    <input type="text" class="d-none" id="filePath">
                    
                </form>
            </div>
            <div class="modal-footer">
            <button id="update-modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateProduction()" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
 async function fillUpUpdateForm(id) {
    try {
        document.getElementById('updateID').value = id;

        let res = await axios.post("/get-filling", { id: id });

        if (res.status === 200) {
            document.getElementById('date_update').value = res.data.date;
            document.getElementById('zara_filling_update').value = res.data.zara_filling;
            document.getElementById('refil_filling_update').value = res.data.refil_filling; 
        } else {
            errorToast("Failed to load production data!");
        }
    } catch (error) {
        console.error(error);
        errorToast("An error occurred while fetching the production details.");
    }
}

async function updateProduction() { 
    let date_update = document.getElementById('date_update').value;
    let zara_filling_update = document.getElementById('zara_filling_update').value;
    let refil_filling_update = document.getElementById('refil_filling_update').value;
    let updateID = document.getElementById('updateID').value;   

    if (date_update.length === 0) {
        errorToast("Production Date is Required!");
    } else if (zara_filling_update.length === 0) {
        errorToast("Zara Filling is Required!");
    } else if (refil_filling_update.length === 0) {
        errorToast("Refil Filling is Required!");
    } else {
        try {
            let payload = {
                id: updateID, // Ensure ID is included in the payload
                date: date_update,
                zara_filling: zara_filling_update,
                refil_filling: refil_filling_update,
            };
            document.getElementById('update-modal-close').click();

            let res = await axios.post("/update-filling", payload);

            if (res.status === 200 && res.data.status === 'success') {
                document.getElementById("productionUpdateForm").reset();
                successToast(res.data.message);
                await getProductionInfo();
            } else {
                errorToast("Failed to update the production: " + res.data.message);
            }
        } catch (error) {
            console.error(error);
            errorToast("An error occurred while updating the production.");
        }
    }
}



</script>