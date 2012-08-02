<div class="container" id="main">
			<script type="text/javascript" src="js/app.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					listenToWorkersJob();
				});
			</script>
			<div class="row">
				<div class="span12">
					<div class="page-header">
					<h2>Jobs</h2>
					</div>
					
					<div class="row">
					<div class="span8">
						<h3>Lastest 4 minutes activities</h3>
						<div id="lastest-jobs"></div>
					</div>
					
					
					<div class="span4">
						
						
						<h4 class="sep">Total Stats</h4>
						
						<div class="row">
						<div class="chart-pie span1" data-success="<?php echo $stats['total']['processed'] - $stats['total']['failed']?>"
						data-failed="<?php echo $stats['total']['failed']?>"></div>
						<div class="span3">
						<dl class="dl-horizontal">
							<dt>Processed jobs</dt>
							<dd id="totalJobCount"><?php echo $stats['total']['processed']?></dd>
							<dt>Failed jobs</dt>
							<dd id="f_totalJobCount"><?php echo $stats['total']['failed']?></dd>
						</dl>
						</div>
					</div>
						
						<h4 class="sep">Active workers stats</h4>
						<div class="row">
						<div class="chart-pie span1" data-success="<?php
						    echo $stats['active']['processed'] - $stats['active']['failed']?>"
						data-failed="<?php echo $stats['active']['failed']?>"></div>
						<div class="span3">
							<dl class="dl-horizontal">
								<dt>Processed jobs</dt>
								<dd id="activeWorkersJobCount"><?php echo $stats['active']['processed']?></dd>
								<dt>Failed jobs</dt>
								<dd id="f_activeWorkersJobCount"><?php echo $stats['active']['failed']?></dd>
							</dl>
						</div>
						</div>
					</div>
					
					</div>
				</div>
				
				
				
			</div>
			<div class="row">
				<div class="span8">
				<div class="page-header">
				<h2>Workers <span class="badge badge-info"><?php echo count($workers)?></span></h2>
				</div>
				
				<?php
				if (!empty($workers)) {
				    $i=0;
				
				    foreach ($workers as $worker) {
    				    if ($i++%2==0 && $i !=0) {
    				        echo '<div class="row">';
    				    }
				
					    $workerId = str_replace('.', '', $worker['host']) . $worker['process'];
				    ?>
					<div class="span4">
						<div class="well">
						<h3># <?php echo $worker['process']; ?></h3>
						<dl class="dl-horizontal workers-menu">
							<dt>Host</dt>
							<dd><?php echo $worker['host']?></dd>
							<dt>Uptime</dt>
							<dd><?php echo ResqueBoard\Lib\DateHelper::ago($worker['start'])?></dd>
							<dt>Started on</dt>
							<dd><?php echo date_format($worker['start'], "r")?></dd>
							<dt>Process Jobs</dt>
							<dd id="s_<?php echo $workerId; ?>"><?php echo $worker['processed']?></dd>
							<dt>Failed Jobs</dt>
							<dd id="f_<?php echo $workerId; ?>"><?php echo $worker['failed']?></dd>
							<dt>Queues</dt>
							<dd><?php echo implode(', ', $worker['queues'])?></dd>
						</dl>
						</div>
					</div>
					<?php  if ($i%2==0 || $i == count($workers)) {
					    echo '</div>';
					}
					
				    }
				} ?>
				
				</div>
				
				<div class="span4">
					<div class="page-header">
					<h2>Queues <span class="badge badge-info"><?php echo count($queues)?></span></h2>
					</div>
					<?php if (!empty($queues)) {
					    echo '<table class="table table-condensed"><thead>'.
                             '<tr><th>Name</th><th>Worker count</th></tr></thead><tbody>';
					    foreach ($queues as $queue => $count) { ?>
						<tr>
							<td><?php echo $queue?></td>
							<td><?php echo $count?></td>
						</tr>
					<?php }
					echo '</tbody></table>';
				} ?>
				</div>
				
			</div>
		</div>