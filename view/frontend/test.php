<?php ob_start(); ?>
<section id="part1" class="part1">
    <?= sliderHeader(); ?>
</section>
<?= meteoBanner(); ?>
<section id="part2" class="part2">
    <div id="mapSection" class="map-container container-fluid">
        <h2 id="mainSectionTitle">Choisissez une station</h2>
        <hr class="mb-4" />
        <div class="row search-container">
            <div class="map-container col-md-7 col-sm-12 mt-3 mb-3 pt-2 pb-2">
                <div id="mapBox">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="part3" class="part3"></section>
<section id="part4" class="part4"></section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>