<?php $product = $function->getData('products', 'id', $row['id']); ?>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo '?id='. $row['id']; ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Edit Product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" placeholder="Enter product name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="description" value="<?php echo $product['description']; ?>" placeholder="Enter product description" class="form-control">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="price" value="<?php echo $product['price']; ?>" placeholder="Enter product price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="quantity" value="<?php echo $product['QuantityInStock']; ?>" placeholder="Enter product  quantity" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="category" class="form-control show-tick">
                                <?php
                                    $query = "SELECT * FROM category";
                                    $rows = $function->selectAll($query);
                                    foreach ($rows as $row): ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']==$product['category_id']) echo 'selected="selected"'; ?>><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="supplier" class="form-control show-tick">
                                <?php
                                    $query = "SELECT * FROM supplier";
                                    $rows = $function->selectAll($query);
                                    foreach ($rows as $row): ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']==$product['supplier_id']) echo 'selected="selected"'; ?>><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="edit-product" class="btn btn-info waves-effect" value="ADD">
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
                    <p>Are you sure you want to delete <b><?php echo $row['name']; ?></b> Product?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo '?id='. $row['id']; ?>">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete-product" class="btn btn-info waves-effect">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>