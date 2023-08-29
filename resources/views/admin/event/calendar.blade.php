@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendario de Eventos</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Eventos Disponibles</h4>
                            </div>
                            <div class="card-body">
                                <!-- the events -->
                                <div id="external-events">
                                    @foreach ($events as $event)
                                    @if($event->event_status == 'En Progreso')
                                    <div class="external-event bg-success">{{ $event->event_name }}</div>
                                    @else
                                    <div class="external-event bg-warning">{{ $event->event_name }}</div>
                                    @endif
                                    @endforeach
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            Quitar al arrastrar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script>
    var sites = {!! json_encode($events->toArray(), JSON_HEX_TAG) !!};
    $(function () {
  
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {
  
          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }
  
          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)
  
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex        : 1070,
            revert        : true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })
  
        })
      }
  
      ini_events($('#external-events div.external-event'))
  
      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()
  
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;
  
      var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');
  
      // initialize the external events
      // -----------------------------------------------------------------
  
      new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
          };
        }
      });
      
      var events = [];
      for(var i = 0; i < sites.length; i++) { 
            //fechas de inicio
            var date_start = sites[i].event_startdate;
            var year_start = date_start.substring(0, 4);
            var month_start = date_start.substring(7, 5);
            var day_start = date_start.substring(date_start.length - 2);
            //console.log(year_start, month_start, day_start);
            //fechas de final
            var date_end = sites[i].event_endate;
            var year_end = date_end.substring(0, 4);
            var month_end = date_end.substring(7, 5);
            var day_end = date_end.substring(date_end.length - 2);
            //horas de inicio
            var time_start = sites[i].event_starthour;
            var hour_start = time_start.substring(0,2);
            var minutes_start = time_start.substring(5,3);
            //console.log(hour_start, minutes_start);
            //horas final
            var time_end = sites[i].event_endhour;
            var hour_end = time_end.substring(0,2);
            var minutes_end = time_end.substring(5,3);
            //creating array events
            events.push({
                title          : sites[i].event_name,
                start          : new Date(year_start, month_start - 1, day_start, hour_start, minutes_start),
                end            : new Date(year_end, month_end - 1, day_end, hour_end, minutes_end),
                allDay         : false,
                backgroundColor: '#00c0ef', //Info (aqua)
                borderColor    : '#00c0ef' //Info (aqua)
            });
        }
      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events,
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });
  
      calendar.render();
      // $('#calendar').fullCalendar()
  
      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }
  
        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color'    : currColor,
          'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)
  
        // Add draggable funtionality
        ini_events(event)
  
        // Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>
@endsection