@extends('home')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.print.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">




    <style>
        body {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        }

        #trash{
            width:32px;
            height:32px;
            float:left;
            padding-bottom: 15px;
            position: relative;
        }

        #wrap {
            width: 1100px;
            margin: 0 auto;
        }

        #external-events {
            float: left;
            width: 150px;
            padding: 0 10px;
            border: 1px solid #ccc;
            background: #eee;
            text-align: left;
        }

        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
        }

        #external-events .fc-event {
            margin: 10px 0;
            cursor: pointer;
        }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
        }

        #external-events p input {
            margin: 0;
            vertical-align: middle;
        }

        #calendar {
            float: right;
            width: 900px;
        }



        .text-width {
            width: 50%;
        }

        li.nostyle {
            list-style-type: none;
        }

        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ol.simple_with_animation li.placeholder {
            position: relative;
            list-style-type: none;
            border: 2px solid #008fb3;
            border-color: #008fb3;
        }

        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }

        .table:hover {
            border: 0.5px solid #d1d1e0;
        }
    </style>
@endsection

@section('subcontent')
    <?php
    use Illuminate\Support\Facades\DB as DB;
    //use Auth;
    $bookId = $_GET['bookId'];


    $results = DB::table('bokked_checkup')->where('bookId','=',$bookId)->get();


    ?>

    <div class="container">


        <div class="box box-default" style="padding: 20px 50px 0px 20px;">
            <div class="box-header with-border">

                <div class="alert alert-success">
                    <strong>Recent medical checkup list</strong>
                </div>
                <ol class='simple_with_animation' style='list-style:none;'>
                    @foreach($results as $key => $result)
                        <li class="nostyle">
                            <table class="table table-hover" class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td> {{ $result->patient_id }}</td>
                                    <td> {{ $result->patient_id }}</td>
                                    <td> {{ $result->patient_id }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        {{--<div class="box box-default" style="padding:0px 10px 0px 20px;">
            <div class="box-header with-border">

                <div class="alert alert-success">
                    <strong>Schedule medical checkup for resources</strong>
                </div>
                <h4 style="font-size: 15px">2016-09-24</h4>
                <ol class='simple_with_animation'
                    style='list-style:none; border: 1px dashed #D9D9D9;border-radius: 10px; padding:50px 40px 50px 40px;'>
                    <li class="nostyle">
                        <input type='hidden' name='stories_to_add[]'
                               value=''/>
                        <table class="table table-hover" class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                    </li>
                    <button type="button" class="btn btn-aqua">Allocate Time</button>
                </ol>

            </div>
        </div>--}}

        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#sample-3a" data-toggle="tab">
                        </i>Sample Heading 1</a>
                </li>
                <li>
                    <a href="#sample-3b" data-toggle="tab">
                        Sample Heading 2</a>
                </li>
                <li>
                    <a href="#sample-3c" data-toggle="tab">
                        </i>Sample Heading 3</a>
                </li>
                <li>
                    <a href="#sample-3d" data-toggle="tab">
                        </i>Sample Heading 4</a>
                </li>
            </ul>
        </div>



            <div class="tab-content">
                <div class="tab-pane fade in active" id="sample-3a" >
                    <div class="row">

                        <div class="col-md-7" >
                            <ol class='simple_with_animation'
                                style='list-style:none; border: 1px dashed #D9D9D9;border-radius: 10px; padding:50px 40px 50px 40px;'>
                                <li class="nostyle">
                                    <input type='hidden' name='stories_to_add[]'
                                           value=''/>
                                    <table class="table table-hover" class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </li>
                                <a class="btn btn-small btn-aqua" style="background-color: #4b990e" href="{{ url('/checkup_shedules/laboratary_details') }}">Schedule Resourses</a>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="sample-3b">
                    <div class="row">
                        <div class="col-md-7" >
                            <ol class='simple_with_animation'
                                style='list-style:none; border: 1px dashed #D9D9D9;border-radius: 10px; padding:50px 40px 50px 40px;'>
                                <li class="nostyle">
                                    <input type='hidden' name='stories_to_add[]'
                                           value=''/>
                                    <table class="table table-hover" class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </li>
                                <button type="button" class="btn btn-aqua">Allocate Time</button>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in" id="sample-3c" >
                    <div class="row">

                        <div class="col-md-7" >
                            <ol class='simple_with_animation'
                                style='list-style:none; border: 1px dashed #D9D9D9;border-radius: 10px; padding:50px 40px 50px 40px;'>
                                <li class="nostyle">
                                    <input type='hidden' name='stories_to_add[]'
                                           value=''/>
                                    <table class="table table-hover" class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </li>
                                <button type="button" class="btn btn-aqua">Allocate Time</button>
                            </ol>
                        </div>
                    </div>
                </div>


        </div>

        <div id='wrap'>

            <div id='external-events'>
                <h4>Draggable Events</h4>
                <div class='fc-event'>New Event</div>
                <p>
                    <img src="assets/img/trashcan.png" id="trash" alt="">
                </p>
            </div>

            <div id='calendar'></div>

            <div style='clear:both'></div>

            <xspan class="tt">x</xspan>

        </div>



    </div>



@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
    <script src="{{ URL::asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/moment.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            var zone = "05:30";  //Change this to your timezone

            $.ajax({
                url: 'process.php',
                type: 'POST', // Send post data
                data: 'type=fetch',
                async: false,
                success: function(s){
                    json_events = s;
                }
            });


            var currentMousePos = {
                x: -1,
                y: -1
            };
            jQuery(document).on("mousemove", function (event) {
                currentMousePos.x = event.pageX;
                currentMousePos.y = event.pageY;
            });

            /* initialize the external events
             -----------------------------------------------------------------*/

            $('#external-events .fc-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/

            $('#calendar').fullCalendar({
                events: JSON.parse(json_events),
                //events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
                utc: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                droppable: true,
                slotDuration: '00:30:00',
                eventReceive: function(event){
                    var title = event.title;
                    var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
                    $.ajax({
                        url: 'process.php',
                        data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            event.id = response.eventid;
                            $('#calendar').fullCalendar('updateEvent',event);
                        },
                        error: function(e){
                            console.log(e.responseText);

                        }
                    });
                    $('#calendar').fullCalendar('updateEvent',event);
                    console.log(event);
                },
                eventDrop: function(event, delta, revertFunc) {
                    var title = event.title;
                    var start = event.start.format();
                    var end = (event.end == null) ? start : event.end.format();
                    $.ajax({
                        url: 'process.php',
                        data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            if(response.status != 'success')
                                revertFunc();
                        },
                        error: function(e){
                            revertFunc();
                            alert('Error processing your request: '+e.responseText);
                        }
                    });
                },
                eventClick: function(event, jsEvent, view) {
                    console.log(event.id);
                    var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
                    if (title){
                        event.title = title;
                        console.log('type=changetitle&title='+title+'&eventid='+event.id);
                        $.ajax({
                            url: 'process.php',
                            data: 'type=changetitle&title='+title+'&eventid='+event.id,
                            type: 'POST',
                            dataType: 'json',
                            success: function(response){
                                if(response.status == 'success')
                                    $('#calendar').fullCalendar('updateEvent',event);
                            },
                            error: function(e){
                                alert('Error processing your request: '+e.responseText);
                            }
                        });
                    }
                },
                eventResize: function(event, delta, revertFunc) {
                    console.log(event);
                    var title = event.title;
                    var end = event.end.format();
                    var start = event.start.format();
                    $.ajax({
                        url: 'process.php',
                        data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            if(response.status != 'success')
                                revertFunc();
                        },
                        error: function(e){
                            revertFunc();
                            alert('Error processing your request: '+e.responseText);
                        }
                    });
                },
                eventDragStop: function (event, jsEvent, ui, view) {
                    if (isElemOverDiv()) {
                        var con = confirm('Are you sure to delete this event permanently?');
                        if(con == true) {
                            $.ajax({
                                url: 'process.php',
                                data: 'type=remove&eventid='+event.id,
                                type: 'POST',
                                dataType: 'json',
                                success: function(response){
                                    console.log(response);
                                    if(response.status == 'success'){
                                        $('#calendar').fullCalendar('removeEvents');
                                        getFreshEvents();
                                    }
                                },
                                error: function(e){
                                    alert('Error processing your request: '+e.responseText);
                                }
                            });
                        }
                    }
                }
            });

            function getFreshEvents(){
                $.ajax({
                    url: 'process.php',
                    type: 'POST', // Send post data
                    data: 'type=fetch',
                    async: false,
                    success: function(s){
                        freshevents = s;
                    }
                });
                $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
            }


            function isElemOverDiv() {
                var trashEl = jQuery('#trash');

                var ofs = trashEl.offset();

                var x1 = ofs.left;
                var x2 = ofs.left + trashEl.outerWidth(true);
                var y1 = ofs.top;
                var y2 = ofs.top + trashEl.outerHeight(true);

                if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
                        currentMousePos.y >= y1 && currentMousePos.y <= y2) {
                    return true;
                }
                return false;
            }

        });













        var adjustment;
        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            // animation on drop
            onDrop: function ($item, container, _super) {
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                $item.animate($clonedItem.position(), function () {
                    $clonedItem.detach();
                    _super($item, container);
                });
            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                        pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });
    </script>
@endsection