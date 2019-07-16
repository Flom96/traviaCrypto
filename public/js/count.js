$(document).ready(function() {

})
var dTimer;

function noanswer(id) {
    var timeLeft = 6;
    dTimer = setInterval(function() {
        if(sessionStorage.sTime) {
            timeLeft = Number(sessionStorage.sTime);
        }
        timeLeft--;
        sessionStorage.sTime = timeLeft;
        document.getElementById("countdown").textContent = timeLeft;
        if(timeLeft <= 0) {
            clearInterval(dTimer);
            sessionStorage.removeItem('sTime');
            $.ajax({
                'method': 'get',
                'url': '/noAnswer',
                'data': {
                    'mquestion_id': id
                },
                'success': function(data) {
                    if(data == 'ok') {
                        window.location.reload();
                    }
                    else {
                        alert(data);
                        window.location.href = '/home';
                    }
                }
            })
        }
        
    }, 1000)
}

function checkAnswer($chosen, $id) {
    $.ajax({
        'method': 'get',
        'url': '/checkAnswer',
        'data': {
            'chosen' : $chosen,
            'mquestion_id': $id
        },
        'success': function(data) {
            clearInterval(dTimer);
            sessionStorage.removeItem('sTime');
            if(data == 'Correct' || data == "Incorrect" ) {
                alert(data);
                window.location.reload();
            }
            else {
                alert(data);
                window.location.href = '/home';
            }
        }
    })
}

            