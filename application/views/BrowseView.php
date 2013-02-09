<?php /* @var Browse_Controller $this */ ?>

<?= /*$this->render->advertisement(Render::AD_WIDE_SKYSCRAPER, array(
	'id' => 'leftWideSkyScraper',
	'class' => 'leftTile board'
)) */''?>

<div id="filters" class="mainTile board">
    <h5>Filters:</h5>

	<?= $this->render->browseFilterSelector($this->selectedFilterNames, array(
		'id' => 'filterSelector'
	)) ?>
	
	<?= $this->render->browseOrderBySelector($this->selectedOrderByName, array(
		'id' => 'orderBySelector'
	)) ?>
</div>
	
<div id="result" class="mainTile board">
    <div id="resultNav"></div>
	
    <div id="resultList" class="clearfix"><img id="loading" src="img/loading-squares.gif" width="43" height="11"/></div>
</div>





