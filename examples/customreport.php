<?php
include(__DIR__.'/../src/Reports/CustomReport.php');
use PayFlowReportingSDK\CustomReport\CustomReport;


$config = array(
		'templateName' => 'MyTestReport',
		'start_date' => '2014-03-01 00:00:00',
		'end_date' => '2014-03-24 23:59:59',
		'pageSize' => 50,
		'options' => array(
				'show_amount' => 'true'
		)
);
$report = new CustomReport($config);
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
