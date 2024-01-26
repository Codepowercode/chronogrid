<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="products-filter-type-get-started">
            <h1>products filter types</h1>
            <p>
                Filter Products type, for left bar API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="products-filter-type-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/filter/type</code>
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

        <div class="overflow-hidden content-section" id="products-filter-type-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
   {
    "year": {
        "max": "2009",
        "min": "1995"
    },
    "price": {
        "max": "2600",
        "min": "1500"
    }
   }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="products-filter-type-errors">
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
