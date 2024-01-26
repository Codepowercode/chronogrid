<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-get-started">
            <h1>product</h1>
            <p>
                One product API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/show/{id}</code>
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
                    <td>id</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Product id</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="product-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "id": 15,
        "company": {
            "id": 1,
            "name": "admin",
            "email": "admin@gmail.com",
            "company": "0",
            "blocked": "0"
        },
        "brand": "xiaomy",
        "description": "description description description",
        "model_number": "513215412",
        "model": "555",
        "color": "red",
        "size": "160",
        "metal": "gold",
        "bezel_size": "55",
        "bezel_type": "tru",
        "bezel_metal": "style",
        "bracelet_type": "cur",
        "condition": "new",
        "more_condition": "box",
        "band": "1",
        "dial_type": "11",
        "year": "1997",
        "quantity": null,
        "price": "1500",
        "auction": 0,
        "auction_price": null,
        "auction_min_bid": null,
        "auction_start": null,
        "auction_end": null,
        "status": 1,
        "created_at": "2022-05-30T13:30:56.000000Z",
        "updated_at": "2022-05-30T13:30:56.000000Z",
        "images": [
            {
                "id": 1,
                "product_id": 15,
                "path": "/storage/product/40a9d3623cc56d9678e73b2940a3f42a.jpg",
                "status": 0,
                "created_at": "2022-05-30T13:30:56.000000Z",
                "updated_at": "2022-05-30T13:30:56.000000Z"
            },
            {
                "id": 2,
                "product_id": 15,
                "path": "/storage/product/062916c4ad0e6897c7792e24c2c477cc.jpg",
                "status": 0,
                "created_at": "2022-05-30T13:30:56.000000Z",
                "updated_at": "2022-05-30T13:30:56.000000Z"
            },
            {
                "id": 3,
                "product_id": 15,
                "path": "/storage/product/717c52a81cc9c8f3997bf9ed98ef1404.jpg",
                "status": 0,
                "created_at": "2022-05-30T13:30:56.000000Z",
                "updated_at": "2022-05-30T13:30:56.000000Z"
            },
            {
                "id": 4,
                "product_id": 15,
                "path": "/storage/product/1c51bcef06263c23d7fc933dc4b9df72.jpg",
                "status": 0,
                "created_at": "2022-05-30T13:30:56.000000Z",
                "updated_at": "2022-05-30T13:30:56.000000Z"
            }
        ]
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="product-errors">
            <h2>Errors</h2>
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
