<?php $product = $function->getData('products', 'id', $row['id']); ?>
  
    <!-- Add Order Modal -->
    <div class="modal fade" id="addModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo '?id='. $row['id']; ?>">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Quantity</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="number" name="quantity" min="1" max="<?php echo $product['QuantityInStock']; ?>" id="quantity" name="quantity" class="form-control" required>
                          <label class="form-label">Quantity</label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        <button type="submit" name="add-order" class="btn btn-info waves-effect">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    