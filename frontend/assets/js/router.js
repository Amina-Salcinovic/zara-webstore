var app = $.spapp({
    defaultView  : "#home",
    templateDir  : "./pages/"
  });

// app.route({ view: 'cart', load: 'cart.html'}); 
// app.route({ view: 'checkout', load: 'checkout.html'}); 
// app.route({ view: 'contact', load: 'contact.html'}); 
// app.route({ view: 'detail', load: 'detail.html'}); 
// app.route({ view: 'shop', load: 'shop.html'}); 

app.run(); 