<div style="color: blue">footer</div>

<script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
</script>
<?php foreach ($this->scripts as $script):?>
    <script type="text/javascript" src="<?=$script?>"></script>
<?php endforeach;?>

</body>

</html>