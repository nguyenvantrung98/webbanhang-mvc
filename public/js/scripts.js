$(document).ready(
    function(){

        // sticky nav
        $('.danhmuc').waypoint(
            function(direction){
                if(direction == "down"){
                    $('nav').addClass('sticky');
                }
                else{
                    $('nav').removeClass('sticky');
                }
            }, {
                // khoang cach giua diem waypoint
                offset:'500px'
            }
        )
    }
)