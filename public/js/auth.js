var action = "Login";

function getEpoch(){
    return Math.round((new Date()).getTime() / 1000);
}

function getVerificationTime(msg){
    return msg.deltaTime != Math.abs(msg.serverTime-clientTime) ? false : true;
}

function getVerificationFingerprint(msg, fingerPrint){
    return msg.fingerPrint != fingerPrint ? false : true;
}

function setCtime(){
    clientTime= Math.round(getEpoch() / 21600);
    return clientTime;
}

function setCnonce(data){
    var arr= [data.gsalt, clientTime, data.snonce, action]
    var cnonce= md5(arr.join("_"));
    return cnonce;
}

function getOtp(data){
    $.ajax({
        method: "POST",
        url: initOtp,
        data: data
    })
    .done(function( msg ) {
        if(msg.status=='notok'){
            console.log(msg.msg);
            return;
        }
        if(!getVerificationTime(msg)){
            console.log('Time Verification Failed')
            return;
        }
        if(!getVerificationFingerprint(msg, data.fingerPrint)){
            console.log('Fingerprint Verification Failed')
            return;
        }
        data.otp= msg.otp;
        data.lock= msg.lock;
        doLogin(data);
    });
}

function getSnonce(fingerPrint){
    var clientTime= setCtime();
    $.ajax({
        method: "POST",
        url: initSnonce,
        data: { clientTime: clientTime , action: action , fingerPrint: fingerPrint}
    })
    .done(function( msg ) {
        if(msg.status=='notok'){
            console.log(msg.msg);
            return;
        }
        if(!getVerificationTime(msg)){
            console.log('Time Verification Failed')
            return;
        }
        if(!getVerificationFingerprint(msg, fingerPrint)){
            console.log('Fingerprint Verification Failed')
            return;
        }
        var cnonce      = setCnonce(msg);
        msg.cnonce      = cnonce;
        msg.action      = action;
        msg.clientTime  = clientTime;
        getOtp(msg);
    });
}

function initLogin(fingerPrint){
    getSnonce(fingerPrint);
}

function doLogin(data){
	data.cuhash= md5(data.otp + data.fingerPrint + data.gsalt + data.snonce + $('#username').val().trim() + data.cnonce);
	data.cphash= md5(data.otp + data.fingerPrint + data.gsalt + data.snonce + md5($('#password').val().trim()) + data.cnonce);
    // data.password= $('#password').val().trim();
    data._token= $('meta[name="csrf-token"]').attr('content'); 
    var el = $('#form-login');
    $.ajax({
        type: el.attr('method'),
        url: el.attr('action'),
        data: data,
        context: this
    }).done(function(msg){
        if(msg.hasOwnProperty('errors')){
            console.log(msg.message);
        } else {
            window.location.href = "/home";
        }
    });

}

function init(){
    new Fingerprint2().get(function(result){
		var fingerPrint= result;
	
        $( "#form-login" ).submit(function( event ) {
            event.preventDefault();
            console.log('halo');
			initLogin(fingerPrint);
        });
	});
}