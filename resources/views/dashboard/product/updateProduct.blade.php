<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productUpdateForm">
                <div class="mb-3">
                        <label for="p_name_update">Name</label>
                        <input type="text" id="p_name_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="p_price_update">Price</label>
                        <input type="number" id="p_price_update" class="form-control">                    
                    </div>                    
                   
                    <input class="d-none" id="updateID">
                    <input type="text" class="d-none" id="filePath">
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateProductInfo()" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function fillUpUpdateForm(id) {
        try {
            document.getElementById('updateID').value = id;

            // showLoader(); // Uncomment if you have a loader
            let res = await axios.post("/get-product", { id: id });
            // hideLoader(); // Uncomment if you have a loader

            if (res.status === 200) {
                document.getElementById('p_name_update').value = res.data['p_name'];
                document.getElementById('p_price_update').value = res.data['p_price'];
            } else {
                errorToast("Failed to load product data!");
            }
        } catch (error) {
            console.error(error);
            errorToast("An error occurred while fetching the product details.");
        }
    }

    async function updateProductInfo() {
        let p_name_update = document.getElementById('p_name_update').value;
        let p_price_update = document.getElementById('p_price_update').value;
        let updateID = document.getElementById('updateID').value;

        if (p_name_update.length === 0) {
            errorToast("Product Name is Required!");
        } else if (p_price_update.length === 0) {
            errorToast("Price is Required!");
        } else {
            try {
                let payload = {
                    p_name: p_name_update,
                    p_price: p_price_update,
                    id: updateID
                };

                document.getElementById('update-modal-close').click();

                // showLoader(); // Uncomment if you have a loader
                let res = await axios.post('/update-product', payload);
                // hideLoader(); // Uncomment if you have a loader

                if (res.status === 200 && res.data.status === 'Success') {
                    document.getElementById("productUpdateForm").reset();
                    successToast("Product updated successfully!");
                    await getProductInfo();
                } else {
                    errorToast("Failed to update the product: " + res.data.message);
                }
            } catch (error) {
                console.error(error);
                errorToast("An error occurred while updating the product.");
            }
        }
    }
</script>