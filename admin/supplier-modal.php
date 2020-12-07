<?php $supplier = $function->getData('supplier', 'id', $row['id']); ?>
    
    <!-- Edit Supplier Modal -->
    <div class="modal fade" id="editModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo '?id='. $row['id']; ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Edit Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" value="<?php echo $supplier['name']; ?>" placeholder="Enter supplier name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="1" name="address" placeholder="Enter supplier address"class="form-control no-resize auto-growth" style="overflow: hidden; overflow-wrap: break-word; height: 35px;"><?php echo $supplier['address']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="contact" value="<?php echo $supplier['contact']; ?>" placeholder="Enter supplier phone number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" name="edit-supplier" class="btn btn-info waves-effect">SAVE CHANGES</button>
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