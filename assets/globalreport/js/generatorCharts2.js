

function typeChart(data,typeChart,functionChart,descripcion,contador){ 


	switch(typeChart)
	{
		case 'barraChart' :
			barraChart(data,descripcion,contador);
			break;
		case 'pastelChart':
			pastelChart(data,descripcion,contador);
			break;
		case 'Pie with legend':
			columnRotatelabelChart(data,descripcion,contador);
			break;
		case 'Pie with monochrome fill':
			Piewithmonochromefill(data,descripcion,contador);
            break;
        case 'Spline with plot bands':
            Spline(data,descripcion,contador);
			break;
        case 'BasicLine':
            BasicLine(data,descripcion,contador);
            break;
        case 'SemiCircleDonut':
            SemiCircleDonut(data,descripcion,contador);
            break;
	}
}


function Piewithmonochromefill(data,descripcion,contador)
{
	var data_array = [];
   $.each(data, function(key, value)
   {
       var total_value = value.total;
       delete value.total;
       value.y = total_value;
       data_array.push(value);
   });
   
	$(function () {

    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    // Build the chart
    Highcharts.chart("container"+contador, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true,
            type: 'pie'
        },
        title: {
            text: descripcion
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'total',
            data:data
        }]
    });
  });
}

function columnRotatelabelChart(data,descripcion,contador)
{
	var data_array = [];

   $.each(data, function(key, value)
   {
       var total_value = value.total;
       delete value.total;
       value.y = total_value;
       data_array.push(value);
   });

	$(function () {
        $(document).ready(function () {
            // Build the chart
            Highcharts.chart("container"+contador, {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: true,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: descripcion
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'total',
                    colorByPoint: true,
                    data:data
                }]
            });
        });
    });
}

function barraChart(data,descripcion,contador)
{
 	var data_array = [];
        $.each(data, function(key, value)
        {
            var total_value = value.total;
            delete value.total;
            value.y = total_value;
            data_array.push(value);
        });

	$(function ()
	{
    	// Create the chart
        Highcharts.chart("container"+contador, {
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: descripcion
	        },
	        subtitle: {
	            text:descripcion
	        },
	        xAxis: {
	            type: 'category'
	        },
	        yAxis: {
	            title: {
	                text: 'Escala'
	            }

	        },
	        legend: {
	            enabled: false
	        },
	        plotOptions: {
	            series: {
	                borderWidth: 0,
	                dataLabels: {
	                    enabled: true,
	                    format: '{point.y:.1f}'
	                }
	            }
	        },

	        tooltip: {
	            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.1f}</b> of total<br/>'
	        },

	        series: [{
	            name: 'Data',
	            colorByPoint: true,
	            data:	 data           
	        }],	       
	    });
	});
}

function pastelChart(data,descripcion,contador)
{
	var data_array = [];

    $.each(data, function(key, value)
    {
       var total_value = value.total;
       delete value.total;
       value.y = total_value;
       data_array.push(value);
    });

	$(function () {
        Highcharts.chart("container"+contador, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true,
                type: 'pie'
            },
            title: {
                text: descripcion
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: false,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Total',
                colorByPoint: true,
                data: data
            }]
        });
    }); 
}

function Spline(data,descripcion,contador){
    var data_array = [];
    $.each(data, function(key, value)
    {
        var total_value = value.total;
        delete value.total;
        value.y = total_value;
        data_array.push(value);
    });

    $(function () {
        Highcharts.chart("container"+contador, {
            chart: {
            type: 'spline'
        },
        title: {
            text: descripcion
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            title: {
                text: descripcion
            },
            minorGridLineWidth: 3,
            gridLineWidth: 4,
            alternateGridColor: null,
            plotBands: [                          
                            
                        ]
        },
        tooltip: {
            valueSuffix: name
        },
        plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: "Total",
            data: data

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '20px'
            }
        }
        });
    });

}

function BasicLine(data,descripcion,contador){
    var data_array = [];
    var texto ="";
    var conta=0;
    $.each(data, function(key, value)
    {
        var total_value = value.total;
        delete value.total;
        value.y = total_value;
        data_array.push(value);
        texto += data[conta]['name']+"<br>";
        conta+=1;
    });

    $(function () {
        Highcharts.chart("container"+contador, {
            title: {
            text: descripcion,
            x: -20 //center
        },
        subtitle: {
            text: descripcion,
            x: -20
        },
        xAxis: {
            categories: [
                
            ]
        },
        yAxis: {

        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: data['total'] ,
            data: data
        }]
    });
    });
}


