<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="listings-filter-type-get-started">
            <h1>listings filter types</h1>
            <p>
                Filter listings type, for left bar API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="listings-filter-type-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/listing/filter/type</code>
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

        <div class="overflow-hidden content-section" id="listings-filter-type-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <p>
                The price that is the product of the company
            </p>
            <pre><code class="json" style="border:1px solid grey">
   {
        "year": {
            "max": 1770,
            "min": 2009
        },
        "price": {
            "max": 2600,
            "min": 850
        },
        "dial": [
            "blue ",
            "black and diamond paved dial",
            "Blue dial",
            "black dial",
            ...
        ],
        "dial_markers": [
            "lumnescent hour markers",
            " diamond hour markers",
            "8 round and 2 baguette diamond hour markers",
            ...
        ],
        "bezel_material": [
            " 18K yellow gold ",
            " steel ",
            " 18K white gold ",
            ...
        ],
        "bezel_type": [
            "rotatable time lapse bezel",
            "18K yellow gold rotatable time lapse bezel",
            " bezel set with 60 baguette diamonds",
            ...
        ],
        "band_material": [
            "18K yellow gold ",
            "Steel",
            "Black Rubber Strap",
            ...
        ],
        "band_type": [
            "Oysterlock ",
            "18k yellow gold oysterlock",
            "strap",
            ...
        ],
   }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="listings-filter-type-errors">
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
