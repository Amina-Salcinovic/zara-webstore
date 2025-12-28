var FavoritesService = {
  add: function (productId) {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

    if (!favorites.includes(productId)) {
      favorites.push(productId);
      localStorage.setItem("favorites", JSON.stringify(favorites));
      toastr.success("Added to favorites");
    } else {
      toastr.info("Already in favorites");
    }
  },

  getAll: function () {
    return JSON.parse(localStorage.getItem("favorites")) || [];
  },

  remove: function (productId) {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    favorites = favorites.filter(id => id !== productId);
    localStorage.setItem("favorites", JSON.stringify(favorites));
  }
};
