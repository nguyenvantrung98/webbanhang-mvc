function toggle(id){
        event.preventDefault(); //dung ca sk khac lai
        var a = document.getElementById(id);
        // console.log(a);
        if(a.style.display === 'block'){
            a.style.display = 'none';
        }
        else{
            a.style.display = 'block';
        }
        var b = document.getElementsByClassName('menu-con');
        var i;
        // chay for de ktra xem cac danh muc khac co dang mở hay ko ,
         // nếu có thì đóng nó đi , và danh mục đó pải khác cái hiện tại đang click vào
        for(i = 0 ; i < b.length ; i++){
            if(i == a['id']){
                continue;
            }else{
                if(b[i].style.display === 'block'){
                    b[i].style.display = 'none';
                }
            }
        }
    }