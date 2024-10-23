<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productCreateForm">
                    <div class="mb-3">
                        <label for="p_name">Name</label>
                        <input type="text" id="p_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="p_price">Price</label>
                        <input type="number" id="p_price" class="form-control">                    
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createProduct()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>




<script>
    
    async function createProduct() {
    try {
        let p_name = document.getElementById('p_name').value;
        let p_price = document.getElementById('p_price').value;
        
        if (p_name.length === 0) {
            errorToast("Product name is required");
        } else if (p_price.length === 0) {
            errorToast("Price is required");
        } else {
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('p_name', p_name);
            formData.append('p_price', p_price);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
            let response = await axios.post('/create-product', formData, config);

            if (response.status === 201) {
                successToast('Product Created Successfully');
                document.getElementById("productCreateForm").reset();
                await getProductInfo();
            } else {
                errorToast("Product creation failed!");
            }
        }
    } catch (error) {
        console.log(error);
        errorToast('Something went wrong. Please try again later.');
    }
}

</script>