
var emailInput = document.getElementById('email');
var timeout = null;
emailInput.onkeyup = function (e) {

    clearTimeout(timeout);
    timeout = setTimeout(function () {
        var mail = $('#email').val();
        if($('#email').val().length >= 16)
        {
            $.ajax({
            type: "post",
            url: "http://kludrive.herokuapp.com/index.php/AddManager/control",
            cache: false,    
            data: {mailAdress: mail},
            success: function(data){   
                var obj = jQuery.parseJSON(data);  
                    if(obj['STATUS'] == "true")
                    {
                        success(obj);
                    }
                    else{
                       danger();               
                    }
            },
            error: function(){      

            }
            });
        }
        else{
            danger();
        }     
        }, 500);
};

function success(obj)  {
    $('#email').addClass(' form-control-success');
    $('#renkButonu').addClass(' has-success');
    $('#message').html("Valid mail! ");
    $('#sizeId').css("display","");
    $('#dutyInformation').css("display","");
    $('#personalityInformation').css("display","");
    $('#btnGonder').css("display","");
    $('#generalInformation').css("display","");
    $('#name').val(obj['NAME']);
    $('#surname').val(obj['SURNAME']);
    $('#unvan').val(obj['UNVAN']);

    $('#progad').val(obj['PROG_AD']);
    $('#fakad').val(obj['FAK_AD']);
    $('#bolad').val(obj['BOL_AD']);

    $('#brans').val(obj['BRANS']);
    $('#perTip').val(obj['PERSONEL_TIP']);
    $('#aktif').val(obj['AKTIF']);
}

function danger()  {
    $('#email').removeClass(' form-control-success');
    $('#renkButonu').removeClass(' has-success');
    $('#message').html("");
    $('#sizeId').css("display","none");
    $('#dutyInformation').css("display","none");
    $('#personalityInformation').css("display","none");
    $('#generalInformation').css("display","none");
    $('#btnGonder').css("display","none");
    $('#name').val("");
    $('#surname').val("");
    $('#unvan').val("");
    $('#progad').val("");
    $('#fakad').val("");
    $('#bolad').val("");
    
    $('#brans').val("");
    $('#perTip').val("");
    $('#aktif').val("");
}