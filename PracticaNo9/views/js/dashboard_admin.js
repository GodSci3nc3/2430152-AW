  const linesGraph = document.getElementById('monthIncomes');
  const barGraph = document.getElementById('topSpecialty');

  //Ingresos mensuales
new Chart(linesGraph, {
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Junio', 'Julio'],
    datasets: [{
      label: 'Ingresos mensuales $',
      data: [12, 19, 3, 5, 2, 3],
      borderColor: '#333',
      backgroundColor: 'rgba(51, 51, 51, 0.1)',
      borderWidth: 2,
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      title: {
          display: true,
          text: 'Ingresos mensuales',
          color: '#2c2c2c', 
          font: {
            family: 'Inter',
            size: 16,
            weight: 600
          }
      },
      legend: {
        display: false
      }
    },
    scales: {
      x: {
        grid: {
          display: false
        },
        ticks: {
          color: '#333',
          font: {
            family: 'Inter, sans-serif'
          }
        }
      },
      y: {
        grid: {
          display: false
        },
        beginAtZero: true,
        ticks: {
          color: '#333',
          font: {
            family: 'Inter, sans-serif'
          }
        }
      }
    }
  }
});

// Ingresos por especialidad: Para saber a dónde destinar recursos, qué especialidad aporta más, etc.
new Chart(barGraph, {
  type: 'bar',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: '#333',
      borderColor: '#333',
      borderRadius: 4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      title: {
        text: 'Ingresos por especialidad',
        display: true,
        color: '#2c2c2c',
        font: {
          size: 16,
          weight: 600
        }
      },
      legend: {
        display: false
      }
    },
    scales: {
      x: {
        grid: {
          display: false
        },
        ticks: {
          color: '#333',
          font: {
            family: 'Inter, sans-serif',
            weight: 500
          }
        }
      },
      y: {
        grid: {
          display: false
        },
        beginAtZero: true,
        ticks: {
          color: '#333',
          font: {
            family: 'Inter, sans-serif'
          }
        }
      }
    }
  }
});

