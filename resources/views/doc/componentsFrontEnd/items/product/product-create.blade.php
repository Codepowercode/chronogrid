<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-create-get-started">
            <h1>product create</h1>
            <p>
                Create Products manually API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-create-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/create</code>
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
                    <td>brand</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter brand</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter description</td>
                </tr>
                <tr>
                    <td>model</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter model</td>
                </tr>
                <tr>
                    <td>model_number</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter model number</td>
                </tr>
                <tr>
                    <td>color</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter color</td>
                </tr>
                <tr>
                    <td>size</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter size</td>
                </tr>
                <tr>
                    <td>metal</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter metal</td>
                </tr>
                <tr>
                    <td>bezel_size</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter bezel size</td>
                </tr>
                <tr>
                    <td>bezel_type</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter bezel type</td>
                </tr>
                <tr>
                    <td>bezel_metal</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter bezel metal</td>
                </tr>
                <tr>
                    <td>bracelet_type</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter bracelet type</td>
                </tr>
                <tr>
                    <td>condition</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter condition ( new, used, ... )</td>
                </tr>
                <tr>
                    <td>more_condition</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter condition ( box, papers, ... )</td>
                </tr>
                <tr>
                    <td>band</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter band</td>
                </tr>
                <tr>
                    <td>dial_type</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter dial type</td>
                </tr>
                <tr>
                    <td>note</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Enter Note</td>
                </tr>
                <tr>
                    <td>price</td>
                    <td>Integer</td>
                    <td><span class="required-col">required</span></td>
                    <td>if auction "0" price product, auction "1" price auction (start price)</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter year</td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Enter quantity product how much is left</td>
                </tr>
                <tr>
                    <td>auction</td>
                    <td>Boolean</td>
                    <td><span class="required-col">required</span></td>
                    <td>auction don`t active (0), auction active (1)</td>
                </tr>
                <tr>
                    <td>images</td>
                    <td>Array</td>
                    <td><span class="required-col">required</span></td>
                    <td>many images array</td>
                </tr>

                <tr>
                    <td>
                        <hr>
                        if auction 1
                        <hr>
                    </td>
                    <td> <hr> -- <hr></td>
                    <td> <hr> -- <hr></td>
                    <td> <hr> -- <hr></td>
                </tr>
                <tr>
                    <td>auction_min_bid</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Min price bid</td>
                </tr>
                <tr>
                    <td>auction_start</td>
                    <td>Timestamp</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter start time</td>
                </tr>
                <tr>
                    <td>auction_end</td>
                    <td>Timestamp</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter end time</td>
                </tr>
                </tbody>
            </table>
            <div class="overflow-hidden content-section" id="product-create-response">
                <h2>Response Success <span class="success-response">200</span></h2>
                <pre><code class="json" style="border:1px solid grey">
        {
            "status": true,
            "message": "Successfully",
            "product": {
                "id": 6,
                "user_id": 1,
                "brand": "Rolex",
                "description": "description description",
                "model_number": "51568984",
                "model": "555",
                "color": "red",
                "size": "160",
                "metal": "gold",
                "bezel_size": "55",
                "bezel_type": "tru",
                "bezel_metal": "style",
                "bracelet_type": "cur",
                "band": "1",
                "condition": "new",
                "more_condition": "box",
                "dial_type": "11",
                "note": "text",
                "price": "1500",
                "year": "1997",
                "auction": "0",
                "updated_at": "2022-05-30T12:00:58.000000Z",
                "created_at": "2022-05-30T12:00:58.000000Z",
                "images": [
                        {
                            "id": 1,
                            "product_id": 6,
                            "path": "/storage/product/40a9d3623cc56d9678e73b2940a3f42a.jpg",
                            "status": 0,
                            "created_at": "2022-05-30T13:30:56.000000Z",
                            "updated_at": "2022-05-30T13:30:56.000000Z"
                        },
                        {
                            "id": 2,
                            "product_id": 6,
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

            <div class="overflow-hidden content-section" id="product-create-errors">
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
                        <td>status</td>
                        <td>boolean</td>
                        <td>false</td>
                    </tr>
                    <tr>
                        <td>message</td>
                        <td>string</td>
                        <td>System error</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
