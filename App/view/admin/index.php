<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $title;?></title>
	<link rel="stylesheet" href="/APP/view/admin/style.css" />
</head>
<body>
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
    </ul>
</div><!--/.nav-collapse -->
<h2>Список</h2>
<p><a href="/admin/add">Добавить новость</a></p>
	<div class="container">
	<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
	
	<thead>
			<tr>
				<th><h3>Id</h3></th>
				<th><h3>Name</h3></th>
				
			</tr>
		</thead>
		<tbody>
			<? foreach($news as $item):?>
            <tr>
                    <td><p><? echo $item->id;?></p></td>
                    <td><p><? echo $item->title;?></p></td>
                    <td><a href="/admin/update/<? echo $item->id?>">update</a></td>
                    <td><a href="/admin/delete/<? echo $item->id?>">delete</a></td>
            </tr>	
			<? endforeach;?>
		</tbody>
  </table>
		</div>
  </table>
	<script type="text/javascript" src="/APP/view/admin/script.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
  </script>
</body>
</html>
	
	
	
	
	
	
	
	
	
</body>
</html>