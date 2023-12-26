      <!-- Sign Up Form -->
      <form class="sign-up-form row g-3" method="POST">
        <?= csrf_field() ?>
        <div class="col-md-12">
          <label for="inputName" class="form-label">Name</label>
          <input type="name" class="form-control" name="name" id="name" required>
        </div>
        <div class="col-md-12">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail5" required>
        </div>
        <div class="col-md-12">
          <label for="inputPassword5" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="inputPassword5" required>
        </div>
        <div class="col-md-12">
          <label for="inputPassword6" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm-password" id="inputPassword6" required>
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Sign Up"/>
        </div>
      </form>
    </div>
  </div>

  <!-- 
    session['id']
    signin/signup switch template
    error loops
    csrf()
    ajax in ci4
   -->