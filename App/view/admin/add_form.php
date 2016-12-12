<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?echo $title;?></title>
</head>
<body>

<? if (isset($mess)){
    echo $mess;
} ?>
    <h2>Добавить новость</h2>
<form enctype="multipart/form-data" action="#" method="post">
    <p>Заголовок</p>
        <input type="text" name="title" placeholder="" value="">

    <p>Текст новости</p>
        <input type="text" name="article" placeholder="" value="">

        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <p>картинка :</p>
        <input class="txt-zag" type="file" value="" name="img">

    <p>Ид автора</p>
        <select name="idauthor">
            <?php foreach ($author as $item): ?>
                <option value="<?php echo $item->id; ?>">
                    <?php echo $item->name;?>
                </option>
            <?php endforeach; ?>
        </select>
    <br><br>
        <input type="submit" name="submit" value="Сохранить">
</form>
</body>
</html>



