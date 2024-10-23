       <!-- dealer list show section & Script start -->
       <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table id="dealerData" class="table table-hover">
                    <thead class="table-light">
                        <tr>

                            <th>Dealer Name</th>
                            <th>Add</th>

                        </tr>
                    </thead>
                    <tbody class="w-100" id="dealerList"></tbody>

                </table>
            </div>
        </div>

        <script>
            async function getDealerList() {
                try {
                    let res = await axios.get("/show-dealer");
                    let dealerList = $("#dealerList");
                    let dealerData = $("#dealerData");
                    dealerData.DataTable().destroy();
                    dealerList.empty();

                    res.data.forEach(function(item, index) {
                        let row = `<tr>
                            <td>${item['name']}</td>
                            <td><a data-name="${item['name']}" data-id="${item['id']}" data-email="${item['mobile']}"}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                            
                         </tr>`;
                        dealerList.append(row);
                    });

                    $('.addCustomer').on('click', async function() {
                        let CName = $(this).data('name');
                        let CEmail = $(this).data('email');
                        let CId = $(this).data('id');

                        $("#CName").text(CName)
                        $("#CEmail").text(CEmail)
                        $("#CId").text(CId)
                    })

                    new DataTable('#dealerData', {
                        order: [
                            [0, 'desc']
                        ],
                        scrollCollapse: false,
                        info: false,
                        lengthChange: false
                    });

                } catch (error) {
                    console.log(error);
                    errorToast("Failed to load product data!");
                }
            }

            // Ensure this is outside of the function definition
            getDealerList();
        </script>
        <!-- dealer list show section & Script end -->
