<?php /* @var Set_Controller $this */ ?>
	
	<div class="mainTile board">
		<div class="innerPadding clearfix">
			<div style="display:block;" class="clearfix">
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
						
						LillyQuiltery is still under construction and has not yet been linked to paypal. Until then, you can purchase patterns and sets by emailing Jill at lillyquiltery@hotmail.com
	                </div>
				</div>
            </div>
			
			<div id="subpatternsWrap" class="clearfix">
				<p>When you buy this set, you gain access to these patterns:</p>
				<div class="clearfix">
					<?php
					/* @var \Entity\Pattern $pattern */
					foreach ($this->bundle->getPatterns() as $pattern) {
						echo 
						'<div class="pItem_container">
							<div class="pItem_wrap">
								<a href="'.$this->format->patternURL($pattern).'">
									<div class="pItem_imgwrap">
										<div class="pItem_valign">
										<img src="'.$this->resource->patternBrowsableImagePath($pattern).'" width="170px" />
										</div>
									</div>
								</a>
								<div class="pItem_info">
									<div class="pItem_name">
										<a href="'.$this->format->patternURL($pattern).'">
										'.$pattern->getName().'
										</a>
									</div> 
								$'.$pattern->getPrice().'
								</div>
							</div>
						</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
	
	