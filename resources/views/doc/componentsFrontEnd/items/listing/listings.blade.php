<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="listings-get-started">
            <h1>listings</h1>
            <p>
                All listings API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="listings-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/listing</code>
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
            <div class="overflow-hidden content-section" id="listings-response">
                <h2>Response Success <span class="success-response">200</span></h2>
                <pre><code class="json" style="border:1px solid grey">
    {
        {
            "id": 1792,
            "brand": "Rolex",
            "description": "278384rbr",
            "model": "Datejust",
            "year": null,
            "images": "",
            "count_product": 1,
            "min_price_product": 2600
        },
        {
            "id": 2048,
            "brand": "Rolex",
            "description": "126301",
            "model": "Datejust",
            "year": null,
            "images": "",
            "count_product": 0,
            "min_price_product": null
        },
    }
                </code></pre>
            </div>

            <div class="overflow-hidden content-section" id="listings-errors">
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
