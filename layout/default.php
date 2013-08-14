<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo util::getConfig('sitename', 'global');?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="<?php echo util::getConfig('sitename', 'global');?>,english,study"/>
    <meta name="keywords" content="<?php echo util::getConfig('sitename', 'global');?>,english,study"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="static/css/common.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="">
                        <a href="/">电视</a>
                    </li>
                    <li class="">
                        <a  class="bootstro">空调</a>
                    </li>
                    <li class="">
                        <a  class="bootstro">自定义</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php echo $layoutContent;?>
<script src="static/js/jquery.js"></script>
<script src="static/js/common.js"></script>
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

