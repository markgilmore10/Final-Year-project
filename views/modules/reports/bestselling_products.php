<div class="box box-default">

    <div class="box-header with-border">

        <h3 class="box-title">Browser Usage</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-card-widget="collapse">
            
                <i class="fa fa-minus"></i>
            
            </button>

            <button type="button" class="btn btn-box-tool" data-card-widget="remove">

                <i class="fa fa-times"></i>

            </button>
        </div>
    </div>


    <div class="box-body">

        <div class="row">

            <div class="col-md-8">

                <div class="chart-responsive">

                    <canvas id="pieChart" height="150"></canvas>

                </div>
       
            </div>
      
        <div class="col-md-4">
        
            <ul class="chart-legend clearfix">

                <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                <li><i class="fa fa-circle-o text-green"></i> IE</li>
                <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>

            </ul>

        </div>
       
    </div>
   
</div>

    <div class="box-footer no-padding">

        <ul class="nav nav-pills nav-stacked">

            <li>
            
            <a href="#">
                United States of America
                <span class="pull-right text-red">
                <i class="fa fa-angle-down"></i>
                12%</span>
            </a>
            </li>

            <li>
            <a href="#">
                India
                <span class="pull-right text-green">
                <i class="fa fa-angle-up"></i> 4%
                </span>
            </a>
            </li>

            <li>
            <a href="#">
                China
                <span class="pull-right text-yellow">
                <i class="fa fa-angle-left"></i> 0%
                </span>
            </a>
            </li>

        </ul>

    </div>

</div>

<script>
// -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

    {
      value    : 700,
      color    : '#f56954',
      highlight: '#f56954',
      label    : '#Chrome'
    }, 

    {
      value    : 500,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'IE'
    },

    {
      value    : 400,
      color    : '#f39c12',
      highlight: '#f39c12',
      label    : 'FireFox'
    },

    {
      value    : 600,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'Safari'
    },

    {
      value    : 300,
      color    : '#3c8bdc',
      highlight: '#3c8bdc',
      label    : 'Opera'
    },

    {
      value    : 100,
      color    : '#d2d6de',
      highlight: '#d2d6de',
      label    : 'Navigator'
    }

  
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------


</script>