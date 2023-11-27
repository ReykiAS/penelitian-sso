@extends('layouts.app') 
@section('header') 
<div class="content">
    <div class="block block-transparent">
        <div class="block-content">
            <div class="row push">
                <div class="d-none d-md-block">
                    <div class="col-md py-10 d-md-flex align-items-md-center">
                        <div class="pic-container pic-medium pic-circle profile-pic mr-picture">
                            <img src="{{ asset('avatar/avatar15.jpg') }}" alt="User Profile" class="img-avatar img-avatar96" id="imgProfilePic">
                        </div>
                        <h2 class="text-white mb-0 text-center">
                            <span class="font-w300 d-md-inline-block ml-2">Welcome<br>
                                <strong class="text-white">{{ $user->name }}</strong> 
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p></p>
</div>
@endsection 
@section('content') 
<style>
.loading {
	z-index: 20;
	position: absolute;
	top: 0;
	left:-5px;
	width: 100%;
	height: 100%;
    background-color: rgba(0,0,0,0.4);
}
.loading-content {
	position: absolute;
	border: 16px solid #f3f3f3; /* Light grey */
	border-top: 16px solid #3498db; /* Blue */
	border-radius: 50%;
	width: 50px;
	height: 50px;
	top: 40%;
	left:47.5%;
	animation: spin 2s linear infinite;
	}
	
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style>
<section id="loading">
  <div id="loading-content"></div>
</section>
<!-- Page Content -->
<div class="content">
    <div class="block block-transparent">
        <div class="">
          <h3 class="block-title">Internal Application</h3>
        </div>
        <div class="block-content">
            <div class="row gutters-tiny push">
                <div class="col-6 col-md-4 col-xl-2 mt-2">
                <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" id="loginUrl" href="{{ $loginUrl }}" target="_blank">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Login Wifi Manual</p>
                    </div>
                  </a>
                </div>
                <!-- <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <form id="#formLogin" action="{{ $loginPostUrl }}" method="POST" target="_blank" formtarget="_blank">
                    <input type="hidden" name="authtype" value="{{ $authtype }}">
                    <input type="hidden" name="usrName" value="{{ $usrName }}">
                    <input type="hidden" name="pwd" value="{{ $pwd }}">
                    <input type="hidden" name="portalType" value="{{ $portalType }}">
                    <input type="hidden" name="gw_ip" value="{{ $gw_ip }}">
                    <input type="hidden" id="ip" name="ip" value="{{ $ip }}">
                    <input type="hidden" id="mac" name="mac" value="{{ $mac }}">
                    <input type="hidden" name="net" value="{{ $net }}">
                    <input type="hidden" name="rmac" value="{{ $rmac }}">
                    <input type="hidden" name="tabs" value="{{ $tabs }}">
                    <input type="hidden" name="cf" value="{{ $cf }}">
                    <input type="hidden" name="mobile" value="{{ $mobile }}">
                    <input type="hidden" name="hq" value="{{ $hq }}">
                    <input type="hidden" name="poup" value="{{ $poup }}">
                    <input type="hidden" name="langSw" value="{{ $langSw }}">
                    <input type="hidden" name="url" value="{{ $url }}">
                    <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" class="button block" onclick="document.getElementById('#formLogin').submit();" formtarget="_blank" > 
                      <div class="my-5 block-content">
                        <p>
                          <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                        </p>
                        <p class="" style="color: #a10000">Login Wifi Otomatis</p>
                      </div>
                    </a>
                </form>
                </div> -->
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
                                                <div class="col-6 col-md-4 col-xl-2 mt-2">
                  <a class="h-100 block block-rounded block-bordered block-link-shadow text-center" href="https://igracias.ittelkom-sby.ac.id/">
                    <div class="my-5 block-content">
                      <p>
                        <i class="fas fa-book fa-3x" style="color: #a10000"></i>
                      </p>
                      <p class="" style="color: #a10000">Igracias</p>
                    </div>
                  </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// $(document).on('click', '#loginWifi', function(e){
//   console.log('clicked');
//   $('#formLogin').submit();
// })
var ip= '{{ $ip }}';
var mac= '{{ $mac }}';
var url= '{{ $loginUrl }}';
$( document ).ready(function() {
  $.ajax({
      url: 'https://ip.ittelkom-sby.ac.id/getmyip/',
      crossDomain:true,
      beforeSend: function(){
        showLoading();
      },
      complete: function(){
        hideLoading();
      },
      success: function(msg){
        msg= JSON.parse(msg);
        if(msg.hasOwnProperty('ip_addr')){
          url = url.replace(ip, msg.ip_addr);
          ip= msg.ip_addr;
          $('#ip').val(ip);
        }
        if(msg.hasOwnProperty('mac')){
          url = url.replace(mac, msg.mac);
          mac= msg.mac;
          $('#mac').val(mac);
        }
        url= url.split('&amp;').join('&');
        $("#loginUrl").attr("href", url);
      }
    });

    $(document).on('click', '#loginUrl', function(e){
      e.preventDefault();
      console.log($("#loginUrl").attr("href"));
      $.ajax({
        url: "{{ $loginPostUrl }}",
        method: 'POST',
        dataType: "jsonp",
        crossDomain: true,
        // format: "json",
        data: {
          authtype : "{{ $authtype  }}",
          usrName : "{{ $usrName  }}",
          pwd : "{{ $pwd  }}",
          portalType : "{{ $portalType  }}",
          gw_ip : "{{ $gw_ip  }}",
          ip : ip,
          mac : mac,
          net : "{{ $net  }}",
          rmac : "{{ $rmac  }}",
          tabs : "{{ $tabs  }}",
          cf : "{{ $cf  }}",
          mobile : "{{ $mobile  }}",
          hq : "{{ $hq  }}",
          poup : "{{ $poup  }}",
          langSw : "{{ $langSw  }}",
          url : "{{ $url  }}",
        },
        beforeSend: function(){
          showLoading();
        },
        complete: function(){
          hideLoading();
        },
        success: function(msg){
          msg= JSON.parse(msg);
          console.log(msg);
        }
      });
    });
});

function showLoading() {
  document.querySelector('#loading').classList.add('loading');
  document.querySelector('#loading-content').classList.add('loading-content');
}

function hideLoading() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
}

</script>
@endsection