jQuery(document).ready(function($) {
	var score = 0;
        function handleDragStart(e) {
            this.style.opacity = '0.4';
            e.dataTransfer.setData('text', this.dataset.number);
        }
        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }
        function handleDrop(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            var data = e.dataTransfer.getData('text');
            if (data == this.dataset.number) {
                score++;
                document.querySelector('.score').innerHTML = 'Score: ' + score;
                this.style.backgroundColor = '#3498db';
                this.innerHTML = data;
                var boxes = document.querySelectorAll('.box');
                for (var i = 0; i < boxes.length; i++) {
                    if (boxes[i].dataset.number == data) {
                        boxes[i].style.display = 'none';
                    }
                }
            }
            return false;
        }
        function handleDragEnd(e) {
            this.style.opacity = '1.0';
        }
        var targets = document.querySelectorAll('.target');
        [].forEach.call(targets, function(target) {
            target.addEventListener('dragover', handleDragOver, false);
            target.addEventListener('drop', handleDrop, false);
        });
        
        var boxes = document.querySelectorAll('.box');
        [].forEach.call(boxes, function(box) {
            box.addEventListener('dragstart', handleDragStart, false);
            box.addEventListener('dragend', handleDragEnd, false);
        });
	
	
	
	
	
	
	
	
	
	
});