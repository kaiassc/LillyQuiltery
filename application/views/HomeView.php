<?php /* @var Home_Controller $this */ ?>

<?php
	echo $this->userManager->getLoggedInUser()->getUsername();
?>