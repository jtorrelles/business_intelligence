<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<script src=\"../js/jquery.are-you-sure.js\"></script>";

if(isset($_GET['selectedid'])){

    echo "<script>findDetailData(".$_GET['selectedid'].");</script>";
    echo "<div style=\"display:none\" id=\"datadetailroute\">";
    echo "<form action=\"market_analysis_modify_selected_results.php\" method=\"POST\">";
    echo "<table>";
    echo "<tr><td colspan=2><h2>ENGAGEMENT SNAPSHOT</h2><h3>PROFORMA: VENUE TAB</h3></td></tr>";
    //echo "<tr><td colspan=2><h3>PROFORMA: VENUE TAB</h3></td></tr>";
    echo "<tr><td colspan=2><p>A Market Analysis Has Already Been Done</p></td></tr>";
    echo "<tr>
        <td><b>Route Detail ID:</b></td>
        <td><input style=\"background-color: lightgrey;\" readonly type='text' name='detid' class=\"detid\"></td>
      </tr>"; 
    echo "<tr>
        <td><b>Gross Potential:</b></td>
        <td><input type='number' name='gross_pot' class=\"gross_pot\" value=0.0 step=0.01></td>
      </tr>";
    echo "<tr>
        <td><b>Sales - Percentage of Gross Potential:</b></td>
        <td><input type='number' name='spo_gross_pot' class=\"spo_gross_pot\" value=0.0 step=0.01></td>
      </tr>";  
    echo "<tr>
        <td><b>Subscription Ticket Sales:</b></td>
        <td><input type='number' name='subs_tsales' class=\"subs_tsales\" value=0.0 step=0.01></td>
      </tr>";  
    echo "<tr>
        <td><b>Group Ticket Sales:</b></td>
        <td><input type='number' name='group_tsales' class=\"group_tsales\" value=0.0 step=0.01></td>
      </tr>";  
    echo "<tr>
        <td><b>Single Ticket Sales:</b></td>
        <td><input type='number' name='single_tsales' class=\"single_tsales\" value=0.0 step=0.01></td>
      </tr>"; 
    echo "<tr>
        <td><b>Gross Sales:</b></td>
        <td><input type='number' name='gross_sales' class=\"gross_sales\" value=0.0 step=0.01></td>
      </tr>";
    echo "<tr>
        <td><b>Off The Top Expenses & Tax:</b></td>
        <td><input type='number' name='ott_expenses' class=\"ott_expenses\" value=0.0 step=0.01></td>
      </tr>";
    echo "<tr>
        <td><b>Nagbor:</b></td>
        <td><input type='number' name='nagbor' class=\"nagbor\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Promoter's Local Expenses:</b></td>
        <td><input type='number' name='pl_expenses' class=\"pl_expenses\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Total Engagement Expenses:</b></td>
        <td><input type='number' name='te_expenses' class=\"te_expenses\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Engagement Profit / Loss:</b></td>
        <td><input type='number' name='ep_loss' class=\"ep_loss\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Guarantee:</b></td>
        <td><input type='number' name='guarantee' class=\"guarantee\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Royalty %:</b></td>
        <td><input type='number' name='royalty_per' class=\"royalty_per\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Royalty $:</b></td>
        <td><input type='number' name='mroyalty' class=\"mroyalty\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Overage %:</b></td>
        <td><input type='number' name='overage_per' class=\"overage_per\" value=0.0 step=0.01></td>
    </tr>";
    echo "<tr>
        <td><b>Overage $:</b></td>
        <td><input type='number' name='overage' class=\"overage\" value=0.0 step=0.01></td>
    </tr>";
    echo "<input type='hidden' name='ind' value=0>";
    echo "</table>";
    echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
    echo "</form>";
  echo "</div>";  

}else {
  echo "failed";
}
echo "
<script>
  $(function() {
	  $('form').areYouSure( {message:\"Data will be lost if you close this window!\"} );
  });
</script>
";
$conn->close();
include '../footer.html';
?>