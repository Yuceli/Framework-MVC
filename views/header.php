<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/default.css">
	<script type="text/javascript" scr="<?php echo URL; ?>public/js/jquery.js"></script>
	<script type="text/javascript" scr="<?php echo URL; ?>public/js/custom.js"></script>	
	<?php 
		if(isset($this->js)){
			foreach ($this->js as $js) {
				 echo '<script type="text/javascript" scr="'.URL.'views/'.$js.'"></script>';
			}
          
		}
	?>	
</head>

<body>
    <?php Session::init(); ?>
	<div id="header">
		<br>
		<?php if(Session::get('loggedIn') == false) :?>
				<a href="<?php echo URL; ?>index">Index</a>
				<a href="<?php echo URL; ?>help">Help</a>
        <?php endif ?>	

		<?php if(Session::get('loggedIn') == true):?>
		        <a href="<?php echo URL; ?>dashboard">Dashboard</a>

        <?php if(Session::get('role') == 'owner'):?>
        <a href="<?php echo URL; ?>user">Users</a>
        <?php endif ?>	

         		<a href="<?php echo URL; ?>dashboard/logout">Logout</a>
		<?php else: ?>
		 		<a href="<?php echo URL; ?>login">Login</a>
		<?php endif ?>	
	</div>

	<div id="content">
	
