<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="auction-create-bid-get-started">
            <h1>auction create bid</h1>
            <p>
                Auction create bid API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="auction-create-bid-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/auction</code>
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
                    <td>price</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>New price in bid</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>boolean</td>
                    <td><span class="required-col">required</span></td>
                    <td>Status view more company [ private (1) / public (0) ]</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="auction-create-bid-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully",
        "auction": {
            "user_id": 1,
            "product_id": "2",
            "price": "2700",
            "status": "0",
            "updated_at": "2022-05-31T11:49:50.000000Z",
            "created_at": "2022-05-31T11:49:50.000000Z",
            "id": 1
        }
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="auction-create-bid-errors">
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
