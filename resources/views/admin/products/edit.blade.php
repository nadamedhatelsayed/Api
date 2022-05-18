<div class="modal fade modal_edit" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">edit product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="PATCH" id="editsubmit">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Price</label>
                    <input type="number" step="0.1" class="form-control" name="price" required id="pricee">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Title</label>
                    <input type="text" class="form-control" name="title" required id="titlee">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="descriptionn"  required name="description"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
