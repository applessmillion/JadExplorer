<?php
require_once '../vars/main.php';
?>
<html>
	<head>
		<title><?php echo $text_login_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body_account; ?>
		<div>
			<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
			<?php if(!isset($_COOKIE['shux_user'])){ ?>
				<tr>
					<td>
						<div class="text-center">
							<img src="../img/login.png" alt="Login_image" <?php echo $webpage_head_image_css; ?>>
							<h1>Sign In to SHUXplorer</h1>
							<?php ?>
						</div>
						<p class="mx-5">
							<?php if(isset($_GET['bad'])){echo $error_bad_cred;} ?>
							<?php echo $text_login_body_desc; ?>
							<form class="px-5 py-3" action="session.php" method="post">
							  <div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" placeholder="Enter Username" name="u">
								<small class="form-text text-muted ml-1">Usernames are not case-sensitive</small>
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" placeholder="Password" name="p">
								<small class="form-text text-muted ml-1">Passwords are case-sensitive</small>
							  </div>
							  <div class="form-check mb-4">
								<input type="checkbox" class="form-check-input" id="extend" name="extend">
								<label class="form-check-label" for="staylogin">Stay logged in</label>
							  </div>
							  <input type="submit" value="Log In" class="btn btn-primary">
							</form>
						</p>
						<?php echo $widget_webpage_border; ?>
					</td>
				</tr>
			<?php }elseif(isset($_COOKIE['shux_user'])){ ?>
				<tr>
					<td>
						<div class="text-center">
							<img src="../img/login.png" alt="Login_image" <?php echo $webpage_head_image_css; ?>>
							<h1><?php echo $error_already_logged_in; ?></h1>
							<?php echo $widget_webpage_border; ?>
						</div>
						<p class="mx-5">
							<?php echo $error_already_logged_in; ?>
						</p>
						<?php echo $widget_webpage_border; ?>
					</td>
			</tr>
			<?php }else{ echo "error";} ?>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
	<?php echo $widget_footer; ?>
</html> 