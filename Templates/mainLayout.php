<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <?php
        if(isset($css)) {
            if(is_array($css)) {
                foreach($css as $key => $val) {
                    echo "<link rel='stylesheet' href='/css/$val'>";
                }
            } else {
                echo "<link rel='stylesheet' href='/css/$css'>";
            }
        }
    ?>
    <title>communes | Madagascar</title>
</head>
<body>
    <header>
        <strong class="logo">Madagascar</strong>
        <nav>
            <ul class="menu">
                <li><a href="/region/index">region</a></li>
                <li><a href="/district/index">district</a></li>
                <li><a href="/communes/index">communes</a></li>
                <li><a href="/fokontany/index">fokontany</a></li>
            </ul>
        </nav>
    </header>
    <?php echo $content ?>
        
    <script src="/js/Jquery.3.4.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <?php
        if(isset($js)) {
            echo "<script src='/js/$js'></script>";
        }
    ?>
</body>
</html>