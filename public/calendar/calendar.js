$(document).ready(function () {

    var d = new Date();
    textyear  = d.getFullYear();
    $(document).on("click",".fc-button-group",function(){
       text = $('.fc-header-toolbar').find('h2').text();
       year = text.split(' ');
       textyear = year[1];

    });
    $('#calendar').fullCalendar({
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: '/calendardata',
                dataType:'json',
                success: function (data) {
                    var events = [];
                    for(var i=0;i<data.length;i++) {
                        if (data[i].birthday != null) {

                          day = '-' + (data[i].birthday).substring(5);




                        if (data[i].status == 2) {
                            events.push({
                                title: data[i].name,

                                start: textyear+ day,
                            });
                        }
                     }
                    }
                   // console.log(events);
                   callback(events);
                }
            });
        }


    });

});
