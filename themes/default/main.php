<?php
# declare(strict_types=1);

/*******************************************************************
* WARNING!! this Glype fork version by guangrei or cirebon-dev.
* 
******************************************************************/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><!--[site_name]--></title>
    <meta name="description" content="<!--[meta_description]-->">
<meta name="keywords" content="<!--[meta_keywords]-->">
	<style type="text/css">
	/* TOOLTIP HOVER EFFECT */
	label {
		font-weight: bold;
		line-height: 20px;
		cursor: help;
	}
	#tooltip {
		width: 20em;
		color: #fff;
		font-size: 12px;
		font-weight: normal;
		padding: 5px;
		border: 3px solid #333;
		text-align: left;
		background-color: #555555;
	}
</style>
<?=injectionJS();?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
	window.addDomReadyFunc(function() {
		document.getElementById('options').style.display = 'none';
		document.getElementById('input').focus();
	});
	disableOverride();
</script>
</head>
<body>

  <div class="container">
      <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo GLYPE_URL."/index.php";?>">
      <img src="<?php echo GLYPE_URL.'/themes/default/logo.png'; ?>">
    </a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="https://github.com/cirebon-dev/Webproxy">
  <div style="position:relative">  
    <span class="icon"><i class="fa-brands fa-github"></i></span>
    <span>fork me on github</span>
  </div>
</a>
    </div>
  </div>
</nav>
    <section class="section">
      <!-- CONTENT START -->
      <!--[error]-->
      <!--[index_above_form]-->
      <form action="<?php echo GLYPE_URL."/includes/process.php?action=update";?>" method="post" onsubmit="return updateLocation(this);" class="box">
        <div class="field">
          <label for="input" class="label">URL</label>
          <div class="control">
            <input type="text" name="u" id="input" class="input" placeholder="https://www.google.com">
          </div>
        </div>
        <div class="field is-grouped">
          <div class="control">
            <input type="submit" value="Go" class="button is-primary">
          </div>
          <div class="control">
            [<a style="cursor:pointer;" onclick="document.getElementById('options').style.display=(document.getElementById('options').style.display=='none'?'':'none')" class="has-text-info">options</a>]
          </div>
        </div>
        <ul id="options" style="display: none;">
        	<?php foreach ($toShow as $option) echo '<li class="field is-grouped"> <div class="control"> <label for="encodeURL" class="checkbox"> <input type="checkbox" name="'.$option['name'].'" id="'.$option['name'].'"'.$option['checked'].'><label for="'.$option['name'].'" class="tooltip" onmouseover="tooltip(\''.$option['escaped_desc'].'\')" onmouseout="exit();"> '.$option['title'].'</label></li>';?>
        </ul>
      </form>
      <!--[index_below_form]-->
      <!-- CONTENT END -->
    </section>
    <section class="section">
    <nav class="level">
      <div class="level-left">
      	<a href="<?php echo GLYPE_URL."/index.php";?>" class="level-item">Home</a>
        <a href="<?php echo GLYPE_URL."/edit-browser.php";?>" class="level-item">Edit Browser</a>
        <a href="<?php echo GLYPE_URL."/cookies.php";?>" class="level-item">Manage Cookies</a>
      </div>
      <div class="level-right">
        <a href="<?php echo GLYPE_URL."/disclaimer.php";?>" class="level-item">Disclaimer</a>
      </div>
    </nav>
    </section>
    <footer class="footer">
      <div class="content has-text-centered">
        <p>Powered by <a href="http://www.glype.com/">Glype</a>&reg; <!--[version]-->.</p>
      </div>
    </footer>
  </div>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/8f86eb7a75.js" crossorigin="anonymous"></script>
</body>
</html>