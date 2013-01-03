<?php /* @var Login_Controller $this */ ?>

<?= $this->render->advertisement(Render::AD_WIDE_SKYSCRAPER, array(
	'class' => 'leftTile'
))?>

<div id="mainContent" class="mainTile">
	<div id="register" class="board">
        <div>
            <h2>Register</h2>
            <form action="" method="post">
	            <input type="hidden" name="formType" value="register"/>
                <label for="registerUsername" class="required">Username</label><input id="registerUsername" type="text" name="username" value="<?=$this->input->post('username')?>"/>
                <label for="registerPassword" class="required">Password</label><input id="registerPassword" type="password" name="password" value="<?=$this->input->post('password')?>"/>
                <label for="registerPasswordVerify" class="required">VerifyPassword</label><input id="registerPasswordVerify" type="password" name="verifiedPassword" value=""/>
                <label for="registerEmail" class="required">Email</label><input id="registerEmail" type="text" name="email" value="<?=$this->input->post('email')?>"/>
                <label for="registerEmailVerify" class="required">VerifyEmail</label><input id="registerEmailVerify" type="text" name="verifiedEmail" value="<?=$this->input->post('verifiedEmail')?>"/>
                <button type="submit">Submit</button>
            </form>
	        
	        <?php
            if (isset($this->registerError)) {
	            echo $this->registerError->getDescription();
            }
	        ?>
        </div>
	</div>
	
	<div id="login" class="board">
		<div>
			<h2>Login</h2>
			<form action="" method="post">
                <input type="hidden" name="formType" value="login"/>
				<label for="loginUsername">Username</label><input id="loginUsername" type="text" name="username" value=""/>
                <label for="loginPassword">Password</label><input id="loginPassword" type="password" name="password" value=""/>
				<button type="submit">Submit</button>
			</form>

			<?php
			if (isset($this->loginError)) {
				echo $this->loginError->getDescription();
			}
			?>
        </div>
	</div>
</div>