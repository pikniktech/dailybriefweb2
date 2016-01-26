var carousels = [];
var goToScreen = function(index, action) {
	try {
		var temp = carousels[index]
		action == 'next' ? carousels[index].next() : carousels[index].previous()
	} catch (ex) {
		console.log(ex)
	}
}
jQuery(document).ready(function($){

if ($('.fullscreen-scrolling').length > 0) { 
$('.fullscreen-scrolling').each(function(index) {
	var carousel = $('#'+$(this).attr('id')+' ul'); //$("#scrolling ul");

	carousel.attr('data-rel', index)
	if (carousel.length > 0 )
		carousel.itemslide({
			one_item: true,
			parent_width: true
		});

	// put next or previous icon
	if (carousel.length > 0) {
		//console.log('height: ', carousel.height())
		carousel.parent().append('<div class="arrows prev" style="color: #fff; position: absolute; top: 45%; z-index:1;"><a href="javascript: goToScreen('+index+', \'prev\')" class="arrow prev"><i class="fa fa-angle-left fa-4x"></i></a></div>')
		carousel.parent().append('<div class="arrows next" style="color: #fff; position: absolute; top: 45%; z-index:1; right: 0;"><a href="javascript: goToScreen('+index+', \'next\')" class="arrow next"><i class="fa fa-angle-right fa-4x"></i></a></div>')
	}
	carousels.push(carousel)
	carousel.on('changePos', function(e) {
//		console.log('carousel-', $(this).attr('data-rel'))
        	var temp = carousels[parseInt($(this).attr('data-rel'))]
//		console.log("new pos: "+ temp.getCurrentPos());

		var prev = temp.parent().find('.arrows.prev')
		var next = temp.parent().find('.arrows.next')
		if (temp.getActiveIndex() == 0)
			prev.hide()
		else
			prev.show()
		//console.log(temp.find('li').length)
		if ((temp.getActiveIndex()+1) >= temp.find('li').length) 
			next.hide() 
		else 
			next.show()
	
		if (temp.find('video').length > 0) {
			temp.find('li.itemslide-active video')[0].play()
		}
	
		delete(temp)
	});

	carousel.find('video').each(function() {
		$(this)[0].addEventListener('loadeddata', function() {
//			$(this).closest('section').height($(this).height())
		}, false);
	})
	//console.log($(window).height())
	carousel.parent().parent().height(carousel.height() > $(window).height() ? carousel.height() : $(window).height())
})
//$('.fullscreen-scrolling').parent().height(c.height())
//$('.fullscreen-scrolling').parent().height(carousels[0].height())
}
   //check if the .cd-image-container is in the viewport 
    //if yes, animate it
    checkPosition($('.cd-image-container'));
    $(window).on('scroll', function(){
        checkPosition($('.cd-image-container'));
    });

     //make the .cd-handle element draggable and modify .cd-resize-img width according to its position
    $('.cd-image-container').each(function(){
        var actual = $(this);
        drags(actual.find('.cd-handle'), actual.find('.cd-resize-img'), actual, actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-image-label[data-type="modified"]'));
    });

    //upadate images label visibility
    $(window).on('resize', function(){
        $('.cd-image-container').each(function(){
            var actual = $(this);
            updateLabel(actual.find('.cd-image-label[data-type="modified"]'), actual.find('.cd-resize-img'), 'left');
            updateLabel(actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-resize-img'), 'right');
        });
    });

	if ($('.scratchpad').length > 0) {
		$('.scratchpad').each(function(index, ele) {
    			$(this).wScratchPad({
        			size        : 50,         
        			bg          : 'http://cors-proxy-252578225.ap-northeast-1.elb.amazonaws.com/'+$(this).attr('data-bimg'),
//				'https://crossorigin.me/'+$(this).attr('data-bimg'),
        			fg          : 'http://cors-proxy-252578225.ap-northeast-1.elb.amazonaws.com/'+$(this).attr('data-fimg'),
//				'https://crossorigin.me/'+$(this).attr('data-fimg'),
        			realtime    : true,       
        			scratchDown : null,       
        			scratchUp   : null,       
        			scratchMove : null,       
			        cursor      : 'crosshair' 
			});
		});
	}
});

function checkPosition(container) {
    container.each(function(){
        var actualContainer = $(this);
//        if( $(window).scrollTop() + $(window).height()*0.5 > (actualContainer.offset().top)) {
            actualContainer.addClass('is-visible');
  //      }
    });
}

//draggable funtionality - credits to http://css-tricks.com/snippets/jquery/draggable-without-jquery-ui/
function drags(dragElement, resizeElement, container, labelContainer, labelResizeElement) {
     dragElement.on("mousedown vmousedown", function(e) {
        dragElement.addClass('draggable');
        resizeElement.addClass('resizable');

        $('body').addClass('draggable');
        var dragWidth = dragElement.outerWidth(),
            xPosition = dragElement.offset().left + dragWidth - e.pageX,
            containerOffset = container.offset().left,
            containerWidth = container.outerWidth(),
            minLeft = containerOffset + 10,
            maxLeft = containerOffset + containerWidth - dragWidth - 10;
        
        dragElement.parents().on("mousemove vmousemove", function(e) {
            leftValue = e.pageX + xPosition - dragWidth;
            
            //constrain the draggable element to move inside his container
            if(leftValue < minLeft ) {
                leftValue = minLeft;
            } else if ( leftValue > maxLeft) {
                leftValue = maxLeft;
            }

            widthValue = (leftValue + dragWidth/2 - containerOffset)*100/containerWidth+'%';
            
            $('.draggable').css('left', widthValue).on("mouseup vmouseup", function() {
                $(this).removeClass('draggable');
                resizeElement.removeClass('resizable');
            });

            $('.resizable').css('width', widthValue); 

            updateLabel(labelResizeElement, resizeElement, 'left');
            updateLabel(labelContainer, resizeElement, 'right');
            
        }).on("mouseup vmouseup", function(e){
            dragElement.removeClass('draggable');
            resizeElement.removeClass('resizable');
            $('body').removeClass('draggable');
        });
        e.preventDefault();
    }).on("mouseup vmouseup", function(e) {
        dragElement.removeClass('draggable');
        resizeElement.removeClass('resizable');
    });
}

function updateLabel(label, resizeElement, position) {
    if(position == 'left') {
        ( label.offset().left + label.outerWidth() < resizeElement.offset().left + resizeElement.outerWidth() ) ? label.removeClass('is-hidden') : label.addClass('is-hidden') ;
    } else {
        ( label.offset().left > resizeElement.offset().left + resizeElement.outerWidth() ) ? label.removeClass('is-hidden') : label.addClass('is-hidden') ;
    }
}

function onLoadFrame(frame) {
//	alert(jQuery(frame).height());
}

