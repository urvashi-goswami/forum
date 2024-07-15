<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModal">Signup with iDiscuss</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="/Project/Forum/partial/_handleSignup.php">
          <div class="form-group">
            <label for="signupUsername">Username :</label>
            <input type="text" class="form-control" id="signupUsername" name="signupUsername" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="signupEmail">Email address : </label>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="signupPassword">Password : </label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="signuConpassword">Confirm Password : </label>
            <input type="password" class="form-control" id="signuConpassword" name="signuConpassword" placeholder="Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
          <button type="submit" class="btn btn-info">Signin</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>