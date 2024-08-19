document.addEventListener("DOMContentLoaded", function () {
    const labels = [
        "10",
        "11",
        "12",
        "13",
        "14",
        "15",
        "16",
        "17",
        "18",
        "19",
        "20",
    ];
    const alumniData = [14, 5, 10, 9, 6, 14, 15, 2, 45, 10];
    const perusahaanData = [8, 10, 15, 12, 8, 87, 9, 54, 7, 4];

    const options = {
        annotations: {
            position: "back",
        },
        series: [
            {
                name: "Alumni",
                data: alumniData,
            },
            {
                name: "Perusahaan",
                data: perusahaanData,
            },
        ],
        chart: {
            height: 350,
            type: "line",
            zoom: {
                enabled: false,
            },
        },
        colors: ["#5bc0de", "#5cb85c"],
        dataLabels: {
            enabled: false,
        },
        markers: {
            size: 0,
        },
        stroke: {
            curve: "straight",
        },
        grid: {
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
        },
        xaxis: {
            categories: labels,
        },
    };

    // Render chart bar
    const chartBar = new ApexCharts(document.querySelector("#chart"), options);
    chartBar.render();
});
// if (document.querySelector("#chart-line")) {
//   fetch('/admin/chart-data')
//       .then(response => response.json())
//       .then(data => {
//           var ctx1 = document.getElementById("chart-line").getContext("2d");

//           var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
//           gradientStroke1.addColorStop(1, "rgba(94, 114, 228, 0.2)");
//           gradientStroke1.addColorStop(0.2, "rgba(94, 114, 228, 0.0)");
//           gradientStroke1.addColorStop(0, "rgba(94, 114, 228, 0)");

//           new Chart(ctx1, {
//               type: "line",
//               data: data,
//               options: {
//                   responsive: true,
//                   maintainAspectRatio: false,
//                   plugins: {
//                       legend: {
//                           display: true,
//                       },
//                   },
//                   interaction: {
//                       intersect: true,
//                       mode: "index",
//                   },
//                   scales: {
//                       y: {
//                           grid: {
//                               drawBorder: true,
//                               display: true,
//                               drawOnChartArea: true,
//                               drawTicks: false,
//                               borderDash: [5, 5],
//                           },
//                           ticks: {
//                               display: true,
//                               padding: 10,
//                               color: "#fbfbfb",
//                               font: {
//                                   size: 11,
//                                   family: "Open Sans",
//                                   style: "normal",
//                                   lineHeight: 2,
//                               },
//                           },
//                       },
//                       x: {
//                           grid: {
//                               drawBorder: false,
//                               display: false,
//                               drawOnChartArea: false,
//                               drawTicks: false,
//                               borderDash: [5, 5],
//                           },
//                           ticks: {
//                               display: true,
//                               color: "#ccc",
//                               padding: 20,
//                               font: {
//                                   size: 11,
//                                   family: "Open Sans",
//                                   style: "normal",
//                                   lineHeight: 2,
//                               },
//                           },
//                       },
//                   },
//               },
//           });
//       });
// }
