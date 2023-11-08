   <!-- The Modal -->
<form action="{{ route('addquestion') }}" method="POST">
    @csrf
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" >
                    <h4 class="modal-title">Ask Questions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="mb-3">
                    <label  class="form-label p-2">Question title</label>
                    <input type="text" class="form-control" required name="question_title"
                        placeholder="any question....." autocomplete="off">  
                </div>
                <div class="mb-3">
                    <label class="form-label p-2">Description</label>
                    <textarea class="form-control" rows="3"  name="description" autocomplete="off"></textarea>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>