<script type="text/javascript">
	function LoadPropertyBasedProject(){}
	$(document).on("click","#button_submit",function(){
		var Project = $("#ProjectID").val();
		if(Project == ""){
			alertify.error("Please Select Project");
			return false;
		}else{
			$("form").submit();
		}
	});
</script>