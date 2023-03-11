<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EStoreSpace</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('admin/global_assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <!-- /theme JS files -->
</head>
<body class="login-container">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <br>
            <br>
            <br>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                 <div class="row">
                         <div class="card-body">
                             <form method="POST" action="{{ route('password.update') }}">
                                 @csrf

                                 <input type="hidden" name="token" value="{{ $token }}">

                                 <div class="form-group row">
                                     <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                     <div class="col-md-6">
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                         @error('email')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                         @error('password')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                     </div>
                                 </div>

                                 <div class="form-group row mb-0">
                                     <div class="col-md-6 offset-md-4">
                                         <button type="submit" class="btn btn-primary">
                                             {{ __('Reset Password') }}
                                         </button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                 </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>

