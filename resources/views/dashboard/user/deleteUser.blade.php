<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once deleted, you can't get it back.</p>
                <input type="hidden" id="deleteID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="userDelete()" type="button" id="confirmDelete" class="btn bg-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
async function userDelete() {
    try {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();
        let res = await axios.delete("/delete-user", { data: { id: id } });
        if (res.data.status === 'success') {
            successToast("User Delete Request Success");
            await getUserList();  // Refresh User List
        } else {
            errorToast("User Delete Request Failed: " + res.data.message);
        }
    } catch (error) {
        console.error(error);
        errorToast("An error occurred while deleting the user");
    }
}


</script>