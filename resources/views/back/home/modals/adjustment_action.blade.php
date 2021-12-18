<div class="modal fade action-sheet" id="adjustmentActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adjustment</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="type_id" value=3>
                        <input type="hidden" name="category_id" value="0">
                        <input type="hidden" name="total" value="{{$total}}">
                        <input type="hidden" name="title" value="Adjustment">

                        <div class="form-group basic">
                            <label class="label">Enter Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control form-control-lg" name="amount">
                            </div>
                        </div>
                       <div class="form-group basic">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>