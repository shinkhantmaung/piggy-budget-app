<div class="modal fade action-sheet" id="expenseActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Expenses</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="type" value="expense">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text11">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>

                        {{-- <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="account2">Category</label>
                                <select class="form-control custom-select" id="account2">
                                    <option value="0">Savings</option>
                                    <option value="1">Investment</option>
                                    <option value="2">Mortgage</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="form-group basic">
                            <label class="label">Enter Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control form-control-lg" name="amount" placeholder="0">
                            </div>
                        </div>

                        

                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>