<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <link href="/APP/view/css/bootstrap.min.css" rel="stylesheet">
    <link href="/APP/view/css/style.css" rel="stylesheet">
    <title><? echo $title?></title>
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <p><a class="btn btn-default" href="/admin" role="button">Админка &raquo;</a></p>

        <div class="search">
            <form action="/search/Default/" method="POST">
                <input class="inpt" type="text" name="txt"  />
                <input type="submit" name="submit" value="Поиск">
            </form>
        </div>
        <div class="col-md-4">
            <? if($news):?>
                <? foreach($news as $item):?>
                    <h2><? echo $item->title;?></h2>
                    <img src="/App/view/img/<? echo $item->img;?>" class="img-responsive ">
                    <p class="descr" id="descr"><?
                        $item->article = substr($item->article,0,235);
                        $item->article = substr($item->article,0,strrpos($item->article, ' '));
                        echo $item->article;
                        ?>
                    </p>
                    <? if(!empty($item->author)):?>
                       <p> Автор : <? echo $item->author->name;?></p>
                    <? endif; ?>
                    <p><a class="btn btn-default" href="/index/one/<? echo $item->id?>" role="button">Перейти к новости &raquo;</a></p>
                <? endforeach;?>
                <? else :?>
                    <p>Новостей с такими параметрами нет</p>
            <? endif; ?>
        </div>
    </div>
    <hr>
    <footer>
        <div class="col-sm-9 padding-right">
            <?php echo $pagination->get(); ?>
        </div>
        <p>&copy; Ryzhyk E</p>
    </footer>
</div> <!-- /container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
</body>
</html>