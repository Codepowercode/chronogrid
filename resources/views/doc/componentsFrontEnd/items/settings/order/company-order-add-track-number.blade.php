<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="add-track-number-get-started">
            <h1>Add track number</h1>
            <p>
                Company order Add track number API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="add-track-number-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/orders/update/{id}</code>
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
                    <td>Order id in url</td>
                </tr>
                <tr>
                    <td>track_number</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Track number</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="add-track-number-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="add-track-number-errors">
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
