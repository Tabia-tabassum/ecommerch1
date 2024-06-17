@extends('layouts.app')
@section('title') {{'Registation'}} @endsection

@section('content')
<section class="vh-100 bg-image my-5 ">
  <div class="mask d-flex align-items-center gradient-custom-3">
    <div class="container ">
      <div class="row d-flex justify-content-center align-items-center h-150">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-1">Create an account</h2>

              <form>

                <div class="form-outline mb-4">
                    <label>Name</label>
                  <input type="text" id="admin_name" class="form-control form-control-lg" />

                </div>

                <div class="form-outline mb-4">
                    <label>Email</label>
                  <input type="email" id="admin_email" class="form-control form-control-lg" />

                </div>

                  <div class="form-outline mb-4">
                      <label class="form-label">Select Role</label>
                      <select class="form-select" id="role" name="role" required="true" aria-required="true">
                          <option value="1">Admin</option>
                          <option value="2">Seller</option>
                      </select>
                  </div>

                <div class="form-outline mb-4">
                    <label>Password</label>
                  <input type="password" id="admin_password" class="form-control form-control-lg" />

                </div>

                <div class="form-outline mb-4">
                    <label>Repeat your password</label>
                  <input type="password" id="admin_password_confirm" class="form-control form-control-lg" />

</div>

                <div class="d-flex justify-content-center">
                  <button type="button" id="registation"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{url('login')}}"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
