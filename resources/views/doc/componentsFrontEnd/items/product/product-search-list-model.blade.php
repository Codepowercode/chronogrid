<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-search-list-model-get-started">
            <h1>product search list model</h1>
            <p>
                Product create, search list model API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-search-list-model-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/list/model</code>
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
                    <td>model</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Model number</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="product-search-list-model-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
{
     "list": [
        {
            "id": 1,
            "brand": "Rolex",
            "model": "Datejust ",
            "metal": "Steel",
            "description": "169628",
            "description1": "169628 b",
            "full_description": "Yacht Master Oyster Perpetual Lady Yacht-Master ",
            "model_text": "Yacht Master",
            "model_description": " Oyster Perpetual Lady Yacht-Master ",
            "size": "29mm",
            "bezel_material": " 18K yellow gold ",
            "bezel_type": "rotatable time lapse bezel",
            "band_material": "18K yellow gold ",
            "band_type": "Oysterlock ",
            "dial": "blue ",
            "dial_markers": "lumnescent hour markers",
            "retail": "9550",
            "path": "/public/storage/unzip/2BLDC.B38A.K66N.jpg",
            "year": null,
            "hash": "05fe1ef44672d21817d2a578e6591f78",
            "json": "{\"brand\":\"Rolex\",\"model\":\"Datejust \",\"metal\":\"Steel\",\"size\":\"29mm\",\"bezel_material\"" 18K yellow gold \",\"bezel_type\":\"rotatable time lapse bezel\"}",
            "created_at": "2022-07-21T13:57:24.000000Z",
            "updated_at": "2022-07-21T13:57:24.000000Z"
        }
        ...
    ]
}
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="product-search-list-model-errors">
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
