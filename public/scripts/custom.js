/* 
 Created on : 12 Dec, 2018, 14:12:51 PM
 Author     : groot (Aditya Pandey)
 Description: Custom Script
 */


$(document).ready(function () {

    if ($(".game_status").val() == "WON" || $(".game_status").val() == "LOST") {
        $("#feed").attr("disabled", "disabled");
    }
    var row = '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
    var request_uri = $(".request_uri").val();
    $("#feed").on("click", function () {
        var fedLife = '';
        var feedUrl = request_uri + "/../app/farm/feed";
        $.ajax({
            url: feedUrl,
            async: false,
            success: function (response) {
                if (response == "WON" || response == "LOST") {
                    location.reload();
                } else {
                    response = jQuery.parseJSON(response);
                    fedLife = parseInt(response[0]) + 1;
                    $(".feed_table").find("tbody").append(row);
                    $(".feed_table").find("tbody tr:last").find("td:eq(0)").html(response[1]);
                    $(".feed_table").find("tbody tr:last").find("td:eq(" + fedLife + ")").html('<img style="height:50px;width:50px;" src="' + request_uri + '/images/food.png" alt="Fed"/>');
                    location.reload();
                }
            }
        });
    });

    $("#newGame").on("click", function () {
        var newGameUrl = request_uri + "/../app/farm/newGame";
        $.ajax({
            url: newGameUrl,
            async: false,
            success: function () {
                location.reload();
            }
        });
    });
});