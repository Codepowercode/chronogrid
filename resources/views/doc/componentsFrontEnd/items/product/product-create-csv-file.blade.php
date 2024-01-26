<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-create-csv-file-get-started">
            <h1>Product create excel file</h1>
            <p>
                Create product in excel file API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-create-csv-file-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/create/csv</code>
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
                    <td>import_file</td>
                    <td>file</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Excel file</td>
                </tr>
                <tr>
                    <td>import_file_zip</td>
                    <td>file</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Zip file</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="product-create-csv-file-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      "status": true,
      "message": "Successfully excel",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="product-create-csv-file-errors">
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
