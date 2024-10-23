<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="row">
            <h3 class="fw-bold fs-4 mb-3">Summary</h3>

            <div class="col-12 col-md-3 col-sm-6 p-1">
                <div class="card">
                    <div class="card-body py-4 s-card">
                        <h5 class="mb-2 fw-bold">Product</h5>
                        <p class="mb-2 fw-bold">
                            <i class="fa-regular fa-id-card"></i>
                            <span id="product">0</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 col-sm-6 p-1">
                <div class="card">
                    <div class="card-body py-4 s-card">
                        <h5 class="mb-2 fw-bold">Dealer</h5>
                        <p class="mb-2 fw-bold">
                            <i class="fa-regular fa-id-card"></i>
                            <span id="dealer">0</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 col-sm-6 p-1">
                <div class="card">
                    <div class="card-body py-4 s-card">
                        <h5 class="mb-2 fw-bold">This Month Production</h5>
                        <p class="mb-2 fw-bold">
                            <i class="fa-regular fa-id-card"></i>
                            <span id="dealer">0</span>
                            <span id="dealer">0</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 col-sm-6 p-1">
                <div class="card">
                    <div class="card-body py-4 s-card">
                        <h5 class="mb-2 fw-bold">This Month Sale</h5>
                        <p class="mb-2 fw-bold">
                            <i class="fa-regular fa-id-card"></i>
                            <span id="dealer">0</span>
                            <span id="dealer">0</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr style="height:3px; color:red; background-color:red;">

        <h3 class="fw-bold fs-4 my-3">Avg. Agent Earnings</h3>

        <hr style="height:3px; color:red; background-color:red;">
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        getSummary();
    });

    async function getSummary() {
        try {
            const res = await axios.get('/summary', {
                headers: { 'User-Id': 'YOUR_USER_ID' } // Replace with dynamic value if needed
            });

            document.getElementById('product').innerText = res.data.product || 0;
            document.getElementById('dealer').innerText = res.data.dealer || 0;
        } catch (error) {
            console.error('Error fetching summary:', error);
        }
    }
</script>
