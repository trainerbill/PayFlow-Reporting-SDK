<script type="text/javascript">
    (function(d, s, id){
      var js, ref = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)){
        js = d.createElement(s); js.id = id; js.async = true;
        js.src = "//www.paypalobjects.com/js/external/paypal.js";
        ref.parentNode.insertBefore(js, ref);
      }
    }(document, "script", "paypal-js"));
</script>

<div class="row">
	<div class="col-md-12">
		<h3>Curl Call</h3>
		<pre>curl -i <?php echo $report->getCallEndpoint(); ?> -d '<?php echo htmlentities($report->getCallQuery()->asXML()) ?>' </pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Submitted String</h3>
		<pre><?php echo htmlentities($report->getCallQuery()->asXML()) ?></pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Return String</h3>
		<pre><?php echo htmlentities($report->getCallResponseDecoded()->asXML()) ?></pre>
	</div>
</div>