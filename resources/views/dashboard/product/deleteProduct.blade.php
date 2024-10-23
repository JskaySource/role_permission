<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once deleted, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="productDelete()" type="button" id="confirmDelete" class="btn bg-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


 <script>

async function productDelete() {
    try {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();
        // showLoader(); // Uncomment if you have a loader

        let res = await axios.post("/delete-product", { id: id });
        // hideLoader();

        if (res.data.status === 'success') {
            successToast("Product Delete Request Success");
            // Refresh product list
            await getProductInfo();
        } else {
            errorToast("Product Delete Request Failed: " + res.data.message);
        }
    } catch (error) {
        console.error(error);
        errorToast("An error occurred while deleting the product");
    } finally {
        // hideLoader(); // Uncomment if you have a loader
    }
}


</script>
