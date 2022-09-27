@extends('auth.layouts.app')
@section('content')
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{ asset('public/assets/img/illustrations/illustration-signup.jpg')}}'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">SIGN UP</h4>
                  <p class="mb-0">Fill up the below form to register</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="name">Name</label>
                      <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="email">Email</label>
                      <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label for="image">Select an Image:</label>
                      <input id="image" type="file" class="dropify @error('image') is-invalid @enderror" data-height="100" name="image">
                      @error('image')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="password">Password</label>
                      <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="password-confirm">Confirm Password</label>
                      <input id="password-confirm" name="password_confirmation" type="password" class="form-control">
                    </div>
                    <div class="form-check form-switch d-flex align-items-center mb-3">
                      <input class="form-check-input" type="checkbox" onclick="showPassword()">
                      <label class="form-check-label mb-0 ms-3">Show Password</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">SIGN IN</a>
                  </p>
                  <p class="mb-2 text-sm mx-auto">
                    Register as a
                    <a href="{{ route('pro-register') }}" class="text-primary text-gradient font-weight-bold">PRO USER</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection