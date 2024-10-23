<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productionCreateForm">
                    <div class="mb-3">
                        <label for="date">Production Date</label>
                        <input type="date" id="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="zara_filling">Zara Filling</label>
                        <input type="number" id="zara_filling" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="refil_filling">Refil Filling</label>
                        <input type="number" id="refil_filling" class="form-control">
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="createProduction()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>



    // async function createProduction() {
    //     try {
    //         let date = document.getElementById('date').value;
    //         let zara_filling = document.getElementById('zara_filling').value;
    //         let refil_filling = document.getElementById('refil_filling').value;

    //         if (date.length === 0) {
    //             errorToast("Date Is Required");
    //         } else if (zara_filling.length === 0) {
    //             errorToast("Zara Filling Quantity is required");
    //         } else if (refil_filling.length === 0) {
    //             errorToast("Refil Filling Quantity is required");
    //         } else {
    //             document.getElementById('modal-close').click();

    //             // Convert date from d-m-Y format to Y-m-d format
    //             let dateParts = date.split('-');
    //             let formattedDate = `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;

    //             let formData = new FormData();
    //             formData.append('date', formattedDate);
    //             formData.append('zara_filling', zara_filling);
    //             formData.append('refil_filling', refil_filling);

    //             const config = {
    //                 headers: {
    //                     'content-type': 'multipart/form-data'
    //                 }
    //             };
    //             let response = await axios.post('/create-filling', formData, config);
    //             if (response.status === 201) {
    //                 successToast('Production inserted successfully');
    //                 document.getElementById('productionCreateForm').reset();
    //                 await getProductionInfo();
    //             } else {
    //                 errorToast("Production insert failed");
    //             }
    //         }
    //     } catch (error) {
    //         console.log(error);
    //         errorToast("Something went wrong. Please try again later");
    //     }
    // }

    async function createProduction() {
    try {
        let date = document.getElementById('date').value;
        let zara_filling = document.getElementById('zara_filling').value;
        let refil_filling = document.getElementById('refil_filling').value;

        if (!date || !zara_filling || !refil_filling) {
            errorToast("All fields are required");
            return;
        }

        document.getElementById('modal-close').click();

        let formData = {
            date: date,
            zara_filling: zara_filling,
            refil_filling: refil_filling
        };

        let response = await axios.post('/create-filling', formData);

        if (response.status === 201) {
            successToast('Production inserted successfully');
            document.getElementById('productionCreateForm').reset();
            await getProductionInfo();
        } else {
            errorToast("Production insert failed");
        }
    } catch (error) {
        console.log(error);
        errorToast("Something went wrong. Please try again later");
    }
}


</script>