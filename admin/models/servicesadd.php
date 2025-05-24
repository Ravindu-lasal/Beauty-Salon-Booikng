<!-- Add Staff Modal -->
<div class="modal fade" id="addServicesModal" tabindex="-1" aria-labelledby="addServicesModal" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="./auth/servicesadd.auth.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServicesModal">Add New Services</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label class="form-label">Service Name</label>
                <input type="text" name="service_name" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Price</label>
              <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Durations (min)</label>
              <input type="number" name="durations" class="form-control" required>
            </div>
            <div class="mb-3 col-md-12">
              <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Service</button>
        </div>
      </div>
    </form>
  </div>
</div>
