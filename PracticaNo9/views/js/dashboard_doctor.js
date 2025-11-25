document.addEventListener('DOMContentLoaded', function() {

        setTimeout(function() {
          const welcomeScreen = document.getElementById('welcome-message');
          const mainContent = document.getElementById('main-content');
      
      welcomeScreen.classList.add('move-up');

          setTimeout(function() {
            mainContent.classList.add('show');

          }, 300)
      
        }, 600);


        var calendarEl = document.getElementById('agenda');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridWeek'
        });
        calendar.render();
      });