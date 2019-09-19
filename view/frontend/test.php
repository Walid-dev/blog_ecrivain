<?php ob_start(); ?>

<div>
    <h1>Bonjour</h1>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>