<?php 
include_once "../loader.html";
include_once "../vars/main.php";
?>
<div id="loadbar"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../" onclick="doLoading()"><img src="../img/logo.png" alt="logo" align="left" style="max-height:38px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../<?php echo $link_header_main; ?>" onclick="doLoading()"><?php echo $text_header_link_main; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../<?php echo $link_header_search; ?>" onclick="doLoading()"><?php echo $text_header_link_search; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../<?php echo $link_header_devices; ?>" onclick="doLoading()"><?php echo $text_header_link_devices; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../<?php echo $link_header_stat; ?>" onclick="doLoading()"><?php echo $text_header_link_stat; ?></a>
            </li>
			<?php if($CUSTOM_LINK_1_ENABLE == TRUE){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../<?php echo $link_header_custom1; ?>" target="<?php echo $CUSTOM_LINK_1_URLMETHOD; ?>" )"><?php echo $text_header_link_custom1; ?></a>
				</li>
			<?php } ?>
			<?php if($CUSTOM_LINK_2_ENABLE == TRUE){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../<?php echo $link_header_custom2; ?>" target="<?php echo $CUSTOM_LINK_2_URLMETHOD; ?>"><?php echo $text_header_link_custom2; ?></a>
				</li>
			<?php }
				if(isset($_COOKIE['shux_user'])){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../<?php echo $link_header_add; ?>" onclick="doLoading()"><?php echo $text_header_link_add; ?></a>
				</li>
			<?php } ?>
        </ul>
        <ul class="navbar-nav">
			<?php 
			if(isset($_COOKIE['shux_user'])){ ?>
				<li class="nav-item">
					<a class="nav-link" href=""><b><?php echo $text_header_link_logged.$_COOKIE['shux_user']; ?></b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php" onclick="doLoading()"><?php echo $text_header_link_logout; ?></a>
				</li>
			<?php }else{?>
				<li class="nav-item">
					<a class="nav-link" href="login.php" onclick="doLoading()"><?php echo $text_header_link_login; ?></a>
				</li>
			<?php } ?>
        </ul>
    </div>
</nav>
