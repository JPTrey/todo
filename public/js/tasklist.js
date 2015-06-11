$("#task-list").change(function() {
	if ($("#task-list").val() == 'new') {
		window.location.replace("/list/add");	
	} else {
		window.location.replace("/task/list/" + $("#task-list").val());
	}
});

$(document).ready(
	function() {
		$('.drag-message').hide();
		$('.btn-add').fadeOut();
		$('.task-row').hover(
			
			// on mouse hover
			function() {
				$(this).addClass('hovered');
				$(this).find('.btn-add').removeClass('hidden');
				$(this).find('.btn-add').fadeIn('hidden');
			},
			
			// on mouse exit
			function() {
				$(this).removeClass('hovered');
				$(this).find('.btn-add').addClass('hidden');
			}
		);
		$('.task-entry').hover(
			
			// on mouse hover
			function() {
				$(this).addClass('hovered');
				$(this).children('.task-actions').removeClass('hidden');
			},
			
			// on mouse exit
			function() {
				$(this).removeClass('hovered');
				$(this).children('.task-actions').addClass('hidden');
			}
		);
		
//		$('.task-item').draggable({
//		    containment: '#content',
//		    cursor: 'move',
//		    snap: '.drop-zone',
//		    // helper: dragHelper,
//		    start: startDrag,
//		    // drag: dragListener,
//		    stop: stopDrag,
//			revert: true
//	  	});
		  
//		$('.task-row').droppable({
//			drop: handleDrop,
//			hoverClass: 'hovered'	
//		});
//		$('.task-actions').hide();
	}
);

function dragHelper(event) {
	// return '<div id="draggableHelper">I am a helper - drag me!</div>';
}

function startDrag(event, ui) {
	$(".task-row").css("background-color", "#EEEEEE");
	showDragMsg();
}

function stopDrag(event, ui) {
	// $(".task-row").css("padding-bottom", "0px");
	$(".task-row").css("background-color", "#FFFFFF");
	$('.drag-message').hide();
	 // var offsetXPos = parseInt( ui.offset.left );
  // var offsetYPos = parseInt( ui.offset.top );
  // // var parent = ui.parent().attr("id");
  // alert( "Drag stopped!\n\nOffset: (" + offsetXPos + ", " + offsetYPos + ")\n\n Parent: " + ui.parent);
}

function showDragMsg() {
	$('.drag-message').text('Drag here to add');
	$('.drag-message').css('box-shadow', '0 1px 5px 5px #64BAE7');
	// $('.drag-message').css('border-radius', '10%');
	$('.drag-message').show();
}

function handleDrop(event, ui) {
	var taskDragged = ui.draggable;	
	alert('The task \'' + taskDragged.first().text() + '\' was dragged into a drop zone.');
}