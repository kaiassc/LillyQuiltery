<?php /* @var Pack_Controller $this */ ?>
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

	<?php //$this->config->item('base_url') ?>
    <base href="/lq/"/>

    <link rel="stylesheet" href="css/page-<?=$this->pageName?>.combined.css">
</head>
	
<body>
	<!--[if lte IE 8]>
	    <p class="chromeframe">You are using an outdated browser.<a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
	<![endif]-->
	
	<div id="header">
		<div id="headerContainer" class="container tiled clearfix">
			<h1 id="title">Lilly Quiltery</h1>
			
			<div id="userMenu">
				<?php if ($this->userManager->isUserLoggedIn()): ?>
				<h5><?=$this->userManager->getLoggedInUser()->getUsername()?></h5>
				<div id="userMenuDropdown">
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
			<div id="logo" class="leftTile">
				<img src="img/mcc-logo.png" alt="Minecraft Customizer logo" width="134" height="130"/>
            </div>
			
	        <div id="nav" class="mainTile">
	            <ul>
	                <li id="navHome"<?=$this->pageName=='home'?' class="sel"':''?>><a href="">Home</a>
	                <li id="navLearn"<?=$this->pageName=='learn'?' class="sel"':''?>><a href="learn">Learn</a>
	                <li id="navPacks"<?=$this->pageName=='pack'?' class="sel"':''?>><a href="pack/62/jolicraft">Packs</a>
	                    <ul>
	                        <li><a href="">Super Home</a>
	                        <li><a href="">Gay Home</a>
	                        <li><a href="">Lovely Home</a>
	                    </ul>
	                <li id="navBrowse"<?=$this->pageName=='browse'?' class="sel"':''?>><a href="browse">Browse</a>
	                <li id="navForum"<?=$this->pageName=='forum'?' class="sel"':''?>><a href="forum">Forum</a>
	            </ul>
	        </div>
			
			
			<?= $this->render->advertisement(Render::AD_LEADERBOARD, array(
				'id' => 'topLeaderboard',
				'class' => 'mainTile board'
			))?>
		
		