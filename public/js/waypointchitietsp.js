$(document).ready(
    function(){

        // sticky nav
        $('.binhluan').waypoint(
            function(direction){
                if(direction == "down"){
                    $('nav').addClass('sticky');
                }
                else{
                    $('nav').removeClass('sticky');
                }
            }, {
                // khoang cach giua diem waypoint
                offset:'400px'
            }
        )
    }
)