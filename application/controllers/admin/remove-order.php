
<!-- Delete Specific Order Modal -->
<div class="modal fade" id="deleteModal_<?php echo $row['cart_id']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form method="post" action="<?php echo '?cart_id='. $row['cart_id']; ?>">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Enter Password</h4>
        </div>
        <div class="modal-body">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="password" name="password" class="form-control" required>
              <label class="form-label">Password</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
          <button type="submit" name="delete-order" class="btn btn-info waves-effect">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>