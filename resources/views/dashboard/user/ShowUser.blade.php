

<div class="container-fluid p-4" style="background-color:#dfdede">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>User Data Show</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-modal">
        Add New
      </button>
                </div>
                <div class="card-body">
                    <table id="userData" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Department</th>
                                <th scope="col">Mobile</th>
                                <th scope="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="userList"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
  
  // Function to fetch and display user data in the table
async function getUserList() {
    try {
        let res = await axios.get("/show-user");

        let userList = $('#userList');
        let userData = $('#userData');

        userData.DataTable().destroy();
        userList.empty();

        res.data.forEach(function(item, index) {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.email}</td>
                    <td>${item.department}</td>
                    <td>${item.mobile}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success"><i class="far fa-edit"></i></button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>`;
            userList.append(row);
        });

        $('.editBtn').on('click', async function () {
            let id = $(this).data('id');
            await fillUpUpdateForm(id);
            $("#update-modal").modal('show');
        });

        $('.deleteBtn').on('click', function () {
            let id = $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        });


        //for data table
        new DataTable(userData, {
            order: [[0, 'asc']],
            lengthMenu: [5, 10, 15, 20, 30]
        });
        
        }catch (error) {
            console.log(error);
            errorToast("Failed to load User data!");
        }
    }
// Fetch and display the user list when the page loads
getUserList();

</script>