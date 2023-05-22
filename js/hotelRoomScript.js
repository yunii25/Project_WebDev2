jQuery(document).ready(function($){

    $.get("xmlfiles/room.xml", function(data){
        var room_data = $(data).find('rooms');
        var display_template = $(document).find("#display-template");

        $(room_data).children("room").each(function(i, el){
            //console.log(el);

            var room_html = display_template.clone(); 
            var roomData = $("<h1></h1>");

            var _roomId = $(el).children("roomId").text();
            var _roomDescription = $(el).children("room_description").text();
            var _roomImg = $(el).children("media").text();
            var _roomPrice = $(el).children("price").text();
            var _roomCategory = $(el).attr("category");


            $(room_html).attr("id", "room-"+ _roomId);
            $(room_html).find(".img-room-cover").html('<img class="card-img-top" src="rooms/'+ _roomImg +'" />');
            
            $(room_html).find(".card-title").text(_roomDescription);
            $(room_html).find(".card-subtitle").text(_roomPrice);

            $(roomData).append(_roomCategory);

            $(room_html).find(".card-text").html(roomData);

            $(room_html).removeClass("d-none").appendTo("#room-list");

        });

    })

});

