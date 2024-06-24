<div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Revisi Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="revisiForm">
                    @csrf
                    <div class="form-group">
                        <label for="revisiInput">Revisi:</label>
                        <textarea class="form-control" id="revisiInput" name="revisi" rows="4" cols="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Revisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
