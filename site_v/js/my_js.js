$(document).ready(function(){
    const slider = $("#slider1").owlCarousel({
        items: 2,
        loop: true,
        margin: 50,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        responsive:{
          0:{items:1},
          900:{items:2}
        }

     });
});

$(document).ready(function(){
    const slider = $("#slider2").owlCarousel({
        items: 1,
        loop: true,
        margin: 50,
        /*autoplay: true,*/
        autoHeight:true,
        /*autoplayTimeout: 3000,*/
        smartSpeed: 1000,
        nav: true,
        dots: true,
        navText:['<img src="css/images/left_icon.svg" alt="left_icon">',
      '<img src="css/images/right_icon.svg" alt="right_icon">'],
        responsive:{
          0:{items:1},
          600:{items:1},
          1000:{items:1}
        }

     });
});
//var col = document.getElementById("colvo").value;
//console.log(col);

/*var div = document.getElementsByClassName('input-number_minus')[0];
console.log(div);
  div.addEventListener('click', function (event) {
          let col = document.getElementsByClassName('input-number_input')[0];
          let value = Number(col.value);
          console.log(value);
          if(value>1){
           col.value = +value-1;
           console.log(col.value);
         }
        });

var divpl = document.getElementsByClassName('input-number_plus')[0];
console.log(divpl);
  divpl.addEventListener('click', function (event) {
          let colin = document.getElementsByClassName('input-number_input')[0];
          let valuepl = Number(colin.value);
          //
          colin.value = +valuepl+1;
          console.log(colin.value);
        });*/

jQuery(($) => {

    // Уменьшаем на 1
    $(document).on("click", ".input-number_minus", function () {
        let input=  $(this).next();
        var count  = Number(input.val());
        if (count > 1) {
            count = count -1;
            input.val(count);
            //console.log(total.val(+total.val() - 1));
        }
    });

    // Увеличиваем на 1
    $(document).on("click", ".input-number_plus", function () {
        let input=  $(this).prev();
        var count  = Number(input.val());
        count = count +1;
        input.val(count);

        //console.log(total.val(+total.val() + 1));
    });

    // Запрещаем ввод текста
    document.querySelectorAll('.input-number_input').forEach(function (el) {
        el.addEventListener('keydown', function (event) {
            // Разрешаем: backspace, delete, tab
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 ||
                // Ctrl+A
                (event.keyCode == 65 && event.ctrlKey === true) ||
                // ← →
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                return;
            } else {
                // Только цифры
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }

        });
    });
});
