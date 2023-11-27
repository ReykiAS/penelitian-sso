@extends('layouts.app2')

@section('content')
<section class="hero is-fullheight is-fullwidth">
    <div class="hero-head has-text-centered">

    </div>
    <div class="hero-body has-text-centered" >
        <div class="login" style="background-color: rgba(255,255,255,0.5);">
            <div>
                <img src="{{url('/images/logo_sso.png')}}" class="img-fluid float-lg-left" alt="" width="100px" height="100px">
                <img src="{{url('/images/logo_itts.png')}}" class="img-fluid float-lg-right" alt="" width="100px" height="100px">
            </div>
            <br><br><br><br><br>
            <h1 style="text-align:center;font-size:20px;">Your Account For Any Activity</h1>
            <br>
            <form method="POST" id="form-login" action="{{ route('login') }}">
                @csrf
                <div class="field form-group">
                    <div class="control">
                        <input class="input is-medium is-rounded form-control @error('username') is-invalid @enderror" id="username" type="text" placeholder="NIM/NIP" autocomplete="username" required />
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="field form-group">
                    <div class="control">
                        <input class="input is-medium is-rounded form-control @error('password') is-invalid @enderror" id="password" type="password" placeholder="**********" autocomplete="current-password" required />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br />
                <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                    Login
                </button>
            </form>
            <br>
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                         @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <!-- <div class="level-item has-text-centered">
                    <div>
                        <a href="#">Create an Account</a>
                    </div>
                </div> -->
            </nav>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{ asset('js/auth.js') }}" ></script>
<script src="{{ asset('js/fingerprint2.min.js') }}" ></script>
<script src="{{ asset('js/md5.min.js') }}" ></script>

<script type="text/javascript">
var initSnonce = "{{ route('getSnonce') }}"
var initOtp = "{{ route('getOtp') }}"

$( document ).ready(function() {
    console.log( "ready!" );
    init();
});
</script>
@endsection