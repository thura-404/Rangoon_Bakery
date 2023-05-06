$(document).ready(function(){
	$("#Choose").on('change',function () 
	{
		var Choose = $(this).val();
		$.ajax(
		{
			method:"POST",
			url:"ajax.php",
			data:{ID:Choose},
			dataType:"html",
			success:function(data)
			{
				$("#Data").html(data);
			}
		});
	});
});