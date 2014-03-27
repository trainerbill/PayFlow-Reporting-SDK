<?php
include(__DIR__.'/../src/Reports/GetReportMetaData.php');
use PayFlowReportingSDK\GetReportMetaData;

if(!isset($_GET['reportid']))
	die('You must set report ID');

$config = array(
		'reportId' => $_GET['reportid'],
);
$report = new GetReportMetaData($config);
$report->executeCall();

include(__DIR__.'/inc/header.php');
include(__DIR__.'/inc/apicalloutput.php');

?>
<div class="row well well-sm ">
	<div class="col-md-12">
		<h3>Next Steps</h3>
		Now you have to execute the get data request for every page that was returned in numberOfPages result
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="getreportresults.php?reportid=<?php echo $_GET['reportid'] ?>&page=1&max=<?php echo $report->getCallResponseDecoded()->getMetaDataResponse->numberOfPages?>">Get Results</a>
	</div>
</div>
<?php include(__DIR__.'/inc/footer.php');?>