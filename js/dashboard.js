google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(chart1);
google.charts.setOnLoadCallback(chart2);
google.charts.setOnLoadCallback(chart3);

/* Chamada para montagem do Gráfico 1 */
function chart1() {

    $.ajax({
        url: 'api/dashboard/chart1',
        success: function (data) {

            var txt = json2array(data);

            var data = google.visualization.arrayToDataTable(txt);

            var options = {
                hAxis: {title: 'Estado', },
                vAxis: {title: 'Quantidade'},
                height: 200,
                chartArea: {'width': '80%', 'height': '90%'},
                legend: {position: 'none'},
                colors: ['#836FFF'],
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart1_div'));
            chart.draw(data, options);
        }
    });
}

/* Chamada para montagem do Gráfico 2 */
function chart2() {

    $.ajax({
        url: 'api/dashboard/chart2',
        success: function (data) {

            var txt = json2array(data);

            var data = google.visualization.arrayToDataTable(txt);

            var options = {
                hAxis: {title: 'Quantidade'},
                vAxis: {title: 'Cidade'},
                height: 200,
                chartArea: {'width': '70%', 'height': '90%'},
                legend: {position: 'none'},
                colors: ['#836FFF'],
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart2_div'));
            chart.draw(data, options);
        }
    });
}

/* Chamada para montagem do Gráfico 3 */
function chart3() {

    $.ajax({
        url: 'api/dashboard/chart3',
        success: function (data) {

            var txt = json2array(data);

            var data = google.visualization.arrayToDataTable(txt);

            var options = {
                hAxis: {title: 'Quantidade'},
                vAxis: {title: 'Cidade'},
                pieSliceText: 'value',
                height: 300,
                chartArea: {'width': '90%', 'height': '90%'},
                colors: ['#6A5ACD', '#836FFF', '#6959CD', '#483D8B', '#191970', '#6495ED', '#4169E1', '#1E90FF', '#00BFFF', '#87CEFA'],
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart3_div'));
            chart.draw(data, options);
        }
    });
}

/* tratamento do JSON para Array utilizado nos gráficos */
function json2array(json_data) {
    var result = [];
    for (var i in json_data)
        result.push([i, json_data[i]]);

    return result;
}