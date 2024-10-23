<div class="modal fade" id="update-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update User</h6>
            </div>
            <div class="modal-body">
                <form id="userUpdateForm">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="department">Department</label>
                        <input type="text" id="department_update" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="number" id="mobile_update" class="form-control">
                    </div>

                    <input class="d-none" id="updateID">
                    <input type="text" class="d-none" id="filePath">

                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="userUpdate()" id="save-btn" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
<script>
   async function fillUpUpdateForm(id) {
    try {
        document.getElementById('updateID').value = id;
        //showLoader(); // Uncomment if you have a loader
        let res = await axios.post("/get-user", { id: id });
        //hideLoader(); // Uncomment if you have a loader
       
        if (res.data) {  // Checking if the data exists
            document.getElementById('name_update').value = res.data.name;
            document.getElementById('email_update').value = res.data.email;
            document.getElementById('department_update').value = res.data.department;
            document.getElementById('mobile_update').value = res.data.mobile;
        } else {
            errorToast('Failed to load user data');
        }
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
}

// Function to update user data
async function userUpdate() {
    let name = document.getElementById('name_update').value;
    let email = document.getElementById('email_update').value;
    let department = document.getElementById('department_update').value;
    let mobile = document.getElementById('mobile_update').value;
    let updateID = document.getElementById('updateID').value;

    try {
        let response = await axios.put('/update-user', {
            id: updateID,
            name: name,
            email: email,
            department: department,
            mobile: mobile
        });

        if (response.data.status === 'Success') {
            successToast('User updated successfully');
            getUserList();
            $('#update-modal').modal('hide');
            document.getElementById('userUpdateForm').reset(); // Reset the form fields
        } else {
            errorToast('Update failed');
        }
    } catch (error) {
        console.error('Error updating user:', error);
    }
}

</script>
