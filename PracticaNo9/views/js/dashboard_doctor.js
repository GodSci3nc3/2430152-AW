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
          initialView: 'dayGridWeek',
          events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
              url: '../../../app/models/Appointments/getAppointmentsCalendar.php',
              type: 'GET',
              success: function(data) {
                var events = JSON.parse(data).map(function(appointment) {
                  return {
                    title: appointment.PatientName + ' - ' + appointment.MotivoConsulta,
                    start: appointment.FechaCita,
                    backgroundColor: '#007bff',
                    borderColor: '#007bff'
                  };
                });
                successCallback(events);
              },
              error: function() {
                failureCallback();
              }
            });
          }
        });
        calendar.render();
      });