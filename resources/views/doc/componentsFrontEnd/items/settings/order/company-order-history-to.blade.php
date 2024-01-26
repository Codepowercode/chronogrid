<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-order-history-to-get-started">
            <h1>Order to, history</h1>
            <p>
                Company order history to API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-order-history-to-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/orders/buy/to/history</code>
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
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="company-order-history-to-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
{
    "status": true,
    "orders": [
        {
            "id": 1,
            "product_id": 1,
            "buyer_id": 1,
            "seller_id": 3,
            "quantity": "1",
            "price": "2000",
            "track_number": null,
            "delivery": "canceled",
            "history": null,
            "status": "0",
            "canceled_user_id": null,
            "created_at": null,
            "updated_at": null,
            "product": {
                "id": 1,
                "user_id": 1,
                "brand": "Casio",
                "description": "15213215",
                "model_number": "887451221",
                "model": "Daytona Yellow Gold",
                "color": "red",
                "size": "150",
                "metal": "stile",
                "condition": "used",
                "more_condition": "papers",
                "year": "1995",
                "bezel_size": "145",
                "bezel_type": "mura",
                "bezel_metal": "gold",
                "bracelet_type": "metalic",
                "band": "mard",
                "dial_type": "firu",
                "note": null,
                "price": 1500,
                "quantity": null,
                "auction": 0,
                "auction_price": null,
                "auction_min_bid": null,
                "auction_start": null,
                "auction_end": null,
                "auction_status_finish": 0,
                "status": 1,
                "created_at": "2022-07-06T08:50:38.000000Z",
                "updated_at": "2022-07-06T08:50:38.000000Z"
            }
        }
    ]
}

                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-order-history-to-errors">
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
