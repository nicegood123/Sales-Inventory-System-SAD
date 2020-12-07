<?php $category = $function->getData('category', 'id', $row['id']); ?>

<!-- Edit Category Modal -->
    <div class="modal fade" id="editModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo '?id='. $row['id']; ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Edit Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" value="<?php echo $category['name']; ?>" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" name="edit-category" class="btn btn-info waves-effect">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $row['name']; ?></b> category?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo '?id='. $row['id']; ?>">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete-category" class="btn btn-info waves-effect">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>