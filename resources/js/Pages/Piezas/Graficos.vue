<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
//import am5 from '@amcharts/amcharts5';
import * as am5xy from "@amcharts/amcharts5/xy";
import * as am5percent from "@amcharts/amcharts5/percent";
import * as am5themes_Animated from "@amcharts/amcharts5/themes/Animated";
import * as am5index from "@amcharts/amcharts5/index";
import * as am5 from "@amcharts/amcharts5/index";


/* Chart code */
// Set up data
let data = [{
  category: "Critical",
  value: 89,
  sliceSettings: {
    fill: am5.color(0xdc4534),
  },
  breakdown: [{
    category: "Sales inquiries",
    value: 29
  }, {
    category: "Support requests",
    value: 40
  }, {
    category: "Bug reports",
    value: 11
  }, {
    category: "Other",
    value: 9
  }]
}, {
  category: "Acceptable",
  value: 71,
  sliceSettings: {
    fill: am5.color(0xd7a700),
  },
  breakdown: [{
    category: "Sales inquiries",
    value: 22
  }, {
    category: "Support requests",
    value: 30
  }, {
    category: "Bug reports",
    value: 11
  }, {
    category: "Other",
    value: 10
  }]
}, {
  category: "Good",
  value: 120,
  sliceSettings: {
    fill: am5.color(0x68ad5c),
  },
  breakdown: [{
    category: "Sales inquiries",
    value: 60
  }, {
    category: "Support requests",
    value: 35
  }, {
    category: "Bug reports",
    value: 15
  }, {
    category: "Other",
    value: 10
  }]
}]

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
let root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create wrapper container
let container = root.container.children.push(am5.Container.new(root, {
  width: am5.p100,
  height: am5.p100,
  layout: root.horizontalLayout
}));


// ==============================================
// Column chart
// ==============================================

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
let columnChart = container.children.push(am5xy.XYChart.new(root, {
  width: am5.p50,
  panX: false,
  panY: false,
  wheelX: "none",
  wheelY: "none",
  layout: root.verticalLayout
}));

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
let yRenderer = am5xy.AxisRendererY.new(root, {});
let yAxis = columnChart.yAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: yRenderer
}));

yRenderer.grid.template.setAll({
  location: 1
})

let xAxis = columnChart.xAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererX.new(root, {
    strokeOpacity: 0.1
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
let columnSeries = columnChart.series.push(am5xy.ColumnSeries.new(root, {
  name: name,
  xAxis: xAxis,
  yAxis: yAxis,
  valueXField: "value",
  categoryYField: "category"
}));

columnSeries.columns.template.setAll({
  tooltipText: "{categoryY}: {valueX}"
});

//series.data.setAll(data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
columnChart.appear(1000, 100);


// ==============================================
// Column chart
// ==============================================

let pieChart = container.children.push(
  am5percent.PieChart.new(root, {
    width: am5.p50,
    innerRadius: am5.percent(50)
  })
);

// Create series
let pieSeries = pieChart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category"
  })
);

pieSeries.slices.template.setAll({
  templateField: "sliceSettings",
  strokeOpacity: 0
});

let currentSlice;
pieSeries.slices.template.on("active", function(active, slice) {
  if (currentSlice && currentSlice != slice && active) {
    currentSlice.set("active", false)
  }

  let color = slice.get("fill");

  label1.setAll({
    fill: color,
    text: root.numberFormatter.format(slice.dataItem.get("valuePercentTotal"), "#.'%'")
  });

  label2.set("text", slice.dataItem.get("category"));

  columnSeries.columns.template.setAll({
    fill: slice.get("fill"),
    stroke: slice.get("fill")
  });

  columnSeries.data.setAll(slice.dataItem.dataContext.breakdown);
  yAxis.data.setAll(slice.dataItem.dataContext.breakdown);

  currentSlice = slice;
});

pieSeries.labels.template.set("forceHidden", true);
pieSeries.ticks.template.set("forceHidden", true);

pieSeries.data.setAll(data);

// Add label
let label1 = pieChart.seriesContainer.children.push(am5.Label.new(root, {
  text: "",
  fontSize: 35,
  fontweight: "bold",
  centerX: am5.p50,
  centerY: am5.p50
}));

let label2 = pieChart.seriesContainer.children.push(am5.Label.new(root, {
  text: "",
  fontSize: 12,
  centerX: am5.p50,
  centerY: am5.p50,
  dy: 30
}));

// Pre-select first slice
pieSeries.events.on("datavalidated", function() {
  pieSeries.slices.getIndex(0).set("active", true);
});

</script>
<!-- Resources -->

<template>
    <Head title="Gráficos de Piezas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gráficos de Piezas</h2>
        </template>

        <div id="chartdiv" style="width: 100%; height: 500px;"></div>
    </AuthenticatedLayout>
</template>