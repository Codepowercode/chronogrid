<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-create-order-get-started">
            <h1>Order Create</h1>
            <p>
                Order Create API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-create-order-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/order/create</code>
            </p>
            <br>
            <h4>QUERY PARAMETERS</h4>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Importance</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>access_token</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Your API access key. (header)</td>
                </tr>
                <tr>
                    <td>product_id</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Product id</td>
                </tr>
                <tr>
                    <td>seller_id</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Company id who created this product</td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Quantity</td>
                </tr>
                <tr>
                    <td>price</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Price product</td>
                </tr>
                </tbody>
            </table>
<pre><code class="json" style="float: right; margin-top: -242px;border: 1px solid grey; width: 207px;">
<span style="text-align: center;display: block;margin-top: -10px;margin-bottom: -17px;color: #56ff00">['how to send in backend']</span>
<hr>
{
    [
      product_id: 1,
      seller_id: 1,
      quantity: 2,
      price: '1500',
    ],
    [
      product_id: 5,
      seller_id: 3,
      quantity: 1,
      price: '3700',
    ],
    ...
}
</code></pre>
        </div>





        <div class="overflow-hidden content-section" id="company-create-order-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      "status": true,
      "message": "Successfully",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-create-order-errors">
            <h2>Errors</h2>
{{--            <p>--}}
{{--                The Westeros API uses the following error codes:--}}
{{--            </p>--}}
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
