<?php /* @var Home_Controller $this */ ?>
	
	<div class="mainTile board">
		<div class="innerPadding">
	
<?php
	$user = $this->userManager->getLoggedInUser();
	
	if( $user ){
		echo $user->getUsername();
	} else {
		echo "AWOEFJAOIWEJFAOIWEJFAOIWEJF";
	}
?>
			<br/><br/><br/>
			<br/><br/><br/>
			<br/><br/><br/>
			<br/><br/><br/>
			<br/><br/><br/>
			<br/><br/><br/>
			<br/><br/><br/>
			hello
		</div>
	</div>
	
	