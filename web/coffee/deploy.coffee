#
# Project: Pontoon
# Author: Saul Johnson
# Notes: Client-side script for the deployments page.
#

#
# Uses an AJAX call to deploy a website.
#
# @param hash  the hash (unique ID) of the project to deploy
#
window.deploy = (hash) ->
  waitingDialog.show 'Deploying site', {}
  $.get "go.php?project=#{hash}", (data) ->
    result = JSON.parse data
    $('.col-msg').html "<div class=\"alert alert-#{result.status}\">#{result.message}</div><pre>#{result.result}</pre>"
    waitingDialog.hide()
