<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-auctions-bidded-list-get-started">
            <h1>Bidded List</h1>
            <p>
                Company Auctions Bidded List API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-auctions-bidded-list-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/company/auctions</code>
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





        <div class="overflow-hidden content-section" id="company-auctions-bidded-list-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
{
    "status": true,
    "auction": [
        {
            "id": 1,
            "company": {
                "id": 1,
                "name": "admin",
                "email": "admin@gmail.com",
                "company": "1",
                "blocked": "0",
                "info": []
            },
            "product_id": 3,
            "price": "5000",
            "status": "public",
            "product": {
                "id": 3,
                "company": {
                    "id": 1,
                    "name": "admin",
                    "email": "admin@gmail.com",
                    "company": "0",
                    "blocked": "0",
                    "info": []
                },
                "brand": "Rolex (auction)",
                "description": "52216125",
                "model_number": "1221154",
                "model": "SF-800",
                "condition": "new",
                "more_condition": "box",
                "year": "2002",
                "quantity": null,
                "note": null,
                "price": 2600,
                "auction": 1,
                "auction_price": "2600",
                "auction_min_bid": "50",
                "auction_start": "2022-05-24 09:52:20",
                "auction_end": "2022-06-24 09:52:20",
                "status": 1,
                "images": [
                    {
                        "id": 12,
                        "product_id": 3,
                        "path": "public/test/12.jpg",
                        "status": 0,
                        "created_at": "2022-07-06T08:50:38.000000Z",
                        "updated_at": "2022-07-06T08:50:38.000000Z"
                    },
                    {
                        "id": 13,
                        "product_id": 3,
                        "path": "public/test/13.jpg",
                        "status": 0,
                        "created_at": "2022-07-06T08:50:38.000000Z",
                        "updated_at": "2022-07-06T08:50:38.000000Z"
                    },
                    {
                        "id": 14,
                        "product_id": 3,
                        "path": "public/test/14.jpg",
                        "status": 0,
                        "created_at": "2022-07-06T08:50:38.000000Z",
                        "updated_at": "2022-07-06T08:50:38.000000Z"
                    },
                ]
            }
        }
    ]
}

                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-auctions-bidded-list-errors">
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
