<div class="modal fade" id="create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Create User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user-form">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="department">Department</label>
                        <input type="text" id="department" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="number" id="mobile" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" required autocomplete="new-password" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button onclick="onRegistration()" id="save-btn" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
  
  async function onRegistration() {
    let userName = document.getElementById('name').value.trim();
    let userEmail = document.getElementById('email').value.trim();
    let department = document.getElementById('department').value.trim();
    let userMobile = document.getElementById('mobile').value.trim();
    let userPassword = document.getElementById('password').value.trim();

    if (!userName) {
        return errorToast('Name is required');
    }
    if (!userEmail) {
        return errorToast('Unique Email is required');
    }
    if (!department) {
        return errorToast('Department is required');
    }
    if (!userMobile) {
        return errorToast('Mobile is required');
    }
    if (!userPassword) {
        return errorToast('Password is required');
    }

    try {
        let response = await axios.post('/create-user', {
            name: userName,
            email: userEmail,
            department: department,
            mobile: userMobile,
            password: userPassword,
            _token: '{{ csrf_token() }}'
        });

        if (response.data.status === 'Success') {
            successToast(response.data.message);
            getUserList();
            $('#create-modal').modal('hide');
        } else {
            errorToast(response.data.message);
        }
    } catch (error) {
        console.error('Data Insert failed', error);
        errorToast('An error occurred while creating the user.');
    }
}


</script>
