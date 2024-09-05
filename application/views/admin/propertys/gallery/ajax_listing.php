<?php
if (!empty($data_array)) {
    $i = 1;
    foreach ($data_array as $data) {
        if (@$data->FileURL != null && $data->FileURL != "" && (file_exists(str_replace(array('\\', '/system'), array('/', ''), BASEPATH) . PROJECT_Gallery_THUMB_UPLOAD_PATH . $data->FileURL))) {
            $path = base_url() . PROJECT_Gallery_THUMB_UPLOAD_PATH . $data->FileURL;
        } else {
            $path =  site_url(DEFAULT_IMAGE);
        }
?>
        <div class="col s3 projectgallery" style="height: auto;">
            <img src="<?php echo $path; ?>" alt="Property Gallery">
            <a class="cross1" data-id='<?php echo $data->PropertyGalleryID; ?>'><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
<?php
        if ($i++ == 4) {
            echo "<div class='clearfix'></div>";
        }
    }
}

?>