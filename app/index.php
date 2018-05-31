<?php
include 'session.php';
include 'header.html';
$description = "Access to system / Index view";
include 'security_log.php';
$profile = $_SESSION['user_profile'];
echo "
<head>
	<script>
		function validateProfile () {
			if ('$profile' === 'report') {
				document.getElementById('report').style.display = 'block';
				document.getElementById('business').style.display = 'none';
				document.getElementById('admin').style.display = 'none';
			} else {
				if ('$profile' === 'business') {
					document.getElementById('report').style.display = 'none';
					document.getElementById('business').style.display = 'block';
					document.getElementById('admin').style.display = 'none';
				} else {
					if ('$profile' === 'admin') {
						document.getElementById('report').style.display = 'none';
						document.getElementById('business').style.display = 'none';
						document.getElementById('admin').style.display = 'block';
					}
				}
			}		
		}
	</script>
</head>
";

echo "<style type='text/css' media='all'>@import 'css/style.css';</style>
<body onload='validateProfile()'>

<div style=\"text-align:center;\">
</div>

<div id='admin'>
<div id=\"plans\" class=\"clearfix\">
    <div class=\"plan\" id=\"border-left\">
        <div class=\"name\">WORKFLOW</div>
		<div><hr></div>
        <div><a href=\"../app/show_routes/show_routes_all.php\">ROUTES</a></div>
        <div><a href=\"../app/contracts/contracts_all.php\">APPROVED DEALS & TERMS</a></div>
        <div><a href=\"../app/settlements/settlements_all.php\">SETTLEMENTS</a></div>
    </div>

    <div class=\"plan\">
        <div class=\"name\">BUSINESS<BR>INTELLIGENCE</div>
		<div><hr></div>
        <div><a href=\"../app/reports/all_routes_view.php\">ROUTING SIDE BY SIDE</a></div>
        <div><a href=\"../app/reports/route_conflicts_view.php\">ROUTE CONFLICTS</a></div>
        <div><a href=\"../app/reports/market_history_view.php\">MARKET HISTORY</a></div>
        <div><a href=\"../app/reports/sales_sumary_view.php\">SALES SUMMARY</a></div>
		<div><a href=\"#\">BREAKEVEN ANALYSIS</a></div>
		<div><a href=\"#\">PLAYED MARKETS</a></div>
    </div>

    <div class=\"plan\">
        <div class=\"name\">MANAGEMENT</div>
		<div><hr></div>
        <div><a href=\"../app/shows/shows_all.php\">SHOWS</a></div>
        <div><a href=\"../app/presenters/presenters_all.php\">PRESENTERS</a></div>
        <div><a href=\"../app/venues/venues_all.php\">VENUES</a></div>
		<div><a href=\"../app/users/security_management.php\">ADMINISTRATION</a></div>		
    </div>
</div>
</div>

<div id='business'>
<div id=\"plans\" class=\"clearfix\">
    <div class=\"plan\" id=\"border-left\">
        <div class=\"name\">WORKFLOW</div>
		<div><hr></div>
        <div><a href=\"../app/show_routes/show_routes_all.php\">ROUTES</a></div>
        <div><a href=\"../app/contracts/contracts_all.php\">APPROVED DEALS & TERMS</a></div>
        <div><a href=\"../app/settlements/settlements_all.php\">SETTLEMENTS</a></div>
    </div>

    <div class=\"plan\">
        <div class=\"name\">BUSINESS<BR>INTELLIGENCE</div>
		<div><hr></div>
        <div><a href=\"../app/reports/all_routes_view.php\">ROUTING SIDE BY SIDE</a></div>
        <div><a href=\"../app/reports/route_conflicts_view.php\">ROUTE CONFLICTS</a></div>
        <div><a href=\"../app/reports/market_history_view.php\">MARKET HISTORY</a></div>
        <div><a href=\"../app/reports/sales_sumary_view.php\">SALES SUMMARY</a></div>
		<div><a href=\"#\">BREAKEVEN ANALYSIS</a></div>
		<div><a href=\"#\">PLAYED MARKETS</a></div>
    </div>

    <div class=\"plan\">
        <div class=\"name\">MANAGEMENT</div>
		<div><hr></div>
        <div><a href=\"../app/shows/shows_all.php\">SHOWS</a></div>
        <div><a href=\"../app/presenters/presenters_all.php\">PRESENTERS</a></div>
        <div><a href=\"../app/venues/venues_all.php\">VENUES</a></div>
    </div>
</div>
</div>

<div id='report'>
<div id=\"plans\" class=\"clearfix\">
    <div class=\"plan\" id=\"border-left\">
        <div class=\"name\">BUSINESS<BR>INTELLIGENCE</div>
		<div><hr></div>
        <div><a href=\"../app/reports/all_routes_view.php\">ROUTING SIDE BY SIDE</a></div>
        <div><a href=\"../app/reports/route_conflicts_view.php\">ROUTE CONFLICTS</a></div>
        <div><a href=\"../app/reports/market_history_view.php\">MARKET HISTORY</a></div>
        <div><a href=\"../app/reports/sales_sumary_view.php\">SALES SUMMARY</a></div>
		<div><a href=\"#\">BREAKEVEN ANALYSIS</a></div>
		<div><a href=\"#\">PLAYED MARKETS</a></div>
    </div>
</div>
</div>

</body>
";

include 'footer.html';
?>
