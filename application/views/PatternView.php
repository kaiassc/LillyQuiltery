<?php /* @var Pattern_Controller $this */ ?>
	
	<div class="mainTile board">
		<div class="innerPadding clearfix">
			
			<div id="imageViewer" class="board">
				<div>
		            <?php
		            
		            $displayPaths = $this->resource->patternDisplayImagePaths($this->pattern);
		            
		            if( !empty($displayPaths) ){
		                echo "<img src=\"$displayPaths[0]\"/>";
		            }
		            
		            ?>
                </div>
			</div>
			
			<div id="patternInfo">
                <div>
					<h1><?=$this->pattern->getName()?></h1>
					<span id="patternID">Item <?=$this->format->formatPatternID($this->pattern->getID())?></span><br/>
					<span id="patternPrice">$<?=$this->pattern->getPrice()?></span><br/>
					
					LillyQuiltery is still under construction and has not yet been linked to paypal. Until then, you can purchase patterns by emailing Jill at lillyquiltery@hotmail.com
	                
	                <br/><br/><br/><br/>

	                <?php if (count($this->pattern->getBundles()) > 0): ?>
                    This pattern is part of the:
                    <ul>
		                <?php
		                /** @var \Entity\Bundle $bundle */
		                foreach ($this->pattern->getBundles() as $bundle) {
			                echo "<li><a href='{$this->format->bundleURL($bundle)}'>{$bundle->getName()}</a>";
		                }
		                ?>
                    </ul>
	                <?php endif; ?>
	                
                </div>
			</div>
			

			
		</div>
	</div>
	
	