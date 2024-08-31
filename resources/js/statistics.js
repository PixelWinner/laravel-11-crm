const ordersByStatusData = {
    labels: JSON.parse(document.getElementById('ordersByStatusData').dataset.labels),
    datasets: [{
        label: 'Количество заказов',
        data: JSON.parse(document.getElementById('ordersByStatusData').dataset.data),
        backgroundColor: ['#4caf50', '#f44336', '#ff9800', '#2196f3'],
        borderColor: '#ffffff',
        borderWidth: 1
    }]
};

const ordersByStatusConfig = {
    type: 'pie',
    data: ordersByStatusData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Количество заказов по статусу (' + document.getElementById('ordersByStatusData').dataset.year + ')'
            }
        }
    },
};

const ordersByStatusChart = new Chart(
    document.getElementById('ordersByStatusChart'),
    ordersByStatusConfig
);

const ordersByMonthData = {
    labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    datasets: [{
        label: 'Количество заказов',
        data: JSON.parse(document.getElementById('ordersByMonthData').dataset.data),
        backgroundColor: '#2196f3',
        borderColor: '#ffffff',
        borderWidth: 1
    }]
};

const ordersByMonthConfig = {
    type: 'bar',
    data: ordersByMonthData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Количество заказов по месяцам (' + document.getElementById('ordersByMonthData').dataset.year + ')'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
};

const ordersByMonthChart = new Chart(
    document.getElementById('ordersByMonthChart'),
    ordersByMonthConfig
);
