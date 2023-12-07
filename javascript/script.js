var i = 0;
var limit;
window.onload = function abc() {
  // this ajax is for loading home page in
  loadHomePage();
  // function for_no_of_popular_products(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      limit = parseInt(this.responseText);
    }
  };
  xhttp.open(
    "GET",
    "./files-for-main-content/no_of_popular_products.php",
    true
  );
  xhttp.send();
};
function changePassword(){
  window.location.href="http://localhost/sportshub/pages/files-for-main-content/change_password.php";
  // alert('sdf');
  // $.ajax(
  //   {
  //     url:"http://localhost/sportshub/pages/files-for-main-content/change_password.php",
      
  //     type:'GET',
  //     success:function(res){
  //       $('#for-change-password').html(res);
  //     }
  //   }
  // )
}
function loadHomePage() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./../pages/main-page.php", true);
  xhttp.send();
  loadPopularPicks();
  document
    .getElementById("Categories_navbar_options")
    .classList.remove("active_for_navbar_options");
  document
    .getElementById("home_navbar_options")
    .classList.add("active_for_navbar_options");
}
function loadPopularPicks() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open(
    "GET",
    "./files-for-main-content/fetch_for_popular_picks.php?currentPage=" + 0,
    true
  );
  xhttp.send();
}
function next() {
  if (limit > i) {
    i++;
    if (limit > i) {
      console.log(i);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("demo").innerHTML = this.responseText;
        }
      };
      xhttp.open(
        "GET",
        "./files-for-main-content/fetch_for_popular_picks.php?currentPage=" + i,
        true
      );
      xhttp.send();
    } else {
      i--;
    }
  }
}
function prev() {
  if (i >= 0) {
    if (i > 0) {
      i--;
    }
    console.log(i);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "./files-for-main-content/fetch_for_popular_picks.php?currentPage=" + i,
      true
    );
    xhttp.send();
  }
}
// function loadCategories(){
//   alert('ok');
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//     document.getElementById("main-page").innerHTML = this.responseText;
//   }
// };
// xhttp.open(
//   "GET",
//   "./../pages/for-dropdown-contents/for_list_of_categorires.php",
//   true
//   );
// xhttp.send();
// }

var previous_selected_option = "";
function setActive(id) {
  try {
    document
      .getElementById(this.previous_selected_option)
      .classList.remove("active");
  } catch (error) {}
  this.previous_selected_option = id;
  document.getElementById(id).classList.add("active");
}
function show_certain_page(page_name) {
  document
    .getElementById("home_navbar_options")
    .classList.remove("active_for_navbar_options");
  document
    .getElementById("Categories_navbar_options")
    .classList.add("active_for_navbar_options");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
      showProductsOfGivenSubcategories(page_name, "T-shirt");
    }
  };
  xhttp.open(
    "GET",
    "./../pages/show_certain_category_page.php?categoryName=" + page_name,
    true
  );
  xhttp.send();
}

function showProductsOfGivenSubcategories(categoryName, sub_categories_name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("products").innerHTML = this.responseText;
    }
  };
  xhttp.open(
    "GET",
    "./../pages/fetch_products.php?categoryName=" +
      categoryName +
      "&sub_categories_name=" +
      sub_categories_name,
    true
  );
  xhttp.send();

  let sendName = categoryName + sub_categories_name;
  setActive(sendName);
  this.previous_selected_option = sendName;
}

// addto cart function

function add_to_cart(id, name, price) {
  var productQunatity = document.getElementById("productQunatity").value;
  if( productQunatity < 1){
    alert('Quantity cannot be negative');
    document.getElementById("productQunatity").focus();
  }else{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      responseFromViewPage = this.responseText;
      if (responseFromViewPage == "not logged in") {
        location.href =
          "http://localhost/sportshub/pages/files-for-main-content/customer-login.php";
      } else {
        alert(this.responseText);
        // alert('logged in nai xa hai ')
        // document.getElementById("main-page").innerHTML = this.responseText;
      }
    }
  };
  xhttp.open(
    "get","./../pages/files-for-main-content/insert_into_cart.php?productId=" +
      id +
      "&productName=" +
      name +
      "&productQunatity=" +
      productQunatity +
      "&productPrice=" +
      price,
    true
  );
  xhttp.send();
}
}

// view cart function
function viewCart() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // checkLogin();
      responseFromViewPage = this.responseText;

      if (responseFromViewPage == "not logged in") {
        location.href ="http://localhost/sportshub/pages/files-for-main-content/customer-login.php";
      } else {
        // alert("logged in nai xa hai ");
        document.getElementById("main-page").innerHTML = this.responseText;
        
      }
    }
  };
  xhttp.open("GET", "./../pages/view_cart.php", true);
  xhttp.send();

}

// function checkLogin(){

//   // var Sessiondescription = '@Session["USER_ID"]';
//   // var Sessiondescription="<%= Session['USER_ID'] %>";
// x=  sessionStorage["USER_NAME"];
//   alert  (x);

// // alert(Sessiondescription);
// //     var session= '@Session["UserName"]';
// //     if(session!=null){
// //      //Show popup
// //     }
// //     else{
// //      //Show loginpage
// //     }

//  }


// to update the quantity of the item of the cart
function update_quantity_of_procduct(cartId,idForqty) {
  // alert("hello");
  updatedQuantity=$(`#${idForqty}`).val();
  if(updatedQuantity<=0){
    updatedQuantity=1
  }
  $.ajax({
    url: "http://localhost/sportshub/pages/files-for-main-content/update_quantity_of_procduct.php?cartId="+cartId+"&updatedQuantity="+updatedQuantity,
    type: 'GET',
    success: function(res) {
      viewCart();
    }
});
}

// to delete an item form the cart 
function delete_an_item_from_cart(cartId){
  $.ajax({
    url: "http://localhost/sportshub/pages/files-for-main-content/delete_an_item_from_cart.php?cartId="+cartId,
    type: 'GET',
    success: function() {
   viewCart();
    }
});
}

// show payment options 
function showPaymentOptions(){
  $.ajax(
    {
      url:"http://localhost/sportshub/payment/paymentMethod.php",
      
      type:'GET',
      success:function(res){
        $('#main-page').html(res);
      }
    }
  )
}


// to show online payment methods
function showOnlinePaymentMethods(){
  if($('input[name="paymentMethodOptions"]:checked').val()=='online'){
    $.ajax(
      {
        url:"http://localhost/sportshub/pages/payment/order.php",
        type:'GET',
        success:function(res){
          $('#main-page').html(res);
        }
      }
      )
    }else{
      $('#main-page').html("cashOnDelivery");
      
    }
}