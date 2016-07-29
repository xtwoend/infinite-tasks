$(document).ready(function(){

	var questionTable = $('table#question-lists').makeTable({
		ordering  : true,
		columns: [
			{ data: 'marker' },
			{ data: 'question' },
			{ data: 'options' },
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
		$('#question-lists_filter input').val(this.value);
		$('#question-lists_filter input').trigger(e.type, {'e': press});		
	});
	
	$('button[data-item="refresh"]').on('click', function(e){
		e.preventDefault();
		questionTable.ajax.reload();
	});

	$('a[data-item="delete"]').on('click', function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var arrData = [];

		$.each($('table#question-lists tbody tr.selected'), function(index, el) {
			arrData.push($(this).attr('id'));
		});

		if(arrData.length === 0){
			swal("Oops...", "Please select first.." , "error");
			return;
		}

		swal({   
			title: "Are you sure?",   
			text: "You will not be able to recover this data!",   
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
					questionTable.ajax.reload(null, false); 
				});
			}, 1000);	
		});
	});

	$('table#question-lists thead tr th.select-checkbox').on('click', function() {
		var btn = $(this).closest('tr');
			btn.toggleClass('selected');
		if( btn.hasClass('selected') )
		{ 
			questionTable.rows().select(); 
		} 
		else 
		{ 
			questionTable.rows().deselect(); 
		}
	});

	questionTable.on('select', function(e, dt, tp, ix){
		var cnt = questionTable.rows('.selected').count(),
			row = questionTable[tp](ix).nodes().to$(),
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
				$('.option-remove').off('click').on('click', function(e){
					e.preventDefault();
					var parent = $(this).parent('span').parent('div.input-group');
					parent.remove();
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
						questionTable.ajax.reload(null, false); 
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