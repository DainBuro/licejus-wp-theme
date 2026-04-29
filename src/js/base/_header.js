document.addEventListener("DOMContentLoaded", function () {
  // header actions
  var searchWrapper = document.getElementById("search-wrapper");
  var searchBar = document.getElementById("search-bar");
  var searchButton = document.getElementById("search-button");
  var closeButton = document.getElementById("close-search-button");
  var input = document.getElementById("search-bar__input");
  var headerMenuToggle = document.getElementById("header-menu-toggle");
  var expandableMenu = document.getElementById("bottom-part");

  searchWrapper.addEventListener("click", function () {
    if (!searchBar.classList.contains("is-active")) {
      searchBar.classList.toggle("is-active");
      searchButton.classList.toggle("is-active");
    }
    input.focus();
  });

  closeButton.addEventListener("click", function (e) {
    e.stopPropagation();
    searchBar.classList.remove("is-active");
    searchButton.classList.remove("is-active");
  });

  document.addEventListener("click", function (e) {
    if (!searchWrapper.contains(e.target)) {
      searchBar.classList.remove("is-active");
      searchButton.classList.remove("is-active");
    }
  });

  headerMenuToggle.addEventListener("click", function () {
    if (!headerMenuToggle.classList.contains("is-active")) {
      headerMenuToggle.classList.toggle("is-active");
      expandableMenu.classList.toggle("is-active");
    } else {
      headerMenuToggle.classList.remove("is-active");
      expandableMenu.classList.remove("is-active");
    }
  });
});
