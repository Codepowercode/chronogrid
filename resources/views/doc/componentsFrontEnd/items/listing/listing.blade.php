<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="listing-get-started">
            <h1>listing</h1>
            <p>
                One listing API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="listing-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/listing/show/{id}</code>
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





        <div class="overflow-hidden content-section" id="listing-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "listing": {
            "id": 2,
            "brand": "Rolex",
            "model": "Datejust  ",
            "metal": "Steel",
            "description": "169623",
            "description1": "169623 b",
            "full_description": "Yacht Master Oyster Perpetual Lady Yacht-Master ",
            "model_text": "Yacht Master",
            "model_description": " Oyster Perpetual Lady Yacht-Master ",
            "size": "29mm",
            "bezel_material": " 18K yellow gold ",
            "bezel_type": "rotatable time lapse bezel",
            "band_material": "Steel",
            "band_type": "18k yellow gold oysterlock",
            "dial": "blue ",
            "dial_markers": "lumnescent hour markers",
            "retail": "11500",
            "path": "/storage/unzip/images/169623b.jpg",
            "year": null
        },
        "products": [
            {
                "id": 1,
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
                            "created_at": "2022-06-28T08:49:07.000000Z",
                            "updated_at": "2022-06-28T08:49:07.000000Z"
                        }
                    ]
                },
                "brand": "Casio",
                "description": "15213215",
                "model_number": "169623",
                "model": "Daytona Yellow Gold",
                "condition": "used",
                "more_condition": "papers & box",
                "year": "1995",
                "quantity": null,
                "note": null,
                "price": 1500,
                "auction": 0,
                "auction_price": null,
                "auction_min_bid": null,
                "auction_start": null,
                "auction_end": null,
                "status": 1,
                "images": [
                    {
                        "id": 1,
                        "product_id": 1,
                        "path": "public/test/1.jpg",
                        "status": 0,
                        "created_at": "2022-06-28T08:49:07.000000Z",
                        "updated_at": "2022-06-28T08:49:07.000000Z"
                    },
                    {
                        "id": 2,
                        "product_id": 1,
                        "path": "public/test/2.jpg",
                        "status": 0,
                        "created_at": "2022-06-28T08:49:07.000000Z",
                        "updated_at": "2022-06-28T08:49:07.000000Z"
                    },
                    {
                        "id": 3,
                        "product_id": 1,
                        "path": "public/test/3.jpg",
                        "status": 0,
                        "created_at": "2022-06-28T08:49:07.000000Z",
                        "updated_at": "2022-06-28T08:49:07.000000Z"
                    },
                ]
            },
        ],
        "lowPrice": 850,
        "avgTotal": 1650,
        "avgPapersBoxTotal": 2050,
        "avgPapersTotal": 1175,
        "avgBoxTotal": 1833.33
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="listing-errors">
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
