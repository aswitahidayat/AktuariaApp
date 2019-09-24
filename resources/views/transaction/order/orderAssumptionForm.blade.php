<div class="modal fade" id="modalOrderAssumption" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="modelHeadingOrderAssumption"><i class="ace-icon fa fa-shopping-cart cyan"></i> | Order Assumption</h4>
            </div>
            {{-- <form id="formOrderAssumption" action="javascript:void(0);"> --}}
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="ordhdr_id" name="ordhdr_id" required>
                    <div id="assumption"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="submitModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="subModalOrderAssumption" tabindex="-1" role="dialog" aria-labelledby="AddOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="subModelHeadingOrderAssumption"><i class="ace-icon fa fa-shopping-cart cyan"></i> | Assumption Progressive</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="ordhdr_id" required>
                    <div id="subAssumption" class="pb-20"></div>
                    <button type="button" class="btn btn-secondary" onclick="addProgressive()">addProgressive</button>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                    <button id="submitSubModal" type="submit" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
                </div>
            </div>
        </div>
    </div>