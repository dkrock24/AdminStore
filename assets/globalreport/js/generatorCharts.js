


function typeChart(data,typeChart,functionChart,descripcion){
	switch(typeChart)
	{
		case 'barraChart' :
			barraChart(data,descripcion);
			break;
		case 'pastelChart':
			pastelChart(data,descripcion);
			break;
		case 'Pie with legend':
			columnRotatelabelChart(data,descripcion);
			break;
		case 'Pie with monochrome fill':
			Piewithmonochromefill(data,descripcion);
            break;
        case 'Spline with plot bands':
            Spline(data,descripcion);
			break;
        case 'BasicLine':
            BasicLine(data,descripcion);
            break;
        case 'SemiCircleDonut':
            SemiCircleDonut(data,descripcion);
            break;
        case 'doubleLine':
            doubleLine(data,descripcion,contador);
            break;
	}
}

function doubleLine(data,descripcion,contador){
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
                type: 'line'
            },
            title: {
                text: 'Monthly Average Temperature'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });

    });
  
}


function Piewithmonochromefill(data,descripcion)
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
    Highcharts.chart('vista_grafica', {
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

function columnRotatelabelChart(data,descripcion)
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
            Highcharts.chart('vista_grafica', {
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

function barraChart(data,descripcion)
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
        Highcharts.chart('vista_grafica', {
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

function pastelChart(data,descripcion)
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
        Highcharts.chart('vista_grafica', {
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

function Spline(data,descripcion){
    var data_array = [];
    $.each(data, function(key, value)
    {
        var total_value = value.total;
        delete value.total;
        value.y = total_value;
        data_array.push(value);
    });

    $(function () {
        Highcharts.chart('vista_grafica', {
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

function BasicLine(data,descripcion){
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
        Highcharts.chart('vista_grafica', {
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


