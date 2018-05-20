<?php
include 'session.php';
include 'header.html';

echo "<style type='text/css' media='all'>@import 'css/style.css';</style>

<div style=\"text-align:center;\">
</div>
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
        <div><a href=\"../app/reports/all_routes_view.php\">ALL ROUTES</a></div>
        <div><a href=\"../app/reports/route_conflicts_view.php\">ROUTES CONFLICTS</a></div>
        <div><a href=\"../app/reports/market_history_view.php\">MARKET HISTORY</a></div>
        <div><a href=\"../app/reports/sales_sumary_view.php\">SALES SUMMARY</a></div>
		<div>ANOTHER REPORTS</div>
    </div>

    <div class=\"plan\">
        <div class=\"name\">MANAGEMENT</div>
		<div><hr></div>
        <div><a href=\"../app/shows/shows_all.php\">SHOWS</a></div>
        <div><a href=\"../app/presenters/presenters_all.php\">PRESENTERS</a></div>
        <div><a href=\"../app/venues/venues_all.php\">VENUES</a></div>
    </div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-10146041-24', 'auto');
  ga('send', 'pageview');
</script>
";

include 'footer.html';
?>