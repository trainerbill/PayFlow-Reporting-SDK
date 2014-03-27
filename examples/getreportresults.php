<?php
include(__DIR__.'/../src/Reports/GetReportResults.php');
use PayFlowReportingSDK\GetReportResults;

if(!isset($_GET['reportid']))
	die('You must set report ID');

if(!isset($_GET['page']))
	die('You must set page number');

if(!isset($_GET['max']))
	die('You must set max number');

if($_GET['page'] > $_GET['max'])
	die('page cannot be greater than max.');

$config = array(
		'reportId' => $_GET['reportid'],
		'pageNum' => $_GET['page']
);
$report = new GetReportResults($config);
$report->executeCall();

include(__DIR__.'/inc/header.php');
include(__DIR__.'/inc/apicalloutput.php');

?>

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="getreportresults.php?reportid=<?php echo $_GET['reportid'] ?>&page=<?php echo ($_GET['page']+ 1)?>&max=<?php echo $_GET['max']?>">Get Next Results</a>
	</div>
</div>
<?php include(__DIR__.'/inc/footer.php');?>