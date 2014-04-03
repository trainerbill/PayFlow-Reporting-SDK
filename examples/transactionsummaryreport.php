<?php
include(__DIR__.'/../src/Reports/TransactionSummaryReport.php');
use PayFlowReportingSDK\TransactionSummaryReport\TransactionSummaryReport;


$config = array(
		'start_date' => '2014-04-02 00:00:00',  //YYYY-MM-DD HH:MM:SS.  Or anything that can be parsed by strtotime
		'end_date' => '2014-04-02 23:59:59',	//YYYY-MM-DD HH:MM:SS   Or anything that can be parsed by strtotime
		'pageSize' => 50,
);
$report = new TransactionSummaryReport($config);
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
