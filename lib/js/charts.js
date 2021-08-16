function chartData(weightData) {
  let serData = [],
    categories = [];
  weightData.sort(function (a, b) {
    return new Date(a.ts) - new Date(b.ts);
  });
  weightData.forEach((w) => {
    serData.push(Number(w.weight));
    const wt = w.ts.split(" ");
    categories.push(`${wt[0]}T${wt[1]}`);
  });
  // Area chart
  var options = {
    chart: {
      height: 350,
      type: "area",
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
    },
    series: [
      {
        name: "weight",
        data: serData,
      },
    ],
    xaxis: {
      type: "datetime",
      categories: categories,
    },
    tooltip: {
      x: {
        format: "dd/MM/yy HH:mm",
      },
    },
  };
  document.querySelector("#apexcharts-area").innerHTML = "";
  var chart = new ApexCharts(
    document.querySelector("#apexcharts-area"),
    options
  );
  chart.render();
}
