<script>
$(document).ready(function () {
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
    if($('#IsPush').is(':checked')){
    	$("input.chkcls").attr('disabled',false);
    }
})
$('#IsPush').change(function() {
	if($(this).is(':checked')){
		$("input.chkcls").attr('disabled',false);
	}else{
		$("input.chkcls").prop("checked",false);
		$("input.chkcls").attr('disabled',true);
	}
});
</script>