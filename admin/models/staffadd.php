<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="./auth/staffadd.auth.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStaffModalLabel">Add New Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="full_name" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Upload Image</label>
              <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3 col-md-12">
              <label class="form-label">Specialization</label>
              <input type="text" name="specialization" class="form-control">
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Availability</label>
              <select name="availability" class="form-select">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Role</label>
              <select name="role" class="form-select" required>
                <option value="staff" selected>Staff</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Hire Date</label>
              <input type="date" name="hire_date" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Staff</button>
        </div>
      </div>
    </form>
  </div>
</div>
