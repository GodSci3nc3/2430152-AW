const express = require('express');
const { Client } = require('pg');

const app = express();
const port = 3000;

/* Conexión a mi base de datos postgresql */
const client = new Client({
  user: 'postgres',
  host: 'localhost',
  database: 'estudiantes',
  password: 'ghp_883?',
  port: 5432,
});

client.connect();

app.use(express.static('vistas'));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

/* Página principal */
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/vistas/index.html');
});

/* Ruta para guardar un estudiante nuevo */
app.post('/guardar', async (req, res) => {
  const { nombre, calificacion } = req.body;

  try {
    const query = 'INSERT INTO estudiantes (nombre, calificacion) VALUES ($1, $2)';
    await client.query(query, [nombre, calificacion]);
    res.redirect('/');
  } catch (error) {
    console.error('Error al guardar el estudiante:', error);
    res.status(500).send('Error al guardar el estudiante');
  }
});

/* Ruta para mostrar la lista de estudiantes en orden de mayor a menor calificación */
app.get('/estudiantes', async (req, res) => {
  try {
    const query = 'SELECT * FROM estudiantes ORDER BY calificacion DESC';
    const result = await client.query(query);
    res.json(result.rows);
  } catch (error) {
    console.error('Error al obtener la lista de estudiantes:', error);
    res.status(500).send('Error al obtener la lista de estudiantes');
  }
});

app.listen(port, () => {
  console.log(`Ingresa aquí para gestionar las calificaciones: http://localhost:${port}`);
});

/* Calcula el promedio general de la clase */
app.get('/promedio', async (req, res) => {
  try {
    const query = 'SELECT AVG(calificacion) AS promedio FROM estudiantes';
    const result = await client.query(query);
    res.json(result.rows[0]);
  } catch (error) {
    console.error('Error al calcular el promedio:', error);
    res.status(500).send('Error al calcular el promedio');
  }
});



