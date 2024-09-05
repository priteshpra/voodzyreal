<?php 
if(!empty($data_array)) { 
    foreach ($data_array as $data) { 
         $doc = explode(',',$data->Document); 
         ?>
    <tr id="row_<?php echo $data->CustomerPropertyDocumentID; ?>">
        <td><?php echo $data->ProjectTitle; ?></td>
        <td><a class="txt-underline bold" href="<?php echo site_url("admin/user/property/details/".$data->CustomerPropertyID);?>"><?php echo $data->PropertyNo; ?></a></td>
        <td><?php $title = ''; $url = '';
        if(!empty($doc)){
            foreach ($doc as $key => $value) {
              $doc_detail = explode('~',$value);

              if(isset($doc_detail[1]) && $doc_detail[1] != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).PROJECT_DOCUMENT_UPLOAD_PATH.$doc_detail[1]))){
                  $url = site_url(PROJECT_DOCUMENT_UPLOAD_PATH.@$doc_detail[1]);
              }
              else{
                  $url = 'javascript:void(0);';
              }
            ?>
              <a download href="<?php echo $url;?>"><?php echo ($doc_detail[0]!='')? $doc_detail[0]: '-'; ?></a><br/>
      <?php }
        }  ?></td>
    </tr>
<?php }
  }

?>  
