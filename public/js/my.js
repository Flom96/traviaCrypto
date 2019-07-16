

function updateImg() {
    var formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);
    $.ajax({
        url: '/updateImg',
        type: 'POST',
        data: formData,
        processData: false, // important
        contentType: false, // important
        success: function(data) {
            $('.img-class').attr("src", data);
        }
    })
}

function charge(id, price) {
    if(confirm(price+' btc will be deducted from your wallet to take this quiz?')) {
        $('#charge'+id).submit();
    } 
}

function che(id) {
    $.ajax({
        url: '/updateSend',
        type: 'POST',
        data: {
            'amount': id
        },
        success: function(data) {
            $('#msg').html(data);
        }
    })
}

function generate() {
    $.ajax({
        url: '/pay',
        method: 'get',
        beforeSend: function() {
            $('.address').html(' loading...'); 
        },
        success: function(data) {
            if(data == '') {
                $('.address').html('  Check your internet connection');

            }
            else {
                $('.card-title').html('Transfer BTC to the below address, your wallet will be update immediately the fund is recieved');
                $('.address').html(data);
                $('#gen').hide();
                $('#qrcode').html("<iframe src='https://blockchain.info/qr?data="+data+"&size=200'style='border:none' height='200'></iframe>");
            }
        }
    })
}

