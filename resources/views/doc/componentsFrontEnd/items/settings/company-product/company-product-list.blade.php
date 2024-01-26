<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-product-list-get-started">
            <h1>Products List</h1>
            <p>
                Company products List API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-product-list-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/company/products</code>
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
                    <td>?page=1</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Add URL ( ./api/settings/company/products?page=1 )</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="company-product-list-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
{
    "status": true,
    "all_products": [
        {
            "id": 10,
            "company": {
                "id": 3,
                "name": "company",
                "email": "company@gmail.com",
                "company": "1",
                "blocked": "0",
                "info": [
                    {
                        "id": 1,
                        "user_id": 3,
                        "address1": "USA",
                        "address2": "USA",
                        "city": "washington",
                        "state": "test",
                        "postal_code": "1232512",
                        "phone_number": "+454654465465454",
                        "fax_number": "+6565656565656565",
                        "website": "https://chronogrid.com/",
                        "skype": "12315651651",
                        "cell_phone": "+156888888888888",
                        "company_type": "test",
                        "country": "test",
                        "business_type": "test",
                        "premium": "test",
                        "created_at": "2022-08-05T10:54:18.000000Z",
                        "updated_at": "2022-08-05T10:54:18.000000Z"
                    }
                ]
            },
            "brand": "Rolex",
            "description": "asdasd",
            "model_number": "234",
            "model": "32q4",
            "condition": "new",
            "more_condition": "box",
            "year": "1960",
            "quantity": "5",
            "note": "asdasdasd",
            "price": 5000,
            "auction": 0,
            "auction_price": null,
            "auction_min_bid": null,
            "auction_start": null,
            "auction_end": null,
            "status": 1,
            "blocked_product": 1,
            "status_position": null,
            "images": [
                {
                    "id": 32,
                    "product_id": 10,
                    "path": "public/storage/users/3/product/BzEmm5KBopBjMMuUwDhWubuRrvxR1L34ANKVw0LX.jpeg",
                    "status": 0,
                    "created_at": "2022-08-05T14:12:57.000000Z",
                    "updated_at": "2022-08-05T14:12:57.000000Z"
                },
                {
                    "id": 33,
                    "product_id": 10,
                    "path": "public/storage/users/3/product/BEmQjHyVCzp49MmTuGlWf3VEIVxGlpsCau5GxraX.png",
                    "status": 0,
                    "created_at": "2022-08-05T14:12:57.000000Z",
                    "updated_at": "2022-08-05T14:12:57.000000Z"
                },
                ...
            ]
        },
    ],
    "waiting_products": [
        {
            "id": 12,
            "company": {
                "id": 3,
                "name": "company",
                "email": "company@gmail.com",
                "company": "1",
                "blocked": "0",
                "info": [
                    {
                        "id": 1,
                        "user_id": 3,
                        "address1": "USA",
                        "address2": "USA",
                        "city": "washington",
                        "state": "test",
                        "postal_code": "1232512",
                        "phone_number": "+454654465465454",
                        "fax_number": "+6565656565656565",
                        "website": "https://chronogrid.com/",
                        "skype": "12315651651",
                        "cell_phone": "+156888888888888",
                        "company_type": "test",
                        "country": "test",
                        "business_type": "test",
                        "premium": "test",
                        "created_at": "2022-08-05T10:54:18.000000Z",
                        "updated_at": "2022-08-05T10:54:18.000000Z"
                    }
                ]
            },
            "brand": "Casio",
            "description": "description2",
            "model_number": "21525165",
            "model": "VH-58",
            "condition": "new",
            "more_condition": "box",
            "year": "1660",
            "quantity": "5",
            "note": "1",
            "price": 800,
            "auction": 0,
            "auction_price": null,
            "auction_min_bid": null,
            "auction_start": null,
            "auction_end": null,
            "status": 0,
            "blocked_product": 0,
            "status_position": "waiting",
            "images": [
                {
                    "id": 38,
                    "product_id": 12,
                    "path": "public/storage/users/3/product/zip/",
                    "status": 0,
                    "created_at": "2022-08-05T14:13:41.000000Z",
                    "updated_at": "2022-08-05T14:13:41.000000Z"
                }
            ]
        },

    ],
    "approved_products": [
                    ...
                    ],
    "rejected_products": [
                    ...
                    ],
    "filter": [
        "waiting",
        "approved",
        "rejected"
    ]
}

                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-product-list-errors">
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
