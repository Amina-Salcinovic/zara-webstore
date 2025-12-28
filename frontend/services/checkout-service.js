var CheckoutService = {

  init: function () {
    CheckoutService.render();
    CheckoutService.bindSubmit();
  },

  render: function () {
    if (!$("#checkout-items").length) return;

    const cart = CartService.getAll();

    if (cart.length === 0) {
      $("#checkout-items").html("<p>Your cart is empty.</p>");
      $("#checkout-subtotal").text("0 KM");
      $("#checkout-total").text("0 KM");
      return;
    }

    let subtotal = 0;
    let html = "";

    cart.forEach(p => {
      subtotal += p.price * p.quantity;

      html += `
        <div class="d-flex justify-content-between mb-2">
          <span>${p.name} × ${p.quantity}</span>
          <span>${p.price * p.quantity} KM</span>
        </div>
      `;
    });

    $("#checkout-items").html(html);
    $("#checkout-subtotal").text(subtotal + " KM");
    $("#checkout-total").text(subtotal + " KM");
  },

  bindSubmit: function () {
    $("#place-order-btn").off("click").on("click", function () {
      CheckoutService.placeOrder();
    });
  },

  placeOrder: function () {
    const cart = CartService.getAll();

    if (cart.length === 0) {
      toastr.error("Your cart is empty");
      return;
    }

    toastr.success("Order placed successfully!");

    CartService.clear();
    window.location.hash = "#shop";
  }
};
