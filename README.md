# product-listing-api

Each product has the following attributes:<br>
name: The name of the product (string).<br>
price: The price of the product (numeric).<br>
category: The category the product belongs to (string).<br><br>

My endpoint allows users to <br>
1. Retrieve a paginated list of products.<br>
2. Filter the products by their category.<br>
3. Sort the products by their price (ascending or descending).<br>
4. Search for products by their name.<br><br>

The response includes pagination metadata (e.g., current_page, next_page_url, etc.). <br>
<pre><code>
{
  "current_page": 2,
  "data": [
    { "id": 1, "name": "Phone A", "price": 100 },
    { "id": 2, "name": "Phone B", "price": 200 }
  ],
  "next_page_url": "http://your-app.com/products?page=3",
  "prev_page_url": "http://your-app.com/products?page=1",
  "last_page": 5,
  "per_page": 10,
  "total": 50
}
</code></pre>
