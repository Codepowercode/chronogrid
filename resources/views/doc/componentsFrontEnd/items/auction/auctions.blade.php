<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="auctions-get-started">
            <h1>auctions</h1>
            <p>
                All auctions API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="auctions-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/auction/list</code>
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
                    <td>pages</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line or product count, default 9 product</td>
                </tr>
                </tbody>
            </table>
            <div class="overflow-hidden content-section" id="auctions-response">
                <h2>Response Success <span class="success-response">200</span></h2>
                <pre><code class="json" style="border:1px solid grey">
    {
        {
            "id": 1,
            "company": {
                "id": 1,
                "name": "admin",
                "email": "admin@gmail.com",
                "company": "0",
                "blocked": "0"
            },
            "brand": "Casio",
            "description": "description description description",
            "model_number": "115612231",
            "model": "1231",
            "condition": "New",
            "more_condition": "Box",
            "year": "1960",
            "quantity": "2",
            "price": "1500",
            "auction": 1,
            "auction_price": 2000,
            "auction_min_bid": 100,
            "auction_start": "2022-05-24 09:52:20",
            "auction_end": "2022-06-24 09:52:20",
            "status": 1,
            "images": [
                {
                    "id": 6,
                    "product_id": 1,
                    "path": "/storage/product/40a9d3623cc56d9678e73b2940a3f42a.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
                {
                    "id": 7,
                    "product_id": 1,
                    "path": "/storage/product/062916c4ad0e6897c7792e24c2c477cc.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
            ]
        },
        {
            "id": 2,
            "company": {
                "id": 1,
                "name": "admin",
                "email": "admin@gmail.com",
                "company": "0",
                "blocked": "0"
            },
            "brand": "Rolex",
            "description": "description description description",
            "model": "12311",
            "condition": "Used",
            "more_condition": "Papers",
            "year": "1960",
            "quantity": "2",
            "price": "2600",
            "auction": 1,
            "auction_price": "2600",
            "auction_min_bid": "50",
            "auction_start": "2022-05-24 09:52:20",
            "auction_end": "2022-06-24 09:52:20",
            "status": 1,
            "images": [
                {
                    "id": 4,
                    "product_id": 2,
                    "path": "/storage/product/40a9d3623cc56d9678e73b2940a3f42a.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
                {
                    "id": 5,
                    "product_id": 2,
                    "path": "/storage/product/062916c4ad0e6897c7792e24c2c477cc.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
            ]
        }
    }
                </code></pre>
            </div>

            <div class="overflow-hidden content-section" id="auctions-errors">
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
</div>
