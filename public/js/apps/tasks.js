$(document).ready(function(){

	var taskTable = $('table#task-lists').makeTable({
		ordering  : true,
		columns: [
			{ data: 'marker' },
			{ data: 'title' },
			{ data: 'date' },
			{ data: 'priority' },
			{ data: 'status' },
			{ data: 'edit' }
		]
	});

	$('input[data-item="search"]').on('keypress keyup keydown', function(e) { 
		var press 	= jQuery.Event(e.type),
			code 	= e.keyCode || e.which,
			forget 	= [9, 16, 17, 18, 224],
			owner 	= this;
		press.which = code ;
		if( $.inArray(press.which, forget) > 0 ) return;
		$('#task-lists_filter input').val(this.value);
		$('#task-lists_filter input').trigger(e.type, {'e': press});		
	});
	
	$('button[data-item="refresh"]').on('click', function(e){
		e.preventDefault();
		taskTable.ajax.reload();
	});

	$('a[data-item="delete"]').on('click', function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var arrData = [];

		$.each($('table#task-lists tbody tr.selected'), function(index, el) {
			arrData.push($(this).attr('id'));
		});

		if(arrData.length === 0){
			swal("Oops...", "Please select first.." , "error");
			return;
		}

		swal({   
			title: "Are you sure?",   
			text: "You will not be able to recover this post!",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Yes, delete it!",   
			closeOnConfirm: false ,
			showLoaderOnConfirm: true,
		}, function(){  
			setTimeout(function(){
				$.post(url, {ids: arrData, _method: 'DELETE'}, function(res){
					swal({
							title: "Deleted!!",
							text: "Your post has been deleted",
							type: "success",
							timer: 1000,   
							showConfirmButton: false 
					});
					taskTable.ajax.reload(null, false); 
				});
			}, 1000);	
		});
	});

	$('table#task-lists thead tr th.select-checkbox').on('click', function() {
		var btn = $(this).closest('tr');
			btn.toggleClass('selected');
		if( btn.hasClass('selected') )
		{ 
			taskTable.rows().select(); 
		} 
		else 
		{ 
			taskTable.rows().deselect(); 
		}
	});

	taskTable.on('select', function(e, dt, tp, ix){
		var cnt = taskTable.rows('.selected').count(),
			row = taskTable[tp](ix).nodes().to$(),
			href;
		// jika tidak sama dengan 1 abaikan
		if( cnt > 1 || cnt < 1 )
		{ 
			$('aside[temp-part="property"]').html('');
			return; 
		}

		href = row.find('td a').attr('data-href');
		$.ajax({
			url: href,
			type: 'GET',
			beforeSend: function(){

			}
		})
		.done(function(data) {
			$('aside[temp-part="property"]').html(data).promise().done(function(){
				$('input.datetime').datetimepicker({
			      	format:'Y-m-d H:i'
			    });
			});

			$('.btn[data-action="update"]').on('click', function(e){
				e.preventDefault();
				$('form#post-quick-update').ajaxSubmit({
					success: function(){
						swal({
							title: "Succes saved..",
							type: "success",
							timer: 1000,   
							showConfirmButton: false 
						});
						taskTable.ajax.reload(null, false); 
					},
					error: function(res){
						var messages = JSON.stringify(res.responseJSON);
						swal("Oops...", messages , "error");
					}
				});
			});
		})		
		.always(function() {
			
		});
	});
});