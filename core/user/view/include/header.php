<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta type="keywords" content="...">
    <meta type="description" content="...">
    <title>Document</title>

    <?php foreach ($this->styles as $style):?>
        <link rel="stylesheet" href="<?=$style?>">
    <?php endforeach;?>

</head>
<body>
<div style="color: blue">User header</div>