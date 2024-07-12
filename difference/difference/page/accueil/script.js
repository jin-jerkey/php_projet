// Récupérer les données depuis PHP ou directement depuis la base de données
const enseignants = ["Paul", "Steve", "Papou"]; // Exemple de données
const assignations = [10, 5, 8]; // Exemple de données

// Créer le graphique avec Chart.js
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: enseignants,
        datasets: [{
            label: 'Nombre d\'assignations',
            data: assignations,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
