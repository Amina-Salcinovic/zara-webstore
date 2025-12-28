var CartService = {

  add: function (product) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let existing = cart.find(p => p.product_id === product.product_id);

    if (existing) {
      existing.quantity += 1;
    } else {
      cart.push({
        product_id: product.product_id,
        name: product.name,
        price: Number(product.price),
        image_url: product.image_url,
        quantity: 1
      });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    toastr.success("Product added to cart");
    CartService.render();
  },

  increaseQuantity: function (productId) {
  let cart = CartService.getAll();

  const item = cart.find(p => p.product_id === productId);
  if (item) {
    item.quantity += 1;
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  CartService.render();
},

decreaseQuantity: function (productId) {
  let cart = CartService.getAll();

  const item = cart.find(p => p.product_id === productId);
  if (item) {
    item.quantity -= 1;

    if (item.quantity <= 0) {
      cart = cart.filter(p => p.product_id !== productId);
    }
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  CartService.render();
},


  getAll: function () {
    return JSON.parse(localStorage.getItem("cart")) || [];
  },

  getTotal: function () {
    return CartService.getAll()
      .reduce((sum, p) => sum + (p.price * p.quantity), 0);
  },

  clear: function () {
    localStorage.removeItem("cart");
    CartService.render();
  },

  render: function () {
    if (!$("#cart-items").length) return;

    const cart = CartService.getAll();

    if (cart.length === 0) {
      $("#cart-items").html("<p>Your cart is empty.</p>");
      $("#cart-total").text("0 KM");
      return;
    }

    let html = "";
  cart.forEach(p => {
  html += `
    <div class="d-flex align-items-center py-4 border-bottom">

      <img src="${p.image_url}" width="90" class="me-4">

      <div class="flex-grow-1">
        <div style="font-weight:500; letter-spacing:1px;">
          ${p.name}
        </div>

        <div class="d-flex align-items-center mt-2" style="gap:10px;">
          <button class="qty-btn"
                  onclick="CartService.decreaseQuantity(${p.product_id})">−</button>

          <span style="min-width:20px; text-align:center;">
            ${p.quantity}
          </span>

          <button class="qty-btn"
                  onclick="CartService.increaseQuantity(${p.product_id})">+</button>

          <span style="margin-left:15px; color:#555;">
            ${p.price} KM
          </span>
        </div>
      </div>

      <div style="font-weight:500;">
        ${p.price * p.quantity} KM
      </div>
    </div>
  `;
});


    $("#cart-items").html(html);
   $("#cart-total").html(`
  <span style="font-size:18px; letter-spacing:1px;">
    ${CartService.getTotal()} KM
  </span>
`);

  }
  
};
