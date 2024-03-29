<?php /* @var PageController $this */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=$this->title?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
	
	<?= getenv('HTTP_HOST') == 'localhost' ? '<base href="/lq/"/>' : '<base href="/"/>'; ?>
	
    <link rel="stylesheet" href="css/page-<?=$this->pageName?>.combined.css">
	<link rel="shortcut icon" href="favicon.ico">
</head>
	
<body>
	<!--[if lte IE 8]>
	    <p class="chromeframe">You are using an outdated browser.<a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
	<![endif]-->
	
	<div id="header">
		<div id="headerContainer" class="container tiled clearfix">
			<div id="logo"><a href=""><img src="img/lq-logo-07.png"></a></div>
			
	        <div id="nav" class="">
	            <ul>
		            <li id="navBrowse"<?=$this->pageName=='browse'?' class="sel"':''?>><a href="browse">Browse</a>
		            <!--li id="navLearn"<?=$this->pageName=='learn'?' class="sel"':''?>><a href="learn">Learn</a>
		            <li id="navContact"<?=$this->pageName=='contact'?' class="sel"':''?>><a href="contact">Contact</a-->
	            </ul>
	        </div>
			
			<div id="userMenu" class="board">
				<?php if ($this->userManager->isUserLoggedIn()): ?>
				<h5>Welcome, <?=$this->userManager->getLoggedInUser()->getUsername()?>!</h5>
				<div id="userMenuDropdown" class="board">
                    <ul>
                        <li><a href="<?=$this->format->userProfileURL($this->userManager->getLoggedInUser())?>">Profile</a>
	                    <?php
	                        $usersTexturePacks = $this->userManager->getLoggedInUser()->getTexturePacks();
	                        if (isset($usersTexturePacks)) {
		                        echo '<li>Packs<ul>';
		                        foreach ($usersTexturePacks as $userTexturePack) {
			                        $userTexturePackURL = $this->format->texturePackURL($userTexturePack);
			                        echo "<li><a href='{$userTexturePackURL}'>{$userTexturePack->getName()}</a>";
		                        }
		                        echo '</ul>';
	                        }
	                    ?>
	                    <li><a href="logout">Logout</a>
                    </ul>
				</div>
				<?php else: ?>
                <h5><a href="login">Login</a></h5>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div id="canvas">
		<div class="container tiled">
			<div id="topBar" class="mainTile board"></div>
		
		