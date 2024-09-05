
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/content"><strong>Page Content</strong></a>
            </h4>

            <div class="row">
                <form class="col s12" name="add_page_content_form" id="add_page_content_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/content/<?=$page?>">
                    <div class="row">
                         <div class="input-field col s6">

                            <label for="page_name_label" class="active">Page Name</label><br>
                            <select id="PageID" name="PageID" class="select2_class" tabindex="1" >
                                <option value="">Choose Page</option>
                                <?php
                                $select = "";
                                foreach ($pages as $page) {
                                    if (isset($cms_pages)) {
                                        if ($cms_pages->PageID == $page['PageID']) {
                                            $select = " selected ";
                                        } else {
                                            $select = "";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $page['PageID']; ?>" <?php echo $select; ?> >
                                        <?php echo $page['PageName']; ?>
                                    </option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter Content, Maximum length is 5000"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <label for="Content">Content</label>
                            <textarea name="Content" id="Content" class="materialize-textarea" tabindex="2" maxlength="5000" style="padding:0.7rem 0"><?php echo @$cms_pages->Content ?></textarea>

                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s6">     
                            <input  tabindex="2" type="checkbox" class="" name="Status" id="Status" <?php
                            if (isset($cms_pages->Status) && $cms_pages->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?> tabindex="2" />
                            <label for="Status">Status</label>
                        </div>                   
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="submit" tabindex="3" id="button_content_submit" name="button_content_submit" tabindex="3">Submit
                            </button>
                            <?php echo $loading_button; ?>
                            <a tabindex="4" href="<?php echo $this->config->item('base_url'); ?>admin/masters/content" tabindex="4" class="right close-button">Close</a>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>