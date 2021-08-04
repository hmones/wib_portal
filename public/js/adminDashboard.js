function renderChart(e){var t=getOptions(e,e.type);new ApexCharts(document.querySelector("#"+e.target),t).render()}function getOptions(e,t){switch(t){case"bar":return{title:{text:e.title,align:"center"},series:[{data:e.data,name:e.name}],chart:{type:"bar",height:350},plotOptions:{bar:{borderRadius:4,horizontal:!0}},colors:["#153e7a"],dataLabels:{enabled:!1},xaxis:{categories:e.labels}};case"donut":return{title:{text:e.title,align:"center",margin:0},series:e.data,chart:{type:"donut"},theme:{monochrome:{enabled:!0,color:"#557fbc",shadeTo:"dark",shadeIntensity:.65}},responsive:[{breakpoint:480,options:{chart:{width:200},legend:{position:"bottom",horizontalAlign:"left"}}}],labels:e.labels};case"area":return{chart:{id:e.target,type:"area",height:160,sparkline:{enabled:!0}},stroke:{curve:"straight"},fill:{opacity:1},series:[{name:e.name,data:e.data}],labels:e.labels,xaxis:{type:"string"},yaxis:{min:0},colors:["#153e7a"],title:{text:e.title,offsetX:0,style:{fontSize:"40px",cssClass:"apexcharts-yaxis-title"}},subtitle:{text:e.name,offsetX:0,offsetY:50,style:{fontSize:"20px",cssClass:"apexcharts-yaxis-title"}}};default:return{}}}"object"==typeof charts?charts.forEach(function(e){renderChart(e)}):console.log("Please define charts variable properly");