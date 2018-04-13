<?php
include 'session.php';
include 'header.html';

echo "
<style>
#plans{
	display:table;
	margin:24px auto 0;
	height:350px;
	}

#plans .plan{
    font-family:'Gudea', sans-serif;
	font-size:16px;float:left;
	height:260px;width:240px;
	line-height:36px;
	border-right:1px solid darkblue;
	border-top:1px solid darkblue;
	border-bottom:1px solid darkblue;
	padding:24px;
	margin-top:12px;
	margin-bottom:12px;
	text-align:center;
	}

#plans #border-left{
	border-left:1px solid darkblue;
    }

#plans .plan div{
	display:table;
	margin-left:auto;
	margin-right:auto;
	width:100%;
	text-align:center;
	}

#plans .name{
    font-family:'Gudea', sans-serif;
	font-size:24px;
	font-weight:bold;
	}

#plans .price{
	color:#81b836;
	font-weight:bold;
	border-bottom:1px solid #ccc
	}

#plans .sprite-button-signup{
	background:url(img/new_site.png) 0 -350px;
	width:130px;
	height:35px;
	margin:16px auto;
	}

#plans .plan:hover{
    font-family:'Gudea', sans-serif;
	font-size:16px;
	color:#333;
	border:3px solid darkblue;
	height:300px;
	width:260px;
	margin-top:0;
	margin-bottom:0;
    -webkit-box-shadow: 1px 1px 25px 7px rgba(122, 122, 22, .6);
    -moz-box-shadow: 1px 1px 25px 7px rgba(122, 122, 22, .6);
    box-shadow: 1px 1px 25px 7px rgba(122, 122, 22, .6); 
	-webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px; 
	}

#plans #border-left:hover{
	border-left:3px solid darkblue;
    }

#plans .plan:hover .name{
    font-family:'Gudea', sans-serif;
	font-size:30px;
	}

#plans .plan:hover .price{
    font-family:'Gudea', sans-serif;
	font-size:18px;
	}

#plans .plan:hover .sprite-button-signup{
	background:url(img/new_site.png) 0 -270px;
	width:160px;
	height:40px;
	display:block;text-indent:-9999px;
	}

#plans .plan:hover .sprite-button-signup:hover{
	background:url(img/new_site.png) 0 -310px;
	}

#signUp{
	padding-bottom:24px
    }

.sprite-button-signup{
	background:url(img/new_site.png) 0 -270px;
	width:160px;
	height:40px;display:block;text-indent:-9999px;
	}

.sprite-button-signup:hover{
	background:url(img/new_site.png) 0 -310px;
	}
</style>
<div style=\"text-align:center;\">

</div>
<div id=\"plans\" class=\"clearfix\">
            <div class=\"plan\" id=\"border-left\">
                <div class=\"name\">WORKFLOW</div>
				<div><hr></div>
                <div><a href=\"/bibeta/app/show_routes/show_routes_all.php\">ROUTES</a></div>
                <div><a href=\"/bibeta/app/contracts/contracts_all.php\">APPROVED DEALS & TERMS</a></div>
                <div><a href=\"/bibeta/app/settlements/settlements_all.php\">SETTLEMENTS</a></div>
            </div>

            <div class=\"plan\">
                <div class=\"name\">BUSINESS<BR>INTELLIGENCE</div>
				<div><hr></div>
                <div><a href=\"javascript:window.open('reports/market_analysis_by_show.php','Market Analysis','width=480,height=530')\">Market Analysis by Show</a></div>
                <div>Market Analysis by Category</div>
                <div>Custom Reports</div>
				<div>More Reports Coming Soon</div>
            </div>

            <div class=\"plan\">
                <div class=\"name\">MANAGEMENT</div>
				<div><hr></div>
                <div><a href=\"/bibeta/app/shows/shows_all.php\">SHOWS</a></div>
                <div><a href=\"/bibeta/app/presenters/presenters_all.php\">PRESENTERS</a></div>
                <div><a href=\"/bibeta/app/venues/venues_all.php\">VENUES</a></div>
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