document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        if (document.getElementById("texto1").value.trim() === "") {
        } else {

            const numeros = document.getElementById("texto1").value.split(",").map(Number);
            const maximo = Math.max(...numeros);
            const minimo = Math.min(...numeros);


            document.getElementById("texto1").value = "";
            document.getElementById("resultados").innerText = "El número máximo es: " + maximo + " y el número mínimo es: " + minimo;
        
        }

        if (document.getElementById("texto2").value.trim() === "") {
        } else {

            const numeros = document.getElementById("texto2").value.split(",").map(Number);
            const numerosUnicos = [...new Set(numeros)];

            document.getElementById("texto2").value = "";
            document.getElementById("resultados2").innerText = "Números y sin duplicados: " + numerosUnicos.join(", ");
        }
    });
});
