function deploy(hash) {
    waitingDialog.show('Deploying site');
    $.get('go.php?project=' + hash, function(data) {
        var result = JSON.parse(data);
        $('.col-msg').html('<div class="alert alert-' + result.status + '">' + result.message + '</div><pre>' + result.result + '</pre>');
        waitingDialog.hide();
    });
}