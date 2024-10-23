
<!-- Modal -->
<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Dealer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dealerUpdateForm">
                    <div class="mb-3">
                        <label for="name_update">Name</label>
                        <input type="text" id="name_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address_update">Address</label>
                        <input type="text" id="address_update" class="form-control">                    
                    </div>
                    <div class="mb-3">
                        <label for="mobile_update">Mobile</label>
                        <input type="text" id="mobile_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jar_limit_update">Jar Limit</label>
                        <input type="number" id="jar_limit_update" class="form-control">                    
                    </div>
                    <input class="d-none" id="updateID">
                    <input type="text" class="d-none" id="filePath">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateDealerList()" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function fillUpUpdateForm(id) {
        try {
            document.getElementById('updateID').value = id;

            // showLoader(); // Uncomment if you have a loader
            let res = await axios.post("/get-dealer", { id: id });
            // hideLoader(); // Uncomment if you have a loader

            if (res.status === 200) {
                document.getElementById('name_update').value = res.data['name'];
                document.getElementById('address_update').value = res.data['address'];
                document.getElementById('mobile_update').value = res.data['mobile'];
                document.getElementById('jar_limit_update').value = res.data['jar_limit'];
            } else {
                errorToast("Failed to load dealer data!");
            }
        } catch (error) {
            console.error(error);
            errorToast("An error occurred while fetching the product details.");
        }
    }

    async function updateDealerList() {
        let name_update = document.getElementById('name_update').value;
        let address_update = document.getElementById('address_update').value;
        let mobile_update = document.getElementById('mobile_update').value;
        let jar_limit_update = document.getElementById('jar_limit_update').value;
        let updateID = document.getElementById('updateID').value;

        if (name_update.length === 0) {
            errorToast("Name is Required!");
        } else if (address_update.length === 0) {
            errorToast("Address is Required!");
        } else if (mobile_update.length === 0) {
            errorToast("Mobile is Required!");
        } else if (jar_limit_update.length === 0) {
            errorToast("Jar Limit is Required!");
        } else {
            try {
                let payload = {
                    name: name_update,
                    address: address_update,
                    mobile: mobile_update,
                    jar_limit:jar_limit_update,
                    id: updateID
                };

                document.getElementById('update-modal-close').click();

                // showLoader(); // Uncomment if you have a loader
                let res = await axios.post('/update-dealer', payload);
                // hideLoader(); // Uncomment if you have a loader

                if (res.status === 200 && res.data.status === 'Success') {
                    document.getElementById("dealerUpdateForm").reset();
                    successToast("Dealert updated successfully!");
                    await getDealerList();
                } else {
                    errorToast("Failed to update the Dealer: " + res.data.message);
                }
            } catch (error) {
                console.error(error);
                errorToast("An error occurred while updating the product.");
            }
        }
    }
</script>