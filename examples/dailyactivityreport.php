<?php
include(__DIR__.'/../src/Reports/DailyActivityReport.php');
use PayFlowReportingSDK\DailyActivityReport\DailyActivityReport;


$config = array(
		'report_date' => '2014-04-02',
		'pageSize' => 50,
);
$report = new DailyActivityReport($config);
$report->executeCall();

include(__DIR__.'/inc/header.php');
include(__DIR__.'/inc/apicalloutput.php');

?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="getreportmetadata.php?reportid=<?php echo $report->getCallResponseDecoded()->runReportResponse->reportId ?>">Get Report Metadata</a>
	</div>
</div>
<?php include(__DIR__.'/inc/footer.php');?>
