<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-delete-one-image-get-started">
            <h1>Product delete one image</h1>
            <p>
                Product delete one image in update or more page API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-delete-one-image-get-characters">
            <h2><span class="request-method">delete</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/delete/one/{id}</code>
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
                    <td>Product id in url</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="product-delete-one-image-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully deleted",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="product-delete-one-image-errors">
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
