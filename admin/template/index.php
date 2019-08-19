<!doctype html>
<html lang="en">

<head>

<?php $dev_ver = time(); ?> 

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ) ?>/index.php.css?v=<?php echo $dev_ver; ?>">
	<title>Hello, world!</title> 
	<style>	
		#loading{
			position: absolute;
			background: rgba(255, 255, 255, 0.54);
			width: 100%;
			height: 100%;
			display: none;
			opacity: 1;
			background-image: url("<?php echo plugin_dir_url( __FILE__ ) ?>/assets/img/spinner.gif");
			background-repeat: no-repeat;
			background-position: center;
			z-index: 99999;
		}
	</style>
</head>

<body>
<div id="message"></div>
<div id="loading"></div>
<?php $get_post_data = get_post($ps_post_id);
			//var_dump($get_post_data);?>

	<div id="leftSidebar" class="sidebar-left">
		<div>When elements are copyable, they can't be sorted in their origin container</div>
		<div>Copying prevents original elements from being dragged. A copy gets created and <em>that</em> gets dragged instead</div>
		<div>Whenever that happens, a <code>cloned</code> event is raised</div>
		<div>Note that the clones get destroyed if they're not dropped into another container</div>
		<div>You'll be dragging a copy, so when they're dropped into another container you'll see the duplication.</div>
          
	</div>


    <div class="sidebar-top">
        <a class="xactive" href="#" title="Home"><i class="fa fa-home"></i></a>
        <a href="#" title="Undo"><i class="fa fa-undo"></i></a>
        <a href="#" title="Redo"><i class="fa fa-repeat"></i></a>
        <a href="#" target="_blank"><i class="fa fa-globe"></i></a>

		<a class="save-post" href="#"><i class="fa fa-floppy-o"></i></a>
		<a class="left-sidebar" href="#"><i class="fa fa-bars"></i></a>
        <a style="float:right" href="#"><i class="fa fa-trash"></i></a>
        <a class="para-bar" style="float:right" href="#"><i class="fa fa-level-down"></i></a>
	</div>


    <div class="sidebar-bottom">
        <a id="sidebar-bottom-icon-left-menu" class="xactive" href="#"><i class="fa fa-home"></i></a>
        <a id="sidebar-bottom-icon-visual-editor" href="#"><i class="fa fa-film"></i></a>
        <a id="sidebar-bottom-icon-html-editor" href="#"><i class="fa fa-code"></i></a>
        <a id="sidebar-bottom-icon-css-editor" href="#"><i class="fa fa-bullseye"></i></a>
        <a id="sidebar-bottom-icon-js-editor" class="xactive" href="#"><i class="fa fa-search"></i></a>
        <a id="sidebar-bottom-icon-right-menu" style="float:right" href="#"><i class="fa fa-trash"></i></a>
    </div>
    <div class="editor-container">
		<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
			<a id = "historyUndo" class="dropdown-item" href="#">Undo</a>
			<a id = "historyRedo" class="dropdown-item" href="#">Redo</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Cut</a>
			<a class="dropdown-item" href="#">Copy</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Paste (Append After)</a>
			<a class="dropdown-item disabled" href="#">Paste (Insert Before)</a>
			<a class="dropdown-item" href="#">Paste (Replace)</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Remove</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Edit (Visual)</a>
			<a class="dropdown-item" href="#">Edit (Code)</a>
		</div>
		<div id="main">
				<div class = "visual-editor" contenteditable>
					<div class="text-center">
						<h1 class="post-title"><?php echo $get_post_data->post_title ?></h1>
						<hr>
					</div>
					
					<!-- <h1 class="display-4"><?php // echo $get_post_data->post_title ?></h1> -->
					<div class="post-content" id="postContent">
					<?php echo $get_post_data->post_content ?>
					</div>
					
				</div>

	<!--
				<div class="container">
				<div class="card-deck mb-3 text-center">
					<div class="card mb-4 shadow-sm">
					<div class="card-header">
						<h4 class="my-0 font-weight-normal">Free</h4>
					</div>
					<div class="card-body">
						<h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
						<ul class="list-unstyled mt-3 mb-4">
						<li>10 users included</li>
						<li>2 GB of storage</li>
						<li>Email support</li>
						<li>Help center access</li>
						</ul>
						<button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
					</div>
					</div>
					<div class="card mb-4 shadow-sm">
					<div class="card-header">
						<h4 class="my-0 font-weight-normal">Pro</h4>
					</div>
					<div class="card-body">
						<h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
						<ul class="list-unstyled mt-3 mb-4">
						<li>20 users included</li>
						<li>10 GB of storage</li>
						<li>Priority email support</li>
						<li>Help center access</li>
						</ul>
						<button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
					</div>
					</div>
					<div class="card mb-4 shadow-sm">
					<div class="card-header">
						<h4 class="my-0 font-weight-normal">Enterprise</h4>
					</div>
					<div class="card-body">
						<h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
						<ul class="list-unstyled mt-3 mb-4">
						<li>30 users included</li>
						<li>15 GB of storage</li>
						<li>Phone and email support</li>
						<li>Help center access</li>
						</ul>
						<button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
					</div>
					</div>
				</div>
				</div>
	-->
				<!-- -->
			
			<div class = "html-editor">
				<textarea id="html-editor-form" class="form-control" rows="5">
					okk
				</textarea>
			</div>
			<div class = "css-editor">
				<p>css editor</p>
			</div>
			<div class = "js-editor">
				<p>js editor</p>
			</div>
		</div>
    </div>

    <!--
	<div class="editor-container" style = "height:1500px; border:1px solid red">
		Hello World!
	</div>
	-->
    <!-- Optional JavaScript ---------------------------------------------------------------------------------------------->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src = "<?php echo plugin_dir_url( __FILE__ ) ?>index.php.js?v=<?php echo $dev_ver; ?>" type="text/javascript"></script>

</body>

</html>

