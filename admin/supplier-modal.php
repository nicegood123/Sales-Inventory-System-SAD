    <!-- Edit Supplier Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Edit Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 35px;"></textarea>
                                <label class="form-label">Address</label>
                            </div>
                        </div>
                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="address" class="form-control">
                                <label class="form-label">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-info waves-effect">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Supplier Modal -->
    <div class="modal fade" id="deleteModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $row['name']; ?></b> Supplier?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo '?id='. $row['id']; ?>">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete-supplier" class="btn btn-info waves-effect">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>