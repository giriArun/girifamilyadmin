<!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmation" data-bs-id="0" data-bs-name="hello world" data-bs-type="projectRoleType">Delete</button> -->


<div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label text-danger">Are you sure you want to delete this item?</label>
                        <br>
                        <label class="col-form-label text-info fw-bold product-name"></label>
                        <input type="hidden" name="deleteId" id="deleteId">
                        <input type="hidden" name="deleteName" id="deleteName">
                        <input type="hidden" name="deleteType" id="deleteType">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var exampleModal = document.getElementById('deleteConfirmation');

    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        var deleteId = button.getAttribute('data-bs-id');
        var deleteName = button.getAttribute('data-bs-name');
        var deleteType = button.getAttribute('data-bs-type');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalProductName = exampleModal.querySelector('.modal-body .product-name');
        var modalBodyDeleteId = exampleModal.querySelector('.modal-body #deleteId');
        var modalBodyDeleteName = exampleModal.querySelector('.modal-body #deleteName');
        var modalBodyDeleteType = exampleModal.querySelector('.modal-body #deleteType');

        modalProductName.textContent = deleteName;
        modalBodyDeleteId.value = deleteId;
        modalBodyDeleteName.value = deleteName;
        modalBodyDeleteType.value = deleteType;
    } );
</script>