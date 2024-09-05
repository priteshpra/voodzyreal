</div>
</div>
<!-- START FOOTER -->
<!--  <footer class="page-footer m-t-0">
   <div class="footer-copyright">
     <div class="container">
       <span>Copyright © 2015 <a class="grey-text text-lighten-4" href="#">Masters</a> All rights reserved.</span>
       </div>
   </div>
 </footer> -->
<!-- END FOOTER -->



<!-- ================================================
Scripts
================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>
<!--materialize js-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.clockpicker.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- chartist -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartjs/chart.min.js"></script>
<!-- sparkline -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/sparkline/sparkline-script.js"></script>

<!-- google map api -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
<!-- morris -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.min.js"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>

<!-- aleryfy.min.js - Some Specific JS codes for Plugin Settings -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/alertify.min.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/drag-arrange.js"></script>

<!-- common.js -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/example.js?v=<?= date('YmW'); ?>"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>js/js.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/common_js.js?v=<?= date('YmW'); ?>"></script>
<script src='<?php echo $this->config->item('admin_assets'); ?>js/jquery.playSound.js'></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>/js/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var wrapper = $('.profile-page-cyan');
    wrapper.height(window.innerHeight - 114);
    $(window).resize(function(event) {
      wrapper.height(window.innerHeight - 114);
    });

  });
</script>
<script>
  //$("[rel^='lightbox']").prettyPhoto();

  //For date picker 
  $('.datepicker').pickadate({
    format: 'dd-mm-yyyy',
    minDate: 0,
    onSet: function(arg) {
      if ('select' in arg) { //prevent closing on selecting month/year
        this.close();
      }
    }
  })
  $('.datetime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    autoclose: true,
    twelvehour: false
  });
  $('.timep').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    autoclose: true,
    twelvehour: false
  });
  $('.timep').on('change', function() {
    $(this).parent().find('.timeplabel').addClass('active');
  });
  //For select 2
  // $('.select2_class').select2();

  var base_url = "<?php echo $this->config->item('base_url'); ?>";
  var active_status_icon_class = "active_status_icon";
  var inactive_status_icon_class = "inactive_status_icon";
  var loading_status_icon_class = "loading_status_icon";

  $(document).ready(function() {

    // $('#addStateForm #button_submit').click(function() {
    //   var SOUNDURL = '<?php echo base_url(); ?>' + 'assets/admin/audio/ringtone-notification.mp3';
    //   $.playSound(SOUNDURL);
    // });


    // Tooltip only Text
    $('.masterTooltip').hover(function() {
      // Hover over code
      var title = $(this).attr('title');
      $(this).data('tipText', title).removeAttr('title');
      $('<p class="tooltip"></p>')
        .text(title)
        .appendTo('body')
        .fadeIn('slow');
    }, function() {
      // Hover out code
      $(this).attr('title', $(this).data('tipText'));
      $('.tooltip').remove();
    }).mousemove(function(e) {
      var mousex = e.pageX + 20; //Get X coordinates
      var mousey = e.pageY + 10; //Get Y coordinates
      $('.tooltip')
        .css({
          top: mousey,
          left: mousex
        })
    });

    $('.notifyalert').click(function() {
      //  Cookies.set('RemoveCount', 'true');
      $('.notification-badge').html('0');

      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/notification/readNotification'); ?>",
        dataType: "JSON",
        success: function(data) {
          alert(data);

        }
      });



    });
  });
</script>

<script type="text/javascript">
  window.dt = new Date();
  $('.datepickerval').on('mousedown', function(event) {
    event.preventDefault();
  })
  $('.datepickerval').pickadate({
    format: 'dd-mm-yyyy',
    onSet: function(arg) {
      if ('select' in arg) {
        this.close();
      }
    },
    onClose: function() {
      $('#button_submit').focus();
      $('#button_submit').trigger('blur')
      $(this).focus();
    }
  })
  $('.timep').on('mousedown', function(event) {
    event.preventDefault();
  })

  $('.timeppast').on('mousedown', function(event) {
    event.preventDefault();
  })

  $('.timeppast').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    twelvehour: false,
    'default': 'now'
  });
  $('.timep').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    twelvehour: false,
    'default': 'now',
    min: dt.getTime()

  });

  $('.datepickervalall').on('mousedown', function(event) {
    event.preventDefault();
  })
  $('.datepickervalall').pickadate({
    format: 'dd-mm-yyyy',
    onSet: function(arg) {
      if ('select' in arg) {
        this.close();
      }
    },
    onClose: function() {
      $('#button_submit').focus();
      $('#button_submit').trigger('blur')
      $(this).focus();
    }
  })

  $(function() {
    $('.draggable-element').arrangeable();
    $('li').arrangeable({
      dragSelector: '.drag-area'
    });
  });
</script>
<script type="text/javascript">
  $('#input_endtime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    twelvehour: false
  });
</script>

<script type="text/javascript">
  $('#input_outtime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: false,
    twelvehour: false
  });
</script>

<?php echo @$page_level_js; ?>
<?php echo @$change_level_js; ?>
<?php echo @$page_level_pending_js; ?>

<script>
  //called = false;
  var auto_refresh = setInterval(
    function() {
      //if (!called) {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/opportunity/assignalert'); ?>",
        dataType: "JSON",
        success: function(data) {
          //called = true;
          if (data != "") {
            var nameArr = data.split(',');
            $(nameArr).each(function(index, value) {
              var SOUNDURL = '<?php echo base_url(); ?>' + 'assets/admin/audio/ringtone-notification.mp3';
              $.playSound(SOUNDURL);
              alert(value);
            });
            //alert(data);

          }
        }
      });
      //}
    }, 90000);

  var auto_refresh = setInterval(
    function() {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/user/visitor/reminderalert'); ?>",
        dataType: "JSON",
        success: function(data) {
          //alert(data);
          if (data != "") {
            var nameArr = data.split(',');
            $(nameArr).each(function(index, value) {
              var SOUNDURL = '<?php echo base_url(); ?>' + 'assets/admin/audio/ringtone-notification.mp3';
              $.playSound(SOUNDURL);
              alert(value);
            });
            //alert(data);

          }
        }
      });
    }, 90000);

  var auto_refresh = setInterval(
    function() {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/opportunity/reminderalert'); ?>",
        dataType: "JSON",
        success: function(data) {
          //alert(data);
          if (data != "") {
            alert(data);
            var SOUNDURL = '<?php echo base_url(); ?>' + 'assets/admin/audio/ringtone-notification.mp3';
            $.playSound(SOUNDURL);
          }
        }
      });
    }, 90000);

  function ChangeProjectRole() {
    var ProjectIDByRoleID = $("#ProjectIDByRoleID").val();
    $.ajax({
      type: "post",
      url: base_url + "common/SetProjectSession",
      data: {
        ProjectIDByRoleID: ProjectIDByRoleID
      },
      success: function(data) {
        if (typeof ajax_property === "function") {
          window.ajax_property(current_page_size, total_page);
        }
        if (typeof common_ajax === "function") {
          window.common_ajax(current_page_size, total_page);
        }
        if (typeof ajax_dashboard === "function") {
          window.ajax_dashboard($("input[name='FilterType']:checked").val());
        }
        if (typeof LoadProjectBasedProject === "function") {
          window.LoadProjectBasedProject(ProjectIDByRoleID);
        }
        if (typeof ajax_listing === "function") {
          window.ajax_listing(PageSize, CurrentPage);
        }
      }
    });
  }
</script>
</body>

</html>