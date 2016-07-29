+function ($) { "use strict";

	$.ajaxSetup({ 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});

  	$(function(){

		// dropfile
		$('.dropfile').each(function(){
			var $dropbox = $(this);
			if (typeof window.FileReader === 'undefined') {
			  $('small',this).html('File API & FileReader API not supported').addClass('text-danger');
			  return;
			}

			this.ondragover = function () {$dropbox.addClass('hover'); return false; };
			this.ondragend = function () {$dropbox.removeClass('hover'); return false; };
			this.ondrop = function (e) {
			  e.preventDefault();
			  $dropbox.removeClass('hover').html('');
			  var file = e.dataTransfer.files[0],
			      reader = new FileReader();
			  reader.onload = function (event) {
			  	$dropbox.append($('<img>').attr('src', event.target.result));
			  };
			  reader.readAsDataURL(file);
			  return false;
			};
		});

		// slider
		$('.slider').each(function(){
			$(this).slider();
		});

		// slim-scroll
		$('.no-touch .slim-scroll').each(function(){
			var $self = $(this), $data = $self.data(), $slimResize;
			$self.slimScroll($data);
			$(window).resize(function(e) {
				clearTimeout($slimResize);
				$slimResize = setTimeout(function(){$self.slimScroll($data);}, 500);
			});
		    $(document).on('updateNav', function(){
		      $self.slimScroll($data);
		    });
		});	

		// portlet
		$('.portlet').each(function(){
			$(".portlet").sortable({
		        connectWith: '.portlet',
	            iframeFix: false,
	            items: '.portlet-item',
	            opacity: 0.8,
	            helper: 'original',
	            revert: true,
	            forceHelperSize: true,
	            placeholder: 'sortable-box-placeholder round-all',
	            forcePlaceholderSize: true,
	            tolerance: 'pointer'
		    });
	    });

		// select2
		$("select.select2.tags").length && $('select.select2.tags').select2({
			tags: true,
			tokenSeparators: [','],
			maximumSelectionLength: 3
		});

		$("select.select2").length && $('select.select2').select2({
		    theme: "bootstrap"
		});

		// datetime picker
    	$('input.datetime').datetimepicker({
	      format:'Y-m-d H:i'
	    });
	    
    	$('input.date').datetimepicker({
	      	timepicker:false,
      		format:'Y-m-d'
	    });

    	$('input.time').datetimepicker({
	      	datepicker:false,
      		format:'H:i'
	    });

	   	$('input.datetime-start').datetimepicker({
			format:'Y-m-d H:i',
		  	onShow:function( ct ){
			   	this.setOptions({
			    	maxDate:$('input.datetime-end').val()?$('input.datetime-end').val():false
			   	})
			}
		});

	    $('input.datetime-end').datetimepicker({
		  	format:'Y-m-d H:i',
		  	onShow:function( ct ){
		   		this.setOptions({
		    		minDate:$('input.datetime-start').val()?$('input.datetime-start').val():false
		   		})
		  	}
		 });
	    
		// markdown
		if($("textarea.markdown").length > 0){
			var simplemde = new SimpleMDE({
			    element: $("textarea.markdown")[0],
			    autoDownloadFontAwesome: false,
			    placeholder: "Type here...",
			    spellChecker: false,
			    status: false,
			    shortcuts: {
			        drawTable: "Cmd-Alt-T"
			    },
			    showIcons: ["code", "table"],
			});
		} 

		// upload 
		$(document).on('change', 'input[type="file"].fileupload', function(e){
			e && e.preventDefault();
			var self = $(this),
				url = self.attr('data-url'),
				field_name = self.attr('data-field');
				
			var formData = new FormData();
	        formData.append('file', self[0].files[0]);
	        $.ajax({
	            url: url,
	            type: 'POST',
	            xhr: function() {
	                var xhr = new window.XMLHttpRequest();
			        xhr.upload.addEventListener("progress", function (evt) {
			            if (evt.lengthComputable) {
			                var percentComplete = evt.loaded / evt.total;
			                console.log(percentComplete*100);
			            }
			        }, false);
			        return xhr; 
	            },
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            beforeSend: function(){
	            	self.closest('div').append('<i class="fa fa-spin fa-spinner show inline" id="spin"></i>');
	            },
	            complete : function(res) {
	            	var data = $.parseJSON(res.responseText); 

	            	var	html='<div class="input-group file-item">';
			       		html+='  <input type="hidden" name="'+ field_name +'" value="'+data.id+'">';
			            html+='  <input type="text" class="form-control" value="'+data.name+'" readonly="true">';
			            html+='  <span class="input-group-btn">';
			            html+='    <button class="btn btn-default remove-item" type="button"><i class="fa fa-trash text-danger"></i></button>';
			            html+='  </span>';
			            html+='</div>';
	                
	                var input = self.siblings('input');
	                console.log(input);
	                if(input.length > 0) 
	                {
	                	input.remove();
	                }

	                self.closest('div').append(html);
	                self.filestyle('destroy');
	                self.addClass('hide');
	                $('i.fa.fa-spin.fa-spinner').remove();
	                    	
	                self.closest('div').find('.btn.remove-item').on('click', function(e){
	                	e.preventDefault();
	                	var item = $($(this).parent()).parent();
	                	
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
							
							item.remove();
	                    	self.removeClass('hide');
	                    	self.filestyle({
	                    		iconName: 'fa fa-folder-open',
	                    		buttonText: '',
	                    		classInput: 'form-control inline v-middle input-s'
							});	

							swal({
									title: "Deleted!!",
									text: "Your file has been deleted",
									type: "success",
									timer: 1000,   
									showConfirmButton: false 
							});

						});
	                });
	            }
	        });
		});

		// docs
	  	$('#docs pre code').each(function(){
		    var $this = $(this);
		    var t = $this.html();
		    $this.html(t.replace(/</g, '&lt;').replace(/>/g, '&gt;'));
		});

		// table select/deselect all
		$(document).on('change', 'table thead [type="checkbox"]', function(e){
			e && e.preventDefault();
			var $table = $(e.target).closest('table'), $checked = $(e.target).is(':checked');
			$('tbody [type="checkbox"]',$table).prop('checked', $checked);
		});

		// random progress
		$(document).on('click', '[data-toggle^="progress"]', function(e){
			e && e.preventDefault();

			var $el = $(e.target),
			$target = $($el.data('target'));
			$('.progress', $target).each(
				function(){
					var $max = 50, $data, $ps = $('.progress-bar',this).last();
					($(this).hasClass('progress-xs') || $(this).hasClass('progress-sm')) && ($max = 100);
					$data = Math.floor(Math.random()*$max)+'%';
					$ps.css('width', $data).attr('data-original-title', $data);
				}
			);
		});
		
		// add notes
		function addMsg($msg){
			var $el = $('.nav-user'), $n = $('.count:first', $el), $v = parseInt($n.text());
			$('.count', $el).fadeOut().fadeIn().text($v+1);
			$($msg).hide().prependTo($el.find('.list-group')).slideDown().css('display','block');
		}
		var $msg = '<a href="#" class="media list-group-item">'+
	                  '<span class="pull-left thumb-sm text-center">'+
	                    '<i class="fa fa-envelope-o fa-2x text-success"></i>'+
	                  '</span>'+
	                  '<span class="media-body block m-b-none">'+
	                    'Sophi sent you a email<br>'+
	                    '<small class="text-muted">1 minutes ago</small>'+
	                  '</span>'+
	                '</a>';	
	  	setTimeout(function(){addMsg($msg);}, 1500);		
  });
}(window.jQuery);