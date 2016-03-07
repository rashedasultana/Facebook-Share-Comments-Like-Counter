<?php
$data = "";
$lists = "";
if(isset($_POST['lists'])){
	$lists = explode(PHP_EOL, $_POST['lists']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Facebook Share, Comments & Like Count Script</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Rasheda Sultana">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		body{padding:0;margin:0;font-family: 'Ubuntu', sans-serif;}
		.main{width:100%;max-width:700px;margin:0 auto;text-align: center;}
		.logo{text-align:center;margin-top:10%;}
		.counter, .result{text-align:center}
		.counter h4{font-size:35px;color: #037737;}
		.input {
			border: 1px solid #ccc;
			border-radius: 4px;
			height: 30px;
			padding: 5px;
			width: 320px;
		}
		.textarea {
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 5px;
			padding: 10px;
			width: 100%;
		}
		.btn {
			-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
			background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
			background-color:#79bbff;
			-webkit-border-top-left-radius:5px;
			-moz-border-radius-topleft:5px;
			border-top-left-radius:5px;
			-webkit-border-top-right-radius:5px;
			-moz-border-radius-topright:5px;
			border-top-right-radius:5px;
			-webkit-border-bottom-right-radius:5px;
			-moz-border-radius-bottomright:5px;
			border-bottom-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			-moz-border-radius-bottomleft:5px;
			border-bottom-left-radius:5px;
			text-indent:0px;
			border:1px solid #84bbf3;
			display:inline-block;
			color:#ffffff;
			cursor: pointer;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			font-style:normal;
			height:43px;
			line-height:40px;
			width:100px;
			text-decoration:none;
			text-align:center;
			text-shadow:1px 1px 0px #528ecc;
		}
		.btn:hover {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
			background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
			background-color:#378de5;
		}.btn:active {
			position:relative;
			top:1px;
		}
		table {margin-top: 15px;width:700px;}
		table tr th, table tr td {padding:5px;text-align:center;border: 1px solid #ccc;}
		table tr td:first-child {text-align: left;}
		.footer{font-size:14px;margin-top:10%;text-align:center}
	</style>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="main">
		<div class="logo"><img src="http://sultana.me/wp-content/uploads/2014/01/logo.png" alt="Rasheda Sultana" height="130px"></div>
		<div class="counter">
			<h4>Find How Much Share/Comments/Like Your Website on Facebook!</h4>
			<form action="" method="post">
				<textarea name="lists" rows="7" cols="50" placeholder="Enter each url in a new line" class="textarea"></textarea><br />
				<input type="submit" value="Find" class="btn"/>
			</form>
		</div>
		<?php if($lists != ""): ?>
		<div class="result">
			<table border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>URL</th>
					<th>Like</th>
					<th>Comments</th>
					<th>Share</th>
					<th>Click</th>
					<th>Total</th>
				</tr>
				<?php
				foreach($lists as $list){
				$list = trim($list);
				$dataurl = "https://api.facebook.com/method/fql.query?query=select%20total_count,like_count,comment_count,share_count,click_count%20from%20link_stat%20where%20url=%27".$list."%27&format=json";
				$data = file_get_contents($dataurl);
				$data = json_decode($data, true);
				$data = $data[0];
				echo "
				<tr>
					<td>".$list."</td>
					<td>".$data['like_count']."</td>
					<td>".$data['comment_count']."</td>
					<td>".$data['share_count']."</td>
					<td>".$data['click_count']."</td>
					<td>".$data['total_count']."</td>
				</tr>";
				} ?>
			</table>
		</div>
		<?php endif; ?>
		<p>Wanna Check Single? <a href="index.php">Click Here</a></p>
		<div class="footer">All Right Reserved by <a href="http://sultana.me">Rasheda Sultana</a></div>
	</div>
</body>
</html>