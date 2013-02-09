<?php /* @var Set_Controller $this */ ?>
	
	<div class="mainTile board">
		<div class="innerPadding clearfix">
			
			<div id="imageViewer" class="board">
				<div>
		            <?php
		            
		            $displayPaths = $this->resource->bundleDisplayImagePaths($this->bundle);
		            
		            if( !empty($displayPaths) ){
		                echo "<img src=\"$displayPaths[0]\"/>";
		            }
		            
		            ?>
                </div>
			</div>
			
			<div id="patternInfo">
                <div>
					<h1><?=$this->bundle->getName()?></h1>
					<span id="patternID">Item <?=$this->format->formatPatternID($this->bundle->getID())?></span><br/>
					<span id="patternPrice">$<?=$this->bundle->getPrice()?></span><br/>
					
					LillyQuiltery is still under construction and has not yet been linked to paypal. In the interim, you can purchase patterns by emailing me at lillyquiltery@hotmail.com
                </div>
			</div>
			
			<div>
				When you buy this set, you gain access to these patterns:
				<div>
					<?php
					
					
					?>
                </div>
			</div>
		</div>
	</div>
	
	