function add_to_cart(product_id, count) {
    if (localStorage.getItem("cart_products") == null || localStorage.getItem("cart_products") == 'null') {
        localStorage.setItem("cart_products", JSON.stringify([]));
    }
    let cart = JSON.parse(localStorage.getItem("cart_products"));
    const index = cart.findIndex(product => {
        return product.product_id == product_id;
    });
    if (index > -1) {
        cart[index].count += count;
    } else {
        cart.push({"product_id": product_id, "count": count});
    }
    localStorage.setItem("cart_products", JSON.stringify(cart));
    document.querySelector("#items-in-cart").innerHTML = Number(document.querySelector("#items-in-cart").innerHTML) + Number(count);
}
