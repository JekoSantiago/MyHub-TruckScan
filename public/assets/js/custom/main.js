$(function(){

   console.log(navigator.userAgent);
   function getOS() {
    var userAgent = window.navigator.userAgent,
        platform = window.navigator.platform,
        macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
        windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
        iosPlatforms = ['iPhone', 'iPad', 'iPod'],
        os = null;

    if (macosPlatforms.indexOf(platform) !== -1) {
      os = 'Mac OS';
    } else if (iosPlatforms.indexOf(platform) !== -1) {
      os = 'iOS';
    } else if (windowsPlatforms.indexOf(platform) !== -1) {
      os = 'Windows';
    } else if (/Android/.test(userAgent)) {
      os = 'Android';
    } else if (!os && /Linux/.test(platform)) {
      os = 'Linux';
    }

    return os;
  }



    function char_count(str, letter)
    {
    var letter_Count = 0;
    for (var position = 0; position < str.length; position++)
    {
        if (str.charAt(position) == letter)
        {
        letter_Count += 1;
        }
    }
    return letter_Count;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // overriding path of JS script and audio
    $.qrCodeReader.jsQRpath = "assets/libs/jsQR/jsQR.min.js";
    $.qrCodeReader.beepPath = "assets/audio/beep.mp3";
    $.qrCodeReader.defaults.repeatTimeout = 2000;

    navigator.geolocation.getCurrentPosition(ok, err);


    function ok(position) {
      var latitude  = position.coords.latitude;
      var longitude = position.coords.longitude;


      console.log(latitude,longitude)

    }

    function err()
                {
                   swal.fire({
                            icon: 'warning',
                            title: 'Unable to detect location',
                            showConfirmButton: false,
                            timer: 1750
                        });
                }





    $("#QR").qrCodeReader({
        multiple: false,
        audioFeedback: true,
        callback: function(code) {
            // console.log(code);
            var positionInfo = ""  ;
            var error = false;
            var latitude;
            var longitude;
            var loc;
            var x = code.split('|');
            var TruckID = x[0];
            var qr = char_count(code,'|');
            var numer = ($.isNumeric(TruckID));
            // console.log((qr > 1),numer);


           if(qr != 1)
           {
             error = true;
             swal.fire({
                icon: 'warning',
                title: 'Invalid QR CODE',
                showConfirmButton: false,
                timer: 1750
             });
             $('#plate').hide();
             $('#logdate').hide();

           }

           if(numer == false)
           {
             error = true;
             swal.fire({
                icon: 'warning',
                title: 'Invalid QR CODE',
                showConfirmButton: false,
                timer: 1750
             });

             $('#plate').hide();
             $('#logdate').hide();
           }

           navigator.permissions && navigator.permissions.query({name: 'geolocation'})
           .then(function(PermissionStatus) {
               if (PermissionStatus.state == 'granted') {
                     console.log(PermissionStatus);
               } else if (PermissionStatus.state == 'prompt') {

                    swal.fire({
                        icon: 'warning',
                        title: 'Location error, turn on your location',
                        showConfirmButton: false,
                        timer: 1750
                    });
                    $('#plate').hide();
                    $('#logdate').hide();
                    $('#loading').hide();
                    error = true

               } else {

                    swal.fire({
                        icon: 'warning',
                        title: 'Location error, turn on your location',
                        showConfirmButton: false,
                        timer: 1750
                    });
                    $('#plate').hide();
                    $('#logdate').hide();
                    $('#loading').hide();
                    error = true
               }
           })


           console.log(error);
          if(error == false)
          {

            function success(position) {
                var latitude  = position.coords.latitude;
                var longitude = position.coords.longitude;
                var OS = getOS();

                console.log(latitude,longitude)

                var token = $('#globalToken').val();
                $.post(WebURL + '/scan',{TruckID:TruckID,latitude:latitude,longitude:longitude,_token:token,OS:OS},function(data){
                    // alert(TruckID);
                    if (data.num>=0)
                    {
                        $('#loading').hide();
                        var datetime = data.datetime;
                        var logdate = datetime.substr(0, 16);
                        loc = true;
                        swal.fire({
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1750
                        });
                        $('#plate').show();
                        $('#logdate').show();
                        $('#truckplate').text(x[1]);
                        $('#logdatetext').text(logdate);
                    }
                    else
                    {
                        console.log(data.num,data.msg);
                        swal.fire({
                            title: "Error Post!",
                            text: data.msg,
                            icon: "warning",
                            confirmButtonText: "Ok",
                            confirmButtonColor: '#6658dd',
                            allowOutsideClick: false,
                        });
                    }

                });



            }

                function error()
                {
                   swal.fire({
                            icon: 'warning',
                            title: 'Unable to detect location',
                            showConfirmButton: false,
                            timer: 1750
                        });
                        $('#loading').hide();
                }

            $('#loading').show();
            navigator.geolocation.getCurrentPosition(success, error);

          }

      }});


  });


