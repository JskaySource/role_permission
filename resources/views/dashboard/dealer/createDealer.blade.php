<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dealerCreateForm">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" id="address" class="form-control">                    
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jar_limit">Jar Limit</label>
                        <input type="number" id="jar_limit" class="form-control">                    
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createDealer()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>




<script>
    
    async function createDealer() {
    try {
        let name = document.getElementById('name').value;
        let address = document.getElementById('address').value;
        let mobile = document.getElementById('mobile').value;
        let jar_limit = document.getElementById('jar_limit').value;
        
       
        if (name.length === 0) {
            errorToast("Dealer name is required");
        } else if (address.length === 0) {
            errorToast("Address is required");
        } else if (mobile.length === 0) {
            errorToast("Mobile is required");
        }else if (jar_limit.length === 0) {
            errorToast("Jar Limit is required");
        }else {
            document.getElementById('modal-close').click();
            // showLoader();

            let formData = new FormData();
            formData.append('name', name);
            formData.append('address', address);
            formData.append('mobile', mobile);
            formData.append('jar_limit', jar_limit);
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let response = await axios.post('/create-dealer', formData, config);

            // hideLoader();
            if (response.status ===201) {
                successToast('Dealer Created Successfully');
                document.getElementById("dealerCreateForm").reset();
                await getDealerList();
            } else {
                errorToast("Dealer creation failed!");
            }
        }
    } catch (error) {
        console.log(error);
        errorToast('Something went wrong. Please try again later.');
    }
}

</script>