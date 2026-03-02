<template>
<div class="container">

<h2>Create Order</h2>

<!-- ORDER FORM -->
<div>
    <label>Product</label>
    <select v-model="productId">
        <option v-for="p in products" :key="p.id" :value="p.id">
            {{ p.name }} - {{ p.base_price }}
        </option>
    </select>

    <label>Quantity</label>
    <input type="number" v-model.number="quantity" min="1" />
</div>

<!-- REAL TIME SUMMARY -->
<h3>Order Summary</h3>
<div v-if="selectedProduct">
    <p>Subtotal: {{ subtotal.toFixed(2) }}</p>
    <p>Discount: {{ discount.toFixed(2) }}</p>
    <p>Tax: {{ tax.toFixed(2) }}</p>
    <h4>Total: {{ total.toFixed(2) }}</h4>
</div>

<button @click="submitOrder">Submit Order</button>

<hr>

<!-- ORDER HISTORY -->
<h2>Order History</h2>

<table border="1">
<thead>
<tr>
<th>ID</th>
<th>Product</th>
<th>Qty</th>
<th>Total</th>
</tr>
</thead>

<tbody>
<tr v-for="order in orders" :key="order.id">
<td>{{ order.id }}</td>
<td>{{ order.product.name }}</td>
<td>{{ order.quantity }}</td>
<td>{{ order.total_price }}</td>
</tr>
</tbody>
</table>

</div>
</template>

<script>
import axios from "axios"

export default {
data() {
    return {
        products: [],
        orders: [],
        productId: null,
        quantity: 1,
        taxRates: {
            Electronics: 0.15,
            Office: 0.05,
            Default: 0.10
        }
    }
},

computed: {

selectedProduct() {
    return this.products.find(p => p.id == this.productId)
},

subtotal() {
    if (!this.selectedProduct) return 0
    return this.selectedProduct.base_price * this.quantity
},

discount() {
    return this.quantity > 10 ? this.subtotal * 0.10 : 0
},

tax() {
    if (!this.selectedProduct) return 0

    let rate =
        this.taxRates[this.selectedProduct.category]
        ?? this.taxRates.Default

    return (this.subtotal - this.discount) * rate
},

total() {
    return (this.subtotal - this.discount) + this.tax
}
},

methods: {

async loadProducts() {
    const res = await axios.get('/api/products')
    this.products = res.data
},

async loadOrders() {
    const res = await axios.get('/api/orders')
    this.orders = res.data
},

async submitOrder() {
    await axios.post('/api/orders', {
        product_id: this.productId,
        quantity: this.quantity
    })

    alert("Order Saved!")

    this.loadOrders()
}
},

mounted() {
    this.loadProducts()
    this.loadOrders()
}
}
</script>