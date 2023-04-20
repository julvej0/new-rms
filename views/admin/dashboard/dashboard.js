// Nav Buttons

const navBtns = document.querySelectorAll('main .routes .nav-button');
const subpage = document.querySelectorAll('main .sub-page');

navBtns.forEach(navlinks => {
    navlinks.addEventListener('click', (e) => {
        e.preventDefault();
        navBtns.forEach(b => {
            b.classList.remove('focused');
        })
        subpage.forEach(page => {
            page.classList.remove('active');
        })

        const target = navlinks.dataset.target;
        document.querySelector(target).classList.add('active');

        navlinks.classList.toggle('focused')
    })
})

    document.querySelector('#pb-page').classList.add('active');
    document.querySelector('.nav-button[data-target="#pb-page"]').classList.add('focused');
    

// CHART
    var options = {
        series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
    }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
    }, {
        name: 'Free Cash Flow',
        data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
    }],
        chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    },
    yaxis: {
        title: {
        text: '$ (thousands)'
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
        formatter: function (val) {
            return "$ " + val + " thousands"
        }
        }
    }
    };

    var chart = new ApexCharts(document.querySelector("#pb-bar-chart"), options);
    chart.render();

    // $.ajax({
    //     url: './functionalities/data.php',
    //     type: 'GET',
    //     dataType: 'json',
    //     success: function(data) {
    //         // data contains the response from your PHP script
    //         // you can use it to render the chart
    //         var options = {
    //             chart: {
    //                 type: 'donut',
    //             },
    //             series: [{
    //                 name: 'Publications',
    //                 data: data.year_data
    //             }],
    //             xaxis: {
    //                 categories: data.year
    //             }
    //         };
    
    //         var chart = new ApexCharts(document.querySelector('#pb-pie-chart'), options);
    //         chart.render();
    //         console.log(data)
    //     }
      
    // });
    
    // Pie Chart
    var options = {
        series: [44, 55, 41, 17, 15],
        chart: {
        type: 'donut',
    },
    responsive: [{
        breakpoint: 480,
        options: {
        chart: {
            width: 200
        },
        legend: {
            position: 'bottom'
        }
        }
    }]
    };

    var chart = new ApexCharts(document.querySelector("#pb-pie-chart"), options);
    chart.render();

// IP-assets charts
    var options = {
        series: [
        {
        name: 'Actual',
        data: [
            {
            x: '2011',
            y: 1292,
            goals: [
                {
                name: 'Expected',
                value: 1400,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2012',
            y: 4432,
            goals: [
                {
                name: 'Expected',
                value: 5400,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2013',
            y: 5423,
            goals: [
                {
                name: 'Expected',
                value: 5200,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2014',
            y: 6653,
            goals: [
                {
                name: 'Expected',
                value: 6500,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2015',
            y: 8133,
            goals: [
                {
                name: 'Expected',
                value: 6600,
                strokeHeight: 13,
                strokeWidth: 0,
                strokeLineCap: 'round',
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2016',
            y: 7132,
            goals: [
                {
                name: 'Expected',
                value: 7500,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2017',
            y: 7332,
            goals: [
                {
                name: 'Expected',
                value: 8700,
                strokeHeight: 5,
                strokeColor: '#775DD0'
                }
            ]
            },
            {
            x: '2018',
            y: 6553,
            goals: [
                {
                name: 'Expected',
                value: 7300,
                strokeHeight: 2,
                strokeDashArray: 2,
                strokeColor: '#775DD0'
                }
            ]
            }
        ]
        }
    ],
        chart: {
        height: 350,
        type: 'bar'
    },
    plotOptions: {
        bar: {
        columnWidth: '60%'
        }
    },
    colors: ['#00E396'],
    dataLabels: {
        enabled: false
    },
    legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['Actual', 'Expected'],
        markers: {
        fillColors: ['#00E396', '#775DD0']
        }
    }
    };

    var chart = new ApexCharts(document.querySelector("#ipa-bar-chart"), options);
    chart.render();

    // IP-assets Pie Chart
    var options = {
          series: [44, 55, 41, 17, 15],
          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#ipa-pie-chart"), options);
        chart.render();