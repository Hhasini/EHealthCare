@extends('app')

@section('page_styles')


    <link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">

@endsection




@section('content')
    <br/>
    <div class="container">



        <div class="box box-default">

            <div class="box-header with-border">


                <div class="box box-default" style="padding: 20px 50px 0px 20px ;">




                    <div class="col-md-12" >


                        <div class="box box-default">
                            <div class="box-header with-border">

                                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_Schedule/list_schedules') }}"> </i> List Schedule</a>

                                <a class="btn  pull-right" style="color: white" href="#"> </i> </a>

                                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_Schedule/create') }}"> </i> Add New Schedule</a>

                                <br><br>

                                <div class="col-lg-12">
                                    <div id='calendar'></div>
                                </div>





                            </div>
                        </div>


                    </div>




                </div>

            </div>
        </div>



    </div>

    <br><br><br><br>
    <br><br><br><br>

@endsection




@section('page_script2')

    <script src="{{ URL::asset('plugins/daterangepicker/moment.min.js') }}"></script>

    <script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
{{--

<script>// Setup FullCalendar
    (function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#fullcalendar').fullCalendar({
            editable: true,
            height: 600,
            header: {
                left: 'title',
                center: '',
                right: 'today prev,next'
            },
            eventRender: function(event, element) {
                $(element).tooltip({title: event.title,container: "body"});
            },
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                }
            ]
        });
    }());
</script>

--}}

    <script type="text/javascript">
        $(document).ready(function() {

            var base_url = '{{ url('/e_schedules') }}';

            $('#calendar').fullCalendar({
                weekends: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: base_url + '/api',
                    error: function() {
                        alert("cannot load json");
                    }
                }
            });
        });
    </script>
@endsection