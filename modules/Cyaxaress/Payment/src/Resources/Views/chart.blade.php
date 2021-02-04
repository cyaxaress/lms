<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('container', {
        title: {
            text: 'نمودار فروش 30 روز گذشته'
        },
        tooltip: {
            useHTML: true,
            style: {
                fontSize: '20px',
                fontFamily: 'tahoma',
                direction: 'rtl',
            },
            formatter: function () {
                return (this.x ? "تاریخ: " +  this.x + "<br>" : "")  + "مبلغ: " + this.y
            }
        },
        xAxis: {
            categories: [@foreach($dates as $date => $value) '{{ getJalaliFromFormat($date) }}', @endforeach]
        },
        yAxis:{
            title: {
                text: "مبلغ"
            },
            labels: {
                formatter: function () {
                    return this.value + " تومان"
                }
            }
        },
        labels: {
            items: [{
                html: 'درامد 30 روز گذشته',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        series: [
            {
                type: 'column',
                name: 'درصد سایت',
                color: "green",
                data: [@foreach($dates as $date => $value) @if($day = $summery->where("date", $date)->first()) {{ $day->totalSiteShare }}, @else 0, @endif @endforeach]
            },
            {
                type: 'column',
                name: 'تراکنش موفق',
                data: [@foreach($dates as $date => $value) @if($day = $summery->where("date", $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach]
            },
            {
                type: 'column',
                name: 'درصد مدرس',
                color: "pink",
                data: [@foreach($dates as $date => $value) @if($day = $summery->where("date", $date)->first()) {{ $day->totalSellerShare }}, @else 0, @endif @endforeach]
            },{
                type: 'spline',
                name: 'فروش',
                data: [@foreach($dates as $date => $value) @if($day = $summery->where("date", $date)->first()) {{ $day->totalAmount }}, @else 0, @endif @endforeach],
                marker: {
                    lineWidth: 2,
                    lineColor: "green",
                    fillColor: 'white'
                },
                color: "green"
            },
            {
                type: 'pie',
                name: 'نسبت',
                data: [{
                    name: 'درصد سایت',
                    y: {{ $last30DaysBenefit }},
                    color: "green"
                }, {
                    name: 'درصد مدرس',
                    y: {{ $last30DaysSellerShare }},
                    color: "pink"
                },
                ],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }
        ],

    });

</script>
