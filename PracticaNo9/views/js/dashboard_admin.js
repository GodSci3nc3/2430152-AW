  window.addEventListener('load', function() {
    setTimeout(function() {
      const welcomeScreen = document.getElementById('welcome-message');
      const mainContent = document.getElementById('main-content');
      
      welcomeScreen.classList.add('move-up');
      
      setTimeout(function() {
        mainContent.classList.add('show');
        
    const linesGraph = document.getElementById('monthIncomes');
    const barGraph = document.getElementById('topSpecialty');

  // Preparar datos de ingresos mensuales
  const mesesMap = {
    '01': 'Enero', '02': 'Febrero', '03': 'Marzo', '04': 'Abril',
    '05': 'Mayo', '06': 'Junio', '07': 'Julio', '08': 'Agosto',
    '09': 'Septiembre', '10': 'Octubre', '11': 'Noviembre', '12': 'Diciembre'
  };

  // Crear array con los últimos 6 meses
  const hoy = new Date();
  const labelsIngresos = [];
  const dataIngresos = [];
  
  for (let i = 5; i >= 0; i--) {
    const fecha = new Date(hoy.getFullYear(), hoy.getMonth() - i, 1);
    const mesKey = String(fecha.getMonth() + 1).padStart(2, '0');
    const mesAno = `${fecha.getFullYear()}-${mesKey}`;
    
    labelsIngresos.push(mesesMap[mesKey]);
    
    // Buscar si hay datos para este mes
    const datoMes = ingresosMensuales.find(item => item.mes === mesAno);
    dataIngresos.push(datoMes ? parseFloat(datoMes.total) : 0);
  }

  // Preparar datos de ingresos por especialidad
  const labelsEspecialidades = ingresosPorEspecialidad.map(item => item.NombreEspecialidad);
  const dataEspecialidades = ingresosPorEspecialidad.map(item => parseFloat(item.totalIngresos));

  //Ingresos mensuales
new Chart(linesGraph, {
  type: 'line',
  data: {
    labels: labelsIngresos,
    datasets: [{
      label: 'Ingresos mensuales $',
      data: dataIngresos,
      borderColor: '#333',
      backgroundColor: 'rgba(51, 51, 51, 0.1)',
      borderWidth: 2,
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
      duration: 1500,
      easing: 'easeOutQuart'
    },
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

// Ingresos por especialidad: Esto para saber a dónde destinar recursos, qué especialidad aporta más, etc.
new Chart(barGraph, {
  type: 'bar',
  data: {
    labels: labelsEspecialidades,
    datasets: [{
      label: 'Ingresos $',
      data: dataEspecialidades,
      backgroundColor: '#333',
      borderColor: '#333',
      borderRadius: 4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
      duration: 1500,
      easing: 'easeOutBounce'
    },
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


      }, 300);
    }, 600);
  });

