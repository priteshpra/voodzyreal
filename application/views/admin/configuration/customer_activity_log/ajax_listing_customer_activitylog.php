<?php
                                foreach ($customer_activity_logs as $customer_activity_log) {
                                    ?>


                                    <tr id="row_<?php echo $customer_activity_log->CustomerActivityID; ?>">                                      
                                    
                                        <td><?php echo $customer_activity_log->MethodName; ?></td>  
                                        <td><?php echo $customer_activity_log->ActivityDescription; ?></td>
                                        <td><?php echo $customer_activity_log->CreatedDate; ?></td>
                                        <?php
                                   /* if ($customer_activity_log->Status == ACTIVE) {
                                        $inactive_icon_status = "hide";
                                        $active_icon_status = "";
                                    } else {
                                        $inactive_icon_status = "";
                                        $active_icon_status = "hide";
                                    }*/
                                    ?>
                                  <!--  <td class="status">

                                        <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?>" data-icon-type="inactive" data-customer-activity-log-id="<?php echo $customer_activity_log->CustomerActivityID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

                                        <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-customer-activity-log-id="<?php echo $customer_activity_log->CustomerActivityID; ?>"></i>

                                        <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?>" data-icon-type="active" data-customer-activity-log-id="<?php echo $customer_activity_log->CustomerActivityID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
										
										<span style="display:none;"><?php echo $customer_activity_log->Status; ?></span>

                                    </td>-->
                                          
                                </tr>
                            <?php }
                            ?>  
