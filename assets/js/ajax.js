$('#saveEmpForm').submit('click',function(){
		var auction_grade = $('#auction_grade').val();
		var auction_grade = $('#auction_grade').val();
		var empDesignation = $('#designation').val();
		$.ajax({
			type : "POST",
			url  : "emp/save",
			dataType : "JSON",
			data : {auction_grade:auction_grade, auction_grade:auction_grade},
			success: function(data){
				$('#auction_grade').val("");
				$('#auction_grade').val("");
				listEmployee();
			}
		});
		return false;
	});