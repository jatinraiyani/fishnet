<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Agastyamarine fishing net">
	<meta name="author" content="Agastyamarine fishing net">
    <link rel="shortcut icon" href="{{URL::to('public/front/images/favicon.png')}}">
	<title>@yield('title')</title>	
	<link href="{{asset('public/admin/css/corporate.css')}}" rel="stylesheet">

    @yield('css')

</head>

<body>
	<div class="wrapper">
      @include('include.admin.sidebar')
    <div class="main">
      @include('include.admin.header')
    <main class="content"> 
      @yield('content')
    </main>     
      @include('include.admin.footer')
      </div>
	</div>  

    <script src="{{asset('public/admin/js/app.js')}}"></script>

<script>
    $(function() {
        $("#usa_map").vectorMap({
            map: "us_aea",
            backgroundColor: "transparent",
            zoomOnScroll: false,
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: false,
            regionStyle: {
                initial: {
                    fill: "#DCE3E8"
                }
            },
            markerStyle: {
                initial: {
                    "r": 9,
                    "fill": window.theme.info,
                    "fill-opacity": .9,
                    "stroke": "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": .4
                },
                hover: {
                    "stroke": "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            markers: [{
                latLng: [37.77, -122.41],
                name: "San Francisco: 375"
            }, {
                latLng: [40.71, -74.00],
                name: "New York: 350"
            }, {
                latLng: [39.09, -94.57],
                name: "Kansas City: 250"
            }, {
                latLng: [36.16, -115.13],
                name: "Las Vegas: 275"
            }, {
                latLng: [32.77, -96.79],
                name: "Dallas: 225"
            }]
        });
        setTimeout(function() {
            $(window).trigger('resize');
        }, 250)
    })

    $(function() {
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: [2015, 1465, 1487, 1796, 1387, 2123, 2866, 2548, 3902, 4938, 3917, 4927]
                }, {
                    label: "Orders",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.tertiary,
                    borderDash: [4, 4],
                    data: [928, 734, 626, 893, 921, 1202, 1396, 1232, 1524, 2102, 1506, 1887]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 500
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });

    $(function() {
        $("#datatables-dashboard-products").DataTable({
            pageLength: 6,
            lengthChange: false,
            bFilter: false,
            autoWidth: false
        });
    });

    $(function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79]
                }, {
                    label: "This year",
                    backgroundColor: "#E8EAED",
                    borderColor: "#E8EAED",
                    hoverBackgroundColor: "#E8EAED",
                    hoverBorderColor: "#E8EAED",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        barPercentage: .75,
                        categoryPercentage: .5,
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    });
</script>
@yield('js')

</body>
</html>