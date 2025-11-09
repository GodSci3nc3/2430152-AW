document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('agenda');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridWeek'
        });
        calendar.render();
      });