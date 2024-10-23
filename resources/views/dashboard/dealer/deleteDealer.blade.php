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
                    <button onclick="dealerDelete()" type="button" id="confirmDelete" class="btn bg-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


 <script>

async function dealerDelete() {
    try {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();
        // showLoader(); // Uncomment if you have a loader

        let res = await axios.delete("/delete-dealer", { data: { id: id } });

        // hideLoader();

        if (res.data.status === 'Success') {
            successToast("Dealer Delete Request Success");
            // Refresh dealer list
            await getDealerList();
        } else {
            errorToast("Dealer Delete Request Failed: " + res.data.message);
        }
    } catch (error) {
        console.error(error);
        errorToast("An error occurred while deleting the dealer");
    } finally {
        // hideLoader(); // Uncomment if you have a loader
    }
}

</script>
