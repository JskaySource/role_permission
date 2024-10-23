<!-- <style>
.left-dialog {
    border-right: 1px solid #dee2e6;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}
</style> -->

<style>
    .challan-body {
        background-color: #e3f2fd;
    }

    .table-custom th,
    .table-custom td {
        border: 1px solid black;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="order-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliveryModalLabel">Delivery Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="markDeliveredBtn" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>