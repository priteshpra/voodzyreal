<?php
if(!empty($data_array)) { 
    $i = 1;
    foreach ($data_array as $data) { 
    	if(@$data->ImagePath != null && $data->ImagePath != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).PROJECT_Gallery_THUMB_UPLOAD_PATH.$data->ImagePath))) { 
			$path = base_url() . PROJECT_Gallery_THUMB_UPLOAD_PATH . $data->ImagePath;
		}else{
			$path =  site_url(DEFAULT_IMAGE);
		}
    	?>
    <div class="col s3 projectgallery" style="height: auto;">
    	<img src="<?php echo $path;?>" alt="Project Gallery">
    	<a class="cross1" data-id='<?php echo $data->ProjectGalleryID;?>'><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
<?php
    if($i++ == 4){
        echo "<div class='clearfix'></div>";
    }    
 }
  }

?>  