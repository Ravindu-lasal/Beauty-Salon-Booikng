<!-- Edit Services Modal -->
<div class="modal fade" id="editServicesModal<?php echo $row['service_id']; ?>" tabindex="-1" aria-labelledby="editServicesModallabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="./auth/servicesedit.auth.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editServicesModallabel">Update Service: <?php echo htmlspecialchars($row['service_name']); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
          <div class="mb-3">
            <label class="form-label">Service Name</label>
            <input type="text" name="service_name" class="form-control" value="<?php echo htmlspecialchars($row['service_name']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $row['price']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Duration (minutes)</label>
            <input type="number" name="durations" class="form-control" value="<?php echo $row['duration_minutes']; ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($row['description']); ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Service</button>
        </div>
      </div>
    </form>
  </div>
</div>
