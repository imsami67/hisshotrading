function addTodo() {
	var name = $("#todo_name").val();
	$.ajax({
		url: 'php_action/todo.php',
		method: 'POST',
		data:{name:name},
		success:function (msg) {
		$('.msg').text(msg).addClass("label label-success").fadeIn(4000).fadeOut(4000);
		load_todo();
		}
	});
}

function load_todo() {
	load = 'load';
	$.ajax({
		url: 'php_action/todo.php',
		method: 'POST',
		data:{load:load},
		success:function (msg) {
		$('#check').html(msg)
		}
	});
}

$(document).on('click','.removeTodo',function(){
	var id = $(this).attr('id');
	$.ajax({
		url: 'php_action/todo.php',
		method: 'POST',
		data:{id:id},
		success:function (msg) {
		$('.msg').text(msg).addClass("label label-success").fadeIn(4000).fadeOut(4000);
		load_todo();
		}
	});
});

$(document).on('click','.edit',function(){
	var id = $(this).attr('value');
	// alert(id)
	$.ajax({
		url: 'php_action/todo.php',
		method: 'POST',
		data:{id2:id2},
		success:function (msg) {
		$('.msg').text(msg).addClass("label label-success").fadeIn(4000).fadeOut(4000);
		load_todo();
		}
	});
});

$(document).ready(function() {
	load_todo();
})