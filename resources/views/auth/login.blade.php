<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" http-equiv="X-UA-Compatible" content="{{ csrf_token() }}" />

    <title>Costumer App</title>


	<style>body{padding-top: 60px;}</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="{{ asset('css/bootstrap.css')  }}" rel="stylesheet" />
	<link href="{{ asset('css/login-register.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	
    <script src="{{ asset('js/jquery-1.10.2.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/login-register.js') }}" type="text/javascript"></script>

</head>
<body>
    <div class="container justify-content-center">
      <div class="logo text-center"><img src="{{ asset('img/Costumer app.png') }}" class="logo-normal" />
      </div>
      <div class="text-center">
        <div class="d-flex justify-content-center pb-4">
            <a class="btn btn-success btn-lg" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a>
        </div>
        <a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a>

      </div>


		 <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login with</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box">
                            <div class="content">
                            @if(Session::get('fail'))
                                    <div id="msg" class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                                <div id="msg" class="d-none alert alert-danger">Invalid Credentials</div>
                                <div class="form loginBox">
                                    <form id="formLogin" action="{{ route('auth.check') }}" method="post" name="formLogin" >
                                       @csrf
                                       <input id="email_login" class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}" >
                                       <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                       <input id="password_login" class="form-control" type="password" placeholder="Password" name="password" >
                                       <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                       <div class="block mt-4">
                                          <label for="remember_me" class="inline-flex items-center">
                                             <input id="remember_me" type="checkbox" class="form-check-input form-check-label" name="remember">
                                             <span>{{ __('Remember me') }}</span>
                                          </label>
                                       </div>
                                       <input type="submit" class="btn btn-default btn-login" value="{{ __('Login') }}" />
                                    </form>
                                 </div>
                             </div>
                        </div>
                        <div class="box">
                           <div class="content registerBox" style="display:none;">
                           <div class="form">
                              <form method="POST" html="{:multipart=>true}" data-remote="true" action="{{ route('register') }}" accept-charset="UTF-8">
                                  @csrf
                                <input id="name_register" class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                                <input id="email_register" class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                <input id="password_register" class="form-control" type="password" placeholder="Password" name="password">
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <span class="text-danger">@error('password_confirmation'){{ $message }} @enderror</span>
                                <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit">
                              </form>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>
    		      </div>
		      </div>
		  </div>
    </div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        openLoginModal();
        jQuery('#').on('submit', e => {
            e.preventDefault();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('auth.check') }}",
                method: 'post',
                data: {
                    email:  jQuery('#email_login').val(),
                    password: jQuery('#password_login').val(),
                    _token: jQuery('input[name=_token]').val(),
                },
                dataType:'json',
                success: response => {
                    if (response.success) {
                        console.log(response);
                        $('#msg').addClass('d-none').html(response.msg);
                        window.location.href = "/dashboard";
                    } else {
                        console.log(response);
                        $('#msg').removeClass('d-none').html(response.msg);
                    }
                        
                }
            });  
        });
    });

</script>


</body>
</html>
