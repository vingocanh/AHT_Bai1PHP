var index = 0;
    showSlide();
    function showSlide(){
        var slide = document.getElementsByClassName('slide_show');
        for(var i = 0; i< slide.length; i++){
            slide[i].style.display="none";
        }
        index++;
        if(index > slide.length){
            index=1;
        }
        slide[index-1].style.display="block";
        setTimeout(showSlide, 1500);
    }