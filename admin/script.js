$(document).ready(function () {

  // banner owl carousel
  $("#banner-area .owl-carousel").owlCarousel({
    dots: true,
    items: 1
  });

  // top sale owl carousel
  $("#top-sale .owl-carousel").owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    }
  });

  // isotope filter
  var $grid = $(".grid").isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows'
  });

  // filter items on button click
  $(".button-group").on("click", "button", function () {
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
  })


  // new phones owl carousel
  $("#new-phones .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    }
  });

  // blogs owl carousel
  $("#blogs .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      }
    }
  });


  // product qty section
  let $qty_up = $(".qty .qty-up");
  let $qty_down = $(".qty .qty-down");
  let $deal_price = $("#deal-price");
  // let $input = $(".qty .qty_input");

  // click on qty up button
  $qty_up.click(function (e) {

    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

    // change product price using ajax call
    $.ajax({
      url: "Template/ajax.php", type: 'post', data: { itemid: $(this).data("id") }, success: function (result) {
        let obj = JSON.parse(result);
        let item_price = obj[0]['item_price'];

        if ($input.val() >= 1 && $input.val() <= 9) {
          $input.val(function (i, oldval) {
            return ++oldval;
          });

          // increase price of the product
          $price.text(parseInt(item_price * $input.val()).toFixed(2));

          // set subtotal price
          let subtotal = parseInt($deal_price.text()) + parseInt(item_price);
          $deal_price.text(subtotal.toFixed(2));
        }

      }
    });
    // closing ajax request
  });
  // closing qty up button

  // click on qty down button
  $qty_down.click(function (e) {

    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

    // change product price using ajax call
    $.ajax({
      url: "Template/ajax.php", type: 'post', data: { itemid: $(this).data("id") }, success: function (result) {
        let obj = JSON.parse(result);
        let item_price = obj[0]['item_price'];

        if ($input.val() > 1 && $input.val() <= 10) {
          $input.val(function (i, oldval) {
            return --oldval;
          });


          // increase price of the product
          $price.text(parseInt(item_price * $input.val()).toFixed(2));

          // set subtotal price
          let subtotal = parseInt($deal_price.text()) - parseInt(item_price);
          $deal_price.text(subtotal.toFixed(2));
        }

      }
    });
    // closing ajax request
  });
  // closing qty down button


  // event ketika keyword product ditulis
  $('#keyword-product-live').on('keyup', function () {
    // munculkan icon loading
    $('.loader').show();

    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // $.get()
    $.get('products-live.php?keyword-product-live=' + $('#keyword-product-live').val(), function (data) {

      $('#table-container').html(data);
      $('.loader').hide();

    });
  });

  // event ketika keyword order ditulis
  $('#keyword-order-live').on('keyup', function () {
    // munculkan icon loading
    $('.loader').show();

    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // $.get()
    $.get('orders-live.php?keyword-order-live=' + $('#keyword-order-live').val(), function (data) {

      $('#table-container').html(data);
      $('.loader').hide();

    });
  });
  
  // event ketika keyword delivery ditulis
  $('#keyword-delivery-live').on('keyup', function () {
    // munculkan icon loading
    $('.loader').show();

    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // $.get()
    $.get('deliveries-live.php?keyword-delivery-live=' + $('#keyword-delivery-live').val(), function (data) {

      $('#table-container').html(data);
      $('.loader').hide();

    });
  });

  // event ketika keyword user ditulis
  $('#keyword-user-live').on('keyup', function () {
    // munculkan icon loading
    $('.loader').show();

    // ajax menggunakan load
    // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

    // $.get()
    $.get('users-live.php?keyword-user-live=' + $('#keyword-user-live').val(), function (data) {

      $('#table-container').html(data);
      $('.loader').hide();

    });
  });

});


// Custom Javascript for sidebar
$(".sidebar-dropdown > a").click(function () {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this).parent().hasClass("active")) {
    $(".sidebar-dropdown").removeClass("active");
    $(this).
      parent().
      removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this).
      next(".sidebar-submenu").
      slideDown(200);
    $(this).
      parent().
      addClass("active");
  }
});

$("#close-sidebar").click(function () {
  $(".page-wrapper").removeClass("toggled");
});

$("#show-sidebar").click(function () {
  $(".page-wrapper").addClass("toggled");
});