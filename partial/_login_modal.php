

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModal">Login to iDiscuss</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/Project/Forum/partial/_handlelogin.php" method="post">
          <div class="form-group">
            <label for="loginEmail">Email Address</label>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="loginPassword">Password</label>
            <input type="password" class="form-control" name="loginPassword" id="loginPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-info">Login</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>