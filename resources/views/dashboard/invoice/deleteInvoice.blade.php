<!-- Delete Button (assumed to be within a loop for each invoice item) -->


<!-- Delete Confirmation Modal -->
<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once deleted, you can't get it back.</p>
                <!-- Hidden Input to Store the ID -->
                <input type="hidden" id="deleteID" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-success mx-2" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button onclick="invoiceDelete()" type="button" id="confirmDelete" class="btn bg-danger">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



 <script>

 

    // Function to handle invoice deletion
    async function invoiceDelete() {
        try {
            // Get the invoice ID from the hidden input field in the modal
            let id = document.getElementById('deleteID').value;
            document.getElementById('delete-modal-close').click(); // Close the modal

            // Send Axios DELETE request
            let res = await axios.delete("/delete-invoice", {inv_id: id});

            if (res.data === 1) {
                successToast("Invoice deleted successfully!"); // Show success toast
                await getInvoiceInfo(); // Refresh invoice info or reload the data
            } else {
                errorToast("Invoice deletion failed."); // Show error toast if delete failed
            }
        } catch (error) {
            console.error(error);
            errorToast("An error occurred while deleting the invoice."); // Handle general errors
        }
    }



</script>
