<?php
include_once("../config/config.php");
include_once("../functions/cache.php"); 
include_once("../query/query_functions.php");

?>
<html>
	<head>
		<title>IATI Activity Viewer - <xsl:value-of select="title"/></title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>  	 
		<script type="text/javascript" src="/js/iati-query-builder.js"></script> 
		<script type="text/javascript" src="/js/jquery.unescape.js"></script> 
		<link media="screen" rel="stylesheet" href="activity/activity.css" />
		<link media="screen" rel="stylesheet" href="/css/iati-toolkit.css" />
		<style><!--
			div.launch-explorer {
				float:right;
				width:200px;
				height:50px;
				border: 2px solid #EA600A;
				padding:10px;
			}
			
			.count_of_text {
				display:none;
			}
			
			.count_limit_text {
				color:darkorange;
			}
		//--></style>

	</head>
	<body>
	<form id="query-builder">
			
<h1>Choose the data you want to explore</h1>	

<!--[if gt IE 6]>
<div class="ie-only">
	Note: The IATI Explorer is a prototype that has been tested with Firefox and Chrome browsers. There are reports of some versions of Internet Explorer having difficulty accessing the IATI Explorer. If you receive an error message when using Internet Explorer, please try an alternative web browser.
</div><![endif]-->


<div class="description">
	<div class="action url launch-explorer count_limit_grey">
		<span class="action url" id=""><a href="#" class="target" target="_parent"><?php echo $_GET['query'] ? "Update" : "Launch"; ?> Explorer</a></span>
		<span class="config">/explorer/?query=QUERY&desc=HUMAN</span>
		<div class="count-details">To explore up to <select name="howmany" class="howmany">
			<?php for($i=100;$i<1001;$i=$i+100) { 
				echo "<option value='$i'";
					if(($_GET['howmany'] ? $_GET['howmany'] : 500) == $i) { echo " SELECTED"; }
				echo ">$i</option>";
			}?>
			</select> 
			of <span class="query_count"></span> activities.</div>
	</div>	
	The IATI Explorer allows you to explore small sets of Aid Activities in depth. It loads your chosen set of activities into your web browser and provides faceted browsing tools to let you quickly dig-down into the data. Click more-details on any activity to get a full profile of it. 		
</div>

<div class="description">
	<b>Current query:</b> <span class="human_query"><?php echo ($_GET['query'] ? $_GET['desc'] : "Any project"); ?></span>
</div>

<div class="description count_limit">
	Your current query could fetch up to <span class="query_count"></span> activities. <span class="count_limit_text"><b>The IATI Explorer works best with fewer than <span class="count_limit_number">400</span> activities and will not display more than 1000 at a time. Please choose from the filter options below to narrow your selection.</b></span> <span class="count_ok_text">The smaller the number of activities to fetch, the more responsive the IATI explorer will be.</span> 
</div>

<?php if(!$_GET['query']) { ?>
<div class="description">
	Pick from the options below, and then click the 'Launch Explorer' button to look at these activities.

		<input name="query" id="query" type="hidden" size="50" value="//iati-activities"/>
	
		<div class="facet"><h4>Recipient Country</h4>
		<?php echo generateSelect("recipient-country/@code",1,"Country"); ?>
		</div>
		
		<div class="facet"><h4>Regional Projects</h4>
		<?php echo generateSelect("recipient-region/@code",1,"Region"); ?>
		</div>
		
		<div class="facet wide"><h4>Funding Organisation</h4>
		<?php echo generateSelect("participating-org/@ref",1,null,"participating-org[@role='Funding']"); ?>
		</div>
		
		<div class="facet wide"><h4>Sector Targetted</h4>
		<?php echo generateSelect("sector/@code",1,null,"sector"); ?>
		</div>
		
		<div class="facet"><h4>Activity Status</h4>
		<?php echo generateSelect("activity-status/@code",1,"ActivityStatus"); ?>
		</div>
		
		<div class="facet"><h4>Default flow type</h4>
		<?php echo generateSelect("default-flow-type/@code",1,"FlowType"); ?>
		</div>
		
		<div class="facet"><h4>Collaboration Type</h4>
		<?php echo generateSelect("collaboration-type/@code",1,"CollaborationType"); ?>
		</div>
		
		<div class="facet wide"><h4>Default Aid Type</h4>
		<?php echo generateSelect("default-aid-type/@code",1,"AidType"); ?>
		</div>
		
		<div class="facet wide"><h4>Default finance type</h4>
		<?php echo generateSelect("default-finance-type/@code",1,"FinanceType"); ?>
		</div>	

		<input type="reset" value="Reset query" class="reset-button">
		
</div>
<?php }  else {?>
	<div class="description">
		<p>
			<a href="query.php">Create new query.</a>
		</p>
		<br/>
		<p><small>(Sorry we can't let you edit your existing query just yet. We're working on it...)</small></p>
	</div>
<?php } ?>
</form>
</body>
</html>