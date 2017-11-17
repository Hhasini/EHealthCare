@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
@endsection

@section('content')

    <br/>
	<input type="hidden" id="event_data" value="{{$events}}" />
    <div class="container">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="box box-default" style="padding: 20px 50px 0px 20px ;">
                    <div class="col-md-12" >
                        <div class="box box-default">
                            <div class="box-header with-border">

                               {{-- <a class="btn btn-small btn-success pull-right" href="#"> </i> List Schedule</a>

                                <a class="btn  pull-right" style="color: white" href="#"> </i> </a>

                                <a class="btn btn-small btn-success pull-right" href="#"> </i> Add New Schedule</a>

                                <br><br>--}}

                                <div class="col-lg-12">
                                <div id="fullcalendar">
                                </div>

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

    <script>// Setup FullCalendar

        $(document).ready(function() {
		
			var event_data = $('#event_data').val();
			var event_arr = [];
			
			if(event_data!=null && event_data.includes(",")){
				event_sub_data = event_data.split(",");
				for ( var i = 0, l = event_sub_data.length; i < l; i++ ) {
					candidate = event_sub_data[i];
					if(candidate!=null && candidate.includes("|")){
						candidate_data = candidate.split("|");						
						event_arr.push({
							title: candidate_data[0],
							start: candidate_data[1],
							end: candidate_data[2],
                            url: candidate_data[3]
                        });
					}
				}
			}

            $('#fullcalendar').fullCalendar({
                editable: false,
                height: 600,
                header: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
				navLinks: true,
				eventLimit: true,
                eventRender: function(event, element) {
                    $(element).tooltip({title: event.title,container: "body"});
                },
                events: event_arr,
				businessHours: {
					dow: [0, 1, 2, 3, 4, 5, 6],
					start: '09:00',
					end: '20:00',
				},
				defaultView: 'month',
				dayClick: function(date, jsEvent, view) {
					console.log(view.name);
					if (view.name === "month") {
						$('#fullcalendar').fullCalendar('gotoDate', date);
						$('#fullcalendar').fullCalendar('changeView', 'agendaDay');
					}
				}
			});
        });
    </script>
@endsection