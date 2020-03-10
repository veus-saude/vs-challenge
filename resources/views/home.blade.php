@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-4 mt-4">
            <div class="card">
                <div class="card-header bg-info text-white"><i class="fa fa-archive"></i> Produtos</div>

                <div class="card-body">
                    <div class="font-weight-bold">Total: {{ $products }}</div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8 mb-4">
            <canvas id="productsChart"></canvas>
        </div>        
    </div>
</div>

<script>
    var ctx = document.getElementById('productsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= $chartData->months; ?>],
            datasets: [{
                label: 'Aquisição de Produtos',
                data: [<?= $chartData->totals; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection
