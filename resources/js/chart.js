document.addEventListener('DOMContentLoaded', () => {
    const reservationData = window.dashboardData?.reservationStatus || {};
    const financialData = window.dashboardData?.financials || {};

    const reservationCtx = document.getElementById('reservationStatusChart')?.getContext('2d');
    if (reservationCtx) {
        new Chart(reservationCtx, {
            type: 'bar',
            data: {
                labels: ['To Claim', 'To Return', 'Completed', 'Cancelled', 'Lost'],
                datasets: [{
                    label: 'Reservation Count',
                    data: [
                        reservationData.to_claim ?? 0,
                        reservationData.to_return ?? 0,
                        reservationData.completed ?? 0,
                        reservationData.cancelled ?? 0,
                        reservationData.lost ?? 0
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    const paymentsPenaltiesCtx = document.getElementById('penaltiesPaymentsChart')?.getContext('2d');
    if (paymentsPenaltiesCtx) {
        new Chart(paymentsPenaltiesCtx, {
            type: 'pie',
            data: {
                labels: ['Penalties', 'Payments'],
                datasets: [{
                    data: [
                        financialData.penalties ?? 0,
                        financialData.payments ?? 0
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.label + ': $' + context.raw.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        }
                    }
                }
            }
        });
    }
});
