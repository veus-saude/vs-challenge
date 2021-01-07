import { FETCH_PRODUCTS } from "../types";
import { FILTER_PRODUCTS_BY_SIZE, ORDER_PRODUCTS_BY_PRICE } from "../types";
export const fetchProducts = () => async (dispatch) => {
  const res = await fetch("/api/v0/products");
  const data = await res.json();
  console.log(data);
  dispatch({
    type: FETCH_PRODUCTS,
    payload: data.products,
  });
};

export const filterProducts = (products, brand) => (dispatch) => {
  dispatch({
    type: FILTER_PRODUCTS_BY_SIZE,
    payload: {
      brand: brand,
      items:
        brand === ""
          ? products
          : products.filter((x) => x.availableSizes.indexOf(brand) >= 0),
    },
  });
};
export const sortProducts = (filteredProducts, sort) => (dispatch) => {
  const sortedProducts = filteredProducts.slice();
  if (sort === "latest") {
    sortedProducts.sort((a, b) => (a.id > b.id ? 1 : -1));
  } else {
    sortedProducts.sort((a, b) =>
      sort === "lowest"
        ? parseFloat(a.price) > parseFloat(b.price)
          ? 1
          : -1
        : parseFloat(a.price) > parseFloat(b.price)
        ? -1
        : 1
    );
  }
  console.log(sortedProducts);
  dispatch({
    type: ORDER_PRODUCTS_BY_PRICE,
    payload: {
      sort: sort,
      items: sortedProducts,
    },
  });
};
