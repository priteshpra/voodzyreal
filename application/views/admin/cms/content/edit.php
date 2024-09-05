<div class="section">
    <div class="card-panel" style="width:65%;margin-left:18%;">

        <h4 class="header"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/content"><strong>Page Content</strong></a></h4>
        <?php
        foreach ($cms_pages as $cms_page) {
            ?> 
            <div class="row">
                <form class="col s12" name="edit_page_content_form" id="edit_page_content_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/content/editPageContent/<?php echo $cms_page->CMSID; ?>">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Please select page name" style="color:black; float:right;" ></i>
                             <label for="page_name_label" class="active">Page Name</label><br>
                              <select id="PageID" name="PageID" class="select2_class" style="width:100%" >
                            <option value="">Choose Page</option>
                            <?php
                            foreach ($pages as $page) {
                                ?>
                                <option value="<?php echo $page['PageID']; ?>" <?php echo ($cms_page->PageID==$page['PageID'])?'selected':''; ?>>
                                    <?php echo $page['PageName']; ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="<?php echo INFO_ICON_CLASS; ?> masterTooltip" title="Please enter the content, Maximum length is 5000" style="color:black; float:right;" ></i>
                            <textarea name="Content" id="Content"  class="materialize-textarea empty_validation_class" maxlength="5000"><?php echo $cms_page->Content; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        if ($cms_page->Status == ACTIVE) {
                            ?>
                            <div class="input-field col s12">
                                <input type="checkbox" class="filled-in" name="Status" id="Status" checked="checked" />
                                <label for="Status">Status</label>     
                            </div>
                            <?php
                        }
                        if ($cms_page->Status == INACTIVE) {
                            ?>
                            <div class="input-field col s12">
                                <input type="checkbox" class="filled-in" name="Status" id="Status"  />
                                <label for="Status">Status</label>     
                            </div>
                            <?PHP
                        }
                    }
                    ?>

                    <div class="row">
                        <div class="input-field col s11">
                            <button class="btn waves-effect waves-light right" type="button" id="button_page_content_submit" name="button_page_content_submit" >Submit
                                <i class="mdi-content-send right"></i>
                            </button>
                            <?php echo $loading_button; ?>
                        </div>  
                        <div class="input-field col s1">
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/content/" class="pull-right">Cancel</a>
                        </div>                        
                    </div>
                </div>
            </form>
        </div>  

    </div>
</div>