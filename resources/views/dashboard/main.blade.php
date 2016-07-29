@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v">Dashboard</h3>
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox animated fadeInUp">
        <section class="scrollable w-f padder-v padder">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                @php 
                  $alerts = [
                    '0' => 'alert-success',
                    '1' => 'alert-info',
                    '2' => 'alert-danger'
                  ];
                @endphp
                @foreach($tasks as $row)  
                  <div class="alert {{ $alerts[$row->priority]  }} alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4><i class="fa fa-bell-alt"></i>{{ $row->title }}</h4>
                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->date)->toDayDateTimeString() }}</p>
                    <br>
                    <p>{{ $row->description }}</p>
                  </div>
                @endforeach

                </div>
                <div class="col-md-4 col-lg-4">
                    @include('.dashboard.users')
                </div>
            </div>
        </section>
    </section>
</section>
@endsection

@section('js')
<!-- Flot -->
<script src="/vendor/charts/flot/jquery.flot.min.js"></script>
<script src="/vendor/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="/vendor/charts/flot/jquery.flot.resize.js"></script>
<script src="/vendor/charts/flot/jquery.flot.orderBars.js"></script>
<script src="/vendor/charts/flot/jquery.flot.pie.min.js"></script>
<script src="/vendor/charts/flot/jquery.flot.grow.js"></script>
<script type="text/javascript">
$(function(){

  //
  var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var d1 = [];
  for (var i = 0; i <= 11; i += 1) {
    d1.push([i, parseInt((Math.floor(Math.random() * (1 + 20 - 10))) + 10)]);
  }

  $("#flot-1ine").length && $.plot($("#flot-1ine"), [{
          data: d1
      }],
      {
        series: {
            lines: {
                show: true,
                lineWidth: 1,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.3
                    }, {
                        opacity: 0.3
                    }]
                }
            },
            points: {
                radius: 3,
                show: true
            },
            grow: {
              active: true,
              steps: 20,
              growings:[
                  {
                      stepDirection: "down"
                  }
              ]
            },
            shadowSize: 2
        },
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: "#f0f0f0",
            borderWidth: 1,
            color: '#f0f0f0'
        },
        colors: ["#1bb399"],
        xaxis:{
        },
        yaxis: {
          ticks: 5
        },
        tooltip: true,
        tooltipOpts: {
          content: "chart: %x.1 is %y.4",
          defaultTheme: false,
          shifts: {
            x: 0,
            y: 20
          }
        }
      }
  );


});
</script>
@endsection
